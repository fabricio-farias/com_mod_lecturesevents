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
$event = $this->event;
?>
<div 
    data-options="{&quot;style&quot;:&quot;tabs&quot;,&quot;autoplay&quot;:0,&quot;interval&quot;:5000,&quot;width&quot;:&quot;auto&quot;,&quot;height&quot;:&quot;auto&quot;,&quot;duration&quot;:500,&quot;index&quot;:0,&quot;order&quot;:&quot;default&quot;,&quot;navigation&quot;:&quot;left&quot;,&quot;animated&quot;:&quot;scroll&quot;}" 
    data-widgetkit="slideshow" 
    class="wk-slideshow wk-slideshow-tabs" 
    style="visibility: visible; position: relative; width: 650px;">
	
	<div class="nav-container nav-left clearfix">
            <ul class="nav" style="margin-bottom: 0!important;">
                <li class="active"><span>Sobre o curso</span></li>
                <li class=""><span>Cronograma</span></li>
                <li class=""><span>Ministrantes</span></li>
                <li class=""><span>Informações</span></li>
            </ul>
	</div>
	
	<div class="slides-container">
            <ul class="slides">
                <li>
                    <article class="wk-content clearfix">
                        <?php if($event[0]->form_content_1){ ?>
                            <?php echo $event[0]->form_content_1;?>
                        <?php }else{ ?>
                            <div class="jumbotron jumbotron-center">
                                <h1><span class="glyphicons list"></span></span></h1>
                                <p><?php echo JText::_('COM_LECT_NO_INFORMATION'); ?></p>
                            </div>
                        <?php } ?>
                    </article>
                </li>
                <li>
                    <article class="wk-content clearfix">
                        <?php if($event[0]->form_content_2){ ?>
                            <?php echo $event[0]->form_content_2;?>
                        <?php }else{ ?>
                            <div class="jumbotron jumbotron-center">
                                <h1><span class="glyphicons list"></span></span></h1>
                                <p><?php echo JText::_('COM_LECT_NO_INFORMATION'); ?></p>
                            </div>
                        <?php } ?>
                    </article>
                </li>
                <li>
                    <article class="wk-content clearfix">
                        <?php if($event[0]->form_content_3){ ?>
                            <?php echo $event[0]->form_content_3;?>
                        <?php }else{ ?>
                            <div class="jumbotron jumbotron-center">
                                <h1><span class="glyphicons list"></span></span></h1>
                                <p><?php echo JText::_('COM_LECT_NO_INFORMATION'); ?></p>
                            </div>
                        <?php } ?>
                    </article>
                </li>
                <li>
                    <article class="wk-content clearfix">
                        <?php if($event[0]->form_content_4){ ?>
                            <?php echo $event[0]->form_content_4;?>
                        <?php }else{ ?>
                            <div class="jumbotron jumbotron-center">
                                <h1><span class="glyphicons list"></span></span></h1>
                                <p><?php echo JText::_('COM_LECT_NO_INFORMATION'); ?></p>
                            </div>
                        <?php } ?>
                    </article>
                </li>
            </ul>
        </div>
</div>