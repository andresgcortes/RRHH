<?php

// No direct access
defined('_JEXEC') or die;

class conparametrizarTableobjeto extends JTable{
	
	public function __construct(&$db)
	{
		parent::__construct('#__core_rup_especialidad', 'id_especialidad', $db);
	}
	
	
	public function check(){
		
//		/*$db = &JFactory::getDBO();
//				
//		// check for existing username
//		$query = $db->getQuery(true);
//		$query->select($db->quoteName('id_especialidad'));
//		$query->from($db->quoteName('#__contrato_objetos'));
//		$query->where($db->quoteName('objeto') . ' = ' . $db->quote($this->objeto));
//		$query->where($db->quoteName('id_especialidad') . ' != ' . (int) $this->id_objeto);
//		$query->where($db->quoteName('id_actividad') . ' = ' . (int) $this->id_actividad);
//		$db->setQuery($query);
//				
//		$xid = intval($db->loadResult());
//				
//		if ($xid && $xid != intval($this->id_objeto))
//		{
//			$this->setError(JText::_('Objeto de contrato ya creado'));
//			return false;
//		}	*/		
		
		return true;
	}
	
		
}
