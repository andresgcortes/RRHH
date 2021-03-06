<?php

defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHTML::_('behavior.formvalidation');

?>

<script type="text/javascript">

	Joomla.submitbutton = function(task){
		
		if ((task == 'area.cancel') || document.formvalidator.isValid(document.id('Formrrhh'))){
			
			Joomla.submitform(task, document.getElementById('Formrrhh'));
	  			
		}else{
	 		alert("Existen campos vacios por favor verifique!");
			return false;
		}	
	
	}
	
	jQuery(document).ready(function(){
	
		jQuery(".box-content").on("change", ".area", function(event){
			
			elemento	= jQuery(this).val();
			
			var dato = new FormData();
				
			dato.append('area', elemento);
						
			jQuery.ajax({
					
				url:'index.php?option=com_rrhh&task=cargo.getarea&tmpl=raw', //Url a donde la enviaremos 
				type:'POST', //Metodo que usaremos		
				contentType:false, //Debe estar en false para que pase el objeto sin procesar
				data:dato, //Le pasamos el objeto que creamos con los archivos
				processData:false, //Debe estar en false para que JQuery no 
				cache:false
				
			}).done(function(msg){
				
				jQuery('.cargo').html(msg);

			});
			
		});
	
	});

</script>		

	<form action="index.php?option=com_rrhh&view=cargos&layout=edit&tmpl=component&id_area=<?php echo $this->item->id_cargo ?>" method="post" name="adminForm" id="Formrrhh" enctype="multipart/form-data" class="form-validate form">
				
		<div class="box-content" style="margin: 20px;">
			
			<div>
	    		<?php echo $this->form->getLabel('id_area'); echo $this->form->getInput('id_area'); ?> 
	    	</div>
	    	
	    	<div class = "cargo"> 
	    		<?php echo $this->form->getLabel('parent_id'); echo $this->form->getInput('parent_id'); ?> 
	    	</div>
			
			<div>
				<?php echo $this->form->getLabel('nombre'); echo $this->form->getInput('nombre'); ?> 
			</div>
			
		</div>
		
		<div style="float: right;" >		
			<input type="button" onclick="Joomla.submitbutton('cargo.save');" class="btn btn-primary" value="Guardar y Salir">		
		</div>
		
		<input type="hidden" name="option" value="com_rrhh" />			
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
		<?php echo $this->form->getInput('id_cargo'); ?>
		
	</form>
