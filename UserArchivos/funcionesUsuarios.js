$(document).ready(function(){

    function comboerp() {
        let tipoFuncion = "combo1";
        let parametros = {"tipo":tipoFuncion}
        $.ajax({
            url:'UserArchivos/metodosUser.php',
            data:parametros,
            type: 'POST',
            success:function(response){
                $('#tipUser').html(response);
            }
        });
    }
    comboerp();

    $.ajax({
        url:'UserArchivos/metodosUser.php',
        type:'POST',
        data: {"tipo":""},
        success:function(response){
            $('#bodyTabla').html(response);
            $('#tabla').DataTable({
                scrollX:true,
            });
        }
    });


});