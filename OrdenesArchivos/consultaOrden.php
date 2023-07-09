<!-- Incluir menu lateral -->
<?php
include "../Layout/navMenu2.php";
?>

<!DOCTYPE html>
<html lang="es">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/movimientos/Orden/ConsultaOrden.css"> <!-- estilo principal -->
    <link rel="stylesheet" href="../css/movimientos/Orden/orden.css">
    <script src="https://kit.fontawesome.com/c65c1f4f0a.js" crossorigin="anonymous"></script> <!-- iconos -->
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css">

    <!-- js de tabla  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <title>APEJAL-Consulta Ordenes</title>
</head>

<body>
<section class="titulo">
        <div>
            <h1>Consulta de Ordenes</h1>
        </div>
        <div>
            <a href="./ReporteOrden.php">Reporte PDF</a>
        </div>
    </section>

    <section class="filtro consultaOrden">
        <div class="filtro-form">
            <form class="row g-6 container-fluid" id="frmConsulta" method="POST"
                action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return 0"
                style="justify-content:center;">

                <div class="col-sm-3">
                    <label for="nomProdu" class="form-label" id="tituloProdu">Nombre de Productor</label>
                    <select name="nomProdu" id="nomProdu" class="form-select" >
                        <option hidden>Selecciona un productor </option>
                    </select>
                </div>

                <div class="col-sm-2">
                    <div>
                        <label for="fechaInicio" class="form-label">Fecha Inicio</label>
                        <input id="fechaInicio" class="form-control" type="date" required />
                    </div>
                </div>

                <div class="col-sm-2">
                    <div>
                        <label for="fechafin" class="form-label">Fecha Fin</label>
                        <input id="fechafin" class="form-control" type="date" required />
                    </div>
                </div>

                <div class="col-sm-3 button-buscar"> <!--Agrega el detalle a la tabla-->
                    <div class="">
                        <button id="aceptar" type="button" class="btn btn-outline-dark" name="Aceptar">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
            </form>
        </div>
    </section>

    <section class="Orden-tabla consultaOrden">
        <h3>Ordenes</h3>
        <div class="form-Orden-table">
            <table class="table table-striped" id="orden">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Distribuidor</th>
                        <th scope="col">Productor</th>
                        <th scope="col">Factura</th>
                        <th scope="col">Archivo Factura</th>
                        <th scope="col">Cédula Receta</th>
                        <th scope="col">Archivo Receta</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Mostrar detalle</th>
                        <!-- aqui agregamos el icono y funcion de eliminar por si se equivoca en algo -->
                    </tr>
                </thead>
                <tbody id="bodyTabla1">

                </tbody>
            </table>
        </div>
    </section>
    <!-- Linea para separar el detalle -->
    <!-- <div>
        <hr class="divider">
    </div> -->

    <section class="detalle-tabla consultaOrden">
        <h3>Detalle Orden</h3>
        <div class="form-Detalle-table">
            <table class="table table-striped" id="detalle">
                <thead>
                    <tr>
                        <th scope="col">Número de Orden</th>
                        <th scope="col">Número Consecutivo</th>
                        <th scope="col">Tipo Químico</th>
                        <th scope="col">Tipo Envase</th>
                        <th scope="col">Color</th>
                        <th scope="col">Piezas</th>
                        <!-- aqui agregamos el icono y funcion de eliminar por si se equivoca en algo -->
                    </tr>
                </thead>
                <tbody id="bodyTabla2">

                </tbody>
            </table>
        </div>
    </section>


    <script type="text/javascript" src="../jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../datatables.min.js"></script>
    <script type="text/javascript" src="../tablas.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- funciones de la consulta -->
    <script type="text/javascript" src="./FuncionesJS/consultaFunciones.js"></script>
    <script src="../Layout/menujs.js"></script>

</body>

</html>