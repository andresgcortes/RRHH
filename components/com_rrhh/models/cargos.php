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

	public function getArbolCargos($tabla, $tipo){

		$db = JFactory::getDbo();

		$this->html = '';

	 	$query = "SELECT parent_id as id, nombre as nombre
				  FROM rrhh_".$tabla."
				  WHERE parent_id != 0 
				  GROUP BY parent_id";

		$db->setQuery($query);
  		$area =  $db->loadObjectList();

  		if(count($area) > 0){

  			$this->html  .= '<ul id="org" style="display:none">';

  			$datosAlbol = min($area);

  			//$cabeceraPrincipal = $this->getArbolCargosCabecera($tabla, $datosAlbol->id, $tipo);
  			

  			$herecia = $this->getArbolCargosSub($datosAlbol->id, $tipo);
  				if ($tipo == 1) {
  					$this->html  .='
				    <li>
				       
				        <div class="cuadroc">
				        	'.$datosAlbol->nombre.'
				        </div>
				        '.$herecia.'
				     </li>
				     
				    ';
  				}
  				
  				if ($tipo == 2) {
  					$this->html  .='
				    <li>
				       <div class="tcargo tcolar"><p>Nombre completo del cargo<p><hr/></div>
				        <div class="cdescrip ccolar"><p>
				        	'.$datosAlbol->nombre.'</p>
				        </div>
				        <div class="fdescrip fcolar"><hr/>
				          <p >(00/00,0/000/00/XX/XX)</p>
				        </div>
				        '.$herecia.'
				     </li>
				     
				    ';
  				}


  			
  			}

		    $this->html .= '</ul>';
		   
  			$this->html .= '<div class="well">
				   		<div id="chart" class="orgChart"></div>	 
				   		<div> ';
			echo $this->html ;	   		

  		}

  		public function getArbolCargosSub($id, $tipo){

  			
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
	  			 	if ($tipo == 1){

	  			 		$htmlD .= '<li >
					       
						        <div class="cuadroc">
						        	<p>'.$datoValue->nombre.'</p>
						        </div>
					         </li>';
	  			 	}

	  			 	if ($tipo == 2){

	  			 		$htmlD .= '<li >
					       
						        <div class="tcargo tcolar"><p>Nombre completo del cargo<p><hr/></div>
				        		<div class="cdescrip ccolar"><p>
						        	<p>'.$datoValue->nombre.'</p>
						        </div>
						        <div class="fdescrip fcolar"><hr/>
				          <p >(00/00,0/000/00/XX/XX)</p>
				        </div>
					         </li>';
	  			 	}
	  			 	
	  			 }

				 
					         
				  $htmlD .= '</ul>';


			}
			return $htmlD;
  		}

  		public function getArbolCargosCabecera($tabla, $id, $tipo){

  			$db = JFactory::getDbo();
			$query = "SELECT a.parent_id as id, a.nombre as nombre
				  FROM rrhh_".$tabla."  as a
				  WHERE a.parent_id =".$id."
				  ORDER BY a.parent_id";


			$db->setQuery($query);
	  		$dato =  $db->loadObjectList();

	  		return count($dato);
  		}

  		

} ?>