$('#frm').submit(function (e) {

    e.preventDefault();  //detener la recarga de la pagina

    let formData = new FormData(this); //Obtiene los archivos del formulario
    $.ajax({
        url: 'Contenedores-Archivos/insertar.php',
        type: 'POST',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            console.log(response);
            if (response == "No hay archivo") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error en el archivo',
                    text: 'Asegúrese de seleccionar un archivo',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(elemen).val('');
                    }
                });
            } else if (response == "Extension no valida") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error en el archivo',
                    text: 'Solo se permiten archivos con extensión .pdf .jpg .jpeg .png',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#infile').val('');
                    }
                });
            } else if (response == "Todo Correcto") {
                Swal.fire({
                    icon: 'success',
                    title: 'Todo correcto',
                    text: 'Se registro el contenedor correctamente',
                    showConfirmButton: true,
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#285430',
                }).then((result) => {
                    if (result.isConfirmed) {
                        //location.reload();
                    }
                });
            } else {
                console.log(response);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error inesperado',
                }).then((result) => {
                    if (result.isConfirmed) {
                        //location.reload();
                    }
                });
            }
        }
    });
});