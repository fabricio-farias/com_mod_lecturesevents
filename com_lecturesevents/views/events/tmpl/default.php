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
$list = $this->events;
$jnow =& JFactory::getDate();
$now = $jnow->toMySQL();

$link = $this->itemid['curso']->link.'&Itemid='.$this->itemid['curso']->id;
?>


<article class="uk-article tm-article">
    <div class="tm-article-content ">
        <h1 class="uk-article-title">Cursos e Treinamentos</h1>
		
        <div style="text-align: center;">
        <?php if($list) {?>

            <?php foreach($list as $l){?>
                <?php $colors = array('#004770'=>'container-icon-info','#198199'=>'container-icon-success','#f5ae33'=>'container-icon-warning','#b80b24'=>'container-icon-danger');?>
                <?php $image = ($l->image == '')?'http://placehold.it/190x230':$l->image;?>
                <?php $closed = ($l->register_closed != '0000-00-00 00:00:00' AND $l->register_closed <= $now)?true:false; ?>
                <div class="cpaneldiv">
                    <div class="icon">
                        <div class="container-icon <?php echo $colors[$l->color];?>">
                            <div class="container-icon-img">
                                <?php if($l->unit){?>
                                    <h4><?php echo $l->unit;?></h4>
                                <?php }?>

                                <img width="190" height="230" src="<?php echo $image;?>" alt="<?php echo $l->alias;?>">
                                <a class="<?php echo ($l->filename == '')?'unabled':'';?>" href="<?php echo ($l->filename == '')?'javascript:;':'lecturesevents/'.$l->filename;?>" onclick="window.open(this.href,'','scrollbars=yes,resizable=yes,location=no,menubar=no,status=no,toolbar=no,left=0,top=0');return false;">EDITAL DO EVENTO</a>
                                <a class="<?php echo ($l->register_link == '' OR $closed === TRUE)?'unabled':'';?>" href="<?php echo ($l->register_link == '' OR $closed === TRUE)?'javascript:;':$l->register_link;?>" target="_blank">REALIZAR INSCRIÇÃO</a>
                            </div>    

                            <div class="container-icon-text">
                                <?php if($closed){?>
                                    <h2 class="cpanel-title-danger" style="display: inline-block;">Inscrições Encerradas</h2> <a href="<?php echo $link.'&id='.$l->id; ?>" class="glyphicons circle_plus" style="float: right;"></a>
                                <?php }else{?>
                                    <h2 style="display: inline-block;">Inscrições Abertas</h2> <a href="<?php echo $link.'&id='.$l->id; ?>" class="glyphicons circle_plus" style="float: right;"></a>
                                <?php }?>

                                <?php if($l->form_lecture_event != ''){?>
                                <label class="title-icon">
                                    <small><?php echo JText::_('COM_LECT_LECT_EVENT'); ?></small>
                                    <span><?php echo $l->form_lecture_event; ?></span>
                                </label>
                                <?php } ?>

                                <?php if($l->form_date_up != ''){?>    
                                <label>
                                    <small><?php echo JText::_('COM_LECT_DATE_UP'); ?></small>
                                    <span><?php echo $l->form_date_up; ?></span>
                                </label>
                                <?php } ?>

                                <?php if($l->form_date_down != ''){?>    
                                <label>
                                    <small><?php echo JText::_('COM_LECT_DATE_DOWN'); ?></small>
                                    <span><?php echo $l->form_date_down; ?></span>
                                </label>
                                <?php } ?>

                                <?php if($l->form_workload != ''){?>    
                                <label>
                                    <small><?php echo JText::_('COM_LECT_WORKLOAD'); ?></small>
                                    <span><?php echo $l->form_workload; ?></span>
                                </label>
                                <?php } ?>

                                <?php if($l->form_location != '' ){?>
                                <label>
                                    <small><?php echo JText::_('COM_LECT_LOCATION'); ?></small>
                                    <span><?php echo $l->form_location; ?></span>
                                </label>
                                <?php } ?>

                                <?php if($l->form_speaker != '' ){?>
                                <label>
                                    <small><?php echo JText::_('COM_LECT_SPEAKER'); ?></small>
                                    <span><?php echo $l->form_speaker;?></span>
                                </label>
                                <?php } ?>

                                <?php if($l->form_audience != '' ){?>
                                <label>
                                    <small><?php echo JText::_('COM_LECT_AUDIENCE'); ?></small>
                                    <span><?php echo $l->form_audience;?></span>
                                </label>
                                <?php } ?>

                                <?php if($l->form_investment != '' ){?>
                                <label>
                                    <small><?php echo JText::_('COM_LECT_INVESTMENT'); ?></small>
                                    <span><?php echo $l->form_investment;?></span>
                                </label>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>

        <?php }else{?>
            <div class="jumbotron jumbotron-center" style="margin-right: 22px;background-color: #FAFAFA;border-radius: 0;">
                <h1><span class="glyphicons list"></span></h1>
                <p><?php echo JText::_('COM_LECT_NO_EVENT'); ?></p>
            </div>
        <?php }?>
		
		<?php echo $this->share['buttons'];?>
        <?php echo $this->share['script'];?>
		
        </div>
    </div>
</article>