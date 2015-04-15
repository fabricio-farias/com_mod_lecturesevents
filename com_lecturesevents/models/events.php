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


class LecturesEventsModelEvents extends JModel
{
	var $_events		= null;
	var $_locations         = null;
	var $_events_ordering	= null;
	var $_event_ordering	= null;
        var $_params            = null;
        

	function __construct() {
		$app	= JFactory::getApplication();
		parent::__construct();
		
		$this->setState('filter.language',$app->getLanguageFilter());
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
            $db = JFactory::getDbo();
            $app		= JFactory::getApplication();
            $params 	= $app->getParams();
            
            if($params->get('catid')){
                $wheres[] = "a.catid = " . $params->get('catid');
            }

            if($params->get('type')){
                $wheres[] = "a.type = {$params->get('type')}";
            }

            $wheres[] = "a.published IN (1)";

            if($params->get('locid')){
                $lid = $params->get('locid');
            }

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
            if($params->get('ordering')){
                $ordering = $params->get('ordering');
            }else{
                $ordering = 'DESC';
            }

            $query = "SELECT a.*,l.title AS language_title,c.title AS category_title, c.id AS category_id "
                   . "FROM #__lecturesevents AS a "
                   . "LEFT JOIN #__languages AS l ON l.lang_code = a.language "
                   . "LEFT JOIN #__lecturesevents_categories AS c ON c.id = a.catid "
                   . "LEFT JOIN #__lecturesevents_locations AS lc ON lc.id = a.locid "
                   . $wheres
                   . " GROUP BY a.id ORDER BY a.ordering ".$ordering
                   ;

            return $query;
        }

}
?>