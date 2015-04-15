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
jimport('joomla.database.database');jimport( 'joomla.database.table' );jimport('joomla.html.parameter');
jimport('joomla.application.component.model');

class modLecturesEventsHelper{
    
    var $_locations             = null;
    var $_locations_ordering    = null;
    var $_location_ordering     = null;
    var $_events                = null;
    var $_params                = null;
    var $_db                    = null;
    
    function __construct($params = array()){
        
        $app = JFactory::getApplication();
        $this->_params = $params;
        $this->_db = JFactory::getDbo();
    }
    
//    static function getList(&$params){
//        $db = JFactory::getDbo();
//        $query	= $db->getQuery(true);
//        
//        $wheres = array();
//        $categories = implode(",", $params->get('category'));
//        
//        $wheres[] = "a.published IN (1)";
//        $wheres[] = "a.catid IN ({$categories})";
//        
//        // Active
//        $jnow		=& JFactory::getDate();
//        $now		= $jnow->toMySQL();
//        $nullDate	= $db->getNullDate();
//        $wheres[] = ' ( a.publish_up = '.$db->Quote($nullDate).' OR a.publish_up <= '.$db->Quote($now).' )';
//        $wheres[] = ' ( a.publish_down = '.$db->Quote($nullDate).' OR a.publish_down >= '.$db->Quote($now).' )';
//                
//        $query = "SELECT a.*,l.title AS language_title,c.title AS category_title, c.id AS category_id "
//               . "FROM #__lecturesevents AS a "
//               . "LEFT JOIN #__languages AS l ON l.lang_code = a.language "
//               . "LEFT JOIN #__lecturesevents_categories AS c ON c.id = a.catid "
//               . "WHERE ".implode( " AND ", $wheres )
//               . " GROUP BY a.id ORDER BY a.ordering {$params->get('ordering')}"
//               ;
//
//        $db->setQuery($query);
//        $rows = $db->loadObjectList();
//
//        return $rows;
//    }
    
    
    
    function _getList($query, $limitstart = 0, $limit = 0)
    {
            $this->_db->setQuery($query, $limitstart, $limit);
            $result = $this->_db->loadObjectList();

            return $result;
    }
    
    
    function getEventsByLocationsList() {
        
        if (empty($this->_locations)) {
            $query = $this->_getLocationsListQuery();
            $this->_locations = $this->_getList($query);

            if (!empty($this->_locations)) {
                foreach ($this->_locations as $key => $value) {
                    $query = $this->_getEventsListQuery($value->id);
                    $this->_locations[$key]->locations = $this->_getList($query);
                }
            }
        }

        return $this->_locations;
    }
    
    function getEventsList() {
        
        if(empty($this->_events)){
            $query = $this->_getEventsListQuery();
            $this->_events = $this->_getList($query);
        }
        
        return $this->_events;
    }
    
    
    function _getLocationsListQuery(){
        
        $wheres = array();
        $app = JFactory::getApplication();
        $params = $this->_params;
        $user = JFactory::getUser();
        $userLevels = implode(',', $user->authorisedLevels());
        
        
        $wheres[] = " lc.published = 1";
        $wheres[] = " lc.access IN (" . $userLevels . ")";

        $query = " SELECT lc.id, lc.title, lc.alias"
                . " FROM #__lecturesevents_locations as lc"
                . " WHERE " . implode(" AND ", $wheres)
                . " ORDER BY lc.ordering"
                ;
        
        return $query;
    }
    
    
    function _getEventsListQuery($lid = array()){
        
        $wheres = array();
        $params = $this->_params;
        $db = $this->_db;

        if($params->get('category')){
            $categories = (is_array($params->get('category'))) ? implode(",", $params->get('category')) : $params->get('category');
            $wheres[] = "a.catid IN ({$categories})";
        }
        
        if($params->get('type')){
            $wheres[] = "a.type = {$params->get('type')}";
        }
        
        
        $wheres[] = "a.published IN (1)";
        
        
        if($lid){
            if(is_array($lid)){
                $wheres[] = ' a.`locid` in('.implode(",", $lid).') ';
            }else{
                $wheres[] = ' a.`locid` in('.$lid.') ';
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
               . " GROUP BY a.id ORDER BY a.ordering {$params->get('ordering')}"
               ;

        //die($db->replacePrefix($query));
        return $query;
    }
    
    function getItemid(){
        $app   = JFactory::getApplication();
        $menu   = $app->getMenu();
        $Itemid = $menu->getItems('component', 'com_lecturesevents');
        $view = array();
        
        if($Itemid){
            if(is_array($Itemid)){
                foreach($Itemid as $i){
                    $view[$i->alias] = $i;
                }
            }
        }
        
        return $view;
    }
}