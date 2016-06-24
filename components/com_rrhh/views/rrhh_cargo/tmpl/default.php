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
JHtml::script(Juri::base() . 'components/com_rrhh/views/rrhh/js/html2canvas.min.js');

JFactory::getDocument()->addScriptDeclaration('

	jQuery(document).ready(function() {
 	
	 	$(".contustiemp").css("display", "none");
	        
	    $("#org").jOrgChart({
	      chartElement : \'#chart\',
	        dragAndDrop  : true
	    });
	    
	    $(".redire").click(function(){
	    	var id_cargo = jQuery(this).children().data("idcargo");				
    		$(location).attr("href","?option=com_rrhh&view=sucesion&id_cargo="+id_cargo);
    	});
	    
		$(".infousutiemp").hover(function(){			
	        $(".contustiemp").css("display", "block");
	    }, function(){            
	        $(".contustiemp").css("display", "none");
	    });
	    
	    html2canvas(document.querySelector(".well")).then(function(canvas){
        	var png = canvas.toDataURL()
            //window.open(png);
       		console.log(png);
       		jQuery("#contenido").val(png); 	                    
        });			
			
	}); 

'); ?>

<style type="text/css">
/* Basic styling */
/* Draw the lines */
.jOrgChart .line {
  height                : 20px;
  width                 : 4px;
}
.jOrgChart .down {
  background-color 		: #888888;	
  margin 				: 0px auto;
}
.jOrgChart .top {
  border-top          : 3px solid #888888;
}
.jOrgChart .left {
  border-right          : 2px solid #888888;
}
.jOrgChart .right {
  border-left           : 2px solid #888888;
}
/* node cell */
.jOrgChart td {
  text-align            : center;
  vertical-align        : top;
  padding               : 0;
}
/* The node */
.jOrgChart .node {
  background-color 		: #35363B;
  display               : inline-block;
  width                 : 192px;
  height                : 100%;
  z-index 				: 10;
  margin               : 0 2px;
}
/* jQuery drag 'n drop */
.drag-active {
  border-style			: dotted !important;
}
.drop-hover {
  border-style			: solid !important;
  border-color 			: #E05E00 !important;
}
body, html, div, p, span, a, h1, h2, h3, h4, h5{
	margin 				: 0;
	padding 			: 0;
}
body, html{	
	width 				: 100%;
}
body{
	background 			: url('../images/bkgd.png') repeat top left;
	color 				: white;
	font-family 		: tahoma;
	font-weight 		: lighter;
	padding-top 		: 40px;
}
	body p{
		font-size 		: 14px;
	}
	
		body p a{
			font-size	: 16px;
		}
h1 {
	color 				: #AEB0B3;	
	font-style 			: italic;
}
a{
	color 				: #AEB0B3;	
	text-decoration		: none;
}
a:hover{
	text-decoration		: underline;
}
/* general */
.clear {
	clear: both;
}
/* Header */
.brand{
	color 				: #AEB0B3 !important;	
	font-family 		: georgia;
	font-style 			: italic;
}
/* list stuff */
#org{
	background-color 	: white;
	margin 				: 10px;
	padding 			: 10px;
}
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
/* Custom chart styling */
.jOrgChart {
  margin                : 10px;
  padding               : 20px;
}
.jOrgChart .node {
    font-size: 14px;
    background-color: #FFFFFF;
    border-radius: 8px;
    border: 1px solid #BBBBBB;
    color: #AEB0B3;
    -moz-border-radius: 8px;
}
/* Custom node styling 
.jOrgChart .node {
	font-size 			: 14px;
	background-color 	: #35363B;
	border-radius 		: 8px;
	border 				: 5px solid white;
	color 				: #F38630;
	-moz-border-radius 	: 8px;
}*/
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
    	padding-top: 9px;
	}
	.cdescrip{
		background: #FFFFFF;
	} 
	.ccolar{
		color: #AEB0B3;
	}
	.fdescrip{
		background: #AEB0B3;
		border-top-left-radius: 6px;
		border-top-right-radius: 6px;
	}
	.fcolar{
		color: #278dad;
		padding-bottom: 10px;
	}

	.jOrgChart .node {
	    text-align: center; 
	    padding: 0px;
	}
	.contustiemp {
	    position: absolute;
	    width: 171px;
	    height: 128px;
	    margin-left: 194px;
	    margin-top: -140px;
	    border-radius: 8px;
	}

	.tabletc {     
		font-family: "Lucida Sans Unicode", "Lucida Grande",Sans-Serif;
    	font-size: 9px;  
    	text-align: left;    
    	border-collapse: collapse; 
    	width: 171px;
    }

    .thtc {     
    	font-size: 9px;     
    	font-weight: normal;    
    	width: 20%;
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
			
			html2canvas(document.querySelector(".well")).then(function(canvas){
            	var png = canvas.toDataURL()
	            //window.open(png);
           		console.log(png);
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

<form action="index.php?option=com_rrhh&view=rrhh_cargo" method="post" name="adminForm" id="Formrrhh" enctype="multipart/form-data" class="form-validate form">
	
	<input type="hidden" name="option" value="com_rrhh" />			
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="contenido" id="contenido" value="" />	
	<?php echo JHtml::_('form.token'); ?>		

</form>

