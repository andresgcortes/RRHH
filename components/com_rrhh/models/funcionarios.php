<?php

//-- No direct access

defined('_JEXEC') or die('=;)');

class RrhhModelFuncionarios extends JModelList{

	public function __construct($config = array()){	

		if (empty($config['filter_fields'])) {

			$config['filter_fields'] = array(
				'nombre', 'a.nombre',
				'disabled', 'a.disabled',
			);
			
			if (JLanguageAssociations::isEnabled()){
				$config['filter_fields'][] = 'association';
			}

		}

		parent::__construct($config);

	}

	protected function populateState($ordering = null, $direction = null)	{
	
		$this->setState('filter.search', $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search'));
			
		$id_area = $this->getUserStateFromRequest($this->context . '.filter.id_area', 'filter_id_area');
		$this->setState('filter.id_area', $id_area);

		// Load the parameters.
		$this->setState('params', JComponentHelper::getParams('com_rrhh'));

		// List state information.
		parent::populateState($ordering, $direction);

	}

	protected function getStoreId($id = ''){
		
		// Compile the store id.
		$id	.= ':'.$this->getState('filter.search');
		
		return parent::getStoreId($id);

	}
	
	function getListQuery(){
	
		// Create a new query object.
		$db 		= $this->getDbo();
		$my			= JFactory::getUser();
		
		$query = $db->getQuery(true);

		$query->select(
			$this->getState('list.select', 'a.*, b.nombre as area, c.nombre as cargo')
		);

		$query->from('#__core_user AS a');
		$query->join('inner','#__core_cargos AS c ON a.id_cargo = c.id_cargo');		
		$query->join('inner','#__core_areas AS b ON b.id_area = c.id_area');
		
		$search = $this->getState('filter.search');
		
		if (!empty($search)){
			if (stripos($search, 'id:') === 0){
				$query->where('a.id_cargo = '.(int) substr($search, 3));
			}else {
				$search = $db->quote('%' . str_replace(' ', '%', $db->escape(trim($search), true) . '%'));
				$query->where('(a.nombre LIKE '.$search.')');
			}
		}
		
		$listOrdering 	= $this->getState('list.ordering', 'a.nombre');
		$listDirn 		= $db->escape($this->getState('list.direction', 'ASC'));
		
		$query->order($db->escape($listOrdering) . ' ' . $listDirn);
					
		return $query;

	}//function
	
}//class