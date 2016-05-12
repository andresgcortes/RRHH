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
	
	protected $html;

	public function getArbolCargos($tabla, $tipo, $id, $inicial = false){

		$db = JFactory::getDbo();
		
		$this->html = '';
	    if ($tipo == 1) {
	    			$idt = "id_area";	
	    }	

	    if ($tipo == 2) {
	    		$idt = "id_cargo";	
	    }	

	 	$query = "SELECT ".$idt." as id, nombre as nombre
			FROM #__".$tabla."
			WHERE parent_id = ". $id;
		$db->setQuery($query);
		$area =  $db->loadObjectList();

  		if(count($area) > 0){	
		
			if($inicial === true){ 
  				echo '<ul id="org" style="display:none">';
			}else{ 
  				echo '<ul>';				
			}
				
  			if($tipo == 1){
  				
  				foreach($area AS $key => $idc){
  					
  					echo '<li>			       
				    	'.$idc->nombre;					
						echo $this->getArbolCargosSub($idc->id, $tipo, $tabla);
				    echo '</li>';
  				
  				}
  				
  			}
  				
			if($tipo == 2) {
					
				foreach($area AS $key => $datosAlbol){
					echo '
				    <li>
				       <div class="tcargo tcolar"><p>Nombre completo del cargo<p><hr/></div>
				        <div class="cdescrip ccolar"><p>
				        	'.$datosAlbol->nombre.'</p>
				        </div>
				        <div class="fdescrip fcolar"><hr/>
				          <p >(00/00,0/000/00/XX/XX)</p>
				        </div>';
				    echo $this->getArbolCargosSub($datosAlbol->id, $tipo, $tabla);
				    echo '</li>';
			 	}
			}

	    	echo '</ul>';
  		
  		}
		
		if($inicial === true){
  			
			echo '<div class="well">
		   		<div id="chart" class="orgChart"></div>	 		   		
		   	<div>';
		
		}
		 	
		return $this->html;	   		

  	}

	public function getArbolCargosSub($id, $tipo, $tabla){
  		
  		$htmlD = '';
  			
  		$db = JFactory::getDbo();
		if ($tipo == 1) {
	    			$idt = "id_area";	
	    }	

	    if ($tipo == 2) {
	    		$idt = "id_cargo";	
	    }	

	 	$query = "SELECT ".$idt." as id, nombre as nombre
			FROM #__".$tabla."  as a
			WHERE a.parent_id = ".$id;
		$db->setQuery($query);
		$dato =  $db->loadObjectList();

  		if(count($dato) > 0){

  			echo '<ul>';

  			foreach ($dato as $key => $datoValue) {

  			 	if ($tipo == 1){

  			 		echo '<li >
					    '.$datoValue->nombre;
					    echo $this->getArbolCargos('core_areas', $tipo, $datoValue->id);
				    echo '</li>';
  			 	
  			 	}

  			 	if ($tipo == 2){

  			 		echo '<li >
				    	<div class="tcargo tcolar"><p>Nombre completo del cargo<p><hr/></div>
			        		<div class="cdescrip ccolar">
					        	<p>';
					        echo $datoValue->nombre;
					        echo'</p>
					        </div>
					        <div class="fdescrip fcolar"><hr/>
				          <p >(00/00,0/000/00/XX/XX)</p>
				        </div>';
				        echo $this->getArbolCargos('core_cargos', $tipo, $datoValue->id);
				     echo '</li>';
  			 	}
  			 	
  			}
			
			echo '</ul>';

		}
		 	
 	}


  	public function getArbolCargosCabecera($tabla, $id, $tipo){

 		$db = JFactory::getDbo();
		
		if ($tipo == 1) {
	    			$idt = "id_area";	
	    }	

	    if ($tipo == 2) {
	    		$idt = "id_cargo";	
	    }	

	 	$query = "SELECT ".$idt." as id, nombre as nombre
		FROM ·#__".$tabla."  as a
		WHERE a.parent_id = ".$id."
		ORDER BY a.parent_id";

		$db->setQuery($query);
  		$dato =  $db->loadObjectList();

  		return count($dato);
  	}

} ?>