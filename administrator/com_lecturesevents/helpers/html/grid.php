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
 
 
include_once(JPATH_ROOT . DS . 'libraries' . DS . 'joomla' . DS . 'html' . DS . 'html' . DS . 'jgrid.php');
//jimport('joomla.html.html.jgrid'); 
class LecturesEventsGrid extends JHtmlJGrid
{
	
	public static function approved($value, $i, $prefix = '', $enabled = true, $checkbox='cb')
	{
		if (is_array($prefix)) {
			$options	= $prefix;
			$enabled	= array_key_exists('enabled',	$options) ? $options['enabled']		: $enabled;
			$checkbox	= array_key_exists('checkbox',	$options) ? $options['checkbox']	: $checkbox;
			$prefix		= array_key_exists('prefix',	$options) ? $options['prefix']		: '';
		}
		$states	= array(
			1	=> array('disapprove',	'COM_LECTURESEVENTS_APPROVED',	'COM_LECTURESEVENTS_NOT_APPROVE_ITEM',	'COM_LECTURESEVENTS_APPROVED',	false,	'publish',		'publish'),
			0	=> array('approve',		'COM_LECTURESEVENTS_NOT_APPROVED',	'COM_LECTURESEVENTS_APPROVE_ITEM',	'COM_LECTURESEVENTS_NOT_APPROVED',	false,	'unpublish',	'unpublish')
		);
		return self::state($states, $value, $i, $prefix, $enabled, true, $checkbox);
	}
}
