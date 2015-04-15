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
jimport( 'joomla.html.pane' );

class LecturesEventsCpViewLecturesEventscp extends JView
{
	public $tmpl;
	function display($tpl = null) {
		
		JHtml::stylesheet( 'administrator/components/com_lecturesevents/assets/lecturesevents.css' );
		JHTML::_('behavior.tooltip');
		$this->tmpl['version'] = LecturesEventsHelper::getLectVersion();
                
                $document = JFactory::getDocument();
                $document->addScript(JURI::root(true) . '/administrator/components/com_lecturesevents/assets/jquery/jquery-1.7.2.min.js?version=' . $this->tmpl['version']);
                $document->addScript(JURI::root(true) . '/administrator/components/com_lecturesevents/assets/jquery/jquery-ui-1.8.21.custom.min.js?version=' . $this->tmpl['version']);
                $document->addScript(JURI::root(true) . '/administrator/components/com_lecturesevents/assets/js/tips.js?version=' . $this->tmpl['version']);
                $document->addStyleSheet(JURI::root(true) . '/administrator/components/com_lecturesevents/assets/css/tips.css?version=' . $this->tmpl['version']);
                
                $js = "
                        $(document).ready(function(){
                            $('.tooltip, .hasTip').tips({parent:'#jce'});
                        })
                    ";
                $document->addScriptDeclaration($js);
                
		$this->assignRef('version',	$version);
		$this->addToolbar();
		parent::display($tpl);
		
	}
	
	protected function addToolbar() {
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'lectureseventscp.php';

		$state	= $this->get('State');
		$canDo	= LecturesEventsCpHelper::getActions();
		JToolBarHelper::title( JText::_( 'COM_LECTURESEVENTS_PD_CONTROL_PANEL' ), 'lecturesevents.png' );
		
		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_lecturesevents');
			JToolBarHelper::divider();
		}
		
		JToolBarHelper::help( 'screen.lecturesevents', true );
	}
}
?>