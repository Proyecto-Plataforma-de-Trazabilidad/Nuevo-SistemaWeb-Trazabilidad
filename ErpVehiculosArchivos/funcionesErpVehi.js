$(document).ready(function(){

    function comboerp() {
        let tipoFuncion = "combo1";
        let parametros = {"tipo":tipoFuncion}
        $.ajax({
            url:'ErpVehiculosArchivos/metodosErpVehic.php',
            data:parametros,
            type: 'POST',
            success:function(response){
                $('#inerp').html(response);
            }
        });
    }
    comboerp();

    $.ajax({
        url: 'ErpVehiculosArchivos/metodosErpVehic.php',
        data:{"tipo":""},
        type:'POST',
        success:function(response){
            $('#bodyTabla').html(response);
            $('#tabla').DataTable({
                scrollX:true,
            });
        }
    });
    window.addEventListener('resize', function(event){
        $('#tabla').DataTable().fnDestroy();
        $('#tabla').DataTable({
            scrollX:true,
        });
    },true);
});