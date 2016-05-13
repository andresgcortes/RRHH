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

class RrhhModelRrhh_cargo extends JModelItem
{
	protected $msg;
	protected $html;

	

	public function getMsg()
	{
		if (!isset($this->msg))
		{
			$this->msg = 'Rrhh';
		}
		$this->msg = 'Malo';
		return $this->msg;
	}

//Probando Albol
	public function getArbol(){

		JModelLegacy::addIncludePath(JPATH_SITE.'/components/com_rrhh/models');
		$categoriesModel = JModelLegacy::getInstance( 'Cargos', 'RrhhModel');
		$id_area = JRequest::getVar('id_area');	
				
		$this->html = $categoriesModel->getArbolCargos('core_cargos', 2, 0, true, $id_area);
			
		return $this->html;   

	}

}


?>