<?php

// No direct access
defined('_JEXEC') or die;

class conparametrizarTableArea extends JTable{
	
	public function __construct(&$db)
	{
		parent::__construct('#__core_areas', 'id_area', $db);
	}
	
	public function check(){
		
		$db = &JFactory::getDBO();
				
		// check for existing username
		$query = $db->getQuery(true);
		$query->select($db->quoteName('id_area'));
		$query->from($db->quoteName('#__core_areas'));
		$query->where($db->quoteName('nombre') . ' = ' . $db->quote($this->nombre));
		$db->setQuery($query);

		$xid = intval($db->loadResult());
				
		if ($xid && $xid != intval($this->id_area))
		{
			$this->setError(JText::_('El nombre de area que desea ingresar ya existe'));
			return false;
		}			
		
		return true;
	}
		
}