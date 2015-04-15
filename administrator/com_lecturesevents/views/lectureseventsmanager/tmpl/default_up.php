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
echo '<div>';
echo '<a style="text-decoration:none" alt=".." href="index.php?option=com_lecturesevents&amp;view=lectureseventsmanager&amp;manager='
	.$this->manager . $group['c'] .'&amp;folder='.$this->folderstate->parent .'&amp;field='. $this->field.'" >';
echo JHTML::_( 'image', 'administrator/components/com_lecturesevents/assets/images/icon-up.png', JText::_('COM_LECTURESEVENTS_UP'));
echo '..</a></div>';