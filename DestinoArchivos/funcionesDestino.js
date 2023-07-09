$(document).ready(function () {

    $.ajax({
        url: 'DestinoArchivos/metodosDestino.php',
        data: { "tipo": "" },
        type: 'POST',
        success: function (response) {
            $('#bodyTabla').html(response);
            $('#tabla').DataTable({
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
        let formData = new FormData(this); //Trae todos los datos del formulario
        $.ajax({
            url: 'DestinoArchivos/Insertar.php',
            data: formData,
            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            datatype: 'json',
            success: function (data) { //Las respuestas que reciba de la petición se deben imprimir con sweetalerts
                if (data == "null") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Seleccione un archivo SEMARNAT válido',
                    });
                } else if (data == "extensión") {
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
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Se han registrado los datos correctamente',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value) {
                            registrarUsuario(); //Función para registrar al usuario automáticamente.
                        }
                    });
                }
            }
        });

        function registrarUsuario() {
            formData.append("tipousuario", "6");

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
                                window.location.href = "EmpresaDestino.php";
                            }
                        });
                    }
                }
            });
        }
    });

});