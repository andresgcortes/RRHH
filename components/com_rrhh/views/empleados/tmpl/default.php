<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_banners
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user      = JFactory::getUser(); ?>

<div class="panel panel-default">
	
	<!-- Default panel contents -->
  	<div style="margin-left: 20px">  		
	  	<h3 class="panel-heading"><?php echo $this->item->area ?></h3>
	  	<h1 class="panel-heading"><?php echo $this->item->cargo ?></h1>
  	</div>
  	
	<form action="<?php echo JRoute::_('index.php?option=com_rrhh&view=empleados'); ?>" method="post" name="adminForm" id="adminForm" class="form-horizontal">
		
		<div class="cuadrou">
			
			<div style="display: flex">
			
			<div style="width: 48%; display: table-cell; text-align: center; float: left;" class="lvertical">
				
				<div style="display: flex;"> 
				
					<div style="float: left; width: 38%;" class="lvertical">
						<div>
							<?php if($this->item->foto){ ?>
								<img src="../../../../../images/fotos/<?php echo $this->item->foto ?>" />								
							<?php }else{ ?>
								<img src="../../../../../images/sucesionh.png" />
							<?php } ?>
						</div>
						<h3 style="line-height: 23px;"><?php echo $this->item->nombre ?></h3>
						<?php $tiempoc = ($this->item->tiempoc < 10)? "0".$this->item->tiempoc : $this->item->tiempoc ?>
						<h5 style="color: #9dc4ce" >(<?php echo $tiempoc ?>/<?php echo $this->item->nota ?>/000/00/XX/XX)</h5>
					</div>
									
					<div style="float: left; width: 50%; padding: 0px 30px; text-align: left">
						<h2>Experiencia </h2>
						
						<div style="margin-top: 20px">
							<h5 style="color: #44BEE1">Cargo Actual: </h5>
							<div class="nombre"><?php echo $this->item->cargo ?></div>
						</div>
						
						<div style="margin-top: 20px">
							<h5 style="color: #44bee1">Cargos Anteriores</h5>
							
							<?php if($this->item->cargos){ 
							
								foreach($this->item->cargos AS $cargos){ ?>
									
									<div class="nombre" ><?php echo $cargos->cargo ?> <span style="font-size: 10px">(<?php echo $cargos->date_inicio ?> / <?php echo $cargos->date_fin ?>)</span></div>
								
								<?php }
							
							}else{ ?>
								<div class="nombre" >Sin Cargos Anteriores</div>
							<?php } ?>
							
						</div>
						
						<div style="margin-top: 20px">
							<h5 style="color: #44bee1">Inicio en el Cargo</h5>
							<div class="nombre"><?php echo $this->item->date_cargo ?></div>
						</div>
						
						<div style="margin-top: 20px">
							<h5 style="color: #44bee1">Inicio en la Compañia</h5>
							<div class="nombre"><?php echo $this->item->date_ingreso ?></div>
						</div>
					</div>
					
				</div>
			
			</div>
							
			<div style="width: 48%; display: table-cell; float: left; padding-left: 30px;">
				
				<div>
					<h2>Competencias</h2>
					
					<div style="margin-top: 20px">
						<h5 style="color: #44BEE1">Comportamientos: </h5>						
						<div></div>
					</div>
					
					<div style="margin-top: 20px">
						<h5 style="color: #44BEE1">Competencias OH&S: </h5>
						<div></div>
					</div>
				</div>	
			
			</div>
			
			</div>			
			
			<div style="display: flex">
			
			<div style="width: 48%; display: table-cell; text-align: center; float: left;" class="lvertical" >
				
				<div style="text-align: left; margin-top:20px"> 
										
					<fieldset>
					
						<legend><h2>Plan de Sucesión</h2></legend>
						
						<div>
							<ul>
							
								<?php if($this->item->sucesion){ 
									
									foreach($this->item->sucesion AS $sucesion){?>
									
										<li style="list-style: none; display: flex;">
											<div class="fl" style="margin-right: 5%; width: 6%">
												<div style="width: 100%; height: 20px; background: <?php echo $sucesion->color ?>; color:#fff; line-height: 21px; text-align: center;">
													<span><?php echo $sucesion->alias ?></span>
												</div>
											</div>
											<div class="fl nombre" style="margin-right: 5%; ; width: 40%"><?php echo $sucesion->area ?></div>
											<div class="fl nombre" style="margin-right: 5%; width: 50%"><?php echo $sucesion->cargo ?></div>
										</li>
								
									<?php }
								
								}else{ ?>
									<h3>No hay Plan de Sucesión</h3>	
								<?php } ?>
								
							</ul>
						</div>
					
					</fieldset>	
				
				</div>
			
			</div>

			<div style="width: 48%; display: table-cell; float: left; padding-left: 30px;">		
				
				<div style="text-align: left; margin-top:20px"> 
										
					<fieldset>
					
						<legend><h2>Desarrollo</h2></legend>
							
							<div style="margin-top: 20px">
								<h5 style="color: #44BEE1">Fortalezas: </h5>								
								<div></div>
							</div>
							
							<div style="margin-top: 20px">
								<h5 style="color: #44BEE1">Áreas de Desarrollo: </h5>
								<div></div>
							</div>
							
					</fieldset>	
				</div>
			
			</div>	
			
			</div>
			
		</div>
				
	</form>  	
  	
</div>


