<?php
include('Layout/navMenu.php');

include 'conexion.php';
$r = "SELECT * FROM usuarios where Correo = '$varses'";
$res = mysqli_query($enlace, $r);
$filas = mysqli_fetch_array($res);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/menu-MovCat/menu-MovCat.css">
    <title>APEJAL-Movimientos</title>
</head>

<body>
    <main>
        <h1>Índice de Movimientos</h1>

        <div class="Menu">
        <?php
            #MENU DEL ADMINISTRADOR
            if ($filas['Idtipousuario'] == 1) {

        ?>

            <div class="menu-item" id="Ordenes" onclick="location.href='Ordenes.php'">
                <img src="Recursos/Iconos/Ordenes.svg" alt="Icono de Ordenes" class="menu-item-imagen">
                <p  class="menu-item-titulo">Ordenes</p>
            </div>

            <div class="menu-item" id="Entregas" onclick="location.href='Entregas.php'">
                <img src="Recursos/Iconos/Entregas.svg" alt="Icono de Entregas" class="menu-item-imagen">
                <p class="menu-item-titulo">Entregas</p>
            </div>

            <div class="menu-item" id="Extraviados" onclick="location.href='Extraviados.php'">
                <img src="Recursos/Iconos/Extraviados.svg" alt="Icono de Extraviados" class="menu-item-imagen">
                <p class="menu-item-titulo">Extraviados</p>
            </div>

            <div class="menu-item" id="Salidas" onclick="location.href='Salidas.php'">
                <img src="Recursos/Iconos/Salidas2.svg" alt="Icono de Salidas" class="menu-item-imagen">
                <p class="menu-item-titulo">Salidas</p>
            </div>
        <?php

            } //Termina el menu de admin

            #Menu de los Productores
            elseif ($filas['Idtipousuario'] == 2) {
        ?>
            <div class="menu-item" id="Ordenes" onclick="location.href='OrdenesArchivos/consultaOrden.php'">
                <img src="Recursos/Iconos/Ordenes.svg" alt="Icono de Ordenes" class="menu-item-imagen">
                <p  class="menu-item-titulo">Ordenes</p>
            </div>

            <div class="menu-item" id="Entregas" onclick="location.href='EntregasArchivos/consultaEntrega.php'">
                <img src="Recursos/Iconos/Entregas.svg" alt="Icono de Entregas" class="menu-item-imagen">
                <p class="menu-item-titulo">Entregas</p>
            </div>

            <div class="menu-item" id="Extraviados" onclick="location.href='Extraviados.php'">
                <img src="Recursos/Iconos/Extraviados.svg" alt="Icono de Extraviados" class="menu-item-imagen">
                <p class="menu-item-titulo">Extraviados</p>
            </div>

        <?php
            }

            #Menu de los Distribuidores, Municipios, Empresas Recolectoras Privadas, CAT
            elseif ($filas['Idtipousuario'] == 3 || $filas['Idtipousuario'] == 4 || $filas['Idtipousuario'] == 5 || $filas['Idtipousuario'] == 11) {
        ?>

            <div class="menu-item" id="Ordenes" onclick="location.href='Ordenes.php'">
                <img src="Recursos/Iconos/Ordenes.svg" alt="Icono de Ordenes" class="menu-item-imagen">
                <p  class="menu-item-titulo">Ordenes</p>
            </div>

            <div class="menu-item" id="Entregas" onclick="location.href='Entregas.php'">
                <img src="Recursos/Iconos/Entregas.svg" alt="Icono de Entregas" class="menu-item-imagen">
                <p class="menu-item-titulo">Entregas</p>
            </div>

            <div class="menu-item" id="Salidas" onclick="location.href='Salidas.php'">
                <img src="Recursos/Iconos/Salidas2.svg" alt="Icono de Salidas" class="menu-item-imagen">
                <p class="menu-item-titulo">Salidas</p>
            </div>
        </div>
        <?php
            }
        ?>

    </main>

    <script src="Layout/menujs.js"></script>


</body>

</html>