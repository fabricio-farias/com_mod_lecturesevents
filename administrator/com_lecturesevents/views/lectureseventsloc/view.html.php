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


class LecturesEventsCpViewLecturesEventsLoc extends JView
{
	protected $state;
	protected $item;
	protected $form;
	protected $tmpl;

	public function display($tpl = null) {
		
		$this->state	= $this->get('State');
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');


		$user 		= JFactory::getUser();
		$model		= $this->getModel();
	
	
	
		
		JHTML::_('behavior.calendar');
		JHTML::stylesheet('administrator/components/com_lecturesevents/assets/lecturesevents.css' );
		
		
		$lists 	= array();		
		$isNew	= ((int)$this->item->id == 0);

		// Edit or Create?
		if (!$isNew) {
			$model->checkout( $user->get('id') );
		} else {
			// initialise new record
			$this->item->approved 		= 1;
			$this->item->published 		= 1;
			$this->item->order 			= 0;
			$this->item->access			= 0;
		}

		$this->addToolbar();
		
		parent::display($tpl);
	}
	
	
	protected function addToolbar() {
		
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'lectureseventslocs.php';
		JRequest::setVar('hidemainmenu', true);
		$bar 		= & JToolBar::getInstance('toolbar');
		$user		= JFactory::getUser();
		$isNew		= ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		$canDo		= LecturesEventsLocsHelper::getActions($this->state->get('filter.location_id'), $this->item->id);
		$paramsC 	= JComponentHelper::getParams('com_lecturesevents');

		

		$text = $isNew ? JText::_( 'COM_LECTURESEVENTS_NEW' ) : JText::_('COM_LECTURESEVENTS_EDIT');
		JToolBarHelper::title(   JText::_( 'COM_LECTURESEVENTS_LOCATION' ).': <small><small>[ ' . $text.' ]</small></small>' , 'location.png');

		// If not checked out, can save the item.
		if (!$checkedOut && $canDo->get('core.edit')){
			JToolBarHelper::apply('lectureseventsloc.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('lectureseventsloc.save', 'JTOOLBAR_SAVE');
			JToolBarHelper::addNew('lectureseventsloc.save2new', 'JTOOLBAR_SAVE_AND_NEW');
			
		}
		// If an existing item, can save to a copy.
		if (!$isNew && $canDo->get('core.create')) {
			//JToolBarHelper::custom('lectureseventscat.save2copy', 'copy.png', 'copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
		}
		if (empty($this->item->id))  {
			JToolBarHelper::cancel('lectureseventsloc.cancel', 'JTOOLBAR_CANCEL');
		}
		else {
			JToolBarHelper::cancel('lectureseventsloc.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolBarHelper::divider();
		JToolBarHelper::help( 'screen.lecturesevents', true );
	}
}
?>
