$(document).ready(function(){

    $('#btnEditar').click(function(e){
        document.getElementById("innom").disabled=false;
        document.getElementById("inreg").disabled=false;
        document.getElementById("indom").disabled=false;
        document.getElementById("incp").disabled=false;
        document.getElementById("inciu").disabled=false;
        document.getElementById("inmuni").disabled=false;
        document.getElementById("inest").disabled=false;
        document.getElementById("intel").disabled=false;
        document.getElementById("incorr").disabled=false;
        document.getElementById("inorden").disabled=false;
        document.getElementById("inpuntos").disabled=false;
        document.getElementById("inentrega").disabled=false;
        document.getElementById("ingiro").disabled=false;
    });

    $('#btnGuardar').click(function(e){
        document.getElementById("inid").disabled=false;
        let id=document.getElementById("inid").value
        let nom=document.getElementById("innom").value
        let reg=document.getElementById("inreg").value;
        let dom=document.getElementById("indom").value;
        let cp=document.getElementById("incp").value;
        let ciu=document.getElementById("inciu").value;
        let muni=document.getElementById("inmuni").value;
        let est=document.getElementById("inest").value;
        let tel=document.getElementById("intel").value;
        let corr=document.getElementById("incorr").value;
        let orden=document.getElementById("inorden").value;
        let puntos=document.getElementById("inpuntos").value;
        let entrega=document.getElementById("inentrega").value;
        let giro=document.getElementById("ingiro").value;

        document.getElementById("innom").disabled=true;
        document.getElementById("inreg").disabled=true;
        document.getElementById("indom").disabled=true;
        document.getElementById("incp").disabled=true;
        document.getElementById("inciu").disabled=true;
        document.getElementById("inmuni").disabled=true;
        document.getElementById("inest").disabled=true;
        document.getElementById("intel").disabled=true;
        document.getElementById("incorr").disabled=true;
        document.getElementById("inorden").disabled=true;
        document.getElementById("inpuntos").disabled=true;
        document.getElementById("inentrega").disabled=true;
        document.getElementById("ingiro").disabled=true;

        
        let tipofuncion="actualizar";
        let parametros={"id":id, "nom":nom, "dom":dom, "cp":cp, "muni":muni, "est":est, "tel":tel, 
                        "reg":reg, "ciu":ciu, "orden":orden, "puntos":puntos, "entrega":entrega,
                        "giro":giro, "corr":corr, "est":est, "tipo":tipofuncion}
        $.ajax({
            url:'metodosProd.php',
            data:parametros,
            type:'POST'
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