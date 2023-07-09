$(document).ready(function () {
    const nombreProdu = document.getElementById("nomProdu");
    añadirProductores(nombreProdu); //Funcion que carga la combo de productores

    mostrarOrden("", "", "");  //Función que se encarga de llenar el datatable
});

//Función jQuery  que se ejecuta cuando das clic al botón
$('#aceptar').click(function () {
    let fechaIni = document.getElementById('fechaInicio').value;
    let fechaFin = document.getElementById('fechafin').value;
    let idProd = document.getElementById('nomProdu').value;
    if (idProd == "Selecciona un productor") {
        mostrarOrden(fechaIni, fechaFin, "");
    } else
        mostrarOrden(fechaIni, fechaFin, idProd);
});

function generarTabla(fechaI, fechaF, idProdud) {
    let tablaOrden = $('#orden').DataTable({
        destroy: true,
        scrollX: true,
        scrollCollapse: true,
        processing: true,
        ajax: {
            "method": "POST",
            "url": "Peticiones/obtenerOrden.php",
            "data": { 'FI': fechaI, 'FF': fechaF, 'IdProdu': idProdud },
            "error": function (res) {
                console.log(res);
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
            { data: "IdOrden" },
            { data: "Distribuidor" },
            { data: "Productor" },
            { data: "NumFactura" },
            {
                data: "Factura",       //Aqui esta el archivo factura
                render: function (data, type, row) {
                    if (data == "Faltante" || data == "") {
                        return "<button class='archivo-btn'><img  src='../Recursos/Iconos/Ordenes32NoEncontrado.svg' alt='No hay archivo' ></button>";
                    } else
                        return "<a href='" + data + "' target='_blank' class='archivo-btn'><img  src='../Recursos/Iconos/Ordenes32.svg' alt='Abrir archivo' ></a>";
                }
            },
            { data: "NumReceta" },
            {
                data: "Receta",         //Aqui esta el archivo recteta
                render: function (data, type, row) {
                    if (data == "Faltante" || data == "") {
                        return "<button class='archivo-btn'><img  src='../Recursos/Iconos/Ordenes32NoEncontrado.svg' alt='No hay archivo' ></button>";
                    } else
                        return "<a href='" + data + "' target='_blank' class='archivo-btn'><img  src='../Recursos/Iconos/Ordenes32.svg' alt='Abrir archivo' ></a>";
                }
            },
            { data: "Fecha" },
            { defaultContent: "<button class='detalle-btn detalle'><img src='../Recursos/Iconos/detalle.svg' alt='Abrir detalle'></button>" },
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json'
        }
    });

    // $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
    //     console.log(message);
    // };

    //Evento que muestra el detalle cuando se da clic al botón de mostrar
    $("#orden tbody").on('click', 'button.detalle', function () {
        var datosFila = tablaOrden.row($(this).parents('tr')).data();
        if (datosFila != undefined) {
            mostrarDetalle(datosFila);
            console.log(datosFila);
        }

    });

    //Evento que permite editar cuando se da clic al botón de editar 
    $("#orden tbody").on('click', 'button.editar', function () {
        var datosFila = tablaOrden.row($(this).parents('tr')).data();
        if (datosFila != undefined) {
            editar(datosFila);
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

function mostrarOrden(fechaI, fechaF, idProdud) {
    $.ajax({
        type: 'POST',
        url: '../validacionesMovimientos.php',
        data: { 'FI': fechaI, 'FF': fechaF, 'IdTipo': "", 'IdProdu': idProdud, 'movi': 'ordenes' },
        success: function (res) {
            let datos = JSON.parse(res);//Trae los datos en formato json y los pasa a objeto
            let opc = datos.mensaje;

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
                //Mensaje de Consulta sin datos
                case "NoHayDatos":
                    mensajeError('No hay datos', "Actualmente no hay registros");
                    break;
                case "ProductorNoHayDatos":
                    mensajeError('No hay datos', "Inténtelo de nuevo");
                    break;
                case "DistribuidorNoHayDatos":
                    mensajeError('No hay datos', "De ese distribuidor");
                    break;
                //Consultas admin
                case "ConsultaGeneral":
                    console.log("ConsultaGeneral");
                    generarTabla('', '', '');
                    break;
                case "ConsultaXFechaYProduct":
                    console.log("ConsultaXFechaYProduct");
                    $('#detalle tbody').children().remove();
                    generarTabla(fechaI, fechaF, idProdud)
                    break;
                case "ConsultaXProductor":
                    console.log("ConsultaXProductor");
                    $('#detalle tbody').children().remove();
                    generarTabla('', '', idProdud)
                    break;
                case "ConsultaXFecha":
                    console.log("ConsultaXFecha");
                    $('#detalle tbody').children().remove();
                    generarTabla(fechaI, fechaF, '')
                    break;
                //Productor
                case "ProductorConsultaGeneral":
                    console.log("ProductorConsultaGeneral");
                    $('#tituloProdu').hide();
                    $('#nomProdu').hide();
                    generarTabla("", "", datos.data)
                    break;
                case "ProductorConsultaXFecha":
                    console.log("ProductorConsultaXFecha");
                    $('#detalle tbody').children().remove();
                    generarTabla(fechaI, fechaF, datos.data)
                    break;
                //Distribuidor  
                case "DistribuidorConsultaGeneral":
                    console.log("DistribuidorConsultaGeneral");
                    $('#detalle tbody').children().remove();
                    generarTabla("", "", "")
                    break;
                case "DistribuidorConsultaXFecha":
                    console.log("DistribuidorConsultaXFecha");
                    $('#detalle tbody').children().remove();
                    generarTabla(fechaI, fechaF, "")
                    break;
                case "DistribuidorConsultaXProductor":
                    console.log("DistribuidorConsultaXProductor");
                    $('#detalle tbody').children().remove();
                    generarTabla("", "", idProdud)
                    break;
                case "DistribuidorConsultaXFechaYProduct":
                    console.log("DistribuidorConsultaXFechaYProduct");
                    $('#detalle tbody').children().remove();
                    generarTabla(fechaI, fechaF, idProdud)
                    break;
                default:

                    break;
            }
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
            "data": { 'IdOrden': datosFila.IdOrden } //Se le manda el IdOrden dependiendo de la fila presionada
        },
        columns: [
            { data: "IdOrden" },
            { data: "Consecutivo" },
            { data: "IdTipoQuimico" },
            { data: "TipoEnvase" },
            { data: "Color" },
            { data: "CantidadPiezas" },
        ]
    });

}

function editar(datosFila) {
    console.log(datosFila);
    $('.titulo h1').text("Editar registro");
    $('.consultaOrden').remove();
    $('.titulo').after(`<section class="form-Principal">
    <form class="row g-4 container-fluid" id="frmOrden" method="POST"
         enctype="multipart/form-data" action="actualizarOrden.php">

        <div class="form-Principal-encabezado">
            <div class="form-Principal-encabezado-numero">
                <label for="" id="numOrden" data-numOrden="">Numero de orden: ${datosFila.IdOrden}</label> 
            </div>
            <div>
                <label for="startDate">Seleccionar Fecha: &nbsp;</label>
            </div>

            <div class="col-sm-2">
                <input id="fecha" class="form-control" type="date" value="${datosFila.Fecha}" required/>
            </div>
        </div>

        <div class="col-sm-4" id="nom">
            <label for="OrdNombre" class="form-label">Nombre del distribuidor</label>
            <!-- debe de cargar dependiendo el inicio de seccion  -->               
            <input disabled type="text" id="nomDistri" name="nomDistribuidor" class="form-control" maxlength="30"
                required placeholder="${datosFila.Distribuidor}" data-idDistribuidor="">
        </div>

        <div class="col-sm-4">
            <label for="OrdFact" class="form-label">Factura</label>
            <input type="text" id="factOrden" name="facturaOrden" class="form-control" maxlength="30"
                pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" placeholder="${datosFila.NumFactura}">
        </div>

        <div class="col-sm-4">
            <label for="formFileMultiple" class="form-label">Subir Factura</label>
            <input class="form-control" type="file" id="archFac" name="archFac" multiple>
        </div>

        <div class="col-sm-4">
            <div>
                <label for="inestado" class="form-label">Nombre de Productor</label>
                <select name="nomProdu" id="nomProdu" class="form-select" required>
                    <option hidden>Selecciona un productor registrado</option>
                </select>
            </div>
        </div>

        <div class="col-sm-4">
            <label for="OrdFact" class="form-label">Cédula de receta</label>
            <input type="text" id="cedReceta" name="facturaOrden" class="form-control" maxlength="30"
                pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" placeholder="${datosFila.NumReceta}">
        </div>

        <div class="col-sm-4">
            <label for="formFileMultiple" class="form-label">Subir Receta</label>
            <input class="form-control" type="file" id="archReceta" name="archRece" multiple>
        </div>
        <div class="col-sm-4">
            <button type="submit" class="btn btn-success button-actualizar" id="actualizar" name="actualizar" form="frmOrden">Guardar</button>
        </div>
    </form>
</section>
<script type="text/javascript" src="btn_Registrar.js"></script>`);

    const nombreProdu = document.getElementById("nomProdu");
    const orden = document.getElementById("numOrden");
    const distri = document.getElementById("nomDistri");

    orden.dataset.numOrden = "" + datosFila.IdOrden;
    distri.dataset.idDistribuidor = "" + datosFila.Distribuidor; //Asigna el id del distribuidor al dataset
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