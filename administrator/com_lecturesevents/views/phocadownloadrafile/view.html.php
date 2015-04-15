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
defined('_JEXEC') or die();
jimport( 'joomla.application.component.view' );
 
class LecturesEventsCpViewLecturesEventsRaFile extends JView
{
	protected $items;
	protected $pagination;
	protected $state;
	

	function display($tpl = null) {
		
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

		JHTML::stylesheet('administrator/components/com_lecturesevents/assets/lecturesevents.css' );
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		$this->addToolbar();
		parent::display($tpl);
		
	}
		

	function addToolbar() {
	
		require_once JPATH_COMPONENT.'/helpers/lectureseventsrafile.php';
	
		$state	= $this->get('State');
		$canDo	= LecturesEventsRaFileHelper::getActions($state->get('filter.category_id'));
	
		JToolBarHelper::title( JText::_( 'COM_LECTURESEVENTS_FILE_RATING' ), 'vote-file.png' );
		
		if ($canDo->get('core.delete')) {
			JToolBarHelper::deleteList(  JText::_( 'COM_LECTURESEVENTS_WARNING_DELETE_ITEMS' ), 'lectureseventsrafile.delete', 'COM_LECTURESEVENTS_DELETE');
		}
		JToolBarHelper::divider();
		JToolBarHelper::help( 'screen.lecturesevents', true );
	}
}
?>