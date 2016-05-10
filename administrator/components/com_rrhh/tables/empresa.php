<?php

// No direct access
defined('_JEXEC') or die;

class conparametrizarTableempresa extends JTable{
	
	public function __construct(&$db)
	{
		parent::__construct('#__contrato_empresas', 'id_empresa', $db);
	}
	
	public function check(){
		
		$db = &JFactory::getDBO();
				
		// check for existing username
		$query = $db->getQuery(true);
		$query->select($db->quoteName('id_empresa'));
		$query->from($db->quoteName('#__contrato_empresas'));
		$query->where($db->quoteName('nombre') . ' = ' . $db->quote($this->nombre));
		$query->where($db->quoteName('id_empresa') . ' != ' . (int) $this->id_empresa);
		$db->setQuery($query);

		$xid = intval($db->loadResult());
				
		if ($xid && $xid != intval($this->id_empresa))
		{
			$this->setError(JText::_('Empresa ya ingresada'));
			return false;
		}			
		
		return true;
	}
	
	
}
