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
jimport('joomla.application.component.controllerform');

class LecturesEventsCpControllerLecturesEventsCase extends JControllerForm
{
	protected	$option 		= 'com_lecturesevents';
	
	function __construct($config=array()) {
		
		parent::__construct($config);
		
		$task = JRequest::getVar('task');
		if ((string)$task == 'addtext') {
			JRequest::setVar('task','add');
			JRequest::setVar('layout','edit_text');
		}
	}
	
	protected function allowAdd($data = array()) {
		$user		= JFactory::getUser();
		$allow		= null;
		$allow	= $user->authorise('core.create', 'com_lecturesevents');
		if ($allow === null) {
			return parent::allowAdd($data);
		} else {
			return $allow;
		}
	}

	protected function allowEdit($data = array(), $key = 'id') {
		$user		= JFactory::getUser();
		$allow		= null;
		$allow	= $user->authorise('core.edit', 'com_lecturesevents');
		if ($allow === null) {
			return parent::allowEdit($data, $key);
		} else {
			return $allow;
		}
	}
	
	public function batch() {
		JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Set the model
		$model	= $this->getModel('lectureseventscase', '', array());

		// Preset the redirect
		$this->setRedirect(JRoute::_('index.php?option=com_lecturesevents&view=lectureseventscases'.$this->getRedirectToListAppend(), false));

		return parent::batch($model);
	}
	
	/*
	function copyquick() {
		$cid	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$model	= $this->getModel( 'lectureseventsfile' );
		if ($model->copyQuick($cid)) {
			$msg = JText::_( 'COM_PHOCADOWNLOAD_SUCCESS_COPY_FILE' );
		} else {
			$msg = JText::_( 'COM_PHOCADOWNLOAD_ERROR_COPY_FILE' );
		}
		$link = 'index.php?option=com_lecturesevents&view=lectureseventscases';
		$this->setRedirect($link, $msg);
	}*/

}
?>
