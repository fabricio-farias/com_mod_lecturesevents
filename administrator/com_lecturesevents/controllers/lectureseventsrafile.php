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
jimport('joomla.application.component.controlleradmin');


class LecturesEventsCpControllerLecturesEventsRaFile extends JControllerAdmin
{
	protected	$option 		= 'com_phocadownload';
	
	public function &getModel($name = 'LecturesEventsRaFile', $prefix = 'LecturesEventsCpModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}
?>
