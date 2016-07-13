<?php

defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHTML::_('behavior.formvalidation');

?>

<script type="text/javascript">

	Joomla.submitbutton = function(task){
		
		if ((task == 'funcionario.cancel') || document.formvalidator.isValid(document.id('Formrrhh'))){
			
			Joomla.submitform(task, document.getElementById('Formrrhh'));
	  			
		}else{
	 		alert("Existen campos vacios por favor verifique!");
			return false;
		}	
	
	}

</script>		

	<form action="index.php?option=com_rrhh&view=funcionarios&layout=edit&tmpl=component&id_user=<?php echo $this->item->id_user ?>" method="post" name="adminForm" id="Formrrhh" enctype="multipart/form-data" class="form-validate form">
				
		<div class="box-content" style="margin: 20px;">
			
			<div>
				<?php echo $this->form->getLabel('codigo'); echo $this->form->getInput('codigo'); ?> 
			</div>
			
			<div>
	    		<?php echo $this->form->getLabel('nombre'); echo $this->form->getInput('nombre'); ?> 
	    	</div>
	    	
	    	<div>
	    		<?php echo $this->form->getLabel('id_cargo'); echo $this->form->getInput('id_cargo'); ?> 
	    	</div>
	    	
	    	<div>
	    		<?php echo $this->form->getLabel('date_ingreso'); echo $this->form->getInput('date_ingreso'); ?> 
	    	</div>
	    	
			<div>
	    		<?php echo $this->form->getLabel('date_cargo'); echo $this->form->getInput('date_cargo'); ?> 
	    	</div>
	    	
	    	<div>
	    		<?php echo $this->form->getLabel('nota'); echo $this->form->getInput('nota'); ?> 
	    	</div>			
	    	
	    	<div>
	    		<?php echo $this->form->getLabel('foto'); echo $this->form->getInput('foto'); ?> 
	    	</div>
	    	
		</div>
		
		<div style="float: right;" >		
			<input type="button" onclick="Joomla.submitbutton('funcionario.save');" class="btn btn-primary" value="Guardar y Salir">		
		</div>
		
		<input type="hidden" name="option" value="com_rrhh" />			
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
		<?php echo $this->form->getInput('id_user'); ?>
		
	</form>
