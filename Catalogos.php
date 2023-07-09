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
    
</head>

<body>
    <main>
        <h1>Índice de Catálogos</h1>



        <div class="Menu">

            <?php
            #MENU DEL ADMINISTRADOR
            if ($filas['Idtipousuario'] == 1) {

            ?>
                <div class="menu-item" id="Ordenes" onclick="location.href='ResponsableCAT.php'">
                    <img src="Recursos/Iconos/ResponsableCat.svg" alt="Responsables Cat" class="menu-item-imagen">
                    <p class="menu-item-titulo">Responsables Cat</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Cat.php'">
                    <img src="Recursos/Iconos/CAT.svg" alt="Icono de CAT" class="menu-item-imagen">
                    <p class="menu-item-titulo">CAT<br /><small>(Centro de Acopio Temporal)</small></p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Distribuidores.php'">
                    <img src="Recursos/Iconos/Distribuidores.svg" alt="Icono de Distribuidores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Distribuidores</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Productores.php'">
                    <img src="Recursos/Iconos/Productores.svg" alt="Icono de Productores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Productores</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Huertos.php'">
                    <img src="Recursos/Iconos/Huertos.svg" alt="Icono de Huertos" class="menu-item-imagen">
                    <p class="menu-item-titulo">Huertos</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='TipoQuimico.php'">
                    <img src="Recursos/Iconos/TipoQuimicos.svg" alt="Icono de Tipo Químico" class="menu-item-imagen">
                    <p class="menu-item-titulo">Tipo Químico</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='EmpresaRecPrivada.php'">
                    <img src="Recursos/Iconos/EP.svg" alt="Icono de ERP" class="menu-item-imagen">
                    <p class="menu-item-titulo">ERP<br /><small>(Empresa Recolectora Privada)</small></p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='ErpVehiculos.php'">
                    <img src="Recursos/Iconos/ERPVehiculos.svg" alt="Icono de ERP Vehículos" class="menu-item-imagen">
                    <p class="menu-item-titulo">ERP Vehículos</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='DistVehiculos.php'">
                    <img src="Recursos/Iconos/distribuidoresVehiculos.svg" alt="Icono de Distribuidores Vehiculos" class="menu-item-imagen">
                    <p class="menu-item-titulo">Distribuidores Vehiculos</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Contenedores.php'">
                    <img src="Recursos/Iconos/Contenedores.svg" alt="Icono de Contenedores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Contenedores</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='TiposCont.php'">
                    <img src="Recursos/Iconos/TipoContenedores.svg" alt="Icono de Tipo Contenedor" class="menu-item-imagen">
                    <p class="menu-item-titulo">Tipo Contenedor</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='EmpresaDestino.php'">
                    <img src="Recursos/Iconos/EmpresaDestino.svg" alt="Icono de Empresa Destino" class="menu-item-imagen">
                    <p class="menu-item-titulo">Empresa Destino</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Municipio.php'">
                    <img src="Recursos/Iconos/Municipio.svg" alt="Icono de Municipio" class="menu-item-imagen">
                    <p class="menu-item-titulo">Municipio</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='MuniVehiculos.php'">
                    <img src="Recursos/Iconos/MunicipioVehiculos.svg" alt="Icono de Vehículos Municipales" class="menu-item-imagen">
                    <p class="menu-item-titulo">Vehículos Municipales</p>
                </div>

                
            <?php

            }

            #Menu de los Productores
            elseif ($filas['Idtipousuario'] == 2) {
            ?>
                <div class="menu-item" id="Ordenes" onclick="location.href='Cat.php'">
                    <img src="Recursos/Iconos/CAT.svg" alt="Icono de CAT" class="menu-item-imagen">
                    <p class="menu-item-titulo">CAT<br /><small>(Centro de Acopio Temporal)</small></p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Contenedores.php'">
                    <img src="Recursos/Iconos/Contenedores.svg" alt="Icono de Contenedores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Contenedores</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='EmpresaDestino.php'">
                    <img src="Recursos/Iconos/EmpresaDestino.svg" alt="Icono de Empresa Destino" class="menu-item-imagen">
                    <p class="menu-item-titulo">Empresa Destino</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='DistArchivos/RODistribuidores.php'">
                    <img src="Recursos/Iconos/Distribuidores.svg" alt="Icono de Distribuidores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Distribuidores</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='EmpresaRecPrivada.php'">
                    <img src="Recursos/Iconos/EP.svg" alt="Icono de ERP" class="menu-item-imagen">
                    <p class="menu-item-titulo">ERP<br /><small>(Empresa Recolectora Privada)</small></p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Huertos.php'">
                    <img src="Recursos/Iconos/Huertos.svg" alt="Icono de Huertos" class="menu-item-imagen">
                    <p class="menu-item-titulo">Huertos</p>
                </div>



            <?php
            }

            #Menu de los Distribuidores
            elseif ($filas['Idtipousuario'] == 3) {
            ?>
                <div class="menu-item" id="Ordenes" onclick="location.href='Cat.php'">
                    <img src="Recursos/Iconos/CAT.svg" alt="Icono de CAT" class="menu-item-imagen">
                    <p class="menu-item-titulo">CAT<br /><small>(Centro de Acopio Temporal)</small></p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Contenedores.php'">
                    <img src="Recursos/Iconos/Contenedores.svg" alt="Icono de Contenedores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Contenedores</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='EmpresaDestino.php'">
                    <img src="Recursos/Iconos/EmpresaDestino.svg" alt="Icono de Empresa Destino" class="menu-item-imagen">
                    <p class="menu-item-titulo">Empresa Destino</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Distribuidores.php'">
                    <img src="Recursos/Iconos/Distribuidores.svg" alt="Icono de Distribuidores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Distribuidores</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='EmpresaRecPrivada.php'">
                    <img src="Recursos/Iconos/EP.svg" alt="Icono de ERP" class="menu-item-imagen">
                    <p class="menu-item-titulo">ERP<br /><small>(Empresa Recolectora Privada)</small></p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Productores.php'">
                    <img src="Recursos/Iconos/Productores.svg" alt="Icono de Productores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Productores</p>
                </div>


            <?php
            }

            #Menu de los Municipios
            elseif ($filas['Idtipousuario'] == 4) {
            ?>
                <!--CÓDIGO-->
                <div class="menu-item" id="Ordenes" onclick="location.href='Cat.php'">
                    <img src="Recursos/Iconos/CAT.svg" alt="Icono de CAT" class="menu-item-imagen">
                    <p class="menu-item-titulo">CAT<br /><small>(Centro de Acopio Temporal)</small></p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='ResponsableCAT.php'">
                    <img src="Recursos/Iconos/ResponsableCat.svg" alt="Responsables Cat" class="menu-item-imagen">
                    <p class="menu-item-titulo">Responsables Cat</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Contenedores.php'">
                    <img src="Recursos/Iconos/Contenedores.svg" alt="Icono de Contenedores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Contenedores</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='TiposCont.php'">
                    <img src="Recursos/Iconos/TipoContenedores.svg" alt="Icono de Tipo Contenedor" class="menu-item-imagen">
                    <p class="menu-item-titulo">Tipo Contenedor</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='EmpresaDestino.php'">
                    <img src="Recursos/Iconos/EmpresaDestino.svg" alt="Icono de Empresa Destino" class="menu-item-imagen">
                    <p class="menu-item-titulo">Empresa Destino</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='TipoQuimico.php'">
                    <img src="Recursos/Iconos/TipoQuimicos.svg" alt="Icono de Tipo Químico" class="menu-item-imagen">
                    <p class="menu-item-titulo">Tipo Químico</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Huertos.php'">
                    <img src="Recursos/Iconos/Huertos.svg" alt="Icono de Huertos" class="menu-item-imagen">
                    <p class="menu-item-titulo">Huertos</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='EmpresaRecPrivada.php'">
                    <img src="Recursos/Iconos/EP.svg" alt="Icono de ERP" class="menu-item-imagen">
                    <p class="menu-item-titulo">ERP<br /><small>(Empresa Recolectora Privada)</small></p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Distribuidores.php'">
                    <img src="Recursos/Iconos/Distribuidores.svg" alt="Icono de Distribuidores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Distribuidores</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Productores.php'">
                    <img src="Recursos/Iconos/Productores.svg" alt="Icono de Productores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Productores</p>
                </div>

            <?php
            }


            #Menu de las Empresas Recolectoras Privadas
            elseif ($filas['Idtipousuario'] == 5) {
            ?>
                <!--CÓDIGO-->

            <?php
            }

            #Menu de las Empresas Recicladoras
            elseif ($filas['Idtipousuario'] == 6) {
            ?>
                <!--CÓDIGO-->
                <div class="menu-item" id="Ordenes" onclick="location.href='ResponsableCAT.php'">
                    <img src="Recursos/Iconos/ResponsableCat.svg" alt="Responsables Cat" class="menu-item-imagen">
                    <p class="menu-item-titulo">Responsables Cat</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Cat.php'">
                    <img src="Recursos/Iconos/CAT.svg" alt="Icono de CAT" class="menu-item-imagen">
                    <p class="menu-item-titulo">CAT<br /><small>(Centro de Acopio Temporal)</small></p>
                </div>


            <?php
            }

            #Menu de AMOCALI (Administrador)
            elseif ($filas['Idtipousuario'] == 7) {
            ?>
                <!--CÓDIGO-->
                <div class="menu-item" id="Ordenes" onclick="location.href='Cat.php'">
                    <img src="Recursos/Iconos/CAT.svg" alt="Icono de CAT" class="menu-item-imagen">
                    <p class="menu-item-titulo">CAT<br /><small>(Centro de Acopio Temporal)</small></p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='ResponsableCAT.php'">
                    <img src="Recursos/Iconos/ResponsableCat.svg" alt="Responsables Cat" class="menu-item-imagen">
                    <p class="menu-item-titulo">Responsables Cat</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='TiposCont.php'">
                    <img src="Recursos/Iconos/TipoContenedores.svg" alt="Icono de Tipo Contenedor" class="menu-item-imagen">
                    <p class="menu-item-titulo">Tipo Contenedor</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Contenedores.php'">
                    <img src="Recursos/Iconos/Contenedores.svg" alt="Icono de Contenedores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Contenedores</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='EmpresaDestino.php'">
                    <img src="Recursos/Iconos/EmpresaDestino.svg" alt="Icono de Empresa Destino" class="menu-item-imagen">
                    <p class="menu-item-titulo">Empresa Destino</p>
                </div>

                

            <?php
            }

            #Menu de ASICA (Administrador)
            elseif ($filas['Idtipousuario'] == 8) {
            ?>
                <!--CÓDIGO-->
                <div class="menu-item" id="Ordenes" onclick="location.href='Cat.php'">
                    <img src="Recursos/Iconos/CAT.svg" alt="Icono de CAT" class="menu-item-imagen">
                    <p class="menu-item-titulo">CAT<br /><small>(Centro de Acopio Temporal)</small></p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='ResponsableCAT.php'">
                    <img src="Recursos/Iconos/ResponsableCat.svg" alt="Responsables Cat" class="menu-item-imagen">
                    <p class="menu-item-titulo">Responsables Cat</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='TiposCont.php'">
                    <img src="Recursos/Iconos/TipoContenedores.svg" alt="Icono de Tipo Contenedor" class="menu-item-imagen">
                    <p class="menu-item-titulo">Tipo Contenedor</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Contenedores.php'">
                    <img src="Recursos/Iconos/Contenedores.svg" alt="Icono de Contenedores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Contenedores</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='EmpresaDestino.php'">
                    <img src="Recursos/Iconos/EmpresaDestino.svg" alt="Icono de Empresa Destino" class="menu-item-imagen">
                    <p class="menu-item-titulo">Empresa Destino</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='TipoQuimico.php'">
                    <img src="Recursos/Iconos/TipoQuimicos.svg" alt="Icono de Tipo Químico" class="menu-item-imagen">
                    <p class="menu-item-titulo">Tipo Químico</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Huertos.php'">
                    <img src="Recursos/Iconos/Huertos.svg" alt="Icono de Huertos" class="menu-item-imagen">
                    <p class="menu-item-titulo">Huertos</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='EmpresaRecPrivada.php'">
                    <img src="Recursos/Iconos/EP.svg" alt="Icono de ERP" class="menu-item-imagen">
                    <p class="menu-item-titulo">ERP<br /><small>(Empresa Recolectora Privada)</small></p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Distribuidores.php'">
                    <img src="Recursos/Iconos/Distribuidores.svg" alt="Icono de Distribuidores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Distribuidores</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Productores.php'">
                    <img src="Recursos/Iconos/Productores.svg" alt="Icono de Productores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Productores</p>
                </div>


            <?php
            }

            #Menu de CESAVEJAL
            elseif ($filas['Idtipousuario'] == 9) {
            ?>
                <!--CÓDIGO-->


            <?php
            }

            #Menu de APEAJAL
            elseif ($filas['Idtipousuario'] == 10) {
            ?>
                <!--CÓDIGO-->

            <?php
            }

            #Menu de los CAT
            elseif ($filas['Idtipousuario'] == 11) {
            ?>
                <!--CÓDIGO-->

                <div class="menu-item" id="Ordenes" onclick="location.href='Cat.php'">
                    <img src="Recursos/Iconos/CAT.svg" alt="Icono de CAT" class="menu-item-imagen">
                    <p class="menu-item-titulo">CAT<br /><small>(Centro de Acopio Temporal)</small></p>
                </div>


                <div class="menu-item" id="Ordenes" onclick="location.href='ResponsableCAT.php'">
                    <img src="Recursos/Iconos/ResponsableCat.svg" alt="Responsables Cat" class="menu-item-imagen">
                    <p class="menu-item-titulo">Responsables Cat</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Contenedores.php'">
                    <img src="Recursos/Iconos/Contenedores.svg" alt="Icono de Contenedores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Contenedores</p>
                </div>


                <div class="menu-item" id="Ordenes" onclick="location.href='Distribuidores.php'">
                    <img src="Recursos/Iconos/Distribuidores.svg" alt="Icono de Distribuidores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Distribuidores</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='EmpresaDestino.php'">
                    <img src="Recursos/Iconos/EmpresaDestino.svg" alt="Icono de Empresa Destino" class="menu-item-imagen">
                    <p class="menu-item-titulo">Empresa Destino</p>
                </div>


                <div class="menu-item" id="Ordenes" onclick="location.href='EmpresaRecPrivada.php'">
                    <img src="Recursos/Iconos/EP.svg" alt="Icono de ERP" class="menu-item-imagen">
                    <p class="menu-item-titulo">ERP<br /><small>(Empresa Recolectora Privada)</small></p>
                </div>


                <div class="menu-item" id="Ordenes" onclick="location.href='Productores.php'">
                    <img src="Recursos/Iconos/Productores.svg" alt="Icono de Productores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Productores</p>
                </div>

                

            <?php
            }



            ?>

        </div>

    </main>

    <script src="Layout/menujs.js"></script>

</body>

</html>