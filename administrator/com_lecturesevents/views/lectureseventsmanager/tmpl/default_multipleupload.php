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
echo '<div id="lecturesevents-multipleupload">';
echo '<div style="font-size:1px;height:1px;margin:0px;padding:0px;">&nbsp;</div>';
echo $this->tmpl['mu_response_msg'] ;
echo '<form action="'. JURI::base().'index.php?option=com_lecturesevents" >';
if ($this->tmpl['ftp']) {echo LecturesEventsFileUpload::renderFTPaccess();}
echo '<fieldset class="actions">'
	.' <legend>'; 
echo JText::_( 'COM_LECTURESEVENTS_UPLOAD_FILE' ).' [ '. JText::_( 'COM_LECTURESEVENTS_MAX_SIZE' ).':&nbsp;'.$this->tmpl['uploadmaxsizeread'].']';
echo ' </legend>';
echo $this->tmpl['mu_output']
	.'</fieldset>';
echo '</form>';
echo LecturesEventsFileUpload::renderCreateFolder($this->session->getName(), $this->session->getId(), $this->currentFolder, 'lectureseventsmanager', 'manager='.$this->manager.'&amp;tab='.$this->tmpl['currenttab']['multipleupload'].'&amp;field='. $this->field );
echo '</div>';
?>