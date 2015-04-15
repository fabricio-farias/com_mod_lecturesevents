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

// no direct access
defined('_JEXEC') or die;

require_once dirname(__FILE__).'/helper.php';

if ($params->def('prepare_content', 1))
{
	JPluginHelper::importPlugin('content');
	$module->content = JHtml::_('content.prepare', $module->content, '', 'mod_lecturesevents.content');
}

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

JFactory::getDocument()->addStyleSheet(JURI::base() . 'modules/mod_lecturesevents/css/style.css');

$modLecturesEventsHelper = new modLecturesEventsHelper($params);

require JModuleHelper::getLayoutPath('mod_lecturesevents', $params->get('layout', 'default'));
