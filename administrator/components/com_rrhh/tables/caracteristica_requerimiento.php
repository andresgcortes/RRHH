<?php

// No direct access
defined('_JEXEC') or die;

class conparametrizarTablecarac_reque extends JTable{
	
	public function __construct(&$db){
		parent::__construct('#__contrato_caracteristicas_p_requerimientos', 'id_requerimiento', $db);
	}		
	
}
