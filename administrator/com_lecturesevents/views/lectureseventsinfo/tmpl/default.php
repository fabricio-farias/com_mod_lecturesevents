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
JHTML::_('behavior.tooltip');

echo '<div class="phoca-adminform">'
	.'<form action="index.php" method="post" name="adminForm">'
	.'<div style="float:right;margin:10px;">'
        . JHTML::_('image', 'administrator/components/com_lecturesevents/assets/images/logo-isgh.png', 'ISGH')
	.'</div>'
	. JHTML::_('image', 'administrator/components/com_lecturesevents/assets/images/icon-128-lecturesevents.png', 'Cursos e Eventos' )
	.'<h3>'.JText::_('COM_LECTURESEVENTS').' - '. JText::_('COM_LECTURESEVENTS_INFORMATION').'</h3>';


echo '<h3>'.  JText::_('COM_LECTURESEVENTS_HELP').'</h3>';

echo '<p>'
.'<a href="http://http://www.isgh.org.br/site/index.php?option=com_foxcontact&view=foxcontact&Itemid=519/" target="_blank">ISGH Ouvidoria</a><br />'
.'</p>';

echo '<h3>'.  JText::_('COM_LECTURESEVENTS_VERSION').'</h3>'
.'<p>'.  $this->tmpl['version'] .'</p>';

echo '<h3>'.  JText::_('COM_LECTURESEVENTS_COPYRIGHT').'</h3>'
.'<p>© 2014 - Fabricio Farias</p>'
.'<p><a href="http://www.isgh.org.br/" target="_blank">www.isgh.org.br</a></p>';

echo '<h3>'.  JText::_('COM_LECTURESEVENTS_LICENSE').'</h3>'
.'<p><a href="http://www.gnu.org/licenses/gpl-2.0.html" target="_blank">GPLv2</a></p>';

echo '<h3>'.  JText::_('COM_LECTURESEVENTS_TRANSLATION').': '. JText::_('COM_LECTURESEVENTS_TRANSLATION_LANGUAGE_TAG').'</h3>'
        .'<p>© 2014 - '. JText::_('COM_LECTURESEVENTS_TRANSLATER'). '</p>'
        .'<p>'.JText::_('COM_LECTURESEVENTS_TRANSLATION_SUPPORT_URL').'</p>';

echo '<input type="hidden" name="task" value="" />'
.'<input type="hidden" name="option" value="com_lecturesevents" />'
.'<input type="hidden" name="controller" value="lectureseventsinfo" />'
.'</form>';

echo '<p>&nbsp;</p>';

echo '<div style="border-top:1px solid #eee"></div>';

echo '<div style="margin-top:30px;height:39px;background: url(\''.JURI::base(true).'/components/com_lecturesevents/assets/images/line.png\') 100% 0 no-repeat;">&nbsp;</div>';

echo '</div>';