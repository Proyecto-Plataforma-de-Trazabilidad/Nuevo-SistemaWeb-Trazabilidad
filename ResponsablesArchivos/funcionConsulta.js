$(document).ready(function(){

    $('#btnEditar').click(function(e){
        document.getElementById("innombre").disabled=false;
        document.getElementById("indom").disabled=false;
        document.getElementById("incp").disabled=false;
        document.getElementById("inmuni").disabled=false;
        document.getElementById("inedo").disabled=false;
        document.getElementById("intel").disabled=false;
        document.getElementById("incorr").disabled=false;
        document.getElementById("inestado").disabled=false;
    });

    $('#btnGuardar').click(function(e){
        let id=document.getElementById("inidcat").value
        let nom=document.getElementById("innombre").value;
        let dom=document.getElementById("indom").value;
        let cp=document.getElementById("incp").value;
        let muni=document.getElementById("inmuni").value;
        let est=document.getElementById("inedo").value;
        let tel=document.getElementById("intel").value;
        let corr=document.getElementById("incorr").value;
        let edo=document.getElementById("inestado").value;
        document.getElementById("innombre").disabled=true;
        document.getElementById("indom").disabled=true;
        document.getElementById("incp").disabled=true;
        document.getElementById("inmuni").disabled=true;
        document.getElementById("inedo").disabled=true;
        document.getElementById("intel").disabled=true;
        document.getElementById("incorr").disabled=true;
        document.getElementById("inestado").disabled=true;
        let tipofuncion="actualizar";
        let parametros={"id":id, "nom":nom, "dom":dom, "cp":cp, "muni":muni, "est":est, "tel":tel, "corr":corr, "edo":edo, "tipo":tipofuncion}
        $.ajax({
            url:'metodosRes.php',
            data:parametros,
            type:'POST',
        });
    });

    $('#btnEliminar').click(function(e){
        let tipofuncion="borrar";
        let id=document.getElementById("inidcat").value;
        let parametros={"id":id, "tipo":tipofuncion};
        $.ajax({
            url:'ResponsablesArchivos/metodosRes.php',
            data:parametros,
            type:'POST',
        });

    });

});