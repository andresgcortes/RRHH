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

class RrhhModelSucesion extends JModelItem{
	
	protected $item;

	public function getItem(){
		
		$db = JFactory::getDbo();	
		$id_cargo = JRequest::getVar('id_cargo');	
		
		$query = $db->getQuery(true);		
		$query->select('a.nombre as cargo, b.nombre as area, c.nombre as nombre');
		$query->from('#__core_cargos AS a');
		$query->join('inner','#__core_areas AS b ON a.id_area = b.id_area');
		$query->join('left outer','#__core_user AS c ON a.id_cargo = b.id_cargo');
		$query->where('a.id_cargo = '. $id_cargo);
		$db->setQuery($query);	
		$this->item = $db->loadObject();
		
		return $this->item;
	
	}

} ?>