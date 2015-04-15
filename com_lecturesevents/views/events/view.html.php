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
defined('_JEXEC') or die();
jimport('joomla.application.component.view');

class LecturesEventsViewEvents extends JView {

    function display($tpl = null) {
        $app            = JFactory::getApplication();
        $params         = &$app->getParams();
        $tmpl['user']   = &JFactory::getUser();
        $model          = &$this->getModel();
        $events         = $model->getEventsList();
                
        $document = &JFactory::getDocument();
        //for GOOGLE+
        $document->addCustomTag('<meta itemprop="name" content="ISGH - Cursos e Treinamentos" />');
        $document->addCustomTag('<meta itemprop="description" content="Acompanhe os cursos promovidos pela Coordenadoria de Educação Permanente, Ensino e Pesquisa -CEPEP do ISGH nas mais diversas áreas da atenção à saúde, com docentes qualificados e excelente estrutura de ensino teórico e prático." />');
        $document->addCustomTag('<meta itemprop="image" content="'.JURI::base().'templates/yoo_avenue/images/isgh-logo-share.png" />');
        //for FACEBOOK
        $document->setMetaData('og:url', JURI::getInstance()->toString());
        $document->setMetaData('og:title', 'ISGH - Cursos e Treinamentos');
        $document->setMetaData('og:description', 'Acompanhe os cursos promovidos pela Coordenadoria de Educação Permanente, Ensino e Pesquisa -CEPEP do ISGH nas mais diversas áreas da atenção à saúde, com docentes qualificados e excelente estrutura de ensino teórico e prático.');
        $document->setMetaData('og:image', JURI::base().'templates/yoo_avenue/images/isgh-logo-share.png');
		
		$document->setTitle( 'ISGH - ' . 'Cursos e Treinamentos' );
		
        $menu   = $app->getMenu();
        $Itemid = $menu->getItems('component', 'com_lecturesevents');
        $ItemidArr = array();
        
        if($Itemid){
            if(is_array($Itemid)){
                foreach($Itemid as $i){
                    $ItemidArr[$i->alias] = $i;
                }
            }
        }
        
        JPluginHelper::importPlugin('content');
		$share = plgContentBt_socialshare::socialButtons();
	        
        $this->assignRef('events', $events);
        $this->assignRef('share', $share);

        $this->assignRef('itemid', $ItemidArr);
        $this->assignRef('params', $params);
        $this->assignRef('tmpl', $tmpl);

        parent::display($tpl);
    }

}
?>