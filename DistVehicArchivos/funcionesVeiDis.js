$(document).ready(function(){

    function combodist(){
        let tipoFuncion="combo1";
        let parametros={"tipo":tipoFuncion}
        $.ajax({
            url:'DistVehicArchivos/metodosDistVehic.php',
            data:parametros,
            type:'POST',
            success:function(response){
                $('#indist').html(response);
            }
        });
    }
    combodist();

    $.ajax({
        url:'DistVehicArchivos/metodosDistVehic.php',
        data:{"tipo":""},
        type:'POST',
        success:function(response){
            $('#bodyTabla').html(response);
            $('#tabladistv').DataTable({
                scrollX:true,
            });
        }
    });
    window.addEventListener('resize', function(event){
        $('#tabladistv').DataTable().fnDestroy();
        $('#tabladistv').DataTable({
            scrollX:true,
        });
    },true);
});