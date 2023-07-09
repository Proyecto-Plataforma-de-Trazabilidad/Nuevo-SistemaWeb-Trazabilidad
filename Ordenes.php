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
    <link rel="stylesheet" href="css/movimientos/Orden/orden.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css">
    <script src="https://kit.fontawesome.com/c65c1f4f0a.js" crossorigin="anonymous"></script> <!-- iconos -->

</head>

<body>
    <section class="titulo">
        <div>
            <h1>Orden de productos</h1>
        </div>
        <div>
            <button onclick="window.location.href='OrdenesArchivos/consultaOrden.php'" type="button"
                class="btn btn-outline-secondary"><i class="fa-solid fa-magnifying-glass"></i> &nbsp;Consultar</button>
        </div>
    </section>

    <section class="form-Principal">
        <form class="row g-4 container-fluid" id="frmOrden" method="POST" enctype="multipart/form-data"
            action="OrdenesArchivos/insertarArchivo.php">

            <div class="form-Principal-encabezado">
                <div class="form-Principal-encabezado-numero">
                    <label  id="numOrden" data-numOrden="">Numero de orden: </label>
                </div>
                <div>
                    <label for="fecha">Seleccionar Fecha: &nbsp;</label>
                </div>

                <div class="col-sm-2">
                    <input id="fecha" class="form-control" type="date" required />
                </div>
            </div>

            <div class="col-sm-4" id="nom">
                <label for="nomDistri" class="form-label">Nombre del distribuidor</label>
                <!-- debe de cargar dependiendo el inicio de seccion  -->
                <input disabled type="text" id="nomDistri" name="nomDistribuidor" class="form-control" maxlength="30"
                    required placeholder="Nombre del distribuidor" data-idDistribuidor=""> <!--Hay que cambiar esto -->
            </div>

            <div class="col-sm-4">
                <label for="factOrden" class="form-label">Factura</label>
                <input type="text" id="factOrden" name="facturaOrden" class="form-control" maxlength="30"
                    pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" required placeholder="Número de cédula">
            </div>

            <div class="col-sm-4">
                <label for="archFac" class="form-label">Subir Factura</label>
                <input class="form-control" type="file" id="archFac" name="archFac" multiple>
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
                <label for="cedReceta" class="form-label">Cédula de receta</label>
                <input type="text" id="cedReceta" name="facturaOrden" class="form-control" maxlength="30"
                    pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" placeholder="Número de cédula">
            </div>

            <div class="col-sm-4">
                <label for="archReceta" class="form-label">Subir Receta</label>
                <input class="form-control" type="file" id="archReceta" name="archRece" multiple>
            </div>
        </form>
    </section>

    <!-- Linea para separar el detalle -->
    <div>
        <hr class="divider">
        <label id="numDetalle" class="divider-titulo">Detalle de orden: 001</label>
    </div>

    <section class="form-Detalle">
        <form class="row g-4 container-fluid" id="frmDetalle" method="POST"
            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return 0">

            <div class="col-sm-4">
                <div>
                    <label for="tipoQuimi" class="form-label">Tipo de Químico</label>
                    <select name="inestado" id="tipoQuimi" class="form-select" required>
                        <option hidden>Selecciona un tipo</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <div>
                    <label for="tipoEnva" class="form-label">Tipo de Envase</label>
                    <select name="tipoEnva" id="tipoEnva" class="form-select" required>
                        <option hidden>Selecciona un tipo</option>
                        <option value="Rígidos lavables">Rígidos lavables</option>
                        <option value="Rígidos no lavables">Rígidos no lavables</option>
                        <option value="Flexibles">Flexibles</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <div>
                    <label for="color" class="form-label">Color</label>
                    <select name="inestado" id="color" class="form-select" required>
                        <option hidden>Selecciona un color</option>
                        <option value="Verde">Verde</option>
                        <option value="Azul">Azul</option>
                        <option value="Amarillo">Amarillo</option>
                        <option value="Rojo">Rojo</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="col-6">
                    <label for="cantiPza" class="form-label">Cantidad de piezas</label>
                    <input type="number" class="form-control" id="cantiPza" min="1" maxlength="10" name="incap" required pattern="[1-9]\d*(\.\d+)?"
                        placeholder="Ingrese la cantidad">
                </div>
            </div>

            <div class="col-sm-4"> <!--Agrega el detalle a la tabla-->
                <button id="aceptar" type="button" class="btn btn-primary button-aceptar"
                    name="Aceptar">Aceptar</button>
            </div>
        </form>


        <div class="form-Detalle-table">

            <table class="table table-striped" id="detalle">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo Químico</th>
                        <th scope="col">Tipo Envase</th>
                        <th scope="col">Color</th>
                        <th scope="col">Cantidad piezas</th>
                        <th scope="col">Eliminar</th>
                        <!-- aqui agregamos el icono y funcion de eliminar por si se equivoca en algo -->
                    </tr>
                </thead>
                <tbody id="bodyTabla">

                </tbody>
            </table>
            <label for="" class="form-Detalle-mensaje">Detalles de orden</label>
            <button type="submit" class="btn btn-success button-registrar" id="registrar" name="Registrar"
                form="frmOrden">Registrar</button>
        </div>
    </section>

    <script>
        //fecha del sistema 
        const inputFecha = document.getElementById('fecha');
        const hoy = new Date().toISOString().slice(0, 10);
        inputFecha.value = hoy;
    </script>

    <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- funciones de formulario -->
    <script type="text/javascript" src="./OrdenesArchivos/FuncionesJS/llenarCampos.js"></script>
    <script type="text/javascript" src="./OrdenesArchivos/FuncionesJS/llenarTabla.js"></script>
    <!-- scrip para la funcion del la tabla detalle orden  -->
    <script type="text/javascript" src="./OrdenesArchivos/FuncionesJS/btnRegistrar.js"></script>
    <!-- scrip para la funcion del boton registrar  -->
    <script src="Layout/menujs.js"></script>
    
</body>

</html>