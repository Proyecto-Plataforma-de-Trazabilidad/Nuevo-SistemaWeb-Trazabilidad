$(document).ready(function () {

    mostrarExtraviado("", "");
});

//Función jQuery  que se ejecuta cuando das clic al botón
$('#aceptar').click(function () {
    let fechaIni = document.getElementById('fechaInicio').value;
    let fechaFin = document.getElementById('fechafin').value;

    mostrarExtraviado(fechaIni, fechaFin);
});

function mensajeError(titulo, texto) {
    Swal.fire({
        icon: 'error',
        title: titulo,
        text: texto,
    }).then((result) => {
        if (result.isConfirmed) {
            console.log("Fallo");
        }
    });
}

function generarTabla(opc, fechaI, fechaF, idProdud) {

    $('#extraviados').DataTable({
        destroy: true,
        scrollX: true,
        scrollCollapse: true,
        processing: true,
        deferRender: true,
        ajax: {
            "method": "POST",
            "url": "peticiones/obtenerExtraviado.php",
            "data": { 'Opcion': opc, 'FI': fechaI, 'FF': fechaF, 'IdProdu': idProdud },
            "error": function (res) {
                if (res.responseText == "Error") {
                    console.log(res.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'No hay datos disponibles',
                        text: 'No se encontraron registros del distribuidor',
                    });
                } else
                    return res.responseText;
            }
        },
        columns: [
            { data: "IdExtraviados" },
            { data: "Nombre" },
            { data: "TipoEnvaseVacio" },
            { data: "CantidadPiezas" },
            { data: "Aclaracion" },
            { data: "fecha" },
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json'
        }
    });

}

function mostrarExtraviado(fechaI, fechaF) {
    $.ajax({
        type: 'POST',
        url: '../validacionesMovimientos.php',
        data: { 'FI': fechaI, 'FF': fechaF, 'IdProdu': '', 'IdTipo': '', 'movi': 'extraviados' },
        success: function (res) {
            let datos = JSON.parse(res);//Trae los datos en formato json y los pasa a objeto
            let opc = datos.mensaje;
            //console.log(opc);
            switch (opc) {
                //Mensajes de error
                case "UsuarioNoPermitido":
                    mensajeError('Usuario no permitido', "Ingrese con una cuenta con permiso");
                    break;
                case "FechaNoValida":
                    mensajeError('Fecha no valida', "fallo");
                    break;
                case "FechaMayor":
                    mensajeError('Fecha inicio mayor', "fallo");
                    break;
                case "FechasIguales":
                    mensajeError('Fechas iguales', "fallo");
                    break;
                //Mensaje de Consulta sin datos
                case "NoHayDatos":
                    mensajeError('No hay datos', "Actualmente no hay registros");
                    break;
                case "ProductorNoHayDatos":
                    mensajeError('No hay datos', "De ese productor");
                    break;
                //Consultas admin
                case "ConsultaGeneral":
                    generarTabla("ConsultaGeneral", fechaI, fechaF, "");
                    break;
                case "ConsultaXFecha":
                    generarTabla("ConsultaXFecha", fechaI, fechaF, "");
                    break;

                //Consultas del productor
                case "ProductorConsultaGeneral":
                    generarTabla("ProductorConsultaGeneral", fechaI, fechaF, datos.data);
                    break;
                case "ProductorConsultaXFecha":
                    generarTabla("ProductorConsultaXFecha", fechaI, fechaF, datos.data);
                    break;
                default:

                    break;
            }
        }
    });
}


