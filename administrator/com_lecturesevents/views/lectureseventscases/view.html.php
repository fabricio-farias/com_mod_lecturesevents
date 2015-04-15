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
jimport( 'joomla.application.component.view' );
 
class LecturesEventsCpViewLecturesEventsCases extends JView
{

	protected $items;
	protected $pagination;
	protected $state;
	protected $tmpl;
	
	function display($tpl = null) {
		
		
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

		
		JHTML::stylesheet('administrator/components/com_lecturesevents/assets/lecturesevents.css' );

		$this->tmpl['notapproved'] 	= & $this->get( 'NotApprovedFile' );
	
		$this->addToolbar();
		parent::display($tpl);
	}
	

	
	protected function addToolbar() {
            
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'lectureseventscases.php';

		$state	= $this->get('State');
                $canDo = LecturesEventsCasesHelper::getActions($state->get('filter.case_id'));

		JToolBarHelper::title( JText::_('COM_LECTURESEVENTS_CASES'), 'cases.png' );
		if ($canDo->get('core.create')) {
			JToolBarHelper::addNew( 'lectureseventscase.add','JTOOLBAR_NEW');
			JToolBarHelper::addNew( 'lectureseventscase.addtext','COM_LECTURESEVENTS_ADD_TEXT');
		}
		if ($canDo->get('core.edit')) {
			JToolBarHelper::editList('lectureseventscase.edit','JTOOLBAR_EDIT');
		}
		
		if ($canDo->get('core.create')) {
			//JToolBarHelper::divider();
			//JToolBarHelper::custom( 'lectureseventscase.copyquick','copy.png', '', 'COM_LECTURESEVENTS_QUICK_COPY', true);
			//JToolBarHelper::custom( 'lectureseventscase.copy','copy.png', '', 'COM_LECTURESEVENTS_COPY', true);
		}
		
		if ($canDo->get('core.edit.state')) {

			JToolBarHelper::divider();
			JToolBarHelper::custom('lectureseventscases.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
			JToolBarHelper::custom('lectureseventscases.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
		}

		if ($canDo->get('core.delete')) {
			JToolBarHelper::deleteList( JText::_( 'COM_LECTURESEVENTS_WARNING_DELETE_ITEMS' ), 'lectureseventscases.delete', 'COM_LECTURESEVENTS_DELETE');
		}
		JToolBarHelper::divider();
		JToolBarHelper::help( 'screen.lecturesevents', true );
	}
	
}
?>