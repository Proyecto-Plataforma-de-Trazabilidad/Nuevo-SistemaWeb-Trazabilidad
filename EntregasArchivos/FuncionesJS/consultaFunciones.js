$(document).ready(function () {
    const nombreProdu = document.getElementById("nomProdu");
    añadirProductores(nombreProdu); //Funcion que carga la combo de productores

    //mostrarEntrega("", "", "", "");  //Función que se encarga de llenar el datatable
});

//Función jQuery  que se ejecuta cuando das clic al botón
$('#aceptar').click(function () {
    let fechaIni = document.getElementById('fechaInicio').value;
    let fechaFin = document.getElementById('fechafin').value;
    let idProd = document.getElementById('nomProdu').value;
    let tipoRecol = document.getElementById('tipoRecol').value;

    if (idProd == "Selecciona un productor" && tipoRecol == "Selecciona un recolector") //Verifica si nos se selecciona ninguna combo
        mostrarEntrega(fechaIni, fechaFin, "", "");
    else if (idProd == "Selecciona un productor" && tipoRecol != "Selecciona un recolector") //Limpia si se selecciono solo tipo
        mostrarEntrega(fechaIni, fechaFin, "", tipoRecol)
    else if (tipoRecol == "Selecciona un recolector" && idProd != "Selecciona un productor") //Limpia si se selecciono solo productor
        mostrarEntrega(fechaIni, fechaFin, idProd, "");
    else
        mostrarEntrega(fechaIni, fechaFin, idProd, tipoRecol);
});


function mostrarEntrega(fechaI, fechaF, idProdud, tipoRecol) {
    $.ajax({
        type: 'POST',
        url: '../validacionesMovimientos.php',
        data: { 'FI': fechaI, 'FF': fechaF, 'IdProdu': idProdud, 'IdTipo': tipoRecol, 'movi': 'entregas' },
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
                    generarTabla("ConsultaGeneral", fechaI, fechaF, idProdud, tipoRecol);
                    $('#detalle tbody').children().remove();
                    break;
                case "ConsultaXFecha":
                    console.log("ConsultaXFecha");
                    generarTabla("ConsultaXFecha", fechaI, fechaF, idProdud, tipoRecol);
                    $('#detalle tbody').children().remove();
                    break;
                case "ConsultaXProductor":
                    console.log("ConsultaXProductor");
                    generarTabla("ConsultaXProductor", fechaI, fechaF, idProdud, tipoRecol);
                    $('#detalle tbody').children().remove();
                    break;
                case "ConsultaXFechaYProduct":
                    console.log("ConsultaXFechaYProduct");
                    generarTabla("ConsultaXFechaYProduct", fechaI, fechaF, idProdud, tipoRecol);
                    $('#detalle tbody').children().remove();
                    break;
                case "ConsultaXTipos":
                    console.log("ConsultaXTipos");
                    generarTabla("ConsultaXTipos", fechaI, fechaF, idProdud, tipoRecol);
                    $('#detalle tbody').children().remove();
                    break;
                case "ConsultaXTiposYFecha":
                    console.log("ConsultaXTiposYFecha");
                    generarTabla("ConsultaXTiposYFecha", fechaI, fechaF, idProdud, tipoRecol);
                    $('#detalle tbody').children().remove();
                    break;
                case "ConsultaXTiposProductor":
                    console.log("ConsultaXTiposProductor");
                    generarTabla("ConsultaXTiposProductor", fechaI, fechaF, idProdud, tipoRecol);
                    $('#detalle tbody').children().remove();
                    break;
                case "ConsultaXTiposYFechaYProduct":
                    console.log("ConsultaXTiposYFechaYProduct");
                    generarTabla("ConsultaXTiposYFechaYProduct", fechaI, fechaF, idProdud, tipoRecol);
                    $('#detalle tbody').children().remove();
                    break;
                //Consultas del productor
                case "ProductorConsultaGeneral":
                    console.log("ProductorConsultaGeneral");
                    generarTabla("ProductorConsultaGeneral", fechaI, fechaF, datos.data, tipoRecol);
                    $('#detalle tbody').children().remove();
                    break;
                case "ProductorConsultaXFecha":
                    console.log("ProductorConsultaXFecha");
                    generarTabla("ProductorConsultaXFecha", fechaI, fechaF, datos.data, tipoRecol);
                    $('#detalle tbody').children().remove();
                    break;
                default:
                    console.log(opc);
                    generarTablaV2(opc, fechaI, fechaF, idProdud, tipoRecol);
                    $('#detalle tbody').children().remove();
                    break;
            }
        }
    });

}

function generarTabla(opc, fechaI, fechaF, idProdud, tipoRecolec) {
    let tablaEntrega = $('#entrega').DataTable({
        destroy: true,
        scrollX: true,
        scrollCollapse: true,
        processing: true,
        deferRender: true,
        ajax: {
            "method": "POST",
            "url": "Peticiones/obtenerEntrega.php",
            "data": { 'Opcion': opc, 'FI': fechaI, 'FF': fechaF, 'IdProdu': idProdud, 'TipoRecol': tipoRecolec },
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
            { data: "IdEntrega" },
            { data: "TipoRecolector" },
            { data: "NomRecolector" },
            { data: "Productor" },
            {
                data: "Recibo",       //Aquí esta el recibo
                render: function (data, type, row) {
                    if (data == "Faltante" || data == "") {
                        return "<button class='archivo-btn'><img  src='../Recursos/Iconos/Ordenes32NoEncontrado.svg' alt='No hay archivo' ></button>";
                    } else
                        return "<a href='" + data + "' target='_blank' class='archivo-btn'><img  src='../Recursos/Iconos/Ordenes32.svg' alt='Abrir archivo' ></a>";
                }
            },
            { data: "ResponsableEntrega" },
            { data: "ResponsableRecepcion" },
            { data: "fecha" },
            { defaultContent: "<button class='detalle-btn detalle'><img src='../Recursos/Iconos/detalle.svg' alt='Abrir detalle'></button>" },
            //{defaultContent: "<button class='detalle-btn editar'><img src='../Recursos/Iconos/editar.svg' alt='Editar'></button>"}

        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json'
        }
    });

    //Evento que muestra el detalle cuando se da clic al botón de mostrar
    $("#entrega tbody").on('click', 'button.detalle', function () {
        var datosFila = tablaEntrega.row($(this).parents('tr')).data();
        if (datosFila != undefined) {
            mostrarDetalle(datosFila);
            console.log(datosFila);
        }
    });

    //Evento que permite editar cuando se da clic al botón de editar 
    $("#entrega tbody").on('click', 'button.editar', function () {
        var datosFila = tablaEntrega.row($(this).parents('tr')).data();
        if (datosFila != undefined) {
            editar(datosFila);
        }
    });
}

function generarTablaV2(opc, fechaI, fechaF, idProdud, tipoRecolec) {
    let tablaEntrega = $('#entrega').DataTable({
        destroy: true,
        scrollX: true,
        scrollCollapse: true,
        processing: true,
        ajax: {
            "method": "POST",
            "url": "Peticiones/obtenerEntrega.php",
            "data": { 'Opcion2': opc, 'FI': fechaI, 'FF': fechaF, 'IdProdu': idProdud, 'TipoRecol': tipoRecolec },
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
            { data: "IdEntrega" },
            { data: "Productor" },
            {
                data: "Recibo",       //Aquí esta el recibo
                render: function (data, type, row) {
                    if (data == "Faltante" || data == "") {
                        return "<button class='archivo-btn'><img  src='../Recursos/Iconos/Ordenes32NoEncontrado.svg' alt='No hay archivo' ></button>";
                    } else
                        return "<a href='" + data + "' target='_blank' class='archivo-btn'><img  src='../Recursos/Iconos/Ordenes32.svg' alt='Abrir archivo' ></a>";
                }
            },
            { data: "ResponsableEntrega" },
            { data: "ResponsableRecepcion" },
            { data: "fecha" },
            { defaultContent: "<button class='detalle-btn detalle'><img src='../Recursos/Iconos/detalle.svg' alt='Abrir detalle'></button>" },
            //{defaultContent: "<button class='detalle-btn editar'><img src='../Recursos/Iconos/editar.svg' alt='Editar'></button>"}

        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json'
        }
    });

    //Evento que muestra el detalle cuando se da clic al botón de mostrar
    $("#entrega tbody").on('click', 'button.detalle', function () {
        var datosFila = tablaEntrega.row($(this).parents('tr')).data();
        if (datosFila != undefined) {
            mostrarDetalle(datosFila);
            console.log(datosFila);
        }

    });

    //Evento que permite editar cuando se da clic al botón de editar 
    $("#entrega tbody").on('click', 'button.editar', function () {
        var datosFila = tablaEntrega.row($(this).parents('tr')).data();
        if (datosFila != undefined) {
            editar(datosFila);
        }

    });
}

function mostrarDetalle(datosFila) {

    //Llenar tabla detalle 
    $('#detalle').DataTable({
        destroy: true,
        ajax: {
            "method": "POST",
            "url": "Peticiones/obtenerDetalle.php",
            "data": { 'IdEntrega': datosFila.IdEntrega } //Se le manda el IdEntrega dependiendo de la fila presionada
        },
        columns: [
            { data: "IdEntrega" },
            { data: "Consecutivo" },
            { data: "TipoEnvaseVacio" },
            { data: "CantidadPiezas" },
            { data: "Peso" },
            { data: "Observaciones" },
        ]
    });

}

function editar(datosFila) {
    console.log(datosFila);
    $('.titulo h1').text("Editar registro");
    $('.consultaEntrega').remove();
    $('.titulo').after(`<section class="form-Principal">
    <form class="row g-4 container-fluid" id="frmEntrega" method="POST" 
        action="EntregasArchivos/insertarArchivo.php" enctype="multipart/form-data">

        <div class="form-Principal-encabezado">
            <div class="form-Principal-encabezado-numero">
                <label id="numEntrega" data-numEntrega="">Número de entrega: ${datosFila.IdEntrega} </label>
            </div>
            <div>
                <label for="fecha">Seleccionar Fecha: &nbsp;</label>
            </div>

            <div class="col-sm-2">
                <input id="fecha" class="form-control" type="date" value="${datosFila.fecha}" required/>
            </div>
        </div>

        <div class="col-sm-4">
            <label for="tipoRecol" class="form-label">Tipo de recolector</label>
            <!-- debe de cargar dependiendo el inicio de seccion  -->
            <input disabled type="text" id="tipoRecol" name="tipoDistribuidor" class="form-control" maxlength="30"
                required placeholder="${datosFila.TipoRecolector}" data-tipoRecolector="">
        </div>

        <div class="col-sm-4">
            <label for="nomRecol" class="form-label">Nombre de recolector</label>
            <!-- debe de cargar dependiendo el inicio de seccion  -->
            <input disabled type="text" id="nomRecol" name="nomRecol" class="form-control" maxlength="30"
                required placeholder="${datosFila.NomRecolector}" data-nomRecolector="">
        </div>

        <div class="col-sm-4">
            <label for="formFileMultiple" class="form-label">Subir recibo de entrega <small>(con
                    firmas)</small></label>
            <input class="form-control" type="file" id="recibo" name="archRecibo" multiple>
        </div> 

        <div class="col-sm-4">
            <div>
                <label for="nomProdu" class="form-label">Nombre de Productor</label>
                <select name="nomProdu" id="nomProdu" class="form-select" required>
                    <option hidden>Selecciona un productor registrado</option>
                </select>
            </div>
        </div>

        <div class="col-sm-4">
            <label for="nomResEntrega" class="form-label">Nombre del responsable de entrega</label>
            <input type="text" id="nomResEntrega" name="nomResEntrega" class="form-control" maxlength="30"
                pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" placeholder="${datosFila.ResponsableEntrega}" required>
        </div>

        <div class="col-sm-4">
            <label for="nomResRecep" class="form-label">Nombre del responsable de recepción</label>
            <input type="text" id="nomResRecep" name="nomResRecep" class="form-control" maxlength="30"
                pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" placeholder="${datosFila.ResponsableRecepcion}" required>
        </div>
        <div class="col-sm-4">
            <button type="submit" class="btn btn-success button-actualizar" id="actualizar" name="actualizar" form="frmEntrega">Guardar</button>
        </div>
    </form>
    </section>`);

    const nombreProdu = document.getElementById("nomProdu");
    añadirProductores(nombreProdu);
}

function añadirProductores(comboProduc) {
    $.ajax({
        url: 'Peticiones/obtenerCampos.php',
        type: 'GET',
        success: function (res) {
            let datos = JSON.parse(res);//Trae los datos en formato json y los pasa a objeto
            if (datos.produtores == "No hay productores") {
                mensajeError('No hay ningún productor registrado', "Por favor vaya a registrar uno");
            } else
                datos.produtores.map(productor => {
                    comboProduc.insertAdjacentHTML('beforeend', `<option value="${productor.IdProductor}">${productor.Nombre}</option>`);//Rellena la combo proveedores    
                });
        }
    })
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