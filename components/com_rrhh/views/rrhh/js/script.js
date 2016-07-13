$(document).ready(function(){

   $("#imge").click(function() {

       var order = 1;

        $.post("index.php?option=com_rrhh&task=rrhh.pdf", {order: order}, function(theResponse){
            console.log(theResponse);
                $('#successe').html(theResponse);
        });

    });
});