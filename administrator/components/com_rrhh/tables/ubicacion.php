<?php

// No direct access
defined('_JEXEC') or die;

class conparametrizarTableUbicacion extends JTable{
	
	public function __construct(&$db)
	{
		parent::__construct('#__contrato_ubicaciones', 'id_ubicacion', $db);
	}
	
	public function check(){
		
		$db = &JFactory::getDBO();
				
		// check for existing username
		$query = $db->getQuery(true);
		$query->select($db->quoteName('id_ubicacion'));
		$query->from($db->quoteName('#__contrato_ubicaciones'));
		$query->where($db->quoteName('nombre') . ' = ' . $db->quote($this->nombre));
		$db->setQuery($query);

		$xid = intval($db->loadResult());
				
		if ($xid && $xid != intval($this->id_ubicacion))
		{
			$this->setError(JText::_('Tipo Ubicación ya existe'));
			return false;
		}			
		
		return true;
	}
		
}