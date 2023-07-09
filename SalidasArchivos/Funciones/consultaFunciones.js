$(document).ready(function () {

    mostrarEntrega("", "", "");  //Función que se encarga de llenar el datatable
});

$('#aceptar').click(function () {
    let fechaIni = document.getElementById('fechaInicio').value;
    let fechaFin = document.getElementById('fechafin').value;
    let tipoRecol = document.getElementById('tipoRecol').value;

    if (tipoRecol == "Selecciona un recolector") //Verifica si nos se selecciona ninguna combo
        mostrarEntrega(fechaIni, fechaFin, "");
    else
        mostrarEntrega(fechaIni, fechaFin, tipoRecol);
});

function generarTabla(opc, fechaI, fechaF, tipoRecolec) {
    let tablaEntrega = $('#tableSalidas').DataTable({
        destroy: true,
        scrollX: true,
        scrollCollapse: true,
        processing: true,
        deferRender: true,
        ajax: {
            "method": "POST",
            "url": "Peticiones/obtenerSalida.php",
            "data": { 'Opcion': opc, 'FI': fechaI, 'FF': fechaF, 'TipoRecol': tipoRecolec },
            "error": function (res) {
                if (res.responseText) {
                    console.log(res.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Ocurrió un error inesperado',
                        text: 'Intente recargar la pagina',
                    });
                } else
                    return res.responseText;
            }
        },
        columns: [
            { data: "IdSalida" },
            { data: "Origen" },
            { data: "Nombre" },
            { data: "Responsable" },
            { data: "Cantidad" },
            { data: "fecha" },
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json'
        }
    });

}

function generarTablaV2(opc, fechaI, fechaF) {
    let tablaEntrega = $('#tableSalidas').DataTable({
        destroy: true,
        scrollX: true,
        scrollCollapse: true,
        processing: true,
        deferRender: true,
        ajax: {
            "method": "POST",
            "url": "Peticiones/obtenerSalida.php",
            "data": { 'Opcion2': opc, 'FI': fechaI, 'FF': fechaF },
            "error": function (res) {
                if (res.responseText) {
                    console.log(res.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Ocurrió un error inesperado',
                        text: 'Intente recargar la pagina',
                    });
                } else
                    return res.responseText;
            }
        },
        columns: [
            { data: "IdSalida" },
            { data: "Origen" },
            { data: "Responsable" },
            { data: "Cantidad" },
            { data: "fecha" },
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json'
        }
    });

}

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

function mostrarEntrega(fechaI, fechaF, tipoRecol) {
    $.ajax({
        type: 'POST',
        url: '../validacionesMovimientos.php',
        data: { 'FI': fechaI, 'FF': fechaF, 'IdProdu': "", 'IdTipo': tipoRecol, 'movi': 'salidas' },
        success: function (res) {
            let datos = JSON.parse(res);//Trae los datos en formato json y los pasa a objeto
            let opc = datos.mensaje;
            console.log(opc);
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
                case "DistribuidorNoHayDatos":
                    mensajeError('No hay datos', "De ese distribuidor");
                    break;
                case "MunicipioNoHayDatos":
                    mensajeError('No hay datos', "De ese municipio");
                    break;
                case "ERPNoHayDatos":
                    mensajeError('No hay datos', "De esa empresa recolectora");
                    break;
                //Consultas admin
                case "ConsultaGeneral":
                    console.log("ConsultaGeneral");
                    generarTabla(opc, fechaI, fechaF, tipoRecol);
                    break;
                case "ConsultaXFecha":
                    console.log("ConsultaXFecha");
                    generarTabla(opc, fechaI, fechaF, tipoRecol);
                    break;
                case "ConsultaXTipos":
                    console.log("ConsultaXTipos");
                    generarTabla(opc, fechaI, fechaF, tipoRecol);
                    break;
                case "ConsultaXTiposYFecha":
                    console.log("ConsultaXTiposYFecha");
                    generarTabla(opc, fechaI, fechaF, tipoRecol);
                    break;

                default:
                    console.log(opc);
                    generarTablaV2(opc, fechaI, fechaF);

                    break;
            }
        }
    });

}