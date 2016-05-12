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

jimport('joomla.application.component.modelitem');
jimport('joomla.application.component.model');

class RrhhModelRrhh extends JModelItem{
	
	protected $msg;
	protected $html;

	//Probando Albol
	public function getArbol(){

		JModelLegacy::addIncludePath(JPATH_SITE.'/components/com_rrhh/models');
		
		$categoriesModel = JModelLegacy::getInstance('Cargos', 'RrhhModel');
		
		$this->html = $categoriesModel->getArbolCargos('core_areas', 1, 1, true);


		return $this->html;   

	}

} ?>