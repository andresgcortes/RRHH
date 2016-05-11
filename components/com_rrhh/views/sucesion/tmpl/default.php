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
JHtml::_('behavior.modal');

$user      = JFactory::getUser(); ?>

<div class="panel panel-default">
	
	<!-- Default panel contents -->
  	<div style="margin-left: 20px">  		
	  	<h3 class="panel-heading"><?php echo $this->item->area ?></h3>
	  	<h1 class="panel-heading"><?php echo $this->item->cargo ?></h1>
  	</div>
  	
	<form action="<?php echo JRoute::_('index.php?option=com_rrhh&view=cargos'); ?>" method="post" name="adminForm" id="adminForm" class="form-horizontal">
		
		<div class="cuadros">
			
			<div style="width: 14%; float: left;">
				
				<?php if(!isset($this->item->nombre)){ ?>
				
					<div style="background: #278cad; padding: 10px; border-radius: 5px;" >
						<div>
							<img src="../../../../../images/sucesionh.png" />
						</div>
						<div style="color: #fff; margin-top: 10px; font-size: 15px;">
							<span>Cargo por asignar</span>
						</div>
						<div style="color: #d8dfe2; margin-top: 10px; font-size: 15px;">
							<span>(00/00,0/000/00/XX/XX)</span>						
						</div>
						<div style="width: 100%; height: 28px; border-radius: 3px; background: #fff; vertical-align: middle; line-height: 28px; margin-top: 10px; font-size: 18px; font-weight: bolder;" >
							<span>Actual</span>
						</div>
					</div>
				
				<?php }else{ 
				
					$tiempoc = ($this->item->tiempoc < 10)? "0".$this->item->tiempoc : $this->item->tiempoc ?>
					
					<div style="background: #278cad; padding: 10px; border-radius: 5px;" >
						<div>
							<?php if($this->item->foto){ ?>
								<img src="../../../../../images/fotos/<?php echo $this->item->foto ?>" />								
							<?php }else{ ?>
								<img src="../../../../../images/sucesionh.png" />
							<?php } ?>
						</div>
						<div style="margin-top: 10px; font-size: 15px;">
							<a rel="{handler: 'iframe', size: {x: 1200, y: 670}}" href="index.php?option=com_rrhh&tmpl=component&view=empleados&layout=defult&id_user=<?php echo $this->item->id_user ?>" class="modal">
								<span style="color: #fff;"><?php echo $this->item->nombre ?></span>
							</a>
						</div>
						<div style="color: #d8dfe2; margin-top: 10px; font-size: 15px;">
							<span>(<?php echo $tiempoc ?>/<?php echo $this->item->nota ?>/000/00/XX/XX)</span>
						</div>
						<div style="width: 100%; height: 28px; border-radius: 3px; background: #fff; vertical-align: middle; line-height: 28px; margin-top: 10px; font-size: 18px; font-weight: bolder;" >
							<span>Actual</span>
						</div>
					</div>
					
				<?php }?>
			</div>
								
			<div style="width: 80%; padding-left: 20px; float: left;">
				
				<?php if($this->item->sucesion){ 
				
					foreach($this->item->sucesion AS $sucesion){ 
						
						$tiempoc = ($sucesion->tiempoc < 10)? "0".$sucesion->tiempoc : $sucesion->tiempoc ?>
										
						<div style="width:16%; background: #fff; padding: 10px; border-radius: 5px; border: 1px solid #aaa; margin-bottom: 20px; float: left; margin-right: 10px;">
							<div>
								<?php if($sucesion->foto){ ?>
									<img src=".././../../../images/fotos/<?php echo $sucesion->foto ?>" />								
								<?php }else{ ?>
									<img src="../../../../../images/sucesionh.png" />
								<?php } ?>
							</div>
							<div style="margin-top: 10px; font-size: 15px;">
									<a rel="{handler: 'iframe', size: {x: 1200, y: 670}}" href="index.php?option=com_rrhh&tmpl=component&view=empleados&layout=defult&id_user=<?php echo $sucesion->id_user ?>" class="modal">
										<span><?php echo $sucesion->nombre ?></span>
									</a>
							</div>
							<div style="color: #d8dfe2; margin-top: 10px; font-size: 15px;">
								<span>(<?php echo $tiempoc ?>/<?php echo $sucesion->nota ?>/000/00/XX/XX)</span>
							</div>
							<div style="width: 100%; height: 28px; border-radius: 3px; background: <?php echo $sucesion->color ?>; color:#fff; vertical-align: middle; line-height: 28px; margin-top: 10px; font-size: 18px; font-weight: bolder;" >
								<span><?php echo $sucesion->alias ?></span>
							</div>
						</div>
				
					<?php }
				
				}else{ ?>
				
					<div><h2>Sin Cargos de Sucesión</h2></div>
				
				<?php } ?>		
			
			</div>
			
		</div>
				
	</form>  	
  	
</div>


