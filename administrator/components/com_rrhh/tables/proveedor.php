<?php

// No direct access
defined('_JEXEC') or die;

class conparametrizarTableProveedor extends JTable{
	
	public function __construct(&$db)
	{
		parent::__construct('#__contrato_proveedores', 'id_proveedor', $db);
	}
	
	public function check(){
			
		$db = &JFactory::getDBO();
				
		// check for existing username
		$query = $db->getQuery(true);
		$query->select($db->quoteName('id_proveedor'));
		$query->from($db->quoteName('#__contrato_proveedores'));
		$query->where($db->quoteName('nombre') . ' = ' . $db->quote($this->nombre));
		$query->where($db->quoteName('nit') . ' = ' . $db->quote($this->nit));
		$db->setQuery($query);

		$xid = intval($db->loadResult());
				
		if ($xid && $xid != intval($this->id_proveedor))
		{
			$this->setError(JText::_('Proveedor ya existe'));
			return false;
		}			
			
		return true;
	}
		
}