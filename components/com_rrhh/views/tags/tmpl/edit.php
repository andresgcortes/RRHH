<?php

defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHTML::_('behavior.formvalidation');

?>

<script type="text/javascript">

	Joomla.submitbutton = function(task){
		
		if ((task == 'tags.cancel') || document.formvalidator.isValid(document.id('Formrrhh'))){
			
			Joomla.submitform(task, document.getElementById('Formrrhh'));
	  			
		}else{
	 		alert("Existen campos vacios por favor verifique!");
			return false;
		}	
	
	}

</script>		

<form action="index.php?option=com_rrhh&view=tags&layout=edit&tmpl=component&id=<?php echo $this->item->id ?>" method="post" name="adminForm" id="Formrrhh" enctype="multipart/form-data" class="form-validate form">
			
	<div class="box-content" style="margin: 20px;">
		
		<div>
			<?php echo $this->form->getLabel('parent_id'); echo $this->form->getInput('parent_id'); ?> 
		</div>
		
		<div>
			<?php echo $this->form->getLabel('title'); echo $this->form->getInput('title'); ?> 
		</div>
		
	</div>
	
	<div style="float: right;" >		
		<input type="button" onclick="Joomla.submitbutton('tags.save');" class="btn btn-primary" value="Guardar y Salir">		
	</div>
	
	<input type="hidden" name="option" value="com_rrhh" />			
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
	<?php echo $this->form->getInput('id'); ?>
	
</form>