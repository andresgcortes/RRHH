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

$document = JFactory::getDocument();
$document->addScript('https://googledrive.com/host/0BygD_wcLS3rmSENDOURWVEZSZW8/jquery.js');
$document->addScript('https://googledrive.com/host/0BygD_wcLS3rmSENDOURWVEZSZW8/jqueryui.js');
JHtml::script(Juri::base() . 'components/com_rrhh/views/areas/js/scripts.js');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.modal');

$user      = JFactory::getUser();
$userId    = $user->get('id');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$canOrder  = $user->authorise('core.edit.state', 'com_banners.category');
$archived  = $this->state->get('filter.state') == 2 ? true : false;
$saveOrder = $listOrder == 'a.ordering';

if ($saveOrder){ 
	$saveOrderingUrl = 'index.php?option=com_rrhh&task=rrhh.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'Areas', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
} ?>

<style>

	#success {
	    color: #4F8A10;
	    background-color: #DFF2BF;
	    border: 1px solid;
	    margin: 10px 0px;
	    padding: 15px 10px 15px 10px;
	    font-size: 16px;
	    text-align: left;
	    width: auto;
    }
    
</style>

<script type="text/javascript">

	Joomla.submitbutton = function(task){
		
		if ((task == 'area.cancel') || document.formvalidator.isValid(document.id('Formrrhh'))){
			
			Joomla.submitform(task, document.getElementById('Formrrhh'));
	  			
		}	
	
	}

</script>		


<div class="panel panel-default">
	
	  <!-- Default panel contents -->
  	<h1 class="panel-heading" style="text-indent: 45px; margin-top: 20px">Relación de Áeas</h1>
  	
  	<a style="margin-right: 56px; margin-top: -30px; float: right;" rel="{handler: 'iframe', size: {x: 400, y: 250}}"  href="index.php?option=com_rrhh&tmpl=component&view=areas&layout=edit&id_user=" class="modal btn btn-primary">
  		Nueva Área
  	</a>
  	
  	<div class="panel-body" style="text-indent: 45px;">
    	<p>Áreas de la compañia</p>
  	</div>
	
	<form action="<?php echo JRoute::_('index.php?option=com_rrhh&view=areas'); ?>" method="post" name="adminForm" id="adminForm" class="form-horizontal">
	
		<div id="j-main-container" class="span12">
		
		<?php // Search tools bar
		//echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>

		<?php if (empty($this->items)){ ?>			
			<div class="alert alert-no-items">
				<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
			</div>
		<?php }else{ ?>
			<div id="success" style="display:none;"></div>
			<table class="table table-striped" id="articleList" style="width: 95%">

				<thead>
					<tr>
						<th width="2%" class="nowrap center hidden-phone">
							<?php echo JHtml::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
						</th>
						<th width="2%" class="center">
							<?php echo JHtml::_('grid.checkall'); ?>
						</th>
						<th width="5%" class="nowrap center">
							<?php echo JHtml::_('searchtools.sort', 'JSTATUS', 'a.disabled', $listDirn, $listOrder); ?>
						</th>
						<th>
							<?php echo JHtml::_('searchtools.sort', 'Nombre del Área', 'a.nombre', $listDirn, $listOrder); ?>
						</th>
						<th>
							<?php echo JHtml::_('searchtools.sort', 'Cargo Responsable', 'a.nombre', $listDirn, $listOrder); ?>
						</th>
						
					</tr>
				</thead>

				<tfoot>
					<tr>
						<td colspan="5">
							<?php echo $this->pagination->getListFooter(); ?>
						</td>
					</tr>
				</tfoot>
                                
				<tbody id="sortable">
					
					<?php foreach ($this->items as $i => $item){
						
						$orderkey   = array_search($item->id_area, $this->ordering[$item->parent_id]);
						$ordering 	= ($listOrder == 'ordering');
						$canCreate  = $user->authorise('core.create',     'com_rrhh');
						$canEdit    = $user->authorise('core.edit',       'com_rrhh');
						$canCheckin = $user->authorise('core.manage',     'com_rrhh') || $item->checked_out == $userId || $item->checked_out == 0; 
						
						// Get the parents of item for sorting
						if ($item->level > 1){
							
							$parentsStr 		= "";
							$_currentParentId	= $item->parent_id;
							$parentsStr 		= " " . $_currentParentId;
							
							for ($i2 = 0; $i2 < $item->level; $i2++){
																
								foreach ($this->ordering as $k => $v){
									
									$v = implode("-", $v);
									$v = "-" . $v . "-";
									if (strpos($v, "-" . $_currentParentId . "-") !== false){
										
										$parentsStr .= " " . $k;
										$_currentParentId = $k;
										break;
									}
								}
							}
						}else{							
							$parentsStr = "";
						} ?>
						
						<tr   class="row<?php echo $i % 2; ?>" sortable-group-id="<?php echo $item->id_area; ?>" itemid ="1">
						
							<td>
								<?php $iconClass = '';
						
								if (!$canEdit){
									$iconClass = ' inactive';
								}elseif (!$saveOrder){
									$iconClass = ' inactive tip-top hasTooltip" title="' . JHtml::tooltipText('JORDERINGDISABLED');
								} ?>
								
								<span class="sortable-handler <?php echo $iconClass ?>">
									<span class="icon-menu"></span>
								</span>
								
								<?php if ($canEdit){ ?>
									<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $orderkey+ 1; ?>" class="width-20 text-area-order " />
								<?php }; ?>
								
								
							</td>
							<td>							
								<?php echo JHtml::_('grid.id', $i, $item->id_area); ?>
							</td>
							<td>
								<div class="btn-group" style="float: left">
									<?php echo JHtml::_('RrhhHtml.Areas.state', $item->disabled, $i, $canEdit, 'cb'); ?>
								</div>
								<div style="float: left; margin-left: 10px">
								 	<a class="btn btn-micro hasTooltip" href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','area.delete')" >
										<span class="icon-delete"></span>
									</a>
								</div>
							</td>
							<td>
								<a rel="{handler: 'iframe', size: {x: 400, y: 250}}"  href="index.php?option=com_rrhh&tmpl=component&view=areas&layout=edit&id_area=<?php echo $item->id_area ?>" class="modal">
									<?php echo str_repeat('<span class="gi">&mdash;</span>', $item->level - 1) ?>
									<?php echo $item->nombre ?>
								</a>
                                <input type="hidden" value="<?php $item->id_area?>" name="id" id="idarea" >
							</td>
							<td><?php echo $item->cargo ?></td>
						</tr>

					<?php } ?>

				</tbody>

			</table>			
			
		<?php } ?>
		
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
			
  		</div>
	
	</form>  	
  	
</div>


