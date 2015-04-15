<?php
/*
 * @package     Joomla.Framework
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license	GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @component Lectures Events
 * @copyright Copyright (C) Fabricio Farias www.isgh.org.br
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License version 2 or later;
 */

defined( '_JEXEC' ) or die();
jimport('joomla.application.component.modeladmin');


class LecturesEventsCpModelLecturesEventsLoc extends JModelAdmin
{

	protected	$option 		= 'com_lecturesevents';
	protected 	$text_prefix	= 'com_lecturesevents';
	
	
	protected function canDelete($record)
	{
		$user = JFactory::getUser();

		if ($record->id) {
			return $user->authorise('core.delete', 'com_lecturesevents.lectureseventsloc.'.(int) $record->id);
		} else {
			return parent::canDelete($record);
		}
	}
	
	protected function canEditState($record)
	{
		$user = JFactory::getUser();

		if ($record->id) {
			return $user->authorise('core.edit.state', 'com_lecturesevents.lectureseventsloc.'.(int) $record->id);
		} else {
			return parent::canEditState($record);
		}
	}
	
	public function getTable($type = 'LecturesEventsLoc', $prefix = 'Table', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true) {
		
		$app	= JFactory::getApplication();
		$form 	= $this->loadForm('com_lecturesevents.lectureseventsloc', 'lectureseventsloc', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_lecturesevents.edit.lectureseventsloc.data', array());

		if (empty($data)) {
			$data = $this->getItem();
		}

		return $data;
	}
	
	public function getItem($pk = null)
	{
		if ($item = parent::getItem($pk)) {
			// Convert the params field to an array.
			$registry = new JRegistry;
			$registry->loadJSON($item->metadata);
			$item->metadata = $registry->toArray();
		}

		return $item;
	}
	
	protected function prepareTable(&$table)
	{
		jimport('joomla.filter.output');
		$date = JFactory::getDate();
		$user = JFactory::getUser();

		$table->title		= htmlspecialchars_decode($table->title, ENT_QUOTES);
		$table->alias		= JApplication::stringURLSafe($table->alias);

		if (empty($table->alias)) {
			$table->alias = JApplication::stringURLSafe($table->title);
		}

		if (empty($table->id)) {
			// Set the values
			//$table->created	= $date->toMySQL();

			// Set ordering to the last item if not set
			if (empty($table->ordering)) {
				$db = JFactory::getDbo();
				$db->setQuery('SELECT MAX(ordering) FROM #__lecturesevents_locations');
				$max = $db->loadResult();

				$table->ordering = $max+1;
			}
		}
		else {
			// Set the values
			//$table->modified	= $date->toMySQL();
			//$table->modified_by	= $user->get('id');
		}
	}
	
	
	/*
	 * Custom Save method - libraries/joomla/application/component/modeladmin.php
	 */
	public function save($data)
	{
            
		
		// = = = = = = = = = = 
		// Default VALUES FOR Rights in FRONTEND
		// ACCESS -  0: all users can see the category (registered or not registered)
		//             if registered or not registered it will be set in ACCESS LEVEL not here)
		//			   if -1 - user was not selected so every registered or special users can see category
		// UPLOAD - -2: nobody can upload or add images in front (if 0 - every users can do it)
		// DELETE - -2: nobody can upload or add images in front (if 0 - every users can do it)
		if(!isset($data['accessuserid'])) { $data['accessuserid'] = array();}
		if(!isset($data['uploaduserid'])) { $data['uploaduserid'] = array();}
		if(!isset($data['deleteuserid'])) { $data['deleteuserid'] = array();}
		$accessUserIdArray	= LecturesEventsHelper::toArray($data['accessuserid']);
		$uploadUserIdArray	= LecturesEventsHelper::toArray($data['uploaduserid']);
		$deleteUserIdArray	= LecturesEventsHelper::toArray($data['deleteuserid']);

		if (isset($data['access']) && (int)$data['access'] > 0 && (int)$accessUserIdArray[0] == 0) {		
			$accessUserId[0]	= -1;
		}
		$data['accessuserid'] = implode(',',$accessUserIdArray);
		$data['uploaduserid'] = implode(',',$uploadUserIdArray);
		$data['deleteuserid'] = implode(',',$deleteUserIdArray);
	
		// = = = = = = = = = = 
		
		
		// Initialise variables;
		$dispatcher = JDispatcher::getInstance();
		$table		= $this->getTable();
                
		$pk			= (!empty($data['id'])) ? $data['id'] : (int)$this->getState($this->getName().'.id');
		$isNew		= true;

		// Include the content plugins for the on save events.
		JPluginHelper::importPlugin('content');

		// Load the row if saving an existing record.
		if ($pk > 0) {
			$table->load($pk);
			$isNew = false;
		}

		// Bind the data.
		if (!$table->bind($data)) {
			$this->setError($table->getError());
			return false;
		}
		
		if(intval($table->date) == 0) {
			$table->date = JFactory::getDate()->toMySQL();
		}

		// Prepare the row for saving
		$this->prepareTable($table);

		// Check the data.
		if (!$table->check()) {
			$this->setError($table->getError());
			return false;
		}

		// Trigger the onContentBeforeSave event.
		/*$result = $dispatcher->trigger($this->event_before_save, array($this->option.'.'.$this->name, $table, $isNew));
		if (in_array(false, $result, true)) {
			$this->setError($table->getError());
			return false;
		}*/

		// Store the data.
		if (!$table->store()) {
			$this->setError($table->getError());
			return false;
		}

		// Clean the cache.
		$cache = JFactory::getCache($this->option);
		$cache->clean();

		// Trigger the onContentAfterSave event.
		//$dispatcher->trigger($this->event_after_save, array($this->option.'.'.$this->name, $table, $isNew));

		$pkName = $table->getKeyName();
		if (isset($table->$pkName)) {
			$this->setState($this->getName().'.id', $table->$pkName);
		}
		$this->setState($this->getName().'.new', $isNew);

		
		
		return true;
	}
	
	
	
	function delete($cid = array()) {
		$app	= JFactory::getApplication();
		$db 	= JFactory::getDBO();
		
		$result = false;
		if (count( $cid )) {
			JArrayHelper::toInteger($cid);
			
			$cids = implode( ',', $cid );
                        $query = 'DELETE FROM #__lecturesevents_locations'
                        . ' WHERE id IN ( '.$cids.' )';
                        $db->setQuery( $query );
                        if (!$db->query()) {
                                $this->setError($this->_db->getErrorMsg());
                                return false;
                        }
			
                        $link = 'index.php?option=com_lecturesevents&view=lectureseventslocs';
                        $app->redirect($link, $msg);
			
		}
		return true;
	}
	
	
	public function increaseOrdering($id) {
		
		$ordering = 1;
		$this->_db->setQuery('SELECT MAX(ordering) FROM #__lecturesevents_locations WHERE id='.(int)$id);
		$max = $this->_db->loadResult();
		$ordering = $max + 1;
		return $ordering;
	}
	
}
?>