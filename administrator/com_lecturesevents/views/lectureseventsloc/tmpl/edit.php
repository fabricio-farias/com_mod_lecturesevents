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
?>
<script type="text/javascript">
    Joomla.submitbutton = function(task)
    {
        if (task == 'lectureseventsloc.cancel' || document.formvalidator.isValid(document.id('lectureseventsloc-form'))) {
            Joomla.submitform(task, document.getElementById('lectureseventsloc-form'));
        }
        else {
            alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
        }
    }
</script>

<form action="<?php JRoute::_('index.php?option=com_lecturesevents'); ?>" method="post" name="adminForm" id="lectureseventsloc-form" class="form-validate">
    <div class="width-60 fltlft">
        <fieldset class="adminform">
            <legend><?php echo empty($this->item->id) ? JText::_('COM_LECTURESEVENTS_NEW_LOCATION') : JText::sprintf('COM_LECTURESEVENTS_EDIT_LOCATION', $this->item->id); ?></legend>

            <ul class="adminformlist">
                <?php
                $formArray = array('title', 'alias', 'ordering',
                    'access', 'accessuserid', 'uploaduserid', 'deleteuserid');
                foreach ($formArray as $value) {
                    echo '<li>' . $this->form->getLabel($value) . $this->form->getInput($value) . '</li>' . "\n";
                }
                ?>
            </ul>
            <?php echo $this->form->getLabel('description'); ?>
            <div class="clr"></div>
            <?php echo $this->form->getInput('description'); ?>
        </fieldset>
    </div>

    <div class="width-40 fltrt">
        <?php echo JHtml::_('sliders.start', 'lectureseventsx-sliders-' . $this->item->id, array('useCookie' => 1)); ?>

        <?php echo JHtml::_('sliders.panel', JText::_('COM_LECTURESEVENTS_GROUP_LABEL_PUBLISHING_DETAILS'), 'publishing-details'); ?>
        <fieldset class="adminform">
            <ul class="adminformlist">
                <?php
                foreach ($this->form->getFieldset('publish') as $field) {
                    echo '<li>';
                    if (!$field->hidden) {
                        echo $field->label;
                    }
                    echo $field->input;
                    echo '</li>';
                }
                ?>
            </ul>
        </fieldset>


        <?php echo $this->loadTemplate('metadata'); ?>

<?php echo JHtml::_('sliders.end'); ?>
    </div>

    <div class="clr"></div>


    <input type="hidden" name="task" value="" />
<?php echo JHtml::_('form.token'); ?>
</form>