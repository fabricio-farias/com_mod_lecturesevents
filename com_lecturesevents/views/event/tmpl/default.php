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
$jnow =& JFactory::getDate();
$now = $jnow->toMySQL();
$event = $this->event;
$closed = ($event[0]->register_closed != '0000-00-00 00:00:00' AND $event[0]->register_closed <= $now)?true:false;
?>

<article class="uk-article tm-article">
    <div class="tm-article-content ">
        <h1 class="uk-article-title">Cursos e Treinamentos</h1>

        <div style="padding: 20px; margin-bottom: 25px;">

        <?php $colors = array('#004770'=>'container-icon-info','#198199'=>'container-icon-success','#f5ae33'=>'container-icon-warning','#b80b24'=>'container-icon-danger');?>
        <?php $image = ($event[0]->image == '')?'http://placehold.it/190x230':$event[0]->image;?>

            <div class="icon">
                <div class="container-icon <?php echo $colors[$event[0]->color]; ?> container-icon-lg">
                    <div class="container-icon-img-lg uk-width-medium-1-3">
                        <?php if ($event[0]->unit) { ?>
                            <h4><?php echo $event[0]->unit; ?></h4>
                        <?php } ?>

                        <img class="img-thumbnail zoom-sm" width="190" height="230" src="<?php echo $image; ?>" alt="<?php echo $event[0]->alias; ?>">
                    </div>    

                    <div class="container-icon-text-lg uk-width-medium-2-3">
                        <h3 class="title-icon-lg"><?php echo ($event[0]->form_lecture_event != '')?utf8_strtolower($event[0]->form_lecture_event):utf8_strtolower($event[0]->title); ?></h3>

                        <?php if ($event[0]->form_date_up != '') { ?>    
                            <label>
                                <small><?php echo JText::_('COM_LECT_DATE_UP'); ?></small>
                                <span><?php echo $event[0]->form_date_up; ?></span>
                            </label>
                        <?php } ?>

                        <?php if ($event[0]->form_date_down != '') { ?>    
                            <label>
                                <small><?php echo JText::_('COM_LECT_DATE_DOWN'); ?></small>
                                <span><?php echo $event[0]->form_date_down; ?></span>
                            </label>
                        <?php } ?>

                        <?php if ($event[0]->form_workload != '') { ?>    
                            <label>
                                <small><?php echo JText::_('COM_LECT_WORKLOAD'); ?></small>
                                <span><?php echo $event[0]->form_workload; ?></span>
                            </label>
                        <?php } ?>

                        <?php if ($event[0]->form_location != '') { ?>
                            <label>
                                <small><?php echo JText::_('COM_LECT_LOCATION'); ?></small>
                                <span><?php echo $event[0]->form_location; ?></span>
                            </label>
                        <?php } ?>

                        <?php if ($event[0]->form_speaker != '') { ?>
                            <label>
                                <small><?php echo JText::_('COM_LECT_SPEAKER'); ?></small>
                                <span><?php echo $event[0]->form_speaker; ?></span>
                            </label>
                        <?php } ?>

                        <?php if ($event[0]->form_audience != '') { ?>
                            <label>
                                <small><?php echo JText::_('COM_LECT_AUDIENCE'); ?></small>
                                <span><?php echo $event[0]->form_audience; ?></span>
                            </label>
                        <?php } ?>

                        <?php if ($event[0]->form_investment != '') { ?>
                            <label>
                                <small><?php echo JText::_('COM_LECT_INVESTMENT'); ?></small>
                                <span><?php echo $event[0]->form_investment; ?></span>
                            </label>
                        <?php } ?>

                        <?php
                            if($event[0]->register_closed != '0000-00-00 00:00:00' AND $event[0]->register_closed <= $now){ $status = 'Inscrições encerradas';$class='danger';}
                            elseif($event[0]->register_closed == '0000-00-00 00:00:00' OR $event[0]->register_closed >= $now){$status = 'Inscrições abertas';$class='primary';}
                            elseif($event[0]->register_link == ''){ $status = 'Inscrições em breve';$class='';}
                        ?>
                        <div class="register-link-lg">
                            <a 
                                class="uk-button uk-button-<?php echo $class; ?>" 
                                href="<?php echo ($event[0]->register_link == '' OR $closed === TRUE) ? 'javascript:;' : $event[0]->register_link; ?>" 
                                target="<?php echo ($event[0]->register_link == '' OR $closed === TRUE) ? '' : '_blank'; ?>">
                                <?php echo $status; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-bottom: 25px;">
            <?php echo $this->loadTemplate('items'); ?>
        </div>

        <div style="margin-bottom: 25px;">
            <a 
                style="display: table;padding: 6px 12px;<?php echo ($event[0]->filename == '')?'color: #999999;background: #f7f7f7;':''; ?>"
                class="uk-button"
                <?php echo ($event[0]->filename == '')?'':'onclick="window.open(this.href,\'\',\'scrollbars=yes,resizable=yes,location=no,menubar=no,status=no,toolbar=no,left=0,top=0\');return false;"'; ?>
                href="<?php echo ($event[0]->filename == '')?'javascript:;':'lecturesevents/'.$event[0]->filename;?>">
                <div style="display: table-cell;">
                    <img width="64" height="64" alt="<?php echo $event[0]->alias; ?>" src="images/newstuff/icon-doc-64<?php echo ($event[0]->filename == '')?'-grey':'';?>.png">
                </div>
                <div style="display: table-cell; text-align: left; vertical-align: middle; padding-left: 5px;">
                    <h3 style="margin-bottom: 5px; font-weight: 500; font-size: 16px;">Edital do evento</h3>
                    <p style="margin: 0px; font-weight: lighter;">Para acessar a programação</p>
                </div>
            </a>
        </div>
		
		<?php echo $this->share['buttons'];?>
        <?php echo $this->share['script'];?>
		
    </div>
</article>