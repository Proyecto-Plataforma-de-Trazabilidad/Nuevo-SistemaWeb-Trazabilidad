$(document).ready(function(){

    $.ajax({
        url:'QuimicoArchivos/metodosQuimico.php',
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
    

    $('#frm').submit(function(e){
        e.preventDefault();
        let conc=document.getElementById("inconc").value;
        let tipofuncion="registrar";
        let parametros={"conc":conc, "tipo":tipofuncion}

    });

});