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
		$query->select('a.nombre as cargo, b.nombre as area, c.id_user, c.nombre as nombre, c.foto, timestampdiff(MONTH, date_cargo, now()) AS tiempoc, c.nota');
		$query->from('#__core_cargos AS a');
		$query->join('inner','#__core_areas AS b ON a.id_area = b.id_area');
		$query->join('left outer','#__core_user AS c ON a.id_cargo = b.id_cargo');
		$query->where('a.id_cargo = '. $id_cargo);
		$db->setQuery($query);	
		$this->item = $db->loadObject();
		
		$query = $db->getQuery(true);		
		$query->select('c.id_user, c.nombre as nombre, c.foto, d.alias, d.color, timestampdiff(MONTH, date_cargo, now()) AS tiempoc, c.nota');
		$query->from('#__core_cargos_rel_users AS a');
		$query->join('inner','#__core_user AS c ON a.id_user = c.id_user');
		$query->join('inner','#__core_tiempos AS d ON a.id_tiempo = d.id_tiempo');
		$query->where('a.id_cargo = '. $id_cargo);
		$db->setQuery($query);	
		$this->item->sucesion = $db->loadObjectList();
				
		return $this->item;
	
	}

} ?>