$(document).ready(function(){

    $.ajax({
        url:'HuertosArchivos/metodosHuertos.php',
        type:'POST',
        data: {"tipo":""},
        success:function(response){
            $('#bodyTabla').html(response);
            $('#tabla').DataTable({
                scrollX:true,
            });
        }
    });
    
    $.ajax({
        url:'HuertosArchivos/metodosHuertos.php',
        type:'POST',
        data: {"tipo":"combo1"},
        success:function(response){
            $('#inprod').html(response);
        }
    });
    
    

    $('#frm').submit(function(e){
        e.preventDefault();
        
        let prod=document.getElementById("inprod").value;
        let hue=document.getElementById("inhue").value;
        let lat=document.getElementById("inlat").value;
        let lon=document.getElementById("inlon").value;
        let tipofuncion="registrar";
        let parametros={"prod":prod, "hue":hue, "lat":lat, "lon":lon, "tipo":tipofuncion}
        $.ajax({
            url:'HuertosArchivos/metodosHuertos.php',
            data:parametros,
            type:'POST',
            success:function(response){
                $('#bodyTabla').html(response);
                tabla.ajax.reload();
            }
        });
        
        $('#frm').trigger('reset');
    });

    window.addEventListener('resize', function(event){
        $('#tabla').DataTable().fnDestroy();
        $('#tabla').DataTable({
            scrollX:true,
        });
    },true);

    

});