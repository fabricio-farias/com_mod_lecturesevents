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
jimport('joomla.filter.input');

class TableLecturesEventsCat extends JTable
{
	
	function __construct(& $db) {
		parent::__construct('#__lecturesevents_categories', 'id', $db);
	}
	
	function check()
	{
		// check for valid name
		if (trim( $this->title ) == '') {
			$this->setError( JText::_( 'CATEGORY MUST HAVE A TITLE') );
			return false;
		}

		if(empty($this->alias)) {
			$this->alias = $this->title;
		}
		//$this->alias = LecturesEventsHelper::get AliasName($this->alias);

		return true;
	}
}
?>