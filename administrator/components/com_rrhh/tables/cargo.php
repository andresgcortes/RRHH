<?php

// No direct access
defined('_JEXEC') or die;

class conparametrizarTableCargo extends JTable{
	
	public function __construct(&$db)
	{
		parent::__construct('#__core_cargo', 'id_cargo', $db);
	}
	
	public function check(){
		
		$db = &JFactory::getDBO();
				
		// check for existing username
		$query = $db->getQuery(true);
		$query->select($db->quoteName('id_cargo'));
		$query->from($db->quoteName('#__core_cargo'));
		$query->where($db->quoteName('name') . ' = ' . $db->quote($this->name));
		$db->setQuery($query);

		$xid = intval($db->loadResult());
				
		if ($xid && $xid != intval($this->id_cargo))
		{
			$this->setError(JText::_('El Cargo ingresado ya existe'));
			return false;
		}			
		
		return true;
	}
		
}