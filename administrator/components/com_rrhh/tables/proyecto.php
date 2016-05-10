<?php

// No direct access
defined('_JEXEC') or die;

class ConparametrizarTableProyecto extends JTable{
	
	public function __construct(&$db)
	{
		parent::__construct('#__comforce_proyectos', 'id_proyecto', $db);
	}
	
	/*public function check(){
		
		$db = &JFactory::getDBO();
				
		// check for existing username
		$query = $db->getQuery(true);
		$query->select($db->quoteName('id_proyecto'));
		$query->from($db->quoteName('#__comforce_proyectos'));
		$query->where($db->quoteName('nombre') . ' = ' . $db->quote($this->nombre));
		$query->where($db->quoteName('id_proyecto') . ' != ' . (int) $this->id_proyecto);
		$db->setQuery($query);

		$xid = intval($db->loadResult());
				
		if ($xid && $xid != intval($this->id_proyecto))
		{
			$this->setError(JText::_('Nombre de Proyecto ya ingresado'));
			return false;
		}			
		
		return true;
	}*/
		
}
