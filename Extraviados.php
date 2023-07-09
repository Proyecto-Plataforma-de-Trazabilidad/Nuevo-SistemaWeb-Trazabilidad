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
    <link rel="stylesheet" href="css/movimientos/Extraviados/Extraviados.css">
    <script src="https://kit.fontawesome.com/c65c1f4f0a.js" crossorigin="anonymous"></script> <!-- iconos -->

</head>


<body>
    <section class="titulo">
        <div>
            <h1>Extraviados</h1>
        </div>
        <div>
            <button type="button" onclick="window.location.href='ExtraviadosArchivos/consultaExtraviados.php'" class="btn btn-outline-secondary"><i class="fa-solid fa-magnifying-glass"></i>
                &nbsp;Consultar</button>
        </div>
    </section>

    <section class="form-Principal">
        <form class="row g-4 container-fluid" id="frmExtraviados" method="POST"
            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return 0">

            <div class="form-Principal-encabezado">
                <div class="form-Principal-encabezado-numero">
                    <label for="" id="numExt" data-numExtraviados="">Número de extraviados:</label>
                </div>
                <div>
                    <label for="fecha">Seleccionar Fecha: &nbsp;</label>
                </div>

                <div class="col-sm-2">
                    <input id="fecha" class="form-control" type="date" />
                </div>
            </div>

            <div class="col-sm-4">
                <label for="productor" class="form-label">Nombre de productor</label>
                <!-- debe de cargar dependiendo el inicio de seccion  -->
                <input disabled type="text" id="productor" name="nomDistribuidor" class="form-control" maxlength="30"
                    required placeholder="Nombre productor" data-idProduc="">
            </div>

            <div class="col-sm-4">
                <div>
                    <label for="tipoEnva" class="form-label">Tipo de Envase</label>
                    <select name="tipoEnva" id="tipoEnva" class="form-select" required>
                        <option hidden>Selecciona un tipo</option>
                        <option value="Rígidos lavable">Rígidos lavable</option>
                        <option value="Rígidos no lavable">Rígidos no lavable</option>
                        <option value="Flexible">Flexible</option>
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
                    <label for="numPiezas" class="form-label">Número de piezas</label>
                    <input type="number" class="form-control" id="numPiezas" min="1" maxlength="10" name="incap" required pattern="[1-9]\d*(\.\d+)?"
                        placeholder="Ingrese una cantidad">
                </div>
            </div>

            <div class="col-sm-4">
                <label for="aclaracion" class="form-label">Aclaración</label>
                <textarea class="form-control" id="aclaracion" rows="5" required
                    placeholder="Escribe una descripción"></textarea>
            </div>

            <div class="col-sm-4">
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
    <script type="text/javascript" src="./ExtraviadosArchivos/funciones/llenarCampos.js"></script>
    <script type="text/javascript" src="./ExtraviadosArchivos/funciones/btnRegistrar.js"></script>
    <script src="Layout/menujs.js"></script>
</body>

</html>