<?php

// No direct access
defined('_JEXEC') or die;

class conparametrizarTablecaracteristica extends JTable{
	
	public function __construct(&$db){
		parent::__construct('#__contrato_caracteristicas_p', 'id_caracteristica_p', $db);
	}	
	
	public function check(){
		
		$db = &JFactory::getDBO();
				
		// check for existing username
		$query = $db->getQuery(true);
		$query->select($db->quoteName('id_caracteristica_p'));
		$query->from($db->quoteName('#__contrato_caracteristicas_p'));
		$query->where($db->quoteName('nombre') . ' = ' . $db->quote($this->nombre));
		$query->where($db->quoteName('isvalor') . ' = ' . $db->quote($this->isvalor));
		$query->where($db->quoteName('isobservacion') . ' = ' . $db->quote($this->isobservacion));
		$query->where($db->quoteName('isfile') . ' = ' . $db->quote($this->isfile));
				
		$db->setQuery($query);

		$xid = intval($db->loadResult());
				
		if ($xid && $xid != intval($this->id_caracteristica_p))
		{
			$this->setError(JText::_('La caracteristica ingresada con sus opciones ya existe'));
			return false;
		}			
		
		return true;
	}
	
}
