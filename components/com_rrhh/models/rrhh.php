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

class RrhhModelRrhh extends JModelItem{
	
	protected $html;

	//Probando Albol
	public function getArbol(){

		$id_area 	= JRequest::getVar('id_area'); 	
		//$this->html .= $this->getImgpdf();
		$this->html .= $this->getArbolCargos('core_areas', 1, 1, true, $id_area);

		return $this->html;   

	}
	
	public function getImgpdf(){
		echo '<div id="imge"><img src="images/pdf.png" style="WIDTH: 5%;"></div><div id="successe"></div>';
	}

	public function getArbolCargos($tabla, $tipo, $id, $inicial = false, $id_area = null){

		$db = JFactory::getDbo();
		
		$this->html = '';
	    
	    if ($tipo == 1) {
	    	$idt = "id_area";	
	    }	

	    if ($tipo == 2) {
	    	$idt = "id_cargo";	
	    }	
		
		$query = $db->getQuery(true);		
		$query->select( $idt.' as id, nombre as nombre, id_area');
		$query->from('#__'.$tabla);
		$query->where("disabled = 0 AND parent_id = ". $id);
		
		if(!is_null($id_area)){
			$query->where("id_area = ". $id_area);	
		}		
		
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
  					
  					echo '<li class="redire" >	 		       
				    	<div data-idcargo="'. $idc->id .'">'.$idc->nombre .'</div>';					
						echo $this->getArbolCargosSub($idc->id, $tipo, $tabla);
				    echo '</li>';
  				
  				}
  				
  			}
  				
			if($tipo == 2) {
					
				foreach($area AS $key => $datosAlbol){
			
					$datoscargo = $this->getInfoCargo($datosAlbol->id);					
					
					if (count($datoscargo) == 0) {
  			 			$dotosInfo->nombre = "No hay nombre registrado";
  			 			$dotosInfo->fecha = "1999-00-00";
  			 		}else{
  			 			$dotosInfo = $datoscargo[0];
  			 		}
					
					echo '<li class="redire" >
				       <div class="tcargo tcolar" data-idcargo="'. $datosAlbol->id .'">
				       		<p>'.$datosAlbol->nombre.'<p><hr/>
				       	</div>
				        <div class="cdescrip ccolar">
				        	<div>'.$dotosInfo->nombre.'</div>
				        </div>

				        <div class="fdescrip fcolar infousutiemp"><hr/>
				          <p >('.date("Y-m-d H:i:s", strtotime($dotosInfo->fecha)).')</p>
				        </div> <div class="contustiemp" >';
				        echo $this->getUsuariosTtiempo($datosAlbol->id);

				    echo '</div>';
				    echo $this->getArbolCargosSub($datosAlbol->id, $tipo, $tabla);
				    echo '</li>';
			 	}
		
			}

	    	echo '</ul>';
  		
  		}
		
		if($inicial === true){
  			
			echo '<div class="well">
		   		<div id="chart" class="orgChart"></div>	 		   		
		   	</div>';
		
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

	 	$query = "SELECT ".$idt." as id, nombre as nombre, id_area
			FROM #__".$tabla."  as a
			WHERE disabled = 0 AND a.parent_id = ".$id;
		$db->setQuery($query);
		$dato =  $db->loadObjectList();

  		if(count($dato) > 0){

  			echo '<ul>';

  			foreach ($dato as $key => $datoValue) {

  			 	if ($tipo == 1){

  			 		echo '<li class="redire">
					    <div data-idcargo="'. $datoValue->id .'">'.$datoValue->nombre .'</div>';
					    echo $this->getArbolCargos($tabla, $tipo, $datoValue->id);
				    echo '</li>';
  			 	
  			 	}

  			 	if ($tipo == 2){
  			 		
  			 		$datoscargo = $this->getInfoCargo($datoValue->id);
  			 		
  			 		if (count($datoscargo) == 0) {
  			 			$dotosInfo->nombre = "No hay nombre registrado";
  			 			$dotosInfo->fecha = "1999-00-00";
  			 		}else{
  			 			$dotosInfo = $datoscargo[0];
  			 		}

  			 		echo '<li class="redire">
				    	<div class="tcargo tcolar" data-idcargo="'. $datoValue->id .'">';
				    	echo $datoValue->nombre;
				    echo '<hr/></div>
			        		<div class="cdescrip ccolar">';
					        	echo $dotosInfo->nombre;
					        echo'</div>
					        <div class="fdescrip fcolar"><hr/>
				          <p >('.date("Y-m-d H:i:s", strtotime($dotosInfo->fecha)).')</p>
				        </div>';
				        echo $this->getArbolCargos($tabla, $tipo, $datoValue->id, false, $datoValue->id_area);
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
		WHERE disabled = 0 AND a.parent_id = ".$id."
		ORDER BY a.parent_id";

		$db->setQuery($query);
  		$dato =  $db->loadObjectList();

  		return count($dato);
  	}

  	private function getInfoCargo($id_cargo){

  		
  		$db = JFactory::getDbo();

  		$tabla = "core_user";

  		$query = "SELECT  date_cargo as fecha, nombre as nombre
			FROM rrhh_".$tabla."  as a
			WHERE a.id_cargo = ".$id_cargo;
			
		$db->setQuery($query);
		$dato =  $db->loadObjectList();
		
		return $dato;
  	}

  	private function getUsuariosTtiempo($id_cargo){
  		
  		$db = JFactory::getDbo();
  		$query = $db->getQuery(true);		
		$query->select('c.id_user, c.nombre as nombre, d.alias, d.color');
		$query->from('#__core_cargos_rel_users AS a');
		$query->join('inner','#__core_user AS c ON a.id_user = c.id_user');
		$query->join('inner','#__core_tiempos AS d ON a.id_tiempo = d.id_tiempo');
		$query->where('a.id_cargo = '. $id_cargo);
		$query->order('d.id_tiempo ASC');
		$db->setQuery($query);	
		$dato = $db->loadObjectList();

		if(count($dato)){
			echo '<table class="tabletc postable">';

			foreach ($dato as $key => $datoTabla) {

				echo '<tr class="trtc">
						<th class="thtc" style="background: '.$datoTabla->color.';">'.$datoTabla->alias.'</th>
						<td class="tdtc">'.$datoTabla->nombre.'</th>
					   </tr>';
				
			}
			echo'</table>';	

		}else{
			echo 'No';
		}
		
  	}
        

} ?>