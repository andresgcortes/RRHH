<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 
 */


defined('_JEXEC') or die;

class RrhhViewTags extends JViewLegacy{
	
	protected $items;
	protected $pagination;
	
	protected $item;
	protected $form;
	protected $state;

	public function display($tpl = null){
		
		$this->items        = $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		
		$this->item      	= $this->get('Item');
		$this->form         = $this->get('Form');
				
		$this->state        = $this->get('State');
		
		/*$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');*/
				
		// Check for errors.
		if (count($errors = $this->get('Errors'))){			
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
			return false;		
		}
		
		if(!empty($this->items)){			
			foreach ($this->items as &$item){
				$this->ordering[$item->parent_id][] = $item->id;
			}		
		}
		
		parent::display($tpl);
	}

}
