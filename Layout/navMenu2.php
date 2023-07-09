<?php
session_start();

$varses = $_SESSION['usuario'];
if ($varses == null || $varses == '') {
    header("Location: ../index.php");
}

include('../conexion.php');
$consulta = "SELECT * FROM usuarios where Correo = '$varses'";
$res = mysqli_query($enlace, $consulta);
$filas = mysqli_fetch_array($res);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEP</title>
    <link rel="icon" type="image/png" href="../Logos/LogoTep.png"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <!-- Icono de carga -->
        <style>
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('../Recursos/Iconos/Loading-Icon-TEP2.gif') 50% 50% no-repeat rgb(249,249,249);
            background-size: 20%;
            opacity: .8;
        }
    </style>
    <div class="loader"></div>

    <!--SWEET ALERT-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <!-- <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="Datatables-1.11.3/css/dataTables.bootstrap5.min.css"> -->


    <link rel="stylesheet" href="../Layout/menucss.css">

    <script src="https://kit.fontawesome.com/c65c1f4f0a.js" crossorigin="anonymous"></script>

    <style>
        a{
            text-decoration: none;
        }
    </style>

</head>

<body id="body">
    <header>
        <div class="icon__menu">
            <div class="margen"></div>
            <i class="fa-sharp fa-solid fa-bars" id="btn_open"></i>
        </div>
    </header>


    <!--Menu-->
    <div class="menu__side" id="menu_side">

        <div class="name__page">
            <i class="fa-sharp fa-solid fa-user" title="Sesión"></i>
            <h4><?php echo $filas[2]; ?></h4>
        </div>

        <div class="options__menu">

            <!--Inicio-->
            <a href="../inicio.php" aria-current="page">
                <div class="option">
                    <i class="fa-sharp fa-solid fa-house" title="Inicio"></i>
                    <h4>Inicio</h4>
                </div>
            </a>

            <!--Catálogos-->
            <a href="../Catalogos.php">
                <div class="option">
                    <i class="fa-sharp fa-solid fa-book" title="Catálogos"></i>
                    <h4>Catálogos</h4>
                </div>


            </a>

            <!--Movimientos-->
            <a href="../Menu-Movimientos.php">
                <div class="option">
                    <i class="fa-sharp fa-solid fa-paper-plane" title="Movimientos"></i>
                    <h4>Movimientos</h4>
                </div>
            </a>

            <!--Reportes-->
            <a href="../Menu-Reportes.php">
                <div class="option">
                    <i class="fa-solid fa-file-circle-check" title="Reportes"></i>
                    <h4>Reportes</h4>
                </div>
            </a>

            <!--Ayuda-->
            <a href="#">
                <div class="option">
                    <i class="fa-sharp fa-solid fa-circle-info" title="Ayuda"></i>
                    <h4>Ayuda</h4>
                </div>
            </a>

            <?php
            if ($filas[1] == 1) {

            ?>
                <!--Registrar Usuarios-->
                <a href="../rusers.php">
                    <div class="option">
                        <i class="fa-solid fa-user-pen"></i>
                        <h4>Usuarios</h4>
                    </div>
                </a>
            <?php
            }
            ?>

            <!--Salir-->
            <a href="../loggin/logout.php" >
                <div class="option">
                    <i class="fa-sharp fa-solid fa-right-from-bracket" title="Salir"></i>
                    <h4>Salir</h4>
                </div>
            </a>

        </div>




    </div>


    <main>

        <div class="row">
            <div class="col-sm-4">
                <center><img class="mb-4" src="../Logos/APEAJAL2.jpg" alt="" width="80"></center>
            </div>

            <div class="col-sm-4">
                <center><img class="mb-4" src="../Logos/AMOCALI.jpg" alt="" width="80"></center>
            </div>
            <div class="col-sm-4">
                <center><img class="mb-4" src="../Logos/ASICA.jpg" alt="" width="80"></center>
            </div>
            <hr style="background-color: green; height:5px;">
        </div>

    <script>
        $(window).on("load", function() {
            $('.loader').fadeOut('slow');
        });
    </script>