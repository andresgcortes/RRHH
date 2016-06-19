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

$document = JFactory::getDocument();
$document->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
$document->addScript('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js');

JHtml::script(Juri::base() . 'templates/protostar/js/jquery.jOrgChart.js');
JHtml::script(Juri::base() . 'components/com_rrhh/views/rrhh/js/script.js');

//JHtml::script(Juri::base() . 'templates/protostar/css/jquery.jOrgChart.css');

JFactory::getDocument()->addScriptDeclaration('
	
	jQuery(document).ready(function() {
 	
        $("#org").jOrgChart({
            chartElement : \'#chart\',
            dragAndDrop  : true,                         
        });
        
		$(".redire").click(function(){			
			var id_area = jQuery(this).children().data("idcargo");
			$(location).attr("href","?option=com_rrhh&view=rrhh_cargo&id_area="+id_area);
    	});
    	
        $(".redire").hover(function(){
            $(this).css("background-color", "#278dad");
        }, function(){
            $(this).css("background-color", "#8A8A8C");
        });
    });

'); ?>

<div style="margin-left: auto; margin-right:auto" >
	
	<div>Descargar PDf</div>
	
	<?php echo $this->html; ?>

</div>

