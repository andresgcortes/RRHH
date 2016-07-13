<?php
/**
* @package Author
* @author 
* @website 
* @email 
* @copyright 
* @license 
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

class RrhhViewRrhh extends JViewLegacy{
	
	function display ($tpl = null){
		
		// Assign data to the view
		$this->html = $this->get('Arbol');
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))){		
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
			return false;
		}

		// Display the view
		parent::display($tpl);
	
	}

} ?>