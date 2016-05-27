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
$trashed   = $this->state->get('filter.state') == -2 ? true : false;
$saveOrder = $listOrder == 'a.ordering';

if ($saveOrder){ 
	$saveOrderingUrl = 'index.php?option=com_rrhh&task=rrhh.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
} ?>

<div class="panel panel-default">
	
	  <!-- Default panel contents -->
  	<h1 class="panel-heading" style="text-indent: 45px; margin-top: 20px">Relación de Cargos</h1>
  	<a style="margin-right: 56px; margin-top: -30px; float: right;" rel="{handler: 'iframe', size: {x: 400, y: 300}}"  href="index.php?option=com_rrhh&tmpl=component&view=cargos&layout=edit&id_user=" class="modal btn btn-primary">
  		Nuevo Cargo
  	</a>
  	
  	<div class="panel-body" style="text-indent: 45px;">
    	<p>Cargos de la compañia</p>
  	</div>
	
	<form action="<?php echo JRoute::_('index.php?option=com_rrhh&view=cargos'); ?>" method="post" name="adminForm" id="adminForm" class="form-horizontal">
	
		<div id="j-main-container" class="span12">
		
		<?php
		// Search tools bar
		//echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>

		<?php if (empty($this->items)){ ?>			
			<div class="alert alert-no-items">
				<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
			</div>
		<?php }else{ ?>
			
			<table class="table table-striped" id="articleList" style="width: 95%">
				<thead>
					<tr>
						<th width="1%" class="nowrap center hidden-phone">
							<?php echo JHtml::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
						</th>
						<th width="1%" class="center">
							<?php echo JHtml::_('grid.checkall'); ?>
						</th>
						<th width="1%" class="nowrap center">
							<?php echo JHtml::_('searchtools.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
						</th>
						<th>
							<?php echo JHtml::_('searchtools.sort', 'Nombre del Cargo', 'a.nombre', $listDirn, $listOrder); ?>
						</th>
						<th>
							<?php echo JHtml::_('searchtools.sort', 'Nombre del Area', 'area', $listDirn, $listOrder); ?>
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

				<tbody>
					
					<?php foreach ($this->items as $i => $item){
						
						$ordering  = ($listOrder == 'ordering');
						$canCreate  = $user->authorise('core.create',     'com_rrhh');
						$canEdit    = $user->authorise('core.edit',       'com_rrhh');
						$canCheckin = $user->authorise('core.manage',     'com_rrhh') || $item->checked_out == $userId || $item->checked_out == 0; ?>
						
						<tr class="row<?php echo $i % 2; ?>" sortable-group-id="<?php echo $item->id_cargo; ?>">
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
									<input type="text" style="display:none" name="order[]" size="5"
										value="<?php echo $item->ordering; ?>" class="width-20 text-area-order " />
								<?php }; ?>
							</td>
							<td><?php echo JHtml::_('grid.id', $i, $item->id_cargo); ?></td>
							<td>
								<div class="btn-group">
									<?php echo JHtml::_('RrhhHtml.Cargos.state', $item->disabled, $i, $canEdit, 'cb'); ?>
								</div>								
							</td>
							<td>
								<a rel="{handler: 'iframe', size: {x: 400, y: 300}}"  href="index.php?option=com_rrhh&tmpl=component&view=cargos&layout=edit&id_cargo=<?php echo $item->id_cargo ?>" class="modal">
									<?php echo $item->nombre ?>
								</a>
							</td>
							<td>
								<?php echo $item->area ?>
							</td>
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


