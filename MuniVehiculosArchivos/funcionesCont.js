$(document).ready(function(){

    function combomuni(){
        let tipoFuncion="combo1";
        let parametros={"tipo":tipoFuncion}
        $.ajax({
            url:'MuniVehiculosArchivos/metodosMuniVehiculos.php',
            data:parametros,
            type:'POST',
            success:function(response){
                $('#inmuni').html(response);
            }
        });
    }
    combomuni();

    $.ajax({
        url:'MuniVehiculosArchivos/metodosMuniVehiculos.php',
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