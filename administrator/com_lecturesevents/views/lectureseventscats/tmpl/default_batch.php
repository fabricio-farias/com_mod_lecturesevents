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

$published = $this->state->get('filter.state');
?>
<fieldset class="batch">
	<legend><?php echo JText::_('COM_LECTURESEVENTS_BATCH_OPTIONS_CATEGORIES');?></legend>
	<?php echo JHtml::_('batch.access');?>
	<?php echo JHtml::_('batch.language');?>

	<?php echo LecturesEventsBatch::item($published, 1); ?>

	<button type="submit" onclick="Joomla.submitbutton('lectureseventscat.batch');">
		<?php echo JText::_('JGLOBAL_BATCH_PROCESS'); ?>
	</button>
	<button type="button" onclick="document.id('batch-category-id').value='';document.id('batch-access').value=''">
		<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>
	</button>
</fieldset>
