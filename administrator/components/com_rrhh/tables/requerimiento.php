<?php

// No direct access
defined('_JEXEC') or die;

class conparametrizarTableRequerimiento extends JTable{
	
	public function __construct(&$db)
	{
		parent::__construct('#__requerimientos', 'id_requerimiento', $db);
	}
	
	public function check(){
		
		$db = &JFactory::getDBO();
				
		// check for existing username
		$query = $db->getQuery(true);
		$query->select($db->quoteName('id_requerimiento'));
		$query->from($db->quoteName('#__requerimientos'));
		$query->where($db->quoteName('nombre') . ' = ' . $db->quote($this->nombre));
		$query->where($db->quoteName('id_categoria') . ' = ' . (int) $this->categoria);
		$db->setQuery($query);

		$xid = intval($db->loadResult());
				
		if ($xid && $xid != intval($this->id_requerimiento)){
			
			$this->setError(JText::_('Requerimiento ya Existe '));
			return false;
		}			
		
		return true;
	}
		
}
