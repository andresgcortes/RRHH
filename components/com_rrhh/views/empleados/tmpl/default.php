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
	  	<h3 class="panel-heading">Nombre del Area al que pertene</h3>
	  	<h1 class="panel-heading">Nombre del Cargo</h1>
  	</div>
  	
	<form action="<?php echo JRoute::_('index.php?option=com_rrhh&view=cargos'); ?>" method="post" name="adminForm" id="adminForm" class="form-horizontal">
		
		<div class="cuadrou">
			
			<div style="display: flex">
			
			<div style="width: 48%; display: table-cell; text-align: center; float: left;" class="lvertical">
				
				<div style="display: flex;"> 
				
					<div style="float: left; width: 38%;" class="lvertical">
						<div>
							<img src="../../../../../images/foto.png" />
						</div>
						<h3>Nombre y Apellido</h3>
						<h5>(aa/aa/aa/aa/)</h5>
					</div>
									
					<div style="float: left; width: 50%; padding: 0px 30px; text-align: left">
						<h2>Experiencia </h2>
						
						<div style="margin-top: 20px">
							<label>Cargo Actual: </label>
							<div class="nombre">Nombre Cargo Actual</div>
						</div>
						
						<div style="margin-top: 20px">
							<label>Cargo Anteriores</label>
							<div class="nombre" >Nombre Cargo Anterior</div>
							<div class="nombre">Nombre Cargo Anterior</div>
							<div class="nombre">Nombre Cargo Anterior</div>
						</div>
						
						<div style="margin-top: 20px">
							<label>Inicio en el Cargo</label>
							<div class="nombre">Nombre Cargo Actual</div>
						</div>
						
						<div style="margin-top: 20px">
							<label>Inicio en la Compañia</label>
							<div class="nombre">Nombre Cargo Actual</div>
						</div>
					</div>
					
				</div>
			
			</div>
							
			<div style="width: 48%; display: table-cell; float: left; padding-left: 30px;">
				
				<div>
					<h2>Competencias</h2>
					
					<div style="margin-bottom: 20px">
						<label>Comportamientos: </label>
						
						<div></div>
					</div>
					
					<div style="margin-bottom: 20px">
						<label>Competencias OH&S: </label>
						<div></div>
					</div>
				</div>	
			
			</div>
			
			</div>			
			
			<div style="display: flex">
			
			<div style="width: 48%; display: table-cell; text-align: center; float: left;" class="lvertical" >
				
				<div style="text-align: left;"> 
										
					<fieldset>
					
						<legend>Plan de Sucesión</legend>
						
						<div>
							<ul>
								<li style="list-style: none; display: flex;">
									<div class="fl" style="margin-right: 5%;"></div>
									<div class="fl nombre" style="margin-right: 5%;">Area del cargo sucesor</div>
									<div class="fl nombre" style="margin-right: 5%;">Nombre del cargo que es sucesor</div>
								</li>
								<li style="list-style: none; display: flex;">
									<div class="fl" style="margin-right: 5%;"></div>
									<div class="fl nombre" style="margin-right: 5%;">Area del cargo sucesor</div>
									<div class="fl nombre" style="margin-right: 5%;">Nombre del cargo que es sucesor</div>
								</li>
							</ul>
						</div>
					
					</fieldset>	
				
				</div>
			
			</div>

			<div style="width: 48%; display: table-cell; float: left; padding-left: 30px;">		
				
				<div>
					<h2>Desarrollo</h2>
					
					<div style="margin-bottom: 20px">
						<label>Fortalezas: </label>
						
						<div></div>
					</div>
					
					<div style="margin-bottom: 20px">
						<label>Áreas de Desarrollo: </label>
						<div></div>
					</div>
				</div>
			
			</div>	
			
			</div>
			
		</div>
				
	</form>  	
  	
</div>


