$(document).ready(function () {

    $.ajax({
        url: 'MunicipioArchivos/metodosMuni.php',
        type: 'POST',
        data: { "tipo": "" },
        success: function (response) {
            $('#bodyTabla').html(response);
            $('#tabla').DataTable({
                scrollX: true,
            });
        }
    });

    $.ajax({
        type: "POST",
        url: "procesar-estados.php",
        data: { estados: "Mexico" }
      }).done(function (data) {
        $("#jmr_contacto_estado").html(data);
      });



    $('#frm').submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this); //Este método trae todos los datos del form sin necesidad de leer el valor de cada campo

        $.ajax({
            url: 'MunicipioArchivos/Insertar.php',
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            datatype: "json",
            success: function (data) { //Las respuestas que reciba de la petición se deben de imprimir con SweetAlerts
                if (data == "null") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Seleccione los 3 archivos',
                    });
                } else if (data == "extension") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Solo se permiten archivos con extensión .pdf .jpg .jpeg .png',
                    });
                } else if (data == "error") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al subir los archivos',
                    });
                } else if (data == "server fail") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hay un error con el servidor',
                        text: 'Intentar de nuevo mas tarde',
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Se han subido los datos correctamente',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value) {
                            registrarUsuario(); //Función para hacer el registro del usuario con los datos del form
                        }
                    });
                }

            }
        });

        function registrarUsuario() {
            formData.append("tipousuario", "4");

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
                            title: 'Error al registrar el usuario',
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'El usuario se ha creado correctamente',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "Municipio.php";
                            }
                        });
                    }
                }
            });
        }
    });

});