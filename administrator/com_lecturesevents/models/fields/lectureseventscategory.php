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

class JFormFieldLecturesEventsCategory extends JFormField {

    protected $type = 'LecturesEventsCategory';

    protected function getInput() {

        $db = &JFactory::getDBO();

        //build the list of categories
        $query = 'SELECT a.title AS text, a.id AS value, a.parent_id as parentid'
                . ' FROM #__lecturesevents_categories AS a'
                . ' WHERE a.published = 1'
                . ' ORDER BY a.ordering';
        $db->setQuery($query);
        $data = $db->loadObjectList();

        // TODO - check for other views than category edit
        $view = JRequest::getVar('view');
        $catId = -1;
        if ($view == 'lectureseventscat') {
            $id = $this->form->getValue('id'); // id of current category
            if ((int) $id > 0) {
                $catId = $id;
            }
        }

        $required = ((string) $this->element['required'] == 'true') ? TRUE : FALSE;
        $size = ((string) $this->element['size'] != '')?'size="'.$this->element['size'].'"':'';
        $multiple = ((string) $this->element['multiple'] == 'true') ? 'multiple="multiple" '.$size : '';

        $tree = array();
        $text = '';
        $tree = LecturesEventsHelper::CategoryTreeOption($data, $tree, 0, $text, $catId);

        array_unshift($tree, JHTML::_('select.option', '', '- ' . JText::_('COM_LECTURESEVENTS_SELECT_CATEGORY') . ' -', 'value', 'text'));
        
        return JHTML::_('select.genericlist', $tree, $this->name, 'class="inputbox" '.$multiple, 'value', 'text', $this->value, $this->id);
    }

}

?>