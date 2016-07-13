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
JHtml::_('behavior.modal');

$document = JFactory::getDocument();
$document->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');

JHtml::script(Juri::base() . 'components/com_rrhh/views/rrhh/js/html2canvas.min.js');

$component = JRequest::getVar('tmpl');
$id_area	= JRequest::getVar('id_area');

$m = ''; 
if($id_area != 18 || $id_area != 17){
	$m = '$(".downlarge").css("margin", "-219px auto 0px auto");';
}if($id_area == 18){
	$m = '$(".downlarge").css("margin", "-265px auto 0px auto");';
}elseif($id_area == 17){
	$m = '$(".downlarge").css("margin", "-292px auto 0px auto");';
}

if($component == 'component'){
	
	JFactory::getDocument()->addScriptDeclaration('

		jQuery(document).ready(function() {
	 		
	 		$(".contustiemp").css("display", "block");
	 		$(".contustiemp").css("position", "inherit");     
	 		$(".contustiemp").css("margin-left", "0px");     
	 		$(".contustiemp").css("margin-top", "5px");
	 		$(".downlarge").css("height", "300px");
	 		'. $m .'
	 		
	 		$(".jOrgChart").css("min-height", "1200px");
	 		$(".wellorg").css("min-height", "1200px");	 		
						
			html2canvas(document.querySelector(".wellorg")).then(function(canvas){
		    	var png = canvas.toDataURL()
		        jQuery("#contenido").val(png); 	                    
		    });	
		    
		    $(".habilitador").click(function(){
	        	jQuery("li.segunda").hide();
		    	jQuery("div.hijo").hide();
		    	jQuery(this).children("div.hijo").show();
		    });
		    
		    jQuery(".padresq").click(function(){
		    	jQuery("div.hijo").hide();
	        	jQuery("li.segunda").show();
		    });
			
		}); 
		
	'); 	
		
}else{
	
	JFactory::getDocument()->addScriptDeclaration('

		jQuery(document).ready(function() {
	 	
		    $(".nodec").dblclick(function(){
		    	var id_cargo = jQuery(this).children(".tcolar").data("idcargo");				
	    		$(location).attr("href","?option=com_rrhh&view=sucesion&id_cargo="+id_cargo);
	    	});
		    
			$(".nodec").hover(function(){			
		        $(this).children(".contustiemp").css("display", "block");
		    }, function(){            
		        $(this).children(".contustiemp").css("display", "none");
		    });
		    
		    html2canvas(document.querySelector(".wellorg")).then(function(canvas){
	        	var png = canvas.toDataURL()
	            jQuery("#contenido").val(png); 	                    
	        });	
	        
	        $(".habilitador").click(function(){
	        	jQuery("li.segunda").hide();
		    	jQuery("div.hijo").hide();
		    	jQuery(this).children("div.hijo").show();
		    });
		    
		    jQuery(".padresq").click(function(){
		    	jQuery("div.hijo").hide();
	        	jQuery("li.segunda").show();
		    });
		    	    
		}); 

	'); 

} ?>

<style type="text/css">

	/* list stuff */
	#show-list{
		cursor 				: pointer;
	}
	
	/* bootstrap overrides */
	.alert-message{
		margin: 2px 0;
	}

	.topbar{
		position 			: absolute;
	}

	.node p{
		font-family 	: sans-serif;
		font-size 		: 12px;
		line-height 	: 11px;
		padding 		: 2px;
	}
	
	.tcolar {
		color: #FFFFFF;
	}
	
	.tcargo {
		background: #278dad;
	    border-top-left-radius: 6px;
	    border-top-right-radius: 6px;
	    text-align: center;
	    padding: 5px 12px;
	    white-space: nowrap;
	    text-overflow: ellipsis;
	    overflow: hidden;
	}
	
	.cdescrip{
		background: #FFFFFF;
	} 
	
	.ccolar{
		color: #AEB0B3;
	    text-align: center;
	    margin: 10px;
	    height: 50px;
	    vertical-align: middle;
	
	}
	
	.fdescrip{
		background: #AEB0B3;
	    border-bottom-left-radius: 6px;
	    border-bottom-right-radius: 6px;
	}
	.fcolar{
		color: #278dad;
		padding: 5px;
		text-align: center;
	}

    .thtc {          
    	font-size: 15px;
	    font-weight: bolder;
	    width: 20%;
	    text-align: center;
	    padding-top: 4px;
    }

	.tdtc {        
		background: #FFFFFF;     
		border-bottom: 1px solid #fff;
    	color: #000000;    
    	border-top: 1px solid transparent; 
    }

	.trtc:hover .tdtc { background: #d0dafd; color: #339; }

</style>

<script type="text/javascript">
	
	Joomla.submitbutton = function(task){
		
		if ((task == 'cancel.cancel') || document.formvalidator.isValid(document.id('Formrrhh'))){
			
			html2canvas(document.querySelector(".wellorg")).then(function(canvas){
	        	var png = canvas.toDataURL()
	            jQuery("#contenido").val(png); 	                    
	        });
	        
			Joomla.submitform(task, document.getElementById('Formrrhh'));
	  			
		}else{
			
	 		alert("Existen campos vacios por favor verifique!");
			return false;
		}	
	
	}	
	
</script>

<form action="index.php?option=com_rrhh&view=rrhh_cargo" method="post" name="adminForm" id="Formrrhh" enctype="multipart/form-data" class="form-validate form">
	
	<input type="hidden" name="option" value="com_rrhh" />			
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="contenido" id="contenido" value="" />	
	<?php echo JHtml::_('form.token'); ?>		

</form>

