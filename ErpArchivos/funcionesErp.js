$(document).ready(function () {

    $.ajax({
        url: 'ErpArchivos/metodosErp.php',
        data: { "tipo": "" },
        type: 'POST',
        success: function (response) {
            $('#bodyTabla').html(response);
            $('#tablaCAT').DataTable({
                scrollX: true,
            });
        }
    });

    //Cargar todos los estados de México al combo de Estados
    $.ajax({
        type: 'POST',
        url: "procesar-estados.php",
        data: { estados: "Mexico" }
    }).done(function (data) {
        $("#jmr_contacto_estado").html(data);
    });

    //Obtener todos los municipios en base al estado seleccionado
    $("#jmr_contacto_estado").change(function () {
        var estado = $("#jmr_contacto_estado option:selected").val();
        $.ajax({
            type: 'POST',
            url: 'procesar-estados.php',
            data: { municipios: estado }
        }).done(function (data) {
            $("#jmr_contacto_municipio").html(data);
        });
    });

    $('#frm').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this); //Este método trae todos los datos del form sin necesidad de leer el valor de cada campo
        $.ajax({
            url: 'ErpArchivos/Insertar.php',
            data: formData,
            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            datatype: "json",
            success: function (res) { //Las respuestas que reciba de la petición se deben imprimir con sweetalerts
                let data = JSON.parse(res);

                if (data == "null") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Seleccione los 2 archivos',
                    });
                } else if (data == "extension") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Solo se permiten archivos con extensión .pdf .jpg .jpeg .png',
                    });
                } else if (data == "error") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al subir el archivo',
                    });
                } else if (data == "server fail") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hay un error con el servidor',
                        text: 'Intentar de nuevo mas tarde'
                    });
                } else if (data == "archivos subidos") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Se han registrado los datos correctamente',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value) {
                            registrarUsuario();  //Funcion para hacer el registro del usuario con los datos del form
                        }
                    });
                }
            }
        });

        function registrarUsuario() {
            //console.log(formData);
            formData.append("tipousuario", "5");
            console.log(formData);

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
                            title: 'Error al registrar al nuevo usuario',
                        })
                    } else if (data) { //Si se devolvio true se manda el mensaje de correcto
                        Swal.fire({
                            icon: 'success',
                            title: 'El usuario se a creado correctamente',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                //window.location.href = "EmpresaRecPrivada.php";
                            }
                        });
                    }
                }
            });
        }

    });

});