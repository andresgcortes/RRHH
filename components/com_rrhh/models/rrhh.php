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
	
	protected $a = 0; /* ámbito global */
		
	//Probando Albol
	public function getArbol(){

		$id_area	= JRequest::getVar('id_area'); 	
		echo $this->getImgpdf();
		$this->html.= $this->getArbolCargos('core_areas', 1, 1, true, $id_area);

		return $this->html;   

	}
	
	public function getImgpdf(){
		
		$html = '<div style="float: right; margin-right: 25px; margin-top: -28px;">	
			<a href="javascript:void(0);" onclick="Joomla.submitbutton(\'rrhh.descargarpdf\')" class="button-color">
				Exportar PDF
			</a>
		</div>';
		
		return $html; 
	}

	public function getArbolCargos($tabla, $tipo, $id, $inicial = false, $id_area = false, $disable = false, $contador = 0){
		
		$db = JFactory::getDbo();
		
		$this->html = '';
	    	    
	    if($tipo == 1){
	    	$idt = "a.id_area";
	    	$columna = ""; 	
	    }elseif($tipo == 2) {
	    	$idt = "a.id_cargo";	
	    	$columna = ", b.columnas";
	    }	
	    	    
		$query = $db->getQuery(true);		
		$query->select( $idt.' as id, a.nombre as nombre'. $columna);
		$query->from('#__'.$tabla. ' AS a');
		
		if($tipo == 2){
			$query->join('inner', '#__core_areas AS b ON a.id_area = b.id_area');
		}
		
		$query->where("a.disabled = 0 AND a.parent_id = ". $id);
		
		if($id_area != false){
			$query->where("a.id_area = ". $id_area);	
		}
		
		$db->setQuery($query);
		$area =  $db->loadObjectList();
		$n = count($area);
  		
		if($n > 0){	
			
			$cpadre = ""; 
			
			if($inicial === true){ 
				$cpadre = "padresq"; 
  				echo '<div id="org" style="min-height: 720px;">
  					<div class="wellorg" style="min-height: 740px;">';
  					
  					$com = '0px';
  					$component = JRequest::getVar('tmpl');
					
					if($component == 'component'){
	  					echo '<div><img src="http://rrhh.dev/images\Logo2.png" style="position: absolute;" alt="RRHH"></div>'; 
						$com = '155px';					
					}
			
  					echo '<ul class="jOrgChart" style="text-align: center; margin: '.$com.' auto 0px auto;">';
			}else{ 
  				
  				if($tipo == 1){
  					
  					$w1 = ""; 
  					
  					if($n > 5){
						$w1 = "margin-left: -12px;";
					}
					
  					echo '<div style="position: absolute; margin-left: 544px;">';
  						echo '<ul style="'. $w1 .'">';				
				}
				
				if($tipo == 2){
					
					$claseh = ""; 
					$dis	= ""; 
							
					if($disable === true){
						$dis = "display: none;";
						$claseh = "hijo";
					}
						
					$w = "0";
					if($n == 4){
						$w = -86*$n; 
					}elseif($n == 3){
						$w = -76.66*$n; 
					}elseif($n == 5){
						$w = -92*$n; 
					}
					
  					echo '<div class="'.$claseh.'" style="position: absolute; '. $dis.' margin-left: '.$w.'px;">';
  						echo '<ul>';				
				} 
			}
							
  			if($tipo == 1){
  				
  				foreach($area AS $key => $idc){
  					
  					$validacion = $this->getQueryArbolSub($idc->id, $tipo, $tabla); 
  					
  					if($key == 0){
  			 			$d = "linep";
					}else{
						
						$d = "line";
						if($n == ($key + 1)){
							$d = "liner";
						}					
					}
										
  					echo '<li class="redire" style="vertical-align: top; text-align: center;">';	 		       
				    	if($id > 2){
							echo '<div class="'. $d.' top"></div>
							<div class="down"></div>';
						}
					    echo '<div data-idcargo="'. $idc->id .'" class="node">'.$idc->nombre .' </div>';					
						if(!empty($validacion))
							echo '<div class="down "></div>';
				    echo '</li>';
  					echo $this->getArbolCargosSub($idc->id, $tipo, $tabla, $contador++);
  				
  				}
  				
  			}
  				
			if($tipo == 2){
					
				foreach($area AS $key => $datosAlbol){
					
					$d = "line";	
					$validacion = $this->getQueryArbolSub($datosAlbol->id, $tipo, $tabla); 
					
					$datoscargo = $this->getInfoCargo($datosAlbol->id);					
					
					if(empty($datoscargo) &&  count($datoscargo) == 0) {
  			 			$dotosInfo = new stdClass;
						$dotosInfo->nombre = "No hay nombre registrado";
  			 			$fecha 				= "-/-/-/-/-/-";
  			 		}else{
  			 			$dotosInfo = $datoscargo[0];
  			 			$fecha = date("Y-m-d", strtotime($dotosInfo->fecha));
  			 		}  			 			
					
		  			if($n == ($key+1)){
						$d = "liner";
					}
	  			 	
	  			 	if($key == 0)
	  			 		$d = "linep";

					echo '<li class="redire" style="vertical-align: top; text-align: center;">';
						if($id > 2){
							if($n > 1)
							echo '<div class="'. $d .' top"></div>';						
							echo '<div class="down"></div>';
						}
						
				       	echo '<div class="nodec '.$cpadre.'">
					       <div class="tcargo tcolar" data-idcargo="'. $datosAlbol->id .'" title="'.$datosAlbol->nombre.'">
					       		'.$datosAlbol->nombre.'
					       	</div>
					       	<div class="cdescrip ccolar">
					        	'.$dotosInfo->nombre.'
					        </div>

					        <div class="fdescrip fcolar infousutiemp">
						        ('. $fecha .')
						    </div> 
						    <div class="contustiemp">';
						        echo $this->getUsuariosTtiempo($datosAlbol->id);
					    	echo '</div>
				    	</div>';
				    	
				    	if(!empty($validacion))
							echo '<div class="down"></div>';
				    	echo $this->getArbolCargosSub($datosAlbol->id, $tipo, $tabla, $datosAlbol->columnas, $contador++);
				    echo '</li>';
			 	}
		
			}

	    	echo '</ul>
	    	</div>'; 
	    	
	    	if($inicial === true){ 
  				echo '</div>';
  			}
  			
  		}else{
			
			return false;	   		
		
		}
		
	}

	public function getArbolCargosSub($id, $tipo, $tabla, $columnas = null, $contador = 0){
  		
  		$htmlD = '';
  			
  		$dato = $this->getQueryArbolSub($id, $tipo, $tabla);
  		$n = count($dato);
  		$e = 0; 
  		
  		if($n  > 0){
  			
  			$par = ""; 			
  			
  			if(($columnas % 2) != 0){   
  				if(($n - $columnas) % 2 == 0){
					$par =  "margin-left: 1px;";
				}else{
					if($n == $columnas){
  						$par =  "margin-left: -227px;"; 
					}else{
						$par =  "margin-left: 231px;";
					}
				}			
  			}else{  				
  				if(($n - $columnas) % 2 == 0){
					$par =  "margin-left: 229px;";
				}else{
					$par =  "margin-left: 1px;";
				}
			}
			
  			if($columnas > 0 && $contador == 0){
				$wt = 'style="width: 1150px;"';
			}else{
				$wt = '';
			}			
				
			if($n > 5 && $tipo == 1){
				$wt = 'style="margin-left: -12px;"';
			}

  			echo '<ul '. $wt.'>';

  			foreach ($dato as $key => $datoValue) {
  					
  				$d = "line";
				$validacion = $this->getQueryArbolSub($datoValue->id, $tipo, $tabla); 
  			 	
  			 	if($columnas > 0){
										
	  			 	if($columnas == ($key+1)){
						$d = "liner";
					}
				
				}else{
					
					if($n == ($key+1)){
						$d = "liner";
					}
					
				}
  			 	
  			 	if($key == 0)
  			 		$d = "linep";
  			 			
  			 	if ($tipo == 1){
						
  			 		echo '<li class="redire" style="vertical-align: top; text-align: center;">';
  			 			
  			 			if($n > 1)
							echo '<div class="'. $d.' top"></div>';
						
						echo '<div class="down"></div>
					    <div data-idcargo="'. $datoValue->id .'" class="node">'.$datoValue->nombre .'</div>';
						if(!empty($validacion))
							echo '<div class="down"></div>';
				    echo '</li>';
  					echo $this->getArbolCargos($tabla, $tipo, $datoValue->id, false, false, $contador++);
  			 	
  			 	}

  			 	if ($tipo == 2){
  			 		
  			 		$datoscargo = $this->getInfoCargo($datoValue->id);
  			 		
  			 		if(empty($datoscargo) && count($datoscargo) == 0) {
  			 			$dotosInfo 			= new stdClass;
						$dotosInfo->nombre 	= "No hay nombre registrado";
  			 			$fecha 				= "-/-/-/-/-/-";
  			 		}else{
  			 			$dotosInfo = $datoscargo[0];
  			 			$fecha = date("Y-m-d", strtotime($dotosInfo->fecha));
  			 		}
  			 		
  			 		if($key < $columnas || $columnas == 0){
						
						$dis 		= false;
						$clas 		= ""; 
						$disable 	= "";
						$claseh 	= ""; 
						 
						if(!empty($validacion) && $columnas > 0){
							$disable = "display: none;"; 
							$dis = true;
							$clas = "habilitador";		
							$claseh = "hijo";					
						}
						
	  			 		echo '<li class="redire '. $clas .'" style="vertical-align: top; text-align: center;">';
							
							if($n > 1)
								echo '<div class="'. $d.' top"></div>';
							
							echo '<div class="down"></div>
							<div class="nodec">					    
						    	<div class="tcargo tcolar" data-idcargo="'. $datoValue->id .'" title="'.$datoValue->nombre.'">';
							    	echo $datoValue->nombre;
							    echo '</div>
					   			<div class="cdescrip ccolar">';
						        	echo $dotosInfo->nombre;
						        echo'</div>
								<div class="fdescrip fcolar infousutiemp">
									('. $fecha .')
						        </div>
						        <div class="contustiemp">';
							        echo $this->getUsuariosTtiempo($datoValue->id);
						    	echo '</div>
					        </div>';
				        	if(!empty($validacion))
								echo '<div class="down '.$claseh.'" style="'. $disable.'"></div>';
					    	echo $this->getArbolCargos($tabla, $tipo, $datoValue->id, false, $datoValue->id_area, $dis, $contador++);
					    echo '</li>';
					
					}else{
						
						if($e > 0)
							$par ='';
							
						$e++; 
							
						echo '<li class="redire segunda" style="vertical-align: top; text-align: center; '. $par.'">';
							if((($n - $columnas) >= $columnas) && $n == ($key+1)){
								echo '<div class="liner top" style="margin-top: -164px;"></div>';					    	
								echo '<div class="downlarge" style="margin-top: 0px"></div>';
							}else{
								echo '<div class="downlarge"></div>';								
							} 
							echo '<div class="nodec">					    
						    	<div class="tcargo tcolar" data-idcargo="'. $datoValue->id .'" title="'.$datoValue->nombre.'">';
							    	echo $datoValue->nombre;
							    echo '</div>
				        		<div class="cdescrip ccolar">';
						        	echo $dotosInfo->nombre;
						        echo'</div>
						        <div class="fdescrip fcolar infousutiemp">
					          		('. $fecha .')
				        		</div>
				        		<div class="contustiemp">';
							        echo $this->getUsuariosTtiempo($datoValue->id);
						    	echo '</div>
					        </div>';
				        	if(!empty($validacion))
								echo '<div class="down"></div>';
					    	echo $this->getArbolCargos($tabla, $tipo, $datoValue->id, false, $datoValue->id_area, $disable);
					    echo '</li>';
						
					}
  			 	
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
	
	private function getQueryArbolSub($id, $tipo, $tabla){
		
		$db = JFactory::getDbo();
		if($tipo == 1) {
	    	$idt = "id_area";	
	    }	

	    if($tipo == 2) {
	    	$idt = "id_cargo";	
	    }	

		$query = $db->getQuery(true);		
		$query->select( $idt.' as id, nombre as nombre, id_area');
		$query->from('#__'.$tabla);
		$query->where("disabled = 0 AND parent_id = ". $id);
		$db->setQuery($query);
		
		return $db->loadObjectList();

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
			echo '<div class="ssucesion"style="display: inline-block;">
				<table class="tabletc postable">';

					foreach ($dato as $key => $datoTabla) {

						echo '<tr class="trtc">
							<th class="thtc" style="background: '.$datoTabla->color.';">'.$datoTabla->alias.'</th>
							<th class="tdtc">
								<div style=" margin-left: 7px; font-size: 15px; margin-top: 3px; text-align: left;">
									'.$datoTabla->nombre.'
								</div>
							</th>
						</tr>';
						
					}
				echo'</table>
			</div>';	

		}else{
			echo '<div class="ssucesion">Sin Canditados para sucesión</div>';
		}
		
  	}

} ?>