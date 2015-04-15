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

if (!class_exists('LecturesEventsHelper')) {
    require_once( JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_lecturesevents' . DS . 'helpers' . DS . 'lecturesevents.php');
}

class JFormFieldLecturesEventsColors extends JFormField {

    protected $type = 'LecturesEventsColors';

    protected function getInput() {

        $options = array();
        $html = array();
        
        $html[] = '<ul class="checklist checklist-color">';
            $options[] = JHtml::_('select.option', '', '<span style="border: 1px solid #333; padding: 4px 8px;">'.JText::_(JNONE).'</span></option>');
            $options[] = JHtml::_('select.option', '#004770', '<span style="background-color: #004770; padding: 4px 8px;color: #FFF;">'.JText::_(JBLUE).'</span></option>');
            $options[] = JHtml::_('select.option', '#198199', '<span style="background-color: #198199; padding: 4px 8px;color: #FFF;">'.JText::_(JGREEN).'</span></option>');
            $options[] = JHtml::_('select.option', '#f5ae33', '<span style="background-color: #f5ae33; padding: 4px 8px;color: #FFF;">'.JText::_(JYELLOW).'</span></option>');
            $options[] = JHtml::_('select.option', '#b80b24', '<span style="background-color: #b80b24; padding: 4px 8px;color: #FFF;">'.JText::_(JRED).'</span></option>');
        
        $html[] = '<li>'.JHTML::_('select.radiolist',  $options,  $this->name, 'class="inputbox"', 'value', 'text', $this->value, $this->id ).'</li>';
        
        $html[] = '</ul>';
        
        return implode('', $html);
    }

}

?>