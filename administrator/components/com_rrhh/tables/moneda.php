<?php

// No direct access
defined('_JEXEC') or die;

class conparametrizarTableMoneda extends JTable{
	
	public function __construct(&$db){
		parent::__construct('#__core_companias_rel_monedas', 'id_moneda', $db);
	}	
	
}
