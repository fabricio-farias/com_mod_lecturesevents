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
?>
<style>
    ul#cpanel {
        list-style: none outside none;
        margin: 0;
        padding: 0;
    }
    ul#cpanel li.cpanel-icon {
        border: 1px solid #f0f0f0;
        box-shadow: 1px 1px 1px #cccccc;
        display: block;
        float: left;
        font-size: 8.5pt;
        height: 100px;
        margin: 5px;
        padding: 5px;
        text-align: center;
        text-shadow: 0 1px 0 #ffffff;
        width: 100px;
    }
    ul#cpanel li.cpanel-icon a {
        color: #666666;
        display: block;
        text-decoration: none;
        vertical-align: middle;
    }
    .cpanel-lect-left, .cpanel-lect-right {
        display: table-cell;
        vertical-align: top;
        width: 50%;
    }
</style>

<form action="index.php" method="post" name="adminForm">
    <div class="adminform">
        <div style="background-color: #ffffff;display: table;padding: 5px; width: 99.5%;">
        <div class="cpanel-lect-left">
            <ul id="cpanel">
                <?php
                $link = 'index.php?option=com_lecturesevents&view=lectureseventscases';
                echo LecturesEventsCpHelper::quickIconButton($link, 'icon-48-cases.png', JText::_('COM_LECTURESEVENTS_CASES'), JText::_('COM_LECTURESEVENTS_CASES_DETAILS'));

                $link = 'index.php?option=com_lecturesevents&view=lectureseventscats';
                echo LecturesEventsCpHelper::quickIconButton($link, 'icon-48-cat.png', JText::_('COM_LECTURESEVENTS_CATEGORIES'), JText::_('COM_LECTURESEVENTS_CATEGORIES_DETAILS'));
                
                $link = 'index.php?option=com_lecturesevents&view=lectureseventslocs';
                echo LecturesEventsCpHelper::quickIconButton($link, 'icon-48-globe.png', JText::_('COM_LECTURESEVENTS_LOCATIONS'), JText::_('COM_LECTURESEVENTS_LOCATIONS_DETAILS'));

                $link = 'index.php?option=com_lecturesevents&view=lectureseventsinfo';
                echo LecturesEventsCpHelper::quickIconButton($link, 'icon-48-info.png', JText::_('COM_LECTURESEVENTS_INFO'), JText::_('COM_LECTURESEVENTS_INFO_DETAILS'));
                ?>

                <!--COLOCAR TABELA AKI DOS ULTIMO EVENTOS-->


            </ul>
        </div>

        <div class="cpanel-lect-right">
            <div style="border:1px solid #ccc;background:#fff;margin:5px;padding:15px">
                <div style="float:right;margin:10px;">
                    <?php echo JHTML::_('image', 'administrator/components/com_phocadownload/assets/images/logo-isgh.png', 'ISGH'); ?>
                </div>

                <?php
                echo '<h3>' . JText::_('COM_LECTURESEVENTS_VERSION') . '</h3>'
                . '<p>' . $this->tmpl['version'] . '</p>';

                echo '<h3>' . JText::_('COM_LECTURESEVENTS_COPYRIGHT') . '</h3>'
                . '<p>© 2014 - Fabricio Farias</p>'
                . '<p><a href="http://www.isgh.org.br/" target="_blank">www.isgh.org.br</a></p>';

                echo '<h3>' . JText::_('COM_LECTURESEVENTS_LICENSE') . '</h3>'
                . '<p><a href="http://www.gnu.org/licenses/gpl-2.0.html" target="_blank">GPLv2</a></p>';

                echo '<h3>' . JText::_('COM_LECTURESEVENTS_TRANSLATION') . ': ' . JText::_('COM_LECTURESEVENTS_TRANSLATION_LANGUAGE_TAG') . '</h3>'
                . '<p>© 2014 Fabricio Farias</p>';

                echo '<div style="border-top:1px solid #c2c2c2"></div>'
                . '<div id="pg-update"></div>';
                ?>

            </div>
        </div>
        </div>
    </div>

    <input type="hidden" name="option" value="com_lecturesevents" />
    <input type="hidden" name="view" value="lectureseventscp" />
    <input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
</form>
