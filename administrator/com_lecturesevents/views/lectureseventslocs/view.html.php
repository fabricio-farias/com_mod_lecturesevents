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

class LecturesEventsCpViewLecturesEventsLocs extends JView
{
	protected $items;
	protected $pagination;
	protected $state;
	protected $tmpl;
	//protected $_context 	= 'com_lecturesevents.lectureseventsc';

	function display($tpl = null) {
	
	
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		
		JHTML::stylesheet('administrator/components/com_lecturesevents/assets/lecturesevents.css' );
		
		$params 	= JComponentHelper::getParams('com_lecturesevents');

		$this->addToolbar();
		parent::display($tpl);
	}
	
	protected function addToolbar() {
		
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'lectureseventslocs.php';

		$state	= $this->get('State');
		$canDo	= LecturesEventsLocsHelper::getActions($state->get('filter.id'));
		
		JToolBarHelper::title( JText::_( 'COM_LECTURESEVENTS_LOCATIONS' ), 'location.png' );
		if ($canDo->get('core.create')) {
			JToolBarHelper::addNew('lectureseventsloc.add','JTOOLBAR_NEW');
		}
		if ($canDo->get('core.edit')) {
			JToolBarHelper::editList('lectureseventsloc.edit','JTOOLBAR_EDIT');
		}
		if ($canDo->get('core.edit.state')) {

			JToolBarHelper::divider();
			JToolBarHelper::custom('lectureseventslocs.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
			JToolBarHelper::custom('lectureseventslocs.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
		}

		if ($canDo->get('core.delete')) {
			JToolBarHelper::deleteList( JText::_( 'COM_LECTURESEVENTS_WARNING_DELETE_ITEMS' ), 'lectureseventslocs.delete', 'COM_LECTURESEVENTS_DELETE');
		}
		JToolBarHelper::divider();
		JToolBarHelper::help( 'screen.lecturesevents', true );
	}
}
?>