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
jimport('joomla.application.component.model');

class LecturesEventsModelEvent extends JModel {

    var $_document = null;
    var $_event = null;
    var $_event_ordering = null;
    var $_pagination = null;
    var $_total = null;

    function __construct() {

        $app = JFactory::getApplication();

        parent::__construct();

        $config = JFactory::getConfig();

//        $paramsC = JComponentHelper::getParams('com_lecturesevents');
//        $defaultPagination = $paramsC->get('default_pagination', '20');

        // Get the pagination request variables
        $this->setState('limit', $app->getUserStateFromRequest('com_lecturesevents.limit', 'limit', '20', 'int'));
        $this->setState('limitstart', JRequest::getVar('limitstart', 0, '', 'int'));

        // In case limit has been changed, adjust limitstart accordingly
        $this->setState('limitstart', ($this->getState('limit') != 0 ? (floor($this->getState('limitstart') / $this->getState('limit')) * $this->getState('limit')) : 0));

        $this->setState('filter.language', $app->getLanguageFilter());

        // Get the filter request variables
        $this->setState('filter_order', JRequest::getCmd('filter_order', 'ordering'));
        $this->setState('filter_order_dir', JRequest::getCmd('filter_order_Dir', 'ASC'));
    }


    function getList($query) {
        return $this->_getList($query, 0, 1);
    }

    function getEvent($eventId) {
        if (empty($this->_event)) {
            $query = $this->_getEventsListQueryById($eventId);
            $this->_event = $this->_getList($query, 0, 1);
        }
        return $this->_event;
    }



    function _getEventsListQueryById($id = array()){
        
        $wheres = array();
        $db = JFactory::getDbo();

        $wheres[] = "a.published IN (1)";


        if($id){
            if(is_array($id)){
                $wheres[] = ' a.`id` in('.implode(",", $id).') ';
            }else{
                $wheres[] = ' a.`id` in('.$id.') ';
            }
        }

        // Active
        $jnow		=& JFactory::getDate();
        $now		= $jnow->toMySQL();
        $nullDate	= $db->getNullDate();
        $wheres[] = ' ( a.publish_up = '.$db->Quote($nullDate).' OR a.publish_up <= '.$db->Quote($now).' )';
        $wheres[] = ' ( a.publish_down = '.$db->Quote($nullDate).' OR a.publish_down >= '.$db->Quote($now).' )';

        $n = count($wheres);
        if($n > 0){
            $wheres = 'WHERE (' . implode( ' AND ', $wheres) . ')';
        }

        $query = "SELECT a.*,l.title AS language_title,c.title AS category_title, c.id AS category_id "
               . "FROM #__lecturesevents AS a "
               . "LEFT JOIN #__languages AS l ON l.lang_code = a.language "
               . "LEFT JOIN #__lecturesevents_categories AS c ON c.id = a.catid "
               . "LEFT JOIN #__lecturesevents_locations AS lc ON lc.id = a.locid "
               . $wheres
               . " GROUP BY a.id ORDER BY a.ordering DESC"
               ;

        return $query;
    }
}

?>