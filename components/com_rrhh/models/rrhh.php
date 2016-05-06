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
class RrhhModelRrhh extends JModelItem
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

		$this->html='
		
			<ul id="org" style="display:none">
				    <li>
				       <div class="tcargo tcolar"><p>Nombre completo del cargo<p><hr/></div>
				       
				        <div class="cdescrip ccolar">
				        	<p> Nombre y apellido del empleado que ocupa el cargo</p>
				        </div>
				        <div class="fdescrip fcolar"><hr/>
				          <p >(00/00,0/000/00/XX/XX)</p>
				        </div>
				       <ul>
				         <li id="beer">
				            <div class="tcargo tcolar"><p>Nombre completo del cargo<p><hr/></div>
				       
					        <div class="cdescrip ccolar">
					        	<p> Nombre y apellido del empleado que ocupa el cargo</p>
					        </div>
					        <div class="fdescrip fcolar"><hr/>
					          <p >(00/00,0/000/00/XX/XX)</p>
					        </div>
				         </li>
				         <li>
				            <div class="tcargo tcolar"><p>Nombre completo del cargo<p><hr/></div>
				       
					        <div class="cdescrip ccolar">
					        	<p> Nombre y apellido del empleado que ocupa el cargo</p>
					        </div>
					        <div class="fdescrip fcolar"><hr/>
					          <p >(00/00,0/000/00/XX/XX)</p>
					        </div>
				           <ul>
				            <li>
				                <div class="tcargo tcolar"><p>Nombre completo del cargo<p><hr/></div>
				       
						        <div class="cdescrip ccolar">
						        	<p> Nombre y apellido del empleado que ocupa el cargo</p>
						        </div>
						        <div class="fdescrip fcolar"><hr/>
						          <p >(00/00,0/000/00/XX/XX)</p>
						        </div>
				                <ul>
				                    <li>
				                        <div class="tcargo tcolar"><p>Nombre completo del cargo<p><hr/></div>
				       
								        <div class="cdescrip ccolar">
								        	<p> Nombre y apellido del empleado que ocupa el cargo</p>
								        </div>
								        <div class="fdescrip fcolar"><hr/>
								          <p >(00/00,0/000/00/XX/XX)</p>
								        </div>         
				                    </li>
				                </ul>

				            </li>
				             <li>
				              <div class="tcargo tcolar"><p>Nombre completo del cargo<p><hr/></div>
				       
						        <div class="cdescrip ccolar">
						        	<p> Nombre y apellido del empleado que ocupa el cargo</p>
						        </div>
						        <div class="fdescrip fcolar"><hr/>
						          <p >(00/00,0/000/00/XX/XX)</p>
						        </div>
					        </li>
				             <li>
				                <div class="tcargo tcolar"><p>Nombre completo del cargo<p><hr/></div>
				       
						        <div class="cdescrip ccolar">
						        	<p> Nombre y apellido del empleado que ocupa el cargo</p>
						        </div>
						        <div class="fdescrip fcolar"><hr/>
						          <p >(00/00,0/000/00/XX/XX)</p>
						        </div>
				             </li>
				           </ul>
				         </li>
				         <li class="fruit">
				         	<div class="tcargo tcolar"><p>Nombre completo del cargo<p><hr/></div>
				       
					        <div class="cdescrip ccolar">
					        	<p> Nombre y apellido del empleado que ocupa el cargo</p>
					        </div>
					        <div class="fdescrip fcolar"><hr/>
					          <p >(00/00,0/000/00/XX/XX)</p>
					        </div>
				           <ul>
				             <li>
				             	<div class="tcargo tcolar"><p>Nombre completo del cargo<p><hr/></div>
				       
						        <div class="cdescrip ccolar">
						        	<p> Nombre y apellido del empleado que ocupa el cargo</p>
						        </div>
						        <div class="fdescrip fcolar"><hr/>
						          <p >(00/00,0/000/00/XX/XX)</p>
						        </div>
				               <ul>
				                 <li>
				                 		<div class="tcargo tcolar"><p>Nombre completo del cargo<p><hr/></div>
				       
								        <div class="cdescrip ccolar">
								        	<p> Nombre y apellido del empleado que ocupa el cargo</p>
								        </div>
								        <div class="fdescrip fcolar"><hr/>
								          <p >(00/00,0/000/00/XX/XX)</p>
								        </div>
				                 </li>
				               </ul>
				             </li>
				             <li>
				             	<div class="tcargo tcolar"><p>Nombre completo del cargo<p><hr/></div>
				       
						        <div class="cdescrip ccolar">
						        	<p> Nombre y apellido del empleado que ocupa el cargo</p>
						        </div>
						        <div class="fdescrip fcolar"><hr/>
						          <p >(00/00,0/000/00/XX/XX)</p>
						        </div>
				               <ul>
				                 <li>
				                 	<div class="tcargo tcolar"><p>Nombre completo del cargo<p><hr/></div>
				       
							        <div class="cdescrip ccolar">
							        	<p> Nombre y apellido del empleado que ocupa el cargo</p>
							        </div>
							        <div class="fdescrip fcolar"><hr/>
							          <p >(00/00,0/000/00/XX/XX)</p>
							        </div>
				                 </li>
				                 <li>
				                 	<div class="tcargo tcolar"><p>Nombre completo del cargo<p><hr/></div>
				       
							        <div class="cdescrip ccolar">
							        	<p> Nombre y apellido del empleado que ocupa el cargo</p>
							        </div>
							        <div class="fdescrip fcolar"><hr/>
							          <p >(00/00,0/000/00/XX/XX)</p>
							        </div>
				                 </li>
				                 <li>
				                 	<div class="tcargo tcolar"><p>Nombre completo del cargo<p><hr/></div>
				       
							        <div class="cdescrip ccolar">
							        	<p> Nombre y apellido del empleado que ocupa el cargo</p>
							        </div>
							        <div class="fdescrip fcolar"><hr/>
							          <p >(00/00,0/000/00/XX/XX)</p>
							        </div>
				                 </li>
				               </ul>
				             </li>
				           </ul>
				         </li>
				         
				       </ul>
				     </li>
				   </ul>
				   <div class="well">
				   <div id="chart" class="orgChart"></div>	 
				   <div>           
				    ';

		return $this->html;   

	}

}


?>