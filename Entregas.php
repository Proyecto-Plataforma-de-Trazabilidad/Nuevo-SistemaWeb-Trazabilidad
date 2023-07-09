<!-- Incluir menu lateral -->
<?php
include "Layout/navMenu.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/movimientos/Entregas/entregas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css">
    <script src="https://kit.fontawesome.com/c65c1f4f0a.js" crossorigin="anonymous"></script> <!-- iconos -->
    
</head>

<body>

    <section class="titulo">
        <div>
            <h1>Entregas</h1>
        </div>
        <div>            
            <button onclick="window.location.href='EntregasArchivos/consultaEntrega.php'" type="button" class="btn btn-outline-secondary"><i class="fa-solid fa-magnifying-glass"></i> &nbsp;Consultar</button>
        </div>
    </section>

    <section class="form-Principal">
        <form class="row g-4 container-fluid" id="frmEntrega" method="POST" 
            action="EntregasArchivos/insertarArchivo.php" enctype="multipart/form-data">

            <div class="form-Principal-encabezado">
                <div class="form-Principal-encabezado-numero">
                    <label id="numEntrega" data-numEntrega="">Número de entrega: 000 </label>
                </div>
                <div>
                    <label for="fecha">Seleccionar Fecha: &nbsp;</label>
                </div>

                <div class="col-sm-2">
                    <input id="fecha" class="form-control" type="date" required/>
                </div>
            </div>

            <div class="col-sm-4">
                <label for="tipoRecol" class="form-label">Tipo de recolector</label>
                <!-- debe de cargar dependiendo el inicio de seccion  -->
                <input disabled type="text" id="tipoRecol" name="tipoDistribuidor" class="form-control" maxlength="30"
                    required placeholder="Empresa, Distribuidor, Municipio" data-tipoRecolector="">
            </div>

            <div class="col-sm-4">
                <label for="nomRecol" class="form-label">Nombre de recolector</label>
                <!-- debe de cargar dependiendo el inicio de seccion  -->
                <input disabled type="text" id="nomRecol" name="nomRecol" class="form-control" maxlength="30"
                    required placeholder="Nombre de Empresa, Distribuidor, Municipio" data-nomRecolector="">
            </div>

            <div class="col-sm-4">
                <label for="" class="form-label">Contenedor</label>
                <select name="contene" id="contene" class="form-select" >
                    <option hidden>Selecciona un contenedor</option>
                </select>
            </div>

            <div class="col-sm-4">
                <label for="formFileMultiple" class="form-label">Subir recibo de entrega <small>(con
                        firmas)</small></label>
                <input class="form-control" type="file" id="recibo" name="archRecibo" multiple disabled>
            </div> 

            <div class="col-sm-4">
                <div>
                    <label for="nomProdu" class="form-label">Nombre de Productor</label>
                    <select name="nomProdu" id="nomProdu" class="form-select" >
                        <option hidden>Selecciona un productor registrado</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <label for="nomResEntrega" class="form-label">Nombre del responsable de entrega</label>
                <input type="text" id="nomResEntrega" name="nomResEntrega" class="form-control" maxlength="30"
                    pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" placeholder="Escribe el nombre" required>
            </div>

            <div class="col-sm-4">
                <label for="nomResRecep" class="form-label">Nombre del responsable de recepción</label>
                <input type="text" id="nomResRecep" name="nomResRecep" class="form-control" maxlength="30"
                    pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" placeholder="Escribe el nombre" required>
            </div>
        </form>
    </section>

    <!-- Linea para separar el detalle -->
    <div>
        <hr class="divider">
        <label class="divider-titulo" id="numDetalle" >Detalle de entrega: 001</label>
    </div>

    <section class="form-Detalle">
        <form class="row g-4 container-fluid" id="frm" method="POST"
            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return 0">

            <div class="col-sm-4">
                <div>
                    <label for="tipoEnva" class="form-label">Tipo de Envase</label>
                    <select name="tipoEnva" id="tipoEnva" class="form-select" required>
                        <option hidden >Selecciona una opción</option>
                        <option value="Rígidos lavables">Rígidos lavables</option>
                        <option value="Rígidos no lavables">Rígidos no lavables</option>
                        <option value="Flexibles">Flexibles</option>
                        <option value="Tapas">Tapas</option>
                        <option value="Cubetas">Cubetas</option>
                        <option value="Cartón">Cartón</option>
                        <option value="Tambos">Tambos</option>
                        <option value="Metal">Metal</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <div>
                    <label for="cantiPza" class="form-label">Cantidad de piezas</label>
                    <input type="number" class="form-control" id="cantiPza" min="1" maxlength="10" name="cantiPza" required pattern="[1-9]\d*(\.\d+)?"
                        placeholder="Ingrese una cantidad">
                </div>
            </div>

            <div class="col-sm-4">
                <div>
                    <label for="peso" class="form-label">Peso <small>(Opcional)</small> </label>
                    <input type="number" class="form-control" id="peso" min="1" maxlength="10" name="peso" pattern="[1-9]\d*(\.\d+)?"
                        placeholder="Ingrese una cantidad">
                </div>
            </div>

            <div class="col-sm-4">
                <label for="observa" class="form-label">Observaciones</label>
                <textarea class="form-control" id="observa" rows="3" required
                    placeholder="Escribe una descripción"></textarea>
            </div>

            <div class="col-sm-2">
                <button type="button" id="aceptar" class="btn btn-primary button-aceptar"  name="Aceptar">Aceptar</button>
            </div>

            <div class="col-sm-6">
                <canvas id="myChart" width="100%" height="100px"></canvas>
            </div>
        </form>


        <div class="form-Detalle-table">

            <table class="table table-striped" id="detalle">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo Envase</th>
                        <th scope="col">Cantidad de piezas</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Eliminar</th>
                        <!-- aqui agregamos el icono y funcion de eliminar por si se equivoca en algo -->
                    </tr>
                </thead>
                <tbody id="bodyTabla">

                </tbody>
            </table>
            <label for="" class="form-Detalle-mensaje">Detalles de entregas</label>
            <div class="col align-self-center">
                <button type="button" id="generarPDF" class="btn btn-success button-registrar " name="Generar">Generar PDF</button>
                <button type="submit" id="registrar" class="btn btn-success button-registrar " name="Registrar" form="frmEntrega">Registrar</button>
            </div>
        </div>

    </section>
    
    <script>
        //fecha del sistema 
        const inputFecha= document.getElementById('fecha');
        const hoy = new Date().toISOString().slice(0,10);
        inputFecha.value=hoy;

        //Marca los combos como invalidos asta que se eliga una opcion
        $('#contene').get(0).setCustomValidity('Elija una opción');
        $('#nomProdu').get(0).setCustomValidity('Elija una opción');
        $('#tipoEnva').get(0).setCustomValidity('Elija una opción');

        //const contenedor = document.getElementById("contene");
        //console.log(contenedor.validity);

    </script>



    <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--Liberia delas graficas-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    <script type="text/javascript" src="./EntregasArchivos/FuncionesJS/llenarCampos.js"></script> <!-- scrip para llenar los campos del form  -->
    <script type="text/javascript" src="./EntregasArchivos/FuncionesJS/llenarDetalle.js"></script> <!-- scrip para llenar el detalle -->
    <script type="text/javascript" src="./EntregasArchivos/FuncionesJS/btnGenerarPDF.js"></script> <!-- scrip para lanzar el generador de PDF-->
    <script type="text/javascript" src="./EntregasArchivos/FuncionesJS/btnRegistrar.js"></script>   <!-- scrip para realizar el registro -->

    <script src="Layout/menujs.js"></script>


</body>

</html>