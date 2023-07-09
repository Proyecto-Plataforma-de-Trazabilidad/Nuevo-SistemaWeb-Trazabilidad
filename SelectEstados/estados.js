$(document).ready(function(){
    function comboestado(){
        let tipoFuncion = "comboEst";
        let parametros = {"tipo": tipoFuncion}
        $.ajax({
            url: 'SelectEstados/metodosEstados.php',
            data: parametros,
            type: 'POST',
            success: function(response){
                $('#inest').html(response);
            }
        });
    }
    comboestado();

    function combomuni(){
        let tipoFuncion = "comboMuni";
        let parametros = {"tipo": tipoFuncion}
        $.ajax({
            url: 'SelectEstados/metodosEstados.php',
            data: parametros,
            type: 'POST',
            success: function(response){
                $('#inest').html(response);
            }
        });
    }
    combomuni();
});