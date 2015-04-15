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

class JFormFieldLecturesEventslocs extends JFormField {

    protected $type = 'LecturesEventsLocs';

    protected function getInput() {

        $db = &JFactory::getDBO();
        $options = array();
        
        //build the list of categories
        $query = 'SELECT a.title AS text, a.id AS value'
                . ' FROM #__lecturesevents_locations AS a'
                . ' WHERE a.published = 1'
                . ' ORDER BY a.ordering';
        $db->setQuery($query);
        $data = $db->loadObjectList();

        
        $required = ((string) $this->element['required'] == 'true') ? TRUE : FALSE;

        foreach($data as $d){
            $options[] = JHtml::_('select.option', $d->value, $d->text);
        }
        
        array_unshift($options, JHTML::_('select.option', '', '- ' . JText::_('COM_LECTURESEVENTS_SELECT_LOCATION') . ' -', 'value', 'text'));
        
        return JHTML::_('select.genericlist', $options, $this->name, 'class="inputbox"', 'value', 'text', $this->value, $this->id);
    }

}

?>