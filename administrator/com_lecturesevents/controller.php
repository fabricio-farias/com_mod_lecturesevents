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

jimport('joomla.application.component.controller');


$l['cp']		= array('COM_LECTURESEVENTS_CONTROL_PANEL', '');
$l['f']			= array('COM_LECTURESEVENTS_CASES', 'lectureseventscases');
$l['c']			= array('COM_LECTURESEVENTS_CATEGORIES', 'lectureseventscats');
$l['l']			= array('COM_LECTURESEVENTS_LOCATIONS', 'lectureseventslocs');
$l['in']		= array('COM_LECTURESEVENTS_INFO', 'lectureseventsinfo');

// Submenu view
$view	= JRequest::getVar( 'view', '', '', 'string', JREQUEST_ALLOWRAW );

foreach ($l as $k => $v) {
	
	if ($v[1] == '') {
		$link = 'index.php?option=com_lecturesevents';
	} else {
		$link = 'index.php?option=com_lecturesevents&view=';
	}

	if ($view == $v[1]) {
		JSubMenuHelper::addEntry(JText::_($v[0]), $link.$v[1], true );
	} else {
		JSubMenuHelper::addEntry(JText::_($v[0]), $link.$v[1]);
	}

}

class LecturesEventsCpController extends JController {
	function display() {
		parent::display();
	}
}
?>
