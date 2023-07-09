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
    <link rel="stylesheet" href="css/movimientos/Salidas/Salidas.css">
    <script src="https://kit.fontawesome.com/c65c1f4f0a.js" crossorigin="anonymous"></script> <!-- iconos -->

</head>


<body>
    <section class="titulo">
        <div>
            <h1>Salidas</h1>
        </div>
        <div>
            <button type="button" onclick="window.location.href='SalidasArchivos/consultaSalidas.php'" class="btn btn-outline-secondary"><i class="fa-solid fa-magnifying-glass"></i>
                &nbsp;Consultar</button>
        </div>
    </section>

    <section class="form-Principal">
        <form class="row g-4 container-fluid" id="frmSalidas" method="POST"
            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return 0">

            <div class="form-Principal-encabezado">
                <div class="form-Principal-encabezado-numero">
                    <label id="numSalida" data-numSalida="">Número de Salida:</label>
                </div>
                <div>
                    <label for="fecha">Seleccionar Fecha: &nbsp;</label>
                </div>

                <div class="col-sm-2">
                    <input id="fecha" class="form-control" type="date" />
                </div>
            </div>

            <div class="col-sm-4">
                <div>
                    <label for="Contenedor" class="form-label">Contenedor</label>
                    <select name="contenedores" id="Contenedor" class="form-select" required>
                        <option hidden>Selecciona un contenedor</option>                        
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <label for="recolector" class="form-label">Nombre de Recolector</label>
                <!-- debe de cargar dependiendo el inicio de seccion  -->
                <input disabled type="text" id="recolector" name="nomRecolector" class="form-control" maxlength="30"
                    required placeholder="Nombre de recolector" data-idRec="">
            </div>

            <div class="col-sm-4">
                <label for="Responsable" class="form-label">Nombre del Responsable de Salida</label>
                <input  type="text" id="Responsable" name="nomResponsable" class="form-control" maxlength="30"
                    required placeholder="Nombre del Responsable de Salida">
            </div>

            <div class="col-sm-3">
                <div>
                    <label for="peso" class="form-label">Cantidad de Recolección (Kg)</label>
                    <input type="number" class="form-control" id="peso" min="1" maxlength="10" name="incap" required pattern="[1-9]\d*(\.\d+)?"
                        placeholder="Ingrese el peso">
                </div>
            </div>

            <div class="col-sm-6">
                <canvas id="myChart" width="100%" height="100px"></canvas>
            </div>

            <div class="col-sm-3">
                <button type="submit" class="btn btn-success button-registrar" onclick=""
                    name="Registrar" id="registrar">Registrar</button>
            </div>

        </form>
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
    <!--Liberia delas graficas-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    <script type="text/javascript" src="SalidasArchivos/Funciones/llenarCampos.js"></script>
    <script type="text/javascript" src="SalidasArchivos/Funciones/btnRegistrar.js"></script>
    <script type="text/javascript" src="SalidasArchivos/Funciones/cargarGrafico.js"></script>

    <script src="Layout/menujs.js"></script>
</body>

</html>