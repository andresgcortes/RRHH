<?php

// No direct access
defined('_JEXEC') or die;

class RrhhTableFuncionarios extends JTable{
	
	public function __construct(&$db)
	{
		parent::__construct('#__core_user', 'id_user', $db);
	}
	
	public function check(){
		
		$db = JFactory::getDBO();
				
		// check for existing username
		$query = $db->getQuery(true);
		$query->select($db->quoteName('id_user'));
		$query->from($db->quoteName('#__core_user'));
		$query->where($db->quoteName('nombre') . ' = ' . $db->quote($this->nombre));
		$query->where($db->quoteName('id_cargo') . ' = ' . (int) $this->id_cargo);
		$query->where($db->quoteName('codigo') . ' = ' . (int) $this->codigo);
		$query->where($db->quoteName('id_user') . ' != ' . (int) $this->id_user);
		$db->setQuery($query);
		
		$xid = intval($db->loadResult());
				
		if ($xid && $xid != intval($this->id_empresa)){
			$this->setError(JText::_('Usuario Ya ingresado'));
			return false;
		}	
		
		return true;
	}
	
} ?> 
