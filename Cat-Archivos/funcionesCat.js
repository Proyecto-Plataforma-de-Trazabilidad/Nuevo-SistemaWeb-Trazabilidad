$(document).ready(function(){

    $.ajax({
        url:'Cat-Archivos/metodosCat.php',
        type:'POST',
        data: {"tipo":""},
        success:function(response){
            $('#bodyTabla').html(response);
            $('#tabla').DataTable({
                scrollX:true,
            });
        }
    });

    function combocat(){
        let tipoFuncion="combo1";
        let parametros={"tipo":tipoFuncion}
        $.ajax({
            url:'Cat-Archivos/metodosCat.php',
            data:parametros,
            type:'POST',
            success:function(response){
                $('#inres').html(response);
            }
        });
    }
    combocat();

    $.ajax({
        type: "POST",
        url: "procesar-estados.php",
        data: { estados: "Mexico" }
      }).done(function (data) {
        $("#jmr_contacto_estado").html(data);
      });
    
      // Obtener municipios
      $("#jmr_contacto_estado").change(function () {
        var estado = $("#jmr_contacto_estado option:selected").val();
        $.ajax({
          type: "POST",
          url: "procesar-estados.php",
          data: { municipios: estado }
        }).done(function (data) {
          $("#jmr_contacto_municipio").html(data);
        });
      });
 


      $('#frm').submit(function(e){
        e.preventDefault();
        console.log("paso por aqui 2.0");
        let formData = new FormData(this); //Este método trae todos los datos del form sin necesidad de leer el valor de cada campo
        console.log("Alv");
        $.ajax({
            url:'Cat-Archivos/Insertar.php',
            data:formData,
            type:'POST',
            contentType: false,
            cache: false,
            processData:false,
            datatype: "json",
            success:function(data){ //!!!Las respuestas que reciba de la petición se deben imprimir con sweetalerts
                if(data == "null"){
                  Swal.fire({
                      icon: 'error',
                      title: 'No se pudo realizar el insert',
                    });
                }else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Se a hecho el registro correctamente',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'yeiiiii'
                    }).then((result) => {
                        if(result.value){
                        registrarUsuario();  //Funcion para hacer el registro del usuario con los datos del form
                        }
                    });
                  }
                }
            });

        function registrarUsuario() {
            formData.append("tipousuario", "11");

            $.ajax({
                url: 'UserArchivos/nuevoRegistrar.php',
                data: formData,
                type: 'POST',
                contentType: false,
                cache: false,
                processData: false,
                datatype: "json",
                success: function (data) {
                    if (data == "null") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al registrar al usuarion nuevo',
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'El usuario se ha creado correctamente',
                            text: 'Recuerda comentarle a los usuarios',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "Cat.php";
                            }
                        });
                    }
                }
            });
        }
    });

});