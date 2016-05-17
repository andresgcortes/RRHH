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

class RrhhViewCargos extends JViewLegacy{
	
	protected $state;
	protected $items;
	protected $pagination;

	function display ($tpl = null){
		
		$this->items         = $this->get('Items');
		$this->pagination    = $this->get('Pagination');
		$this->state         = $this->get('State');
		/*$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');*/
				
		// Check for errors.
		if (count($errors = $this->get('Errors'))){
			
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
			return false;
		}

		// Display the view
		parent::display($tpl);
	}

} ?>