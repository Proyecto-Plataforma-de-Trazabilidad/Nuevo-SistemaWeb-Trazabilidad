$(document).ready(function(){
    $('#guardar').click(function(e){
        let idcat=document.getElementById("incat").value;
        let nom=document.getElementById("innom").value;
        let nra=document.getElementById("innra").value;
        let info=document.getElementById("info").value;
        let dom=document.getElementById("indom").value;
        let cp=document.getElementById("incp").value;
        let muni=document.getElementById("inmuni").value;
        let est=document.getElementById("inest").value;
        let tel=document.getElementById("intel").value;
        let corr=document.getElementById("incorr").value;
        let hor=document.getElementById("inhor").value;
        let lat=document.getElementById("inlat").value;
        let lon=document.getElementById("inlon").value;
        let plan=document.getElementById("inplan").value;
        if(nra.length>10 || nra.length<10){
            alert("El campo: Numero de registro ambiental, debe ser de 10 digitos");
            return false;
            }   
            if(cp.length>5 || cp.length<5){
            alert("El campo: Código postal, debe ser de 5 digitos");
            return false;
            }
            if(tel.length>10 || tel.length<10){
            alert("El campo: Telefono, debe ser de 10 digitos");
            return false;
            }

        
        document.getElementById("innra").disabled=true;
          document.getElementById("innom").disabled=true;
          document.getElementById("info").disabled=true;
          document.getElementById("indom").disabled=true;
          document.getElementById("incp").disabled=true;
          document.getElementById("inmuni").disabled=true;
          document.getElementById("inest").disabled=true;
          document.getElementById("intel").disabled=true;
          document.getElementById("incorr").disabled=true;
          document.getElementById("inhor").disabled=true;
          document.getElementById("inlat").disabled=true;
          document.getElementById("inlon").disabled=true;
          document.getElementById("inplan").disabled=true;
          document.getElementById("guardar").disabled=true;
          document.getElementById("editar").disabled=false;
          console.log(idcat);
          console.log(nra);
          console.log(nom);
          console.log(info);
          console.log(dom);
          console.log(cp);
          console.log(muni);
          console.log(est);
          console.log(tel);
          console.log(corr);
          console.log(hor);
          console.log(lat);
          console.log(lon);
          console.log(plan);
        let tipofuncion="actualizar";
        let parametros={"idcat":idcat, "nra":nra, "nom":nom, "info":info, "dom":dom, "cp":cp, "muni":muni, "est":est, "tel":tel, "corr":corr, "hor":hor, "lat":lat, "lon":lon, "plan":plan, "tipo":tipofuncion}
        $.ajax({
            url:'metodosCat.php',
            data:parametros,
            type:'POST',
            success:function(response){
                console.log(response);
            }
        });
    });

    $('#editar').click(function(e){
        combocat();
    });
    function combocat(){
        let tipoFuncion="combo1";
        let parametros={"tipo":tipoFuncion}
        $.ajax({
            url:'metodosCat.php',
            data:parametros,
            type:'POST',
            success:function(response){
                $('#inres').html(response);
            }
        });
    }

});