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

		$this->html='<ul id="org" style="display:none">
				    <li>
				       <h5>PRESIDENTE</h5>
				        <p><img src="assets/img/ui-zac.jpg" class="img-circle" width="80"></p>
				        <p><b>Zac Snider</b></p>
				        <p >MEMBER SINCE</p>
				        <p>2012</p>
				        <p >TOTAL SPEND</p>
				        <p>$ 47,60</p>
				       <ul>
				         <li id="beer">
				            <h5>GERENTE 1</h5>
				            <p><img src="assets/img/ui-zac.jpg" class="img-circle" width="80"></p>
				            <p><b>Zac Snider</b></p>
				            <p >MEMBER SINCE</p>
				            <p>2012</p>
				            <p >TOTAL SPEND</p>
				            <p>$ 47,60</p>
				         </li>
				         <li>
				            <h5>GERENTE 2</h5>
				            <p><img src="assets/img/ui-zac.jpg" class="img-circle" width="80"></p>
				            <p><b>Zac Snider</b></p>
				            <p >MEMBER SINCE</p>
				            <p>2012</p>
				            <p >TOTAL SPEND</p>
				            <p>$ 47,60</p>
				            <a href="http://wesnolte.com" target="_blank">ver perfil</a>
				           <ul>
				            <li>
				                <h5>COORDINADO</h5>
				                <p><img src="assets/img/ui-zac.jpg" class="img-circle" width="80"></p>
				                <p><b>Zac Snider</b></p>
				                <p >MEMBER SINCE</p>
				                <p>2012</p>
				                <p >TOTAL SPEND</p>
				                <p>$ 47,60</p>
				                <ul>
				                    <li>
				                        <h5>lIDER AREA</h5>
				                        <p><img src="assets/img/ui-zac.jpg" class="img-circle" width="80"></p>
				                        <p><b>Zac Snider</b></p>
				                        <p >MEMBER SINCE</p>
				                        <p>2012</p>
				                        <p >TOTAL SPEND</p>
				                        <p>$ 47,60</p>
				                                    
				                    </li>
				                </ul>

				            </li>
				             <li>Pumpkin</li>
				             <li>
				                <a href="http://tquila.com" target="_blank">Aubergine</a>
				                <p>A link and paragraph is all we need.</p>
				             </li>
				           </ul>
				         </li>
				         <li class="fruit">Fruit
				           <ul>
				             <li>Apple
				               <ul>
				                 <li>Granny Smith</li>
				               </ul>
				             </li>
				             <li>Berries
				               <ul>
				                 <li>Blueberry</li>
				                 <li><img src="images/raspberry.jpg" alt="Raspberry"/></li>
				                 <li>Cucumber</li>
				               </ul>
				             </li>
				           </ul>
				         </li>
				         <li>Bread</li>
				         <li class="collapsed">Chocolate
				           <ul>
				             <li>Topdeck</li>
				             <li>Reeses Cups</li>
				           </ul>
				         </li>
				       </ul>
				     </li>
				   </ul>            
				    ';

		return $this->html;   

	}

}


?>