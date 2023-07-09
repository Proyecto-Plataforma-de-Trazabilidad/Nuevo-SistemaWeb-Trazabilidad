$(document).ready(function(){

    $.ajax({
        url:'TipoCont/metodosTipoCont.php',
        type:'POST',
        data: {"tipo":""},
        success:function(response){
            $('#bodyTabla').html(response);
            $('#tabla').DataTable({
                scrollX:true,
            });
        }
    });
    

    $('#frm').submit(function(e){
        e.preventDefault();
        
        let conc=document.getElementById("inconc").value;
        let tipofuncion="registrar";
        let parametros={"conc":conc, "tipo":tipofuncion}
        $.ajax({
            url:'TipoCont/metodosTipoCont.php',
            data:parametros,
            type:'POST',
            success:function(response){
                $('#bodyTabla').html(response);
                $('#tabla').DataTable({
                    scrollX:true,
                });
            }
        });
        console.log("paso por aqui");
        $('#frm').trigger('reset');
    });

});