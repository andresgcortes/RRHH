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
JHTML::_('behavior.formvalidation');

$user      		= JFactory::getUser();
$funcionario    = JRequest::getvar('funcionarios'); 

JHtml::script(Juri::base() . 'components/com_rrhh/views/rrhh/js/html2canvas.min.js'); ?>

<script type="text/javascript">

	Joomla.submitbutton = function(task){
		
		if ((task == 'funcionario.cancel') || document.formvalidator.isValid(document.id('Formrrhh'))){
			
			html2canvas(document.querySelector(".panel")).then(function(canvas){
            	var png = canvas.toDataURL()
	            //window.open(png);
           		console.log(png);
           		jQuery('#contenido').val(png); 	            
	        
	        });
			
			Joomla.submitform(task, document.getElementById('Formrrhh'));
	  			
		}else{
	 		alert("Existen campos vacios por favor verifique!");
			return false;
		}	
	
	}
	
	jQuery(document).ready(function($){
		
		html2canvas(document.querySelector(".panel")).then(function(canvas){
        	var png = canvas.toDataURL()
            //window.open(png);
       		console.log(png);
       		jQuery('#contenido').val(png); 	                    
        });
	        
		jQuery('.panel-default').on('click', '.sucesionp', function(){
			
			var cargo = jQuery('#jform_id_cargos').val();
			var tiempo = jQuery('#jform_tiempos').val();
			var user = jQuery('#jform_id_user').val();
		
			var dato = new FormData();
			dato.append('id_cargo', cargo);
			dato.append('id_tiempo', tiempo);
			dato.append('id_user', user);
								
			jQuery.ajax({
			
				url: 'index.php?option=com_rrhh&task=funcionario.sucesion&tmpl=raw',
				type: "POST",
				contentType:false, //Debe estar en false para que pase el objeto sin procesar
				data:dato, //Le pasamos el objeto que creamos con los archivos
				processData:false, //Debe estar en false para que JQuery no 
				cache:false
				
			}).done(function(msg){
				
				jQuery('.sucesiona').html(msg);
			
			});
			
		});
		
		jQuery('.panel-default').on('click', '.sucesiond', function(){
			
			var tiempo 	= jQuery(this).data('tiempo');
			var user 	= jQuery('#jform_id_user').val();
		
			var dato = new FormData();
			dato.append('id_tiempo', tiempo);
			dato.append('id_user', user);
								
			jQuery.ajax({
			
				url: 'index.php?option=com_rrhh&task=funcionario.sucesiond&tmpl=raw',
				type: "POST",
				contentType:false, //Debe estar en false para que pase el objeto sin procesar
				data:dato, //Le pasamos el objeto que creamos con los archivos
				processData:false, //Debe estar en false para que JQuery no 
				cache:false
				
			}).done(function(msg){
				
				jQuery('.sucesiona').html(msg);
			
			});
			
		});
	
	});
	
</script>	

<div style="float: right; margin-right: 35px; margin-top: 40px;" >		
	<input type="button" onclick="Joomla.submitbutton('funcionario.save2');" class="btn btn-primary" value="Guardar y Salir">
	<a href="javascript:void(0);" onclick="Joomla.submitbutton('rrhh.descargarpdf')" class="button-color">
		Exportar PDF
	</a>		
</div>
	
<div class="panel panel-default">
	
	<!-- Default panel contents -->
  	<div style="margin-left: 20px">  		
	  	<h3 class="panel-heading"><?php echo $this->item->area ?></h3>
	  	<h1 class="panel-heading"><?php echo $this->item->cargo ?></h1>
  	</div>
  	
	<form action="<?php echo JRoute::_('index.php?option=com_rrhh&view=empleados'); ?>" method="post" name="adminForm" id="Formrrhh" class="form-horizontal">
		
		<div class="cuadrou">
			
			<div style="display: flex">
			
			<div style="width: 48%; display: table-cell; text-align: center; float: left;" class="lvertical">
				
				<div style="display: flex;"> 
				
					<div style="float: left; width: 38%;" class="lvertical">
						<div>
							<?php if(!is_null($this->item->foto)){ ?>
								<img src="<?php echo $this->baseurl ?>/images/fotos/<?php echo $this->item->foto ?>" />								
							<?php }else{ ?>
								<img src="<?php echo $this->baseurl ?>/images/sucesionh.png" />
							<?php } ?>
							<?php if($funcionario == 1){
								echo $this->form->getInput('foto');
							} ?>
						</div>
						<h3 style="line-height: 23px;">
							<?php if($funcionario == 0){
								echo $this->item->nombre; 
							}else{
								echo $this->form->getInput('nombre');
							} ?>
						</h3>
						<?php $tiempoc = ($this->item->tiempoc < 10)? "0".$this->item->tiempoc : $this->item->tiempoc ?>
						<h5 style="color: #9dc4ce" >(<?php echo $tiempoc ?>/<?php echo $this->item->nota ?>/000/00/XX/XX)</h5>
					</div>
									
					<div style="float: left; width: 50%; padding: 0px 30px; text-align: left">
						<h2>Experiencia </h2>
						
						<div style="margin-top: 20px">
							<h5 style="color: #44BEE1">Cargo Actual: </h5>
							<div class="nombre">
								<?php if($funcionario == 0){
									echo $this->item->cargo; 
								}else{
									echo $this->form->getInput('id_cargo');
								} ?>
							</div>
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
							<div class="nombre">
								<?php if($funcionario == 0){
									echo $this->item->date_cargo; 
								}else{
									echo $this->form->getInput('date_cargo');
								} ?>
							</div>
						</div>
						
						<div style="margin-top: 20px">
							<h5 style="color: #44bee1">Inicio en la Compañia</h5>
							<div class="nombre">
								<?php if($funcionario == 0){
									echo $this->item->date_ingreso; 
								}else{
									echo $this->form->getInput('date_ingreso');
								} ?>
							</div>
						</div>
					</div>
					
				</div>
			
			</div>
							
			<div style="width: 48%; display: table-cell; float: left; padding-left: 30px;">
				
				<div>
					<h2>Competencias</h2>
					
					<div style="margin-top: 20px">
						<h5 style="color: #44BEE1">Comportamientos: </h5>						
						<div>
							<div style="display: flex;"> 
								<div style="float: left; margin-right:10px; width: 50%">
									<?php echo $this->form->getLabel('CPT_PN1_VE');
									echo $this->form->getInput('CPT_PN1_VE'); ?>
								</div>
								<div style="float: left; width: 50%">
									<?php echo $this->form->getLabel('CPT_PN2_ARP');
									echo $this->form->getInput('CPT_PN2_ARP'); ?>
								</div>
							</div>
							<div style="display: flex;"> 
								<div style="float: left; margin-right:10px; width: 50%">
									<?php echo $this->form->getLabel('CPT_PN2_AFN');
									echo $this->form->getInput('CPT_PN2_AFN'); ?>
								</div>
								<div style="float: left; width: 50%">
									<?php echo $this->form->getLabel('CPT_ER1_LE');
									echo $this->form->getInput('CPT_ER1_LE'); ?>
								</div>
							</div>
							<div style="display: flex;">
								<div style="float: left; margin-right:10px; width: 50%">
									<?php echo $this->form->getLabel('CPT_ER2_EC');
									echo $this->form->getInput('CPT_ER2_EC'); ?>
								</div>
								<div style="float: left; width: 50%">
									<?php echo $this->form->getLabel('CPT_ER3_LD');
									echo $this->form->getInput('CPT_ER3_LD'); ?>
								</div>
							</div>							
						</div>
					</div>
					
					<div style="margin-top: 20px">
						<h5 style="color: #44BEE1">Competencias OH&S: </h5>
						<div>
							<div style="display: flex;"> 
								<div style="float: left; margin-right:10px; width: 50%">
									<?php echo $this->form->getLabel('CPT_CO1_IMO');
									echo $this->form->getInput('CPT_CO1_IMO'); ?>
								</div>
								<div style="float: left; width: 50%">
									<?php echo $this->form->getLabel('CPT_CO2_AAO');
									echo $this->form->getInput('CPT_CO2_AAO'); ?>
								</div>
							</div>
							<div style="display: flex;">
								<div style="float: left; margin-right:10px; width: 50%">
									<?php echo $this->form->getLabel('CPT_CO3_ICR');
									echo $this->form->getInput('CPT_CO3_ICR'); ?>
								</div>
								<div style="float: left; width: 50%">
									<?php echo $this->form->getLabel('CPT_CO4_MI');
									echo $this->form->getInput('CPT_CO4_MI'); ?>
								</div>
							</div>
						</div>
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
							
							<?php echo $this->form->getInput('id_cargos'); ?>
							<?php echo $this->form->getInput('tiempos'); ?>
							<a class="btn btn-micro hasTooltip sucesionp" href="javascript:void(0);">
								<span class="icon-plus-2"></span>
							</a>
							
							<ul class="sucesiona" style="margin-top: 30px;">
							
								<?php if($this->item->sucesion){ 
									
									foreach($this->item->sucesion AS $sucesion){?>
									
										<li style="list-style: none; display: flex;">
											<div class="fl" style="margin-right: 5%; width: 6%">
												<a class="hasTooltip sucesiond" href="javascript:void(0);" style="float: left; margin-top: 3px;" data-tiempo="<?php echo $sucesion->id_tiempo ?>" >
													<span class="icon-delete"></span>
												</a>										
												<div style="width: 100%; height: 20px; background: <?php echo $sucesion->color ?>; color:#fff; line-height: 21px; text-align: center; margin-left: 25px;">
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

			<div style="width: 48%; display: table-cell; float: left; padding-left: 12px;">		
				
				<div style="text-align: left; margin-top:20px; margin-left: 20px;"> 
										
					<fieldset>
					
						<legend><h2>Desarrollo</h2></legend>
							
							<div>
								<div>
								
									<h5 style="color: #44BEE1; float: left; margin-right: 7px;">Fortalezas: </h5>						
									<?php if($this->item->fortalezas){ 										
										foreach($this->item->fortalezas AS $fortaleza){?>									
											<div style="padding: 8px; margin-top: 2px; margin-bottom: 2px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; background: #a4f220; display: -webkit-inline-box; color: #fff" >
												<span><?php echo $fortaleza->title ?></span>
											</div>											
										<?php }									
									} ?>										
									
								</div>
							</div>
							
							<div style="margin-top: 40px">
								<div>
									<h5 style="color: #44BEE1; float: left; margin-right: 7px;">Áreas de Desarrollo: </h5>
									<?php if($this->item->desarrollos){ 										
										foreach($this->item->desarrollos AS $desarrollo){?>									
											<div style="padding: 8px; margin-top: 2px; margin-bottom: 2px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; background: 5ADDE0; display: -webkit-inline-box; color: #fff" >
												<span><?php echo $desarrollo->title ?></span>
											</div>											
										<?php }									
									} ?>										
								</div>
							</div>
							
					</fieldset>	
				</div>
			
			</div>	
			
			</div>
			
		</div>
		
		<input type="hidden" name="option" value="com_rrhh" />			
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="contenido" id="contenido" value="" />		
		<?php echo JHtml::_('form.token'); ?>
		<?php echo $this->form->getInput('id_user'); ?>
	
	</form>  	
  	
</div>


