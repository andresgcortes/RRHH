<?php
/**
* @package Author
* @author 
* @website 
* @email 
* @copyright 
* @license 
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

class RrhhModelRrhh_cargo extends JModelItem{
	
	protected $html;

	//Probando Albol
	public function getArbol(){

		$id_area = JRequest::getVar('id_area');	
		
		JModelLegacy::addIncludePath(JPATH_SITE.'/components/com_rrhh/models');
		$categoriesModel = JModelLegacy::getInstance('Rrhh', 'RrhhModel');
				
		$this->html = $categoriesModel->getArbolCargos('core_cargos', 2, 0, true, $id_area);
			
		return $this->html;   

	}

} ?>