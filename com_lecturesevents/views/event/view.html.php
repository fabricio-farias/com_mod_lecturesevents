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

class LecturesEventsViewEvent extends JView {

    protected $event;

    function display($tpl = null) {

        $app = JFactory::getApplication();
        $params = $app->getParams();
        $tmpl = array();
        $tmpl['user'] = &JFactory::getUser();
        $uri = &JFactory::getURI();
        $model = &$this->getModel();
		
        $this->eventId = JRequest::getVar('id', 0, '', 'int');
        $limitStart = JRequest::getVar('limitstart', 0, '', 'int');
        $this->event = $model->getEvent($this->eventId);

		$document = &JFactory::getDocument();
        //for GOOGLE+
        $document->addCustomTag('<meta itemprop="name" content="ISGH - Cursos e Treinamentos" />');
        $document->addCustomTag('<meta itemprop="description" content="'.$this->event[0]->title.'" />');
        $document->addCustomTag('<meta itemprop="image" content="'.JURI::base().$this->event[0]->image.'" />');
        //for FACEBOOK
        $document->setMetaData('og:url', JURI::getInstance()->toString());
        $document->setMetaData('og:title', 'ISGH - Cursos e Treinamentos');
        $document->setMetaData('og:description', $this->event[0]->title);
        $document->setMetaData('og:image', JURI::base().$this->event[0]->image);
				
		$document->setTitle( 'ISGH - ' . $this->event[0]->title );
		
		JPluginHelper::importPlugin('content');
		$share = plgContentBt_socialshare::socialButtons();
		
        // Limit start
        if ($limitStart > 0) {
            $tmpl['limitstarturl'] = '&start=' . $limitStart;
        } else {
            $tmpl['limitstarturl'] = '';
        }

//        $tmpl['items'] = $params->get('default_items');

        $this->assignRef('tmpl', $tmpl);
        $this->assignRef('params', $params);
        $this->assignRef('event', $this->event);
		$this->assignRef('share', $share);

        parent::display($tpl);
    }

}

?>