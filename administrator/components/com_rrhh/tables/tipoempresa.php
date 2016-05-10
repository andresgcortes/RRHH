<?php

// No direct access
defined('_JEXEC') or die;

class conparametrizarTableTipoempresa extends JTable{
	
	public function __construct(&$db)
	{
		parent::__construct('#__contrato_tipo_empresas', 'id_tipo_empresa', $db);
	}
	
	public function check(){
		
		$db = &JFactory::getDBO();
				
		// check for existing username
		$query = $db->getQuery(true);
		$query->select($db->quoteName('id_tipo_empresa'));
		$query->from($db->quoteName('#__contrato_tipo_empresas'));
		$query->where($db->quoteName('nombre') . ' = ' . $db->quote($this->nombre));
		$query->where($db->quoteName('id_tipo_empresa') . ' != ' . (int) $this->id_tipo_empresa);
		$db->setQuery($query);

		$xid = intval($db->loadResult());
				
		if ($xid && $xid != intval($this->id_tipo_empresa))
		{
			$this->setError(JText::_('Tipo empresa ya ingresada'));
			return false;
		}			
		
		return true;
	}
		
}
