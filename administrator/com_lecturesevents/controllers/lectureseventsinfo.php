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

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class LecturesEventsCpControllerLecturesEventsinfo extends LecturesEventsCpController
{
	function __construct() {
		parent::__construct();
	}
	
	function cancel() {
		$this->setRedirect( 'index.php?option=com_lecturesevents' );
	}
}
?>
