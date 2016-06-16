<?php

// No direct access
defined('_JEXEC') or die;

class RrhhTableCargos extends JTable{
	
	public function __construct(&$db){
		parent::__construct('#__core_cargos', 'id_cargo', $db);
	}	
	
	public function check(){
		
		
		/*$db = &JFactory::getDBO();
				
		// check for existing username
		$query = $db->getQuery(true);
		$query->select($db->quoteName('id_actividad'));
		$query->from($db->quoteName('#__contrato_actividades'));
		$query->where($db->quoteName('nombre') . ' = ' . $db->quote($this->nombre));
		$query->where($db->quoteName('id_actividad') . ' != ' . (int) $this->id_actividad);
		$db->setQuery($query);

		$xid = intval($db->loadResult());
				
		if ($xid && $xid != intval($this->id_actividad))
		{
			$this->setError(JText::_('Actividad en usu'));
			return false;
		}		
		*/ 
		
		return true; 
	
	}
		
}
