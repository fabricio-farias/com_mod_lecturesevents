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
defined('_JEXEC') or die('Restricted access');
$group 	= LecturesEventsHelper::getManagerGroup($this->manager);

if ($this->manager == 'filemultiple') {
	$checked 	= JHTML::_('grid.id', $this->folderi, $this->folders[$this->folderi]->path_with_name_relative_no, 0, 'foldercid' );
	echo '<div class="pd-admin-file">';
	echo $checked . '&nbsp;';
	echo JHTML::_( 'image', 'administrator/components/com_lecturesevents/assets/images/icon-folder.png', ''). '&nbsp;';
	echo '<a href="index.php?option=com_lecturesevents&amp;view=lectureseventsmanager'
		 .'&amp;manager='.$this->manager
		 .$group['c']
		 .'&amp;folder='.$this->_tmp_folder->path_with_name_relative_no
		 .'&amp;field='. $this->field.'">';
	echo $this->_tmp_folder->name;
	echo '</a>';
	echo '</div>';
} else {
	echo '<div>';
	echo '<a href="index.php?option=com_lecturesevents&amp;view=lectureseventsmanager'
		 .'&amp;manager='. $this->manager
		 . $group['c']
		 .'&amp;folder='.$this->_tmp_folder->path_with_name_relative_no
		 .'&amp;field='. $this->field.'">';
		 
	echo JHTML::_( 'image', 'administrator/components/com_lecturesevents/assets/images/icon-folder.png', JText::_('COM_LECTURESEVENTS_OPEN'));
	 
	echo '</a> ';
	echo '<a href="index.php?option=com_lecturesevents&amp;view=lectureseventsmanager'
		 .'&amp;manager='.$this->manager
		 .$group['c']
		 .'&amp;folder='.$this->_tmp_folder->path_with_name_relative_no
		 .'&amp;field='. $this->field.'">';
	echo $this->_tmp_folder->name;
	echo '</a>';
	echo '</div>'."\n";
}
