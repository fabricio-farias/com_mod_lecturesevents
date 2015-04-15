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

$list = $modLecturesEventsHelper->getEventsByLocationsList();
$acc = 1;
$jnow = & JFactory::getDate();
$now = $jnow->toMySQL();

$get = JRequest::get('get');

$Itemid = $modLecturesEventsHelper->getItemid();
$link = $Itemid['curso']->link . '&Itemid=' . $Itemid['curso']->id;
?>

<ul class="uk-nav uk-nav-parent-icon uk-nav-side" data-uk-nav>
    <?php foreach ($list as $l) { ?>
        <?php $acc_li = 1; ?>
        <li class="uk-parent">
            <a href="#" alt="<?php echo $l->alias; ?>"><?php echo $l->title; ?></a>
            <ul class="uk-nav-sub tm-list" style="padding: 10px;">

                <?php if ($l->locations) { ?>
                    <?php $count = count($l->locations); ?>
                    <?php foreach ($l->locations as $ll) { ?>
                        <?php $title = mb_strtolower($ll->title, "UTF-8"); $title = ucwords($title);?>
                        <?php if ($ll->register_closed == '0000-00-00 00:00:00' OR $ll->register_closed >= $now) { ?>
                            <li style="padding: 10px 0;">
                                <div style="display: table;">
                                        <!--<div style="display: table-cell; vertical-align: middle;"><span class="uk-badge uk-badge-primary uk-badge-notification"><?php //echo $acc_li;  ?></span></div>-->
                                    <div style="display: table-cell; vertical-align: middle;">
                                        <span style="color: #e8e8e8; font-size: 24pt;"><?php echo $acc_li; ?></span>
                                    </div>
                                    <div style="display: table-cell; vertical-align: middle; width: 100%; padding-left: 8px;">
                                        <a href="<?php echo $link . '&id=' . $ll->id ?>"><?php echo $title; ?></a>
                                    </div>
                                </div>
                            </li>
                            <?php $acc_li++; ?>
                        <?php } else { ?> 
                            <?php $count--; ?>
                        <?php } ?>
                    <?php } ?>

                    <?php if ($count == 0) { ?>
                        <div class="jumbotron jumbotron-center" style="margin-right: 22px;background-color: #FAFAFA;border-radius: 0;">
                            <h1><span class="glyphicons list"></span></h1>
                            <p><?php echo sprintf(JText::_('MOD_LECT_NO_EVENT'), $l->title); ?></p>
                        </div>
                    <?php } ?>	

                <?php } else { ?>
                    <div class="jumbotron jumbotron-center" style="margin-right: 22px;background-color: #FAFAFA;border-radius: 0;">
                        <h1><span class="glyphicons list"></span></h1>
                        <p><?php echo sprintf(JText::_('MOD_LECT_NO_EVENT'), $l->title); ?></p>
                    </div>
                <?php } ?>
            </ul>
        </li>

        <?php $acc++; ?>
    <?php } ?>
</ul>