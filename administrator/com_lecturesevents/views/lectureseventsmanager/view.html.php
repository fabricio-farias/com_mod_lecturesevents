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
jimport('joomla.client.helper');
jimport('joomla.application.component.view');
jimport('joomla.html.pane');

class LecturesEventsCpViewLecturesEventsManager extends JView {

    protected $field;
    protected $fce;
    protected $folderstate;
    protected $images;
    protected $folders;
    protected $tmpl;
    protected $session;
    protected $currentFolder;

    public function display($tpl = null) {

        $this->field = JRequest::getVar('field');
        $this->fce = 'lectSelectFileName_' . $this->field;



        JHTML::stylesheet('administrator/components/com_lecturesevents/assets/lecturesevents.css');


        $this->folderstate = $this->get('FolderState');
        $this->files = $this->get('Files');
        $this->folders = $this->get('Folders');
        $this->session = JFactory::getSession();
        $this->manager = JRequest::getVar('manager', '', '', 'file');

        if ($this->manager == 'filemultiple') {
            $this->form = $this->get('Form');
        }

        $params = JComponentHelper::getParams('com_lecturesevents');

        $this->tmpl['multipleuploadchunk'] = $params->get('multiple_upload_chunk', 0);
        $this->tmpl['uploadmaxsize'] = $params->get('upload_maxsize', 3145728);
        $this->tmpl['uploadmaxsizeread'] = LecturesEventsHelper::getFileSizeReadable($this->tmpl['uploadmaxsize']);
        $this->tmpl['enablemultiple'] = $params->get('enable_multiple', 0);
        $this->tmpl['multipleuploadmethod'] = $params->get('multiple_upload_method', 1);


        $this->currentFolder = '';
        if (isset($this->folderstate->folder) && $this->folderstate->folder != '') {
            $this->currentFolder = $this->folderstate->folder;
        }

        // - - - - - - - - - -
        //TABS
        // - - - - - - - - - - 
        $this->tmpl['tab'] = JRequest::getVar('tab', 0, '', 'int');
        $this->tmpl['displaytabs'] = 0;

        // UPLOAD
        $this->tmpl['currenttab']['upload'] = $this->tmpl['displaytabs'];
        $this->tmpl['displaytabs'] ++;

        // MULTIPLE UPLOAD
        if ((int) $this->tmpl['enablemultiple'] >= 0) {
            $this->tmpl['currenttab']['multipleupload'] = $this->tmpl['displaytabs'];
            $this->tmpl['displaytabs'] ++;
        }

        $group = LecturesEventsHelper::getManagerGroup($this->manager);

        // - - - - - - - - - - -
        // Upload
        // - - - - - - - - - - -
        $sU = new LecturesEventsFileUploadSingle();
        $sU->returnUrl = 'index.php?option=com_lecturesevents&view=lectureseventsmanager&tab=' . $this->tmpl['currenttab']['upload'] . str_replace('&amp;', '&', $group['c']) . '&manager=' . $this->manager . '&field=' . $this->field . '&folder=' . $this->currentFolder;
        $sU->tab = $this->tmpl['currenttab']['upload'];
        $this->tmpl['su_output'] = $sU->getSingleUploadHTML();
        $this->tmpl['su_url'] = JURI::base() . 'index.php?option=com_lecturesevents&task=lectureseventsupload.upload&amp;'
                . $this->session->getName() . '=' . $this->session->getId() . '&amp;'
                . JUtility::getToken() . '=1&amp;viewback=lectureseventsmanager&amp;manager=' . $this->manager . '&amp;field=' . $this->field . '&amp;'
                . 'folder=' . $this->currentFolder . '&amp;tab=' . $this->tmpl['currenttab']['upload'];


        // - - - - - - - - - - -
        // Multiple Upload
        // - - - - - - - - - - -
        // Get infos from multiple upload
        $muFailed = JRequest::getVar('mufailed', '0', '', 'int');
        $muUploaded = JRequest::getVar('muuploaded', '0', '', 'int');
        $this->tmpl['mu_response_msg'] = $muUploadedMsg = '';

        if ($muUploaded > 0) {
            $muUploadedMsg = JText::_('COM_LECTURESEVENTS_COUNT_UPLOADED_FILE') . ': ' . $muUploaded;
        }
        if ($muFailed > 0) {
            $muFailedMsg = JText::_('COM_LECTURESEVENTS_COUNT_NOT_UPLOADED_FILE') . ': ' . $muFailed;
        }
        if ($muFailed > 0 && $muUploaded > 0) {
            $this->tmpl['mu_response_msg'] = '<div class="pgunsetmsg">'
                    . JText::_('COM_LECTURESEVENTS_COUNT_UPLOADED_FILE') . ': ' . $muUploaded . '<br />'
                    . JText::_('COM_LECTURESEVENTS_COUNT_NOT_UPLOADED_FILE') . ': ' . $muFailed . '</div>';
        } else if ($muFailed > 0 && $muUploaded == 0) {
            $this->tmpl['mu_response_msg'] = '<div class="pgerrormsg">'
                    . JText::_('COM_LECTURESEVENTS_COUNT_NOT_UPLOADED_FILE') . ': ' . $muFailed . '</div>';
        } else if ($muFailed == 0 && $muUploaded > 0) {
            $this->tmpl['mu_response_msg'] = '<div class="pgsuccessmsg">'
                    . JText::_('COM_LECTURESEVENTS_COUNT_UPLOADED_FILE') . ': ' . $muUploaded . '</div>';
        } else {
            $this->tmpl['mu_response_msg'] = '';
        }

        if ((int) $this->tmpl['enablemultiple'] >= 0) {

            lectureseventsFileUploadMultiple::renderMultipleUploadLibraries();
            $mU = new lectureseventsFileUploadMultiple();
            $mU->frontEnd = 0;
            $mU->method = $this->tmpl['multipleuploadmethod'];
            $mU->url = JURI::base() . 'index.php?option=com_lecturesevents&task=lectureseventsupload.multipleupload&amp;'
                    . $this->session->getName() . '=' . $this->session->getId() . '&'
                    . JUtility::getToken() . '=1&tab=' . $this->tmpl['currenttab']['multipleupload']
                    . '&manager=' . $this->manager . '&field=' . $this->field . '&folder=' . $this->currentFolder;
            $mU->reload = JURI::base() . 'index.php?option=com_lecturesevents&view=lectureseventsmanager'
                    . str_replace('&amp;', '&', $group['c']) . '&'
                    . $this->session->getName() . '=' . $this->session->getId() . '&'
                    . JUtility::getToken() . '=1&tab=' . $this->tmpl['currenttab']['multipleupload'] . '&'
                    . 'manager=' . $this->manager . '&field=' . $this->field . '&folder=' . $this->currentFolder;
            $mU->maxFileSize = LecturesEventsFileUploadMultiple::getMultipleUploadSizeFormat($this->tmpl['uploadmaxsize']);
            $mU->chunkSize = '1mb';

            $mU->renderMultipleUploadJS(0, $this->tmpl['multipleuploadchunk']);
            $this->tmpl['mu_output'] = $mU->getMultipleUploadHTML();
        }


        $this->tmpl['ftp'] = !JClientHelper::hasCredentials('ftp');
        $this->tmpl['path'] = LecturesEventsHelper::getPathSet($this->manager);

        $this->addToolbar();
        parent::display($tpl);
        echo JHTML::_('behavior.keepalive');
    }

    function setFolder($index = 0) {
        if (isset($this->folders[$index])) {
            $this->_tmp_folder = &$this->folders[$index];
        } else {
            $this->_tmp_folder = new JObject;
        }
    }

    function setFile($index = 0) {
        if (isset($this->files[$index])) {
            $this->_tmp_file = &$this->files[$index];
        } else {
            $this->_tmp_file = new JObject;
        }
    }

    protected function addToolbar() {

        JRequest::setVar('hidemainmenu', true);
        require_once JPATH_COMPONENT . DS . 'helpers' . DS . 'lectureseventsmanager.php';

        $state = $this->get('State');
        $canDo = LecturesEventsManagerHelper::getActions($state->get('filter.multiple'));

        JToolBarHelper::title(JText::_('COM_LECTURESEVENTS_MULTIPLE_ADD'), 'multiple.png');

        if ($canDo->get('core.create')) {
            JToolBarHelper::save('lectureseventsm.save', 'JTOOLBAR_SAVE');
        }

        JToolBarHelper::cancel('lectureseventsm.cancel', 'JTOOLBAR_CLOSE');
        JToolBarHelper::divider();
        JToolBarHelper::help('screen.lecturesevents', true);
    }

}

?>