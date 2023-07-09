$(document).ready(function(){

    $.ajax({
        url:'DistArchivos/metCons.php',
        data:{"tipo":""},
        type:'POST',
        success:function(response){
            $('#bodyTabla').html(response);
            $('#tabla').DataTable({
                scrollX:true,
            });
        }
    });

});