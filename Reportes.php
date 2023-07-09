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
        <h1>Índice de Reportes</h1>



        <div class="Menu">

            <?php
            #MENU DEL ADMINISTRADOR
            if ($filas['Idtipousuario'] == 1) {

            ?>
                <div class="menu-item" id="Ordenes" onclick="location.href='ReportesArchivos/Envases.php'">
                    <img src="Recursos/Iconos/Envases2.svg" alt="Uso de Envases" class="menu-item-imagen">
                    <p class="menu-item-titulo">Uso de Envases</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='ReportesArchivos/EnvasesMasOrden.php'">
                    <img src="Recursos/Iconos/OrdenesMas.svg" alt="Envases mas orden" class="menu-item-imagen">
                    <p class="menu-item-titulo">Envases Más Ordenados</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='ReportesArchivos/DistribuidoresConcurridos.php'">
                    <img src="Recursos/Iconos/DistribuidorConcurrido.svg" alt="Icono de Distribuidores" class="menu-item-imagen">
                    <p class="menu-item-titulo">Distribuidores Más Concurridos</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='ReportesArchivos/ContenedoresConcurridos.php'">
                    <img src="Recursos/Iconos/ContenedoresConcurridos.svg" alt="Icono de Contenedores Concurridos" class="menu-item-imagen">
                    <p class="menu-item-titulo">Contenedores Más Concurridos</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='ReportesArchivos/ProductoresMasOrdenes.php'">
                    <img src="Recursos/Iconos/MasOrdenes.svg" alt="Icono de Ordenes" class="menu-item-imagen">
                    <p class="menu-item-titulo">Productores Con Más Ordenes</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='ReportesArchivos/MunicipioMenosEntregas.php'">
                    <img src="Recursos/Iconos/Parlamento.svg" alt="Icono de Municipios Menos Entregas" class="menu-item-imagen">
                    <p class="menu-item-titulo">Municipios Con Menos Entregas</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='ReportesArchivos/DistribuidorMenosEntregas.php'">
                    <img src="Recursos/Iconos/DistribuidorMenosEntregas.svg" alt="Icono de Distribuidor Menos Entregas" class="menu-item-imagen">
                    <p class="menu-item-titulo">Distribuidor Con Menos Entregas</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='ReportesArchivos/ContenedoresMenosSalidas.php'">
                    <img src="Recursos/Iconos/ContenedorMenos.svg" alt="Icono de Contenedores Menos salidas" class="menu-item-imagen">
                    <p class="menu-item-titulo">Contenedores Con Menos Salidas</p>
                </div>

                <div class="menu-item" id="Ordenes" onclick="location.href='Reporte.php'">
                    <img src="Recursos/Iconos/Ordenes.svg" alt="Icono de Contenedores Menos salidas" class="menu-item-imagen">
                    <p class="menu-item-titulo">Envases ordenados por productor</p>
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