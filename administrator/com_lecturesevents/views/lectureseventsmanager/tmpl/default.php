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
JHTML::_('behavior.tooltip');

if ($this->manager == 'filemultiple') {

	?><script language="javascript" type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		
		if (task == 'lectureseventsm.cancel') {
			submitform(task);
		}

		if (task == 'lectureseventsm.save') {
			lectureseventsmform = document.getElementById('adminForm');
			if (lectureseventsmform.boxchecked.value==0) {
				alert( "<?php echo JText::_( 'COM_LECTURESEVENTS_WARNING_SELECT_FILENAME_OR_FOLDER', true ); ?>" );
			} else  {
				var f = lectureseventsmform;
				var nSelectedImages = 0;
				var nSelectedFolders = 0;
				var i=0;
				cb = eval( 'f.cb' + i );
				while (cb) {
					if (cb.checked == false) {
						// Do nothing
					}
					else if (cb.name == "cid[]") {
						nSelectedImages++;
					}
					else {
						nSelectedFolders++;
					}
					// Get next
					i++;
					cb = eval( 'f.cb' + i );
				}
				
				if (lectureseventsmform.jform_catid.value == "" && nSelectedImages > 0){
					alert( "<?php echo JText::_( 'COM_LECTURESEVENTS_WARNING_FILE_SELECTED_SELECT_CATEGORY', true ); ?>" );
				} else {
					submitform(task);
				}
			}
		}
		//submitform(task);
	}
	</script><?php
}

echo '<div id="lectureseventsmanager">';

if ($this->manager == 'filemultiple') {
	echo '<form action="'.JRoute::_('index.php?option=com_lecturesevents').'" method="post" name="adminForm" id="adminForm" class="form-validate">';
	echo '<div class="width-100 fltlft">';
	echo '<fieldset class="adminform">';
	echo '<legend>'. JText::_('COM_LECTURESEVENTS_MULTIPLE_ADD').'</legend>';
	echo '<ul class="adminformlist">';
	$formArray = array ('title', 'alias','published', 'approved', 'ordering', 'catid', 'language');
		foreach ($formArray as $value) {
			echo '<li>'.$this->form->getLabel($value) . $this->form->getInput($value).'</li>' . "\n";
		}
	echo '</ul></fieldset></div>';
	echo '<div class="clr"></div>';
}


echo '<div class="pd-admin-path">' . JText::_('COM_LECTURESEVENTS_PATH'). ': '.JPath::clean($this->tmpl['path']['orig_abs_ds']. $this->folderstate->folder) .'</div>';

echo '<div class="pd-admin-files">';

if ($this->manager == 'filemultiple' && (count($this->files) > 0 || count($this->folders) > 0)) {
	echo '<div class="pd-admin-file-checkbox">';
	$fileFolders = count($this->files) + count($this->folders);
	echo '<input type="checkbox" name="toggle" value="" onclick="checkAll('.$fileFolders.');" />';
	echo '&nbsp;&nbsp;'. JText::_('COM_LECTURESEVENTS_CHECK_ALL');
	echo '</div>';
}

echo $this->loadTemplate('up');
if (count($this->files) > 0 || count($this->folders) > 0) { ?>
<div>

	<?php for ($i=0,$n=count($this->folders); $i<$n; $i++) :
		$this->setFolder($i);
		$this->folderi = $i;
		echo $this->loadTemplate('folder');
	endfor; ?>

	<?php for ($i=0,$n=count($this->files); $i<$n; $i++) :
		$this->setFile($i);
		$this->filei = $i;
		echo $this->loadTemplate('file');
	endfor; ?>

</div>
<?php } else { ?>
<div>
	<center style="clear:both;font-size:large;font-weight:bold;color:#b3b3b3;font-family: Helvetica, sans-serif;">
		<?php echo JText::_( 'COM_LECTURESEVENTS_THERE_IS_NO_FILE' ); ?>
	</center>
</div>
<?php }
echo '</div>';

if ($this->manager == 'filemultiple') {
	?>
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="layout" value="edit" />
	<?php echo JHtml::_('form.token'); ?>
	</form>
	<?php
} ?>

<div style="border-bottom:1px solid #cccccc;margin-bottom: 10px">&nbsp;</div>

<?php

if ($this->tmpl['displaytabs'] > 0) {
	echo '<div id="lecturesevents-pane">';

	echo JHtml::_('tabs.start', 'config-tabs-com_lecturesevents-manager', array('useCookie'=>1, 'startOffset'=> $this->tmpl['tab']));

	echo JHtml::_('tabs.panel', JHtml::_( 'image', 'administrator/components/com_lecturesevents/assets/images/icon-16-upload.png', '') . '&nbsp;'.JText::_('COM_LECTURESEVENTS_UPLOAD'), 'upload' );
	echo $this->loadTemplate('upload');
	
	
	if((int)$this->tmpl['enablemultiple']  >= 0) {
		echo JHtml::_('tabs.panel', JHtml::_( 'image', 'administrator/components/com_lecturesevents/assets/images/icon-16-upload-multiple.png', '') . '&nbsp;'.JText::_('COM_LECTURESEVENTS_MULTIPLE_UPLOAD'), 'multipleupload' );
		echo $this->loadTemplate('multipleupload');
	}


	//echo $pane->endPane();
	echo JHtml::_('tabs.end');
	echo '</div>';// end lecturesevents-pane
}
echo '</div>';

?>
