$(document).ready(function(){
    
    $('#btnGuardar').click(function(e){
        e.preventDefault();
        let idtipo=document.getElementById("inid").value;
        let conc=document.getElementById("inconc").value;
        let tipofuncion="actualizar";
        let parametros={"conc":conc, "tipo":tipofuncion, "idtipo":idtipo}
        $.ajax({
            url:'metodosTipoCont.php',
            data:parametros,
            type:'POST',
        });
        location.href="../TiposCont.php"
    });

});