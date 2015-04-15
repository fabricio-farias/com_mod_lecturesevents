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

class  LecturesEventsCpViewLecturesEventsinfo extends JView
{
	public $tmpl;
	
	function display($tpl = null) {
		
		JHTML::stylesheet( 'administrator/components/com_lecturesevents/assets/lecturesevents.css' );
		$this->tmpl['version'] = LecturesEventsHelper::getPhocaVersion();
		$this->addToolbar();
		parent::display($tpl);
	}
	
	protected function addToolbar() {
		JToolBarHelper::title( JText::_( 'COM_LECTURESEVENTS_PD_INFO' ), 'info.png' );
		JToolBarHelper::cancel( 'cancel', 'COM_LECTURESEVENTS_CLOSE' );
		JToolBarHelper::divider();
		JToolBarHelper::help( 'screen.lecturesevents', true );
	}
}
?>
