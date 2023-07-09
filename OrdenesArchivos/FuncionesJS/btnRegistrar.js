$('#frmOrden').submit(function (e) {

    e.preventDefault();  //detener la recarga de la pagina

    let formData = new FormData(this); //Obtiene los archivos del formulario

    //tomar los valores del formulario
    let accion = 'registrarOrden';

    let nomDis = document.getElementById('nomDistri')
    let idDis = nomDis.dataset.idDistribuidor;
    let idProd = document.getElementById('nomProdu').value;
    let NumFac = document.getElementById('factOrden').value;
    let numRec = document.getElementById('cedReceta').value;
    let fecha = document.getElementById('fecha').value;

    //validar campos del formulario de orden
    let datos = {
        accion: accion,
        idDis: idDis,
        idProd: idProd,
        NumFac: NumFac,
        factura: "",
        numRec: numRec,
        receta: "",
        fecha: fecha,
    };
    //console.log(datos);

    let orden = document.getElementById('numOrden');
    const numOrden = orden.dataset.numOrden; //Se obtiene el id de la orden almacenada en el dataSet
    formData.append("IdOrden", numOrden); //Se agrega el id de la orden para mandarlo junto con los archivos

    if (!(document.querySelector('#detalle'))) {
        // if (!$('#archFac').val() && !$('#archRece').val()) {
        //     console.log("No seleciono ningun archivo");
        // }
        insertarArchivo("Nada", "actualiza", '../Peticiones/insertarArchivo.php');
    } else {
        //tomar los valores de la tabla detalle
        let arreglo = new Array();
        let tabla = document.querySelector('#detalle'); //buscamos la tabla
        let filas = tabla.querySelectorAll('tr'); // seleccionamos todas los renglones

        if (filas[1] == undefined) {
            mensajeAdvertencia("Fallo al registrar", "Debe añadir un registro al detalle");
        } else {
            //ciclo que recorre las filas del detalle
            for (var i = 1; i < filas.length; i++) {
                //ejecutara todo el numero de filas
                var celdas = filas[i].getElementsByTagName('td'); //solo tomara las que son de td
                var fila = {
                    idOrden: numOrden,
                    consecutivo: celdas[0].innerHTML,
                    idquimico: celdas[1].dataset.tableIdquimico,
                    tipoEnvase: celdas[2].innerHTML,
                    color: celdas[3].innerHTML,
                    piezas: celdas[4].innerHTML,
                };
                arreglo.push(fila);
            }
            //console.log(arreglo);
            insertarArchivo(arreglo, "registra", 'OrdenesArchivos/Peticiones/insertarArchivo.php');
        }
    }

    let resArchivo = "";

    //mandar archivo con ajax 
    function insertarArchivo(arreglo, opcion, ruta) {
        //console.log(arreglo, opcion, ruta);
        $.ajax({
            url: ruta,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                resArchivo = JSON.parse(response);
                //console.log(resArchivo);

                datos.factura = resArchivo.rutaArchFac;
                datos.receta = resArchivo.rutaArchRece;

                // if(resArchivo.rutaArchFac == "Faltante")
                //     mensajeAdvertencia('No ingreso archivo de factura', 'Pero puede continuar de igual manera');
                // if(resArchivo.rutaArchRece == "Faltante")
                //     mensajeAdvertencia('No ingreso archivo de receta', 'Pero puede continuar de igual manera');

                //!Errores de extension
                if (resArchivo.extCorrectaArchFac == "No permitida")
                    mensajeError('Extensión incorrecta', 'De archivo factura', '#archFac');
                else if (resArchivo.extCorrectaArchRece == "No permitida")
                    mensajeError('Extensión incorrecta', 'De archivo receta', '#archReceta');
                else if (resArchivo.guardadoArchFac == "Fallido") //!Errores de guardado
                    mensajeError('Error al guardar', 'El archivo factura no se pudo guardar, intentelo de nuevo', '#archFac');
                else if (resArchivo.guardadoArchRece == "Fallido")
                    mensajeError('Error al guardar', 'El archivo receta no se pudo guardar, intentelo de nuevo', '#archReceta');
                else {
                    if (opcion == "registra")
                        insertarOrden(datos, arreglo);
                    else
                        actualizarOrden(datos);
                }

                //
            }
        });
    }

    function actualizarOrden(datosValidos) {
        datosValidos.NumOrden = numOrden;
        console.log(datosValidos);
        $.ajax({
            url: '../Peticiones/actualizarOrden.php',
            data: { orden: datosValidos },
            type: 'POST',
            success: function (response) {

                if (response == 'Correcto') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Orden Actualizada',
                        text: 'Se actualizo correctamente la orden',
                        showConfirmButton: true,
                        confirmButtonText: 'Ok',
                        confirmButtonColor: '#285430',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            limpiar();
                        }
                    });
                } else if (response == 'Error') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al actualizar',
                        text: 'Inténtelo de nuevo',
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
                    title: 'No se pudo registrar por error',
                    text: thrownError,
                });
            },
        });

    }

    function insertarOrden(datosValidos, arregloValido) {
        //mandar orden y detalle con ajax
        $.ajax({
            url: 'OrdenesArchivos/Peticiones/insertarOrden.php',
            data: { orden: datosValidos, detalle: arregloValido },
            type: 'POST',
            success: function (response) {
                if (response == 'correcto') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Orden Correcta',
                        text: 'Orden Registrada',
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
                        title: 'Orden Incorrecta',
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
                    title: 'No se pudo registrar por error',
                    text: thrownError,
                });
            },
        });

    }
});

function mensajeAdvertencia(titulo, texto) {
    Swal.fire({
        icon: 'warning',
        title: titulo,
        text: texto,
        showConfirmButton: false,
        timer: 1800
    });
}

function mensajeError(titulo, texto, elemen) {
    Swal.fire({
        icon: 'error',
        title: titulo,
        text: texto,
    }).then((result) => {
        if (result.isConfirmed) {
            $(elemen).val('');
        }
    });
}

function limpiar() {
    location.reload();
}
