<?php

// No direct access
defined('_JEXEC') or die;

class conparametrizarTableCompania extends JTable{
	
	public function __construct(&$db)
	{
		parent::__construct('#__contrato_companias', 'id_companias', $db);
	}
	
	public function check(){
		
		$db = &JFactory::getDBO();
				
		// check for existing username
		$query = $db->getQuery(true);
		$query->select($db->quoteName('id_companias'));
		$query->from($db->quoteName('#__contrato_companias'));
		$query->where($db->quoteName('nombre') . ' = ' . $db->quote($this->nombre));
		$query->where($db->quoteName('nit') . ' = ' . $db->quote($this->nit));
		$query->where($db->quoteName('email') . ' = ' . $db->quote($this->email));
		$db->setQuery($query);

		$xid = intval($db->loadResult());
				
		if ($xid && $xid != intval($this->id_companias))
		{
			$this->setError(JText::_('Compañia ya existe'));
			return false;
		}			
		
		return true;
	}
		
}