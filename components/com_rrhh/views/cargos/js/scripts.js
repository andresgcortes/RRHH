
/**
 * @package     Joomla.Site
 * @autor  		Jorge Angarita
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.2
 */
$(document).ready(function(){

    $('#sortable').sortable({
        revert: true,
        opacity: 0.6, 
        cursor: 'move',
        update: function() {
            //var order = $("#idarea").sortable("serialize")+'&action=orderState';
            var order = $("#sortable").sortable("toArray",{attribute: "sortable-group-id"});
            $.post("index.php?option=com_rrhh&task=cargo.cambioPosicionAjax", {nuevo_orden: order}, function(theResponse){
                $('#success').html('Gracias por ordenar!').slideDown('slow').delay(1000).slideUp('slow');
            });
        }
    });
    
});


	

