$(document).ready(function(){
    function combo(){
        $.ajax({
            url:'metodosHuertos.php',
            type:'POST',
            data: {"tipo":"combo1"},
            success:function(response){
                $('#inprod').html(response);
            }
        });
    }

    $('#btnGuardar').click(function(e){
        let id=document.getElementById("inid").value;
        let prod=document.getElementById("inprod").value;
        let hue=document.getElementById("inhue").value;
        let lat=document.getElementById("inlat").value;
        let lon=document.getElementById("inlon").value;
        let tipofuncion="actualizar";
        let parametros={"id":id, "prod":prod, "hue":hue, "lat":lat, "lon":lon, "tipo":tipofuncion}
        $.ajax({
            url:'metodosHuertos.php',
            data:parametros,
            type:'POST',
            success:function(response){
                window.location="../Huertos.php";
            }
        });
    });
    $('#btnEditar').click(function(e){
        combo();
    });

});