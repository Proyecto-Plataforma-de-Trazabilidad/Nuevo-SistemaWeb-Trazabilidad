$('#frmSalidas').submit(function (e) {

    e.preventDefault();  //detener la recarga de la pagina

    //let formData = new FormData(this); //Obtiene los archivos del formulario

    //tomar los valores del formulario
    let accion = 'registrarSalidas';

    let Recolector = document.getElementById('recolector')
    let idRec = Recolector.dataset.idRec;
    let Contenedores = document.getElementById('Contenedor').value
    let Responsable = document.getElementById('Responsable').value;
    let peso = document.getElementById('peso').value;
    let fecha = document.getElementById('fecha').value;


    //validar campos del formulario de orden
    let datos = {
        accion: accion,
        idRec: idRec,
        Contenedor: Contenedores,
        Responsable: Responsable,
        peso: peso,
        fecha: fecha,
    };
    console.log(datos);

    //realizar ejecucion 
    let chartStatus = Chart.getChart("myChart");
    //console.log(chartStatus.config.data.datasets[0].data[0]);

    let status = chartStatus.config.data.datasets[0].data[0];
    if (parseInt(peso) > parseInt(status)) {
        Swal.fire({
            icon: 'error',
            title: 'El peso es mayor al Status',
            text: 'Ingrese otra cantidad',
        }).then((result) => {
            if (result.isConfirmed) {
                $('#peso').val('');
            }
        });
    } else {
        insertarSalidas(datos);
    }


    function insertarSalidas(datosValidos) {
        //mandar datos del formulario con ajax
        $.ajax({
            url: 'SalidasArchivos/Peticiones/insertarSalida.php',
            data: { salidas: datosValidos },
            type: 'POST',
            success: function (response) {
                if (response == 'correcto') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro exitoso',
                        text: 'El registro se ha guardado correctamente',
                        showConfirmButton: true,
                        confirmButtonText: 'Ok',
                        confirmButtonColor: '#285430',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            limpiar();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Registro incorrecto',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            limpiar();
                        }
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                Swal.fire({
                    icon: 'error',
                    title: 'No se pudo registrar por algún error',
                    text: thrownError,
                });
            },
        });
    }

});

function limpiar() {
    location.reload();
}
