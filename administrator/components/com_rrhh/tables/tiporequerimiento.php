<?php

// No direct access
defined('_JEXEC') or die;

class conparametrizarTableTiporequerimiento extends JTable{
	
	public function __construct(&$db)
	{
		parent::__construct('#__contrato_tipo_requerimientos', 'id_tipo_requerimiento', $db);
	}
	
	public function check(){
		
		$db = &JFactory::getDBO();
				
		// check for existing username
		$query = $db->getQuery(true);
		$query->select($db->quoteName('	id_tipo_requerimiento'));
		$query->from($db->quoteName('#__contrato_tipo_requerimientos'));
		$query->where($db->quoteName('nombre') . ' = ' . $db->quote($this->nombre));
		$query->where($db->quoteName('id_tipo_requerimiento') . ' != ' . (int) $this->id_tipo_requerimiento);
		$db->setQuery($query);

		$xid = intval($db->loadResult());
				
		if ($xid && $xid != intval($this->id_tipo_requerimiento))
		{
			$this->setError(JText::_('Tipo de requerimiento  ya ingresada'));
			return false;
		}			
		
		return true;
	}
	
	
}