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
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

// External link
$extlink = 0;
if (isset($this->item->extid) && $this->item->extid != '') {
	$extlink = 1;
}

?>
<script type="text/javascript">
    Joomla.submitbutton = function(task)
    {
            if (task == 'lectureseventscase.cancel' || document.formvalidator.isValid(document.id('lectureseventscase-form'))) {
                    Joomla.submitform(task, document.getElementById('lectureseventscase-form'));
            }
            else {
                    alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
            }
    }
</script>

<form action="<?php JRoute::_('index.php?option=com_lecturesevents'); ?>" method="post" name="adminForm" id="lectureseventscase-form" class="form-validate">
	<div class="width-60 fltlft">
		
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_LECTURESEVENTS_NEW_FILE') : JText::sprintf('COM_LECTURESEVENTS_EDIT_FILE', $this->item->id); ?></legend>
			
						
		<ul class="adminformlist">
			<?php
			// Extid is hidden - only for info if this is an external image (the casename field will be not required)
			$formArray = array ('title', 'alias', 'catid', 'ordering','access');
			foreach ($formArray as $value) {
				echo '<li>'.$this->form->getLabel($value) . $this->form->getInput($value).'</li>' . "\n";
			} ?>
		</ul>
		
		<input type="hidden" name="jform[casename]" id="jform_casename" value="-" />
		<input type="hidden" name="jform[textonly]" id="jform_textonly" value="1" />
		

		
			<?php echo $this->form->getLabel('description'); ?>
			<div class="clr"></div>
			<?php echo $this->form->getInput('description'); ?>
		
		<div class="clr"></div>
		</fieldset>
	</div>
	



<div class="width-40 fltrt">
	<div style="text-align:right;margin:5px;"><?php echo $this->tmpl['enablethumbcreationstatus']; ?></div>
	<?php echo JHtml::_('sliders.start','lectureseventsx-sliders-'.$this->item->id, array('useCookie'=>1)); ?>

	<?php echo JHtml::_('sliders.panel',JText::_('COM_LECTURESEVENTS_GROUP_LABEL_PUBLISHING_DETAILS'), 'publishing-details'); ?>
		<fieldset class="adminform">
		<ul class="adminformlist">
			<?php foreach($this->form->getFieldset('publish') as $field) {
				// Text does not need every case item
				if ($field->id != 'jform_hits') {
					echo '<li>';
						if (!$field->hidden) {
							echo $field->label;
						}
						echo $field->input;
					echo '</li>';
				}
			} ?>
			</ul>
		</fieldset>
		
	<?php echo JHtml::_('sliders.end'); ?>
</div>

<div class="clr"></div>

<input type="hidden" name="task" value="" />
<?php echo JHtml::_('form.token'); ?>
</form>