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

class LecturesEventsCpViewLecturesEventsCase extends JView
{
	protected $state;
	protected $item;
	protected $form;
	protected $tmpl;
	
	
	public function display($tpl = null) {
		
		$this->state	= $this->get('State');
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		
		JHTML::stylesheet('administrator/components/com_lecturesevents/assets/lecturesevents.css' );
		
		if (isset($this->item->textonly) && (int)$this->item->textonly == 1 && JRequest::getVar('layout') != 'edit_text') {
			$tpl = 'text';
		}
		
		$this->addToolbar();
		parent::display($tpl);
	}
	
	
	
	
	protected function addToolbar() {
		
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'lectureseventscases.php';
                
		JRequest::setVar('hidemainmenu', true);
		$bar 		= JToolBar::getInstance('toolbar');
		$user		= JFactory::getUser();
		$isNew		= ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		$canDo		= LecturesEventsCasesHelper::getActions($this->state->get('filter.case_id'), $this->item->id);
		$paramsC 	= JComponentHelper::getParams('com_lecturesevents');

		

		$text = $isNew ? JText::_( 'COM_LECTURESEVENTS_NEW' ) : JText::_('COM_LECTURESEVENTS_EDIT');
		
                JToolBarHelper::title(   JText::_( 'COM_LECTURESEVENTS_CASE' ).': <small><small>[ ' . $text.' ]</small></small>' , 'cases');

		// If not checked out, can save the item.
		if (!$checkedOut && $canDo->get('core.edit')){
			JToolBarHelper::apply('lectureseventscase.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('lectureseventscase.save', 'JTOOLBAR_SAVE');
			JToolBarHelper::addNew('lectureseventscase.save2new', 'JTOOLBAR_SAVE_AND_NEW');
		
		}
		// If an existing item, can save to a copy.
		if (!$isNew && $canDo->get('core.create')) {
			//JToolBarHelper::custom('lectureseventsc.save2copy', 'copy.png', 'copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
		}
		if (empty($this->item->id))  {
			JToolBarHelper::cancel('lectureseventscase.cancel', 'JTOOLBAR_CANCEL');
		}
		else {
			JToolBarHelper::cancel('lectureseventscase.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolBarHelper::divider();
		JToolBarHelper::help( 'screen.lecturesevents', true );
	}
}
?>
