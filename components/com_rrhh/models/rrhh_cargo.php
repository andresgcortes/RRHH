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
		
		echo $this->getImgpdf($id_area);
		$categoriesModel->getArbolCargos('core_cargos', 2, 0, true, $id_area);
			
		return $this->html;   

	}
	
	public function getImgpdf($id_area){
		
		$component 	= JRequest::getVar('tmpl');
		$html 		= ''; 
		
		if($component == 'component'){
			
			$html.= '<div style="float: right; margin-right: 25px; margin-top: 15px;">	
				<a href="javascript:void(0);" onclick="Joomla.submitbutton(\'rrhh.descargarpdf\')" class="button-color">
					Exportar PDF
				</a>
			</div>';
		
		}else{
			
			$html = '<div style="float: right; margin-right: 25px; margin-top: -28px;">							
				<a href="index.php?option=com_rrhh&view=rrhh_cargo&tmpl=component&id_area='. $id_area.'" target="_blank">
					Exportar PDF
				</a>
			</div>';
					
			
		}
		return $html; 
	}

} ?>