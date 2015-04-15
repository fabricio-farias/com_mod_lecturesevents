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

$fieldSets = $this->form->getFieldsets('metadata');
foreach ($fieldSets as $name => $fieldSet) :
    echo JHtml::_('sliders.panel', JText::_($fieldSet->label), $name . '-options');
    if (isset($fieldSet->description) && trim($fieldSet->description)) :
        echo '<p class="tip">' . $this->escape(JText::_($fieldSet->description)) . '</p>';
    endif;
    ?>
    <fieldset class="panelform">
        <ul class="adminformlist">
            <?php if ($name == 'metadata') : // Include the real fields in this panel.  ?>
                <li><?php echo $this->form->getLabel('metadesc'); ?>
                    <?php echo $this->form->getInput('metadesc'); ?></li>

                <li><?php echo $this->form->getLabel('metakey'); ?>
                    <?php echo $this->form->getInput('metakey'); ?></li>


            <?php endif; ?>
        </ul>
    </fieldset>
<?php endforeach; ?>