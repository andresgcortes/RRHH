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

class RrhhModelEmpleados extends JModelItem{
	
	protected $item;

	public function getItem(){
		
		$db = JFactory::getDbo();	
		$id_user = JRequest::getVar('id_user');	
		
		$query = $db->getQuery(true);		
		$query->select('a.nombre as cargo, b.nombre as area, c.id_user, c.nombre as nombre, c.foto, c.date_cargo, c.date_ingreso, timestampdiff(MONTH, date_cargo, now()) AS tiempoc, c.nota');
		$query->from('#__core_cargos AS a');
		$query->join('inner','#__core_areas AS b ON a.id_area = b.id_area');
		$query->join('left outer','#__core_user AS c ON a.id_cargo = b.id_cargo');
		$query->where('c.id_cargo = '. $id_user);
		$db->setQuery($query);	
		$this->item = $db->loadObject();
		
		$query = $db->getQuery(true);		
		$query->select('b.alias, b.color, c.nombre as cargo, d.nombre as area');
		$query->from('#__core_cargos_rel_users AS a');
		$query->join('inner','#__core_tiempos AS b ON a.id_tiempo = b.id_tiempo');
		$query->join('inner','#__core_cargos AS c ON c.id_cargo = a.id_cargo');
		$query->join('inner','#__core_areas AS d ON d.id_area = c.id_area');
		$query->where('a.id_user = '. $id_user);
		$query->order('b.id_tiempo ASC');
		$db->setQuery($query);	
		$this->item->sucesion = $db->loadObjectList();
		
		$query = $db->getQuery(true);		
		$query->select('b.nombre as cargo, a.date_fin, a.date_inicio');
		$query->from('#__core_user_cargos AS a');
		$query->join('inner','#__core_cargos AS b ON b.id_cargo = a.id_cargo');
		$query->where('a.id_user = '. $id_user);
		$db->setQuery($query);	
		$this->item->cargos = $db->loadObjectList();
				
		return $this->item;
	
	}

} ?>