<?php
/**
* @package Author
* @author 
* @website 
* @email 
* @copyright 
* @license 
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

JHTML::_('behavior.formvalidation');

$document = JFactory::getDocument();
$document->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
$document->addScript('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js');

JHtml::script(Juri::base() . 'templates/protostar/js/jquery.jOrgChart.js');
JHtml::script(Juri::base() . 'components/com_rrhh/views/rrhh/js/script.js');
JHtml::script(Juri::base() . 'components/com_rrhh/views/rrhh/js/html2canvas.min.js');

JFactory::getDocument()->addScriptDeclaration('
	
	jQuery(document).ready(function() {
 	        
		$(".redire").dblclick(function(){			
			var id_area = jQuery(this).children(".node").data("idcargo");
			$(location).attr("href","?option=com_rrhh&view=rrhh_cargo&id_area="+id_area);
    	});
    	
        $(".node").hover(function(){
            $(this).css("background-color", "#278dad");
        }, function(){
            $(this).css("background-color", "#8A8A8C");
        });
        
        html2canvas(document.querySelector(".wellorg")).then(function(canvas){
        	var png = canvas.toDataURL()
            //window.open(png);
       		console.log(png);
       		jQuery("#contenido").val(png); 	                    
        });
        	
    });

'); ?>

<script type="text/javascript">
	
	Joomla.submitbutton = function(task){
		
		if ((task == 'area.cancel') || document.formvalidator.isValid(document.id('Formrrhh'))){
						
			html2canvas(document.querySelector(".wellorg")).then(function(canvas){
            	var png = canvas.toDataURL()
	       		jQuery('#contenido').val(png); 	            
	        });
			
			Joomla.submitform(task, document.getElementById('Formrrhh'));
	  			
		}else{
			
	 		alert("Existen campos vacios por favor verifique!");
			return false;
		}	
	
	}	
	
</script>
        
<a href="javascript:void(0);" onclick="Joomla.submitbutton('rrhh.descargarpdf')" class="button-color">
	Exportar PDF
</a>

<div style="margin-left: auto; margin-right:auto" >
	<?php echo $this->html; ?>
</div>

<form action="index.php?option=com_rrhh&view=rrhh" method="post" name="adminForm" id="Formrrhh" enctype="multipart/form-data" class="form-validate form">
	
	<input type="hidden" name="option" value="com_rrhh" />			
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="contenido" id="contenido" value="" />	
	<?php echo JHtml::_('form.token'); ?>		

</form>