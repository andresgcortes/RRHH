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
  	
	<form action="<?php echo JRoute::_('index.php?option=com_rrhh&view=cargos'); ?>" method="post" name="adminForm" id="adminForm" class="form-horizontal">
		
		<div class="cuadros">
			
			<div style="width: 14%; float: left;">
				
				<?php if(!isset($this->item->nombre)){ ?>
					<div style="background: #278cad; padding: 10px; border-radius: 5px;" >
						<div>
							<img src="../../../../../images/sucesionh.png" />
						</div>
						<div style="color: #fff; margin-top: 10px; font-size: 15px;">
							<span>Por Asignar Cargo</span>
						</div>
						<div style="color: #d8dfe2; margin-top: 10px; font-size: 15px;">
							<span>(-/-/-/-/-/-)</span>
						</div>
						<div style="width: 100%; height: 28px; border-radius: 3px; background: #fff; vertical-align: middle; line-height: 28px; margin-top: 10px; font-size: 18px; font-weight: bolder;" >
							<span>Actual</span>
						</div>
					</div>
				
				<?php }else{ ?>
					
					<div style="background: #278cad; padding: 10px; border-radius: 5px;" >
						<div>
							<img src="../../../../../images/sucesionh.png" />
						</div>
						<div style="color: #fff; margin-top: 10px; font-size: 15px;">
							<span>Noimnbre</span>
						</div>
						<div style="color: #d8dfe2; margin-top: 10px; font-size: 15px;">
							<span>()</span>
						</div>
						<div style="width: 100%; height: 28px; border-radius: 3px; background: #fff; vertical-align: middle; line-height: 28px; margin-top: 10px; font-size: 18px; font-weight: bolder;" >
							<span>Actual</span>
						</div>
					</div>
					
				<?php }?>
			</div>
								
			<div style="width: 80%; padding-left: 20px; float: left;">
				
				<div style="width:16%; background: #fff; padding: 10px; border-radius: 5px; border: 1px solid #aaa; margin-bottom: 20px; float: left; margin-right: 10px;">
					<div>
						<img src="../../../../../images/sucesionh.png" />
					</div>
					<div style="margin-top: 10px; font-size: 15px;">
						<span>Noimnbre</span>
					</div>
					<div style="color: #d8dfe2; margin-top: 10px; font-size: 15px;">
						<span>()</span>
					</div>
					<div style="width: 100%; height: 28px; border-radius: 3px; background: #fff; vertical-align: middle; line-height: 28px; margin-top: 10px; font-size: 18px; font-weight: bolder;" >
						<span>Actual</span>
					</div>
				</div>
				
				<div style="width:16%; background: #fff; padding: 10px; border-radius: 5px; border: 1px solid #aaa; margin-bottom: 20px; float: left; margin-right: 10px;">
					<div>
						<img src="../../../../../images/sucesionh.png" />
					</div>
					<div style="margin-top: 10px; font-size: 15px;">
						<span>Noimnbre</span>
					</div>
					<div style="color: #d8dfe2; margin-top: 10px; font-size: 15px;">
						<span>()</span>
					</div>
					<div style="width: 100%; height: 28px; border-radius: 3px; background: #fff; vertical-align: middle; line-height: 28px; margin-top: 10px; font-size: 18px; font-weight: bolder;" >
						<span>Actual</span>
					</div>
				</div>
				
				<div></div>
				
				<div></div>
				
				<div></div>		
			</div>
			
		</div>
				
	</form>  	
  	
</div>


