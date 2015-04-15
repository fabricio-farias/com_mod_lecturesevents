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
//$doc = JFactory::getDocument();
//$js = "jQuery(document).ready(function(){
//          jQuery('.lec-content').css('height', '110px').dotdotdot();
//      })"
//;
//$doc->addScriptDeclaration($js);


$list = $modLecturesEventsHelper->getEventsList();

$jnow = & JFactory::getDate();
$now = $jnow->toMySQL();
$colorArr = array('#004770' => 'box-info', '#198199' => 'box-success', '#f5ae33' => 'box-warning', '#b80b24' => 'box-danger' );
?>

<div class="custom<?php echo $moduleclass_sfx ?>" <?php if ($params->get('backgroundimage')): ?> style="background-image:url(<?php echo $params->get('backgroundimage'); ?>)"<?php endif; ?> >

    <?php if($list){ ?>
    <div style="padding-left: 15px;">
        <div class="moduletableeventos">
            <?php foreach ($list as $l){ ?>
                <div class="box <?php echo ($l->color != '') ? $colorArr[$l->color] : 'box-info'; ?>">
                    <div class="box-heading box-toggle">
                        <h3 class="box-title"><?php echo $l->unit; ?></h3>
                        <p><?php echo $l->title; ?></p>
                    </div>

                    <?php if ($l->form_lecture_event != '') { ?>
                    <div class="box-body">
                        <label>
                            <small><?php echo JText::_('MOD_LECT_LECT_EVENT'); ?></small>
                            <span><?php echo $l->form_lecture_event; ?></span>
                        </label>
                    </div>
                    <?php } ?>

                    <?php if ($l->form_date_up != '') { ?>
                    <div class="box-body">
                        <label>
                            <small><?php echo JText::_('MOD_LECT_DATE_UP'); ?></small>
                            <span><?php echo $l->form_date_up; ?></span>
                        </label>
                    </div>
                    <?php } ?>

                    <?php if ($l->form_date_down != '') { ?>    
                    <div class="box-body">
                        <label>
                            <small><?php echo JText::_('MOD_LECT_DATE_DOWN'); ?></small>
                            <span><?php echo $l->form_date_down; ?></span>
                        </label>
                    </div>
                    <?php } ?>

                    <?php if ($l->form_workload != '') { ?>
                    <div class="box-body">
                        <label>
                            <small><?php echo JText::_('MOD_LECT_WORKLOAD'); ?></small>
                            <span><?php echo $l->form_workload; ?></span>
                        </label>
                    </div>
                    <?php } ?>

                    <?php if ($l->form_location != '') { ?>
                    <div class="box-body">
                        <label>
                            <small><?php echo JText::_('MOD_LECT_LOCATION'); ?></small>
                            <span><?php echo $l->form_location; ?></span>
                        </label>
                    </div>
                    <?php } ?>

                    <?php if ($l->form_speaker != '') { ?>
                    <div class="box-body">
                        <label>
                            <small><?php echo JText::_('MOD_LECT_SPEAKER'); ?></small>
                            <span><?php echo $l->form_speaker; ?></span>
                        </label>
                    </div>
                    <?php } ?>

                    <?php if ($l->form_audience != '') { ?>
                    <div class="box-body">
                        <label>
                            <small><?php echo JText::_('MOD_LECT_AUDIENCE'); ?></small>
                            <span><?php echo $l->form_audience; ?></span>
                        </label>
                    </div>
                    <?php } ?>

                    <?php if ($l->form_investment != '') { ?>
                    <div class="box-body">
                        <label>
                            <small><?php echo JText::_('MOD_LECT_INVESTMENT'); ?></small>
                            <span><?php echo $l->form_investment; ?></span>
                        </label>
                    </div>
                    <?php } ?>

                    <div class="box-footer">
                    <?php if($l->form_link != ''){ ?>
                        <a href="<?php echo $l->form_link;?>">Leia +</a>
                    <?php }else{ ?>
                        <a href="javascript:;">&nbsp;</a>
                    <?php } ?>
                    </div>

                </div>
            <?php } ?>
        </div>
    </div>
    <?php } else { ?>
        <div class="jumbotron jumbotron-center" style="margin-bottom: 0;background-color: #FFFFFF;border-radius: 0;">
            <h1><span class="glyphicon glyphicon-th-list"></span></h1>
            <p><?php echo JText::_('MOD_LECT_NO_EVENTS_EVENTS'); ?></p>
            <p style="font-size: 14px;">Acesse:</p>
            <p><a href="http://www.isgh.org.br/site/index.php?option=com_lecturesevents&view=events" class="btn btn-default">Cursos</a></p>
            <p><a href="index.php?option=com_content&view=article&id=1002&Itemid=708" class="btn btn-default">Educação Permanente</a></p>
        </div>
    <?php } ?>
</div>
