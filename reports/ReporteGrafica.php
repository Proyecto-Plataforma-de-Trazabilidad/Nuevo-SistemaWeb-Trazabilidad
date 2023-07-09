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
    <link rel="stylesheet" href="../css/Reportes/reportes.css"> <!-- estilo principal -->
    <link rel="stylesheet" href="../menucss.css"> <!-- estilo menu lateral -->
    <script src="../Librerias/PapaParse-5.0.2/papaparse.min.js"></script>
    <script src="https://kit.fontawesome.com/c65c1f4f0a.js" crossorigin="anonymous"></script> <!-- iconos -->
    <!-- <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" /> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css"> -->

    <!-- js de tabla  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <title>APEJAL-Reporte</title>
    
</head>

<body>
    <section class="titulo">
        <div>
            <h1 id="texto"></h1>
        </div>
    </section>

    <section class="Botones">
        <div class="col-sm-3">
            <button type="submit" id="consu" class="btn btn-success" onclick="" name="Registrar">Generar
                Gráfico</button>
        </div>

        <div class="col-sm-3">
            <button type="submit" id="pdf" class="btn btn-success" onclick="" name="Registrar" disabled>Generar
                PDF</button>
        </div>

        <div class="col-sm-3">
            <button type="submit" id="csv" class="btn btn-success" onclick="" name="Registrar">Generar
                CSV</button>
        </div>

    </section>

    <section class="Grafica">
        <canvas id="myChart"></canvas>
    </section>

    <script src="../Layout/menujs.js"></script>
    <script type="text/javascript" src="../jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <!-- <script type="text/javascript" src="../datatables.min.js"></script> -->
    <!-- <script type="text/javascript" src="../tablas.js"></script> -->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script type="text/javascript" src="funcionGraficar.js"></script>

    <!--Liberia delas graficas-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

</body>

</html>