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

class RrhhModelCargos extends JModelItem{
	
	protected $msg;

	public function getMsg()
	{
		if (!isset($this->msg))
		{
			$this->msg = 'Rrhh';
		}
		$this->msg = 'Malo';

		return $this->msg;
	}

	public function getArbolCardos(){

		$db = JFactory::getDbo();

		$this->html = '';

		$query = "SELECT parent_id as id, nombre as nombre
				  FROM rrhh_core_areas 
				  WHERE parent_id != 0 
				  GROUP BY parent_id";

		$db->setQuery($query);
  		$area =  $db->loadObjectList();

  		if(count($area) > 0){

  			$this->html  .= '<ul id="org" style="display:none">';

  			$datosAlbol = min($area);



  			$herecia = $this->getArbolCardosSub($datosAlbol->id);

  				$this->html  .='
				    <li>
				       
				        <div class="cuadroc">
				        	'.$datosAlbol->nombre.'
				        </div>
				        '.$herecia.'
				     </li>
				     
				    ';


  			
  			}

		    $this->html .= '</ul>';
		   
  			$this->html .= '<div class="well">
				   		<div id="chart" class="orgChart"></div>	 
				   		<div> ';
			echo $this->html ;	   		

  		}

  		public function getArbolCardosSub($id){

  			
  			$id = $id + 1 ;

  			$htmlD = '';
  			
  			$db = JFactory::getDbo();
			$query = "SELECT a.parent_id as id, a.nombre as nombre
				  FROM rrhh_core_areas  as a
				  WHERE a.parent_id =".$id."
				  ORDER BY a.parent_id";


			$db->setQuery($query);
	  		$dato =  $db->loadObjectList();


	  		if(count($dato) > 0){

	  			$htmlD .= '<ul>';

	  			 foreach ($dato as $key => $datoValue) {
	  			 	$htmlD .= '<li >
					       
						        <div class="cuadroc">
						        	<p>'.$datoValue->nombre.'</p>
						        </div>
					         </li>';
	  			 }

				 
					         
				  $htmlD .= '</ul>';


			}
			return $htmlD;
  		}

  		

} ?>