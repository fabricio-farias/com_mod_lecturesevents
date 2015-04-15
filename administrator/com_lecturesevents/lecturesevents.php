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
defined('_JEXEC') or die;
if (!JFactory::getUser()->authorise('core.manage', 'com_lecturesevents')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

require_once( JPATH_COMPONENT.DS.'controller.php' );
require_once( JPATH_COMPONENT.DS.'helpers'.DS.'lecturesevents.php' );
require_once( JPATH_COMPONENT.DS.'helpers'.DS.'html'.DS.'category.php' );
require_once( JPATH_COMPONENT.DS.'helpers'.DS.'html'.DS.'grid.php' );
require_once( JPATH_COMPONENT.DS.'helpers'.DS.'html'.DS.'batch.php' );

require_once( JPATH_COMPONENT.DS.'helpers'.DS.'lectureseventscp.php' );
require_once( JPATH_COMPONENT.DS.'helpers'.DS.'fileupload.php' );
require_once( JPATH_COMPONENT.DS.'helpers'.DS.'fileuploadmultiple.php' );
require_once( JPATH_COMPONENT.DS.'helpers'.DS.'fileuploadsingle.php' );

jimport('joomla.application.component.controller');
$controller	= JController::getInstance('LecturesEventsCp');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
?>