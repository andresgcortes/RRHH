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
  	<h1 class="panel-heading" style="text-indent: 45px; margin-top: 20px">Etiquetas</h1>
  	<a style="margin-right: 56px; margin-top: -30px; float: right;" rel="{handler: 'iframe', size: {x: 400, y: 300}}"  href="index.php?option=com_rrhh&tmpl=component&view=etiquetas&layout=edit&id=" class="modal btn btn-primary">
  		Nueva Etiqueta
  	</a>
  	
  	<div class="panel-body" style="text-indent: 45px;">
    	<p>Etiquetas</p>
  	</div>
	
	<form action="<?php echo JRoute::_('index.php?option=com_rrhh&view=tags'); ?>" method="post" name="adminForm" id="adminForm" class="form-horizontal">
	
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
						<th width="2%" class="center">
							<?php echo JHtml::_('searchtools.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
						</th>
						<th width="2%" class="nowrap center">
							<?php echo JHtml::_('searchtools.sort', 'Eliminar', 'a.state', $listDirn, $listOrder); ?>
						</th>
						<th>
							<?php echo JHtml::_('searchtools.sort', 'Etiquetas', 'a.nombre', $listDirn, $listOrder); ?>
						</th>						
					</tr>
				</thead>

				<tfoot>
					<tr>
						<td colspan="3">
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
						
						<tr class="row<?php echo $i % 2; ?>" sortable-group-id="<?php echo $item->id; ?>">
							<td>
								<div style="display: none;">
									<?php echo JHtml::_('grid.id', $i, $item->id); ?>
								</div>
								<div class="btn-group" style="float: left">
                        			<?php echo JHtml::_('RrhhHtml.Tags.state', $item->published, $i, $canEdit, 'cb'); ?>
                        		</div>
							</td>
							<td>
								<div style="float: left; margin-left: 10px">
								 	<a class="btn btn-micro hasTooltip" href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','tags.delete')" >
										<span class="icon-delete"></span>
									</a>
								</div>
							</td>
							<td>
								<a rel="{handler: 'iframe', size: {x: 400, y: 300}}"  href="index.php?option=com_rrhh&tmpl=component&view=tags&layout=edit&id=<?php echo $item->id ?>" class="modal">
									<?php echo $this->escape($item->title); ?>
								</a>
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


