$(document).ready(function(){
    function combo(){
        $.ajax({
            url:'metodosUser.php',
            type:'POST',
            data: {"tipo":"combo1"},
            success:function(response){
                $('#tuser').html(response);
            }
        });
    }

    $('#btnGuardar').click(function(e){
        let iduser=document.getElementById("iduser").value;
        let nomb=document.getElementById("nomb").value;
        let tuser=document.getElementById("tuser").value;
        let correo=document.getElementById("correo").value;
        let contra=document.getElementById("contra").value;
        let tipofuncion="actualizar";
        let parametros={"nomb":nomb, "tuser":tuser, "correo":correo, "contra":contra, "iduser":iduser, "tipo":tipofuncion}
        $.ajax({
            url:'metodosUser.php',
            data:parametros,
            type:'POST',
            success:function(response){
                window.location="../rusers.php";
            }
        });
    });
    $('#btnEditar').click(function(e){
        combo();
    });

});