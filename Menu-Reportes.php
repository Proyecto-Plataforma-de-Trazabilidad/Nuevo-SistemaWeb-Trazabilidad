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
    <link rel="stylesheet" href="css/menu-MovCat/menu-MovCat-Reportes.css">
    <!-- <link href="bootstrap-5.3.0-alpha3-dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->
    <!-- <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" /> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script> -->

</head>

<body>
    <main>
        <h1 class="titulo">Índice de Reportes</h1>


        <div class="Menu">

            <?php
            #MENU DEL ADMINISTRADOR
            if ($filas['Idtipousuario'] == 1) {

                ?>
                <!-- menu tipo acordeon  -->
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">

                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                Generales
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                            aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">

                                <div class="menu-item" data-url="ReportesArchivos/Envases.php" data-opcionreporte="">
                                    <img src="Recursos/Iconos/Envases2.svg" alt="Uso de Envases" class="menu-item-imagen">
                                    <p class="menu-item-titulo">Uso de Envases</p>
                                </div>

                                <div class="menu-item" data-url="ReportesArchivos/EnvasesMasOrden.php"
                                    data-opcionreporte="1">
                                    <img src="Recursos/Iconos/OrdenesMas.svg" alt="Envases mas orden"
                                        class="menu-item-imagen">
                                    <p class="menu-item-titulo">Envases Más Ordenados</p>
                                </div>

                            </div>

                        </div>
                    </div>


                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseTwo">
                                Listas
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingTwo">
                            <div class="accordion-body">
                                <div class="menu-item" data-opcionreporte="">
                                    <img src="Recursos/Iconos/Distribuidores.svg" alt="Icono de Distribuidores"
                                        class="menu-item-imagen">
                                    <p class="menu-item-titulo">Lista de Distribuidores</p>
                                </div>

                                <div class="menu-item" data-opcionreporte="">
                                    <img src="Recursos/Iconos/Productores.svg" alt="Icono de Distribuidor Menos Entregas"
                                        class="menu-item-imagen">
                                    <p class="menu-item-titulo">Lista de Productores</p>
                                </div>

                                <div class="menu-item" data-opcionreporte="">
                                    <img src="Recursos/Iconos/Huertos.svg" alt="Icono de Distribuidores"
                                        class="menu-item-imagen">
                                    <p class="menu-item-titulo">Lista de Huertos</p>
                                </div>

                                <div class="menu-item" data-opcionreporte="">
                                    <img src="Recursos/Iconos/CAT.svg" alt="Icono de Distribuidor Menos Entregas"
                                        class="menu-item-imagen">
                                    <p class="menu-item-titulo">Lista de CAT</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseThree">
                                Distribuidores
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body">
                                <div class="menu-item" data-opcionreporte="2">
                                    <img src="Recursos/Iconos/DistribuidorConcurrido.svg" alt="Icono de Distribuidores"
                                        class="menu-item-imagen">
                                    <p class="menu-item-titulo">Distribuidores Más Concurridos</p>
                                </div>

                                <div class="menu-item" data-opcionreporte="6">
                                    <img src="Recursos/Iconos/DistribuidorMenosEntregas.svg"
                                        alt="Icono de Distribuidor Menos Entregas" class="menu-item-imagen">
                                    <p class="menu-item-titulo">Distribuidor Con Menos Entregas</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseFour">
                                Productores
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingFour">
                            <div class="accordion-body">
                                <div class="menu-item" data-opcionreporte="4">
                                    <img src="Recursos/Iconos/MasOrdenes.svg" alt="Icono de Ordenes"
                                        class="menu-item-imagen">
                                    <p class="menu-item-titulo">Productores Con Más Ordenes</p>
                                </div>
                                <div class="menu-item">
                                    <img src=" Recursos/Iconos/Ordenes.svg" alt="Icono de Contenedores Menos salidas"
                                        class="menu-item-imagen">
                                    <p class="menu-item-titulo">Envases ordenados por productor</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseFive">
                                Municipios
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingFive">
                            <div class="accordion-body">
                                <div class="menu-item" data-opcionreporte="5">
                                    <img src="Recursos/Iconos/Parlamento.svg" alt="Icono de Municipios Menos Entregas"
                                        class="menu-item-imagen">
                                    <p class="menu-item-titulo">Municipios Con Menos Entregas</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseSix">
                                Contenedores
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingSix">
                            <div class="accordion-body">
                                <div class="menu-item" data-opcionreporte="3">
                                    <img src="Recursos/Iconos/ContenedoresConcurridos.svg"
                                        alt="Icono de Contenedores Concurridos" class="menu-item-imagen">
                                    <p class="menu-item-titulo">Contenedores Más Concurridos</p>
                                </div>

                                <div class="menu-item" data-opcionreporte="7">
                                    <img src="Recursos/Iconos/ContenedorMenos.svg" alt="Icono de Contenedores Menos salidas"
                                        class="menu-item-imagen">
                                    <p class="menu-item-titulo">Contenedores Con Menos Salidas</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingSeven">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseSeven">
                                Ordenes
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingSeven">
                            <div class="accordion-body">

                                <div class="menu-item" data-opcionreporte="10">
                                    <img src="Recursos/Iconos/DistribuidorConcurrido.svg"
                                        alt="Icono de Contenedores Concurridos" class="menu-item-imagen">
                                    <p class="menu-item-titulo">Ordenes por Productor</p>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingEigth">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseEigth" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseEigth">
                                Entregas
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseEigth" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingEigth">
                            <div class="accordion-body">
                                <div class="menu-item" data-opcionreporte="8">

                                    <img src="Recursos/Iconos/DistribuidorConcurrido.svg"
                                        alt="Icono de Contenedores Concurridos" class="menu-item-imagen">
                                    <p class="menu-item-titulo">Todas las entregas por Productor</p>
                                </div>

                                <div class="menu-item" data-opcionreporte="9">

                                    <img src="Recursos/Iconos/Extraviados.svg" alt="Icono de Contenedores Concurridos"
                                        class="menu-item-imagen">
                                    <p class="menu-item-titulo">Todas los Extraviados por Productor</p>
                                </div>
                                <div class="menu-item" data-opcionreporte="11">

                                    <img src="Recursos/Iconos/Extraviados.svg" alt="Icono de Contenedores Concurridos"
                                        class="menu-item-imagen">
                                    <p class="menu-item-titulo">Todas las Entregas por Distribuidor</p>
                                </div>



                            </div>
                        </div>
                    </div>


                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingNine">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseNine" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseNine">
                                Extravidados
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseNine" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingNine">
                            <div class="accordion-body">

                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseTen" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseTen">
                                Salidas
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTen" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingTen">
                            <div class="accordion-body">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ---------- -->


                <?php

            }

            #Menu de los Productores
            elseif ($filas['Idtipousuario'] == 2) {
                ?>
                <!-- menu tipo acordeon  -->
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                    Listas
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body">
                                    <div class="menu-item" data-opcionreporte="">
                                        <img src="Recursos/Iconos/Distribuidores.svg" alt="Icono de Distribuidores"
                                            class="menu-item-imagen">
                                        <p class="menu-item-titulo">Lista de Distribuidores</p>
                                    </div>

                                    <div class="menu-item" data-opcionreporte="">
                                        <img src="Recursos/Iconos/CAT.svg" alt="Icono de Distribuidor Menos Entregas"
                                            class="menu-item-imagen">
                                        <p class="menu-item-titulo">Lista de CAT</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseFive">
                                    Municipios
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingFive">
                                <div class="accordion-body">
                                    <div class="menu-item" data-opcionreporte="5">
                                        <img src="Recursos/Iconos/Parlamento.svg" alt="Icono de Municipios Menos Entregas"
                                            class="menu-item-imagen">
                                        <p class="menu-item-titulo">Municipios Con Menos Entregas</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseSeven">
                                    Ordenes
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingSeven">
                                <div class="accordion-body">

                                    <div class="menu-item" data-opcionreporte="10">
                                        <img src="Recursos/Iconos/DistribuidorConcurrido.svg"
                                            alt="Icono de Contenedores Concurridos" class="menu-item-imagen">
                                        <p class="menu-item-titulo">Ordenes por Productor</p>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingEigth">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseEigth" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseEigth">
                                    Entregas
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseEigth" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingEigth">
                                <div class="accordion-body">
                                    <div class="menu-item" data-opcionreporte="8">

                                        <img src="Recursos/Iconos/DistribuidorConcurrido.svg"
                                            alt="Icono de Contenedores Concurridos" class="menu-item-imagen">
                                        <p class="menu-item-titulo">Todas las entregas por Productor</p>
                                    </div>

                                    <div class="menu-item" data-opcionreporte="9">

                                        <img src="Recursos/Iconos/Extraviados.svg" alt="Icono de Contenedores Concurridos"
                                            class="menu-item-imagen">
                                        <p class="menu-item-titulo">Todas los Extraviados por Productor</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ---------- -->


                    <?php
            }

            #Menu de los Distribuidores
            elseif ($filas['Idtipousuario'] == 3) {
                ?>
                    <!-- menu tipo acordeon  -->
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">

                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne">
                                    Generales
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">


                                    <div class="menu-item" data-url="ReportesArchivos/EnvasesMasOrden.php"
                                        data-opcionreporte="1">
                                        <img src="Recursos/Iconos/OrdenesMas.svg" alt="Envases mas orden"
                                            class="menu-item-imagen">
                                        <p class="menu-item-titulo">Envases Más Ordenados</p>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseFour">
                                    Productores
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingFour">
                                <div class="accordion-body">
                                    <div class="menu-item" data-opcionreporte="4">
                                        <img src="Recursos/Iconos/MasOrdenes.svg" alt="Icono de Ordenes"
                                            class="menu-item-imagen">
                                        <p class="menu-item-titulo">Productores Con Más Ordenes</p>
                                    </div>
                                    <div class="menu-item">
                                        <img src=" Recursos/Iconos/Ordenes.svg" alt="Icono de Contenedores Menos salidas"
                                            class="menu-item-imagen">
                                        <p class="menu-item-titulo">Envases ordenados por productor</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingEigth">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseEigth" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseEigth">
                                    Entregas
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseEigth" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingEigth">
                                <div class="accordion-body">
                                    <div class="menu-item" data-opcionreporte="11">

                                        <img src="Recursos/Iconos/Extraviados.svg" alt="Icono de Contenedores Concurridos"
                                            class="menu-item-imagen">
                                        <p class="menu-item-titulo">Todas las Entregas por Distribuidor</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- ---------- -->


                    <?php
            }

            #Menu de los Municipios
            elseif ($filas['Idtipousuario'] == 4) {
                ?>
                    <!--CÓDIGO-->
                    <div class="menu-item">
                        <img src="Recursos/Iconos/CAT.svg" alt="Icono de CAT" class="menu-item-imagen">
                        <p class="menu-item-titulo">CAT<br /><small>(Centro de Acopio Temporal)</small></p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/ResponsableCat.svg" alt="Responsables Cat" class="menu-item-imagen">
                        <p class="menu-item-titulo">Responsables Cat</p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/Contenedores.svg" alt="Icono de Contenedores" class="menu-item-imagen">
                        <p class="menu-item-titulo">Contenedores</p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/TipoContenedores.svg" alt="Icono de Tipo Contenedor"
                            class="menu-item-imagen">
                        <p class="menu-item-titulo">Tipo Contenedor</p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/EmpresaDestino.svg" alt="Icono de Empresa Destino"
                            class="menu-item-imagen">
                        <p class="menu-item-titulo">Empresa Destino</p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/TipoQuimicos.svg" alt="Icono de Tipo Químico" class="menu-item-imagen">
                        <p class="menu-item-titulo">Tipo Químico</p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/Huertos.svg" alt="Icono de Huertos" class="menu-item-imagen">
                        <p class="menu-item-titulo">Huertos</p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/EP.svg" alt="Icono de ERP" class="menu-item-imagen">
                        <p class="menu-item-titulo">ERP<br /><small>(Empresa Recolectora Privada)</small></p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/Distribuidores.svg" alt="Icono de Distribuidores"
                            class="menu-item-imagen">
                        <p class="menu-item-titulo">Distribuidores</p>
                    </div>

                    <div class="menu-item">
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
                    <div class="menu-item">
                        <img src="Recursos/Iconos/ResponsableCat.svg" alt="Responsables Cat" class="menu-item-imagen">
                        <p class="menu-item-titulo">Responsables Cat</p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/CAT.svg" alt="Icono de CAT" class="menu-item-imagen">
                        <p class="menu-item-titulo">CAT<br /><small>(Centro de Acopio Temporal)</small></p>
                    </div>


                    <?php
            }

            #Menu de AMOCALI (Administrador)
            elseif ($filas['Idtipousuario'] == 7) {
                ?>
                    <!--CÓDIGO-->
                    <div class="menu-item">
                        <img src="Recursos/Iconos/CAT.svg" alt="Icono de CAT" class="menu-item-imagen">
                        <p class="menu-item-titulo">CAT<br /><small>(Centro de Acopio Temporal)</small></p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/ResponsableCat.svg" alt="Responsables Cat" class="menu-item-imagen">
                        <p class="menu-item-titulo">Responsables Cat</p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/TipoContenedores.svg" alt="Icono de Tipo Contenedor"
                            class="menu-item-imagen">
                        <p class="menu-item-titulo">Tipo Contenedor</p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/Contenedores.svg" alt="Icono de Contenedores" class="menu-item-imagen">
                        <p class="menu-item-titulo">Contenedores</p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/EmpresaDestino.svg" alt="Icono de Empresa Destino"
                            class="menu-item-imagen">
                        <p class="menu-item-titulo">Empresa Destino</p>
                    </div>



                    <?php
            }

            #Menu de ASICA (Administrador)
            elseif ($filas['Idtipousuario'] == 8) {
                ?>
                    <!--CÓDIGO-->
                    <div class="menu-item">
                        <img src="Recursos/Iconos/CAT.svg" alt="Icono de CAT" class="menu-item-imagen">
                        <p class="menu-item-titulo">CAT<br /><small>(Centro de Acopio Temporal)</small></p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/ResponsableCat.svg" alt="Responsables Cat" class="menu-item-imagen">
                        <p class="menu-item-titulo">Responsables Cat</p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/TipoContenedores.svg" alt="Icono de Tipo Contenedor"
                            class="menu-item-imagen">
                        <p class="menu-item-titulo">Tipo Contenedor</p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/Contenedores.svg" alt="Icono de Contenedores" class="menu-item-imagen">
                        <p class="menu-item-titulo">Contenedores</p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/EmpresaDestino.svg" alt="Icono de Empresa Destino"
                            class="menu-item-imagen">
                        <p class="menu-item-titulo">Empresa Destino</p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/TipoQuimicos.svg" alt="Icono de Tipo Químico" class="menu-item-imagen">
                        <p class="menu-item-titulo">Tipo Químico</p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/Huertos.svg" alt="Icono de Huertos" class="menu-item-imagen">
                        <p class="menu-item-titulo">Huertos</p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/EP.svg" alt="Icono de ERP" class="menu-item-imagen">
                        <p class="menu-item-titulo">ERP<br /><small>(Empresa Recolectora Privada)</small></p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/Distribuidores.svg" alt="Icono de Distribuidores"
                            class="menu-item-imagen">
                        <p class="menu-item-titulo">Distribuidores</p>
                    </div>

                    <div class="menu-item">
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

                    <div class="menu-item">
                        <img src="Recursos/Iconos/CAT.svg" alt="Icono de CAT" class="menu-item-imagen">
                        <p class="menu-item-titulo">CAT<br /><small>(Centro de Acopio Temporal)</small></p>
                    </div>


                    <div class="menu-item">
                        <img src="Recursos/Iconos/ResponsableCat.svg" alt="Responsables Cat" class="menu-item-imagen">
                        <p class="menu-item-titulo">Responsables Cat</p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/Contenedores.svg" alt="Icono de Contenedores" class="menu-item-imagen">
                        <p class="menu-item-titulo">Contenedores</p>
                    </div>


                    <div class="menu-item">
                        <img src="Recursos/Iconos/Distribuidores.svg" alt="Icono de Distribuidores"
                            class="menu-item-imagen">
                        <p class="menu-item-titulo">Distribuidores</p>
                    </div>

                    <div class="menu-item">
                        <img src="Recursos/Iconos/EmpresaDestino.svg" alt="Icono de Empresa Destino"
                            class="menu-item-imagen">
                        <p class="menu-item-titulo">Empresa Destino</p>
                    </div>


                    <div class="menu-item">
                        <img src="Recursos/Iconos/EP.svg" alt="Icono de ERP" class="menu-item-imagen">
                        <p class="menu-item-titulo">ERP<br /><small>(Empresa Recolectora Privada)</small></p>
                    </div>


                    <div class="menu-item">
                        <img src="Recursos/Iconos/Productores.svg" alt="Icono de Productores" class="menu-item-imagen">
                        <p class="menu-item-titulo">Productores</p>
                    </div>



                    <?php
            }



            ?>

            </div>

    </main>

    <script src="Layout/menujs.js"></script>
    <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.3.0-alpha3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="reports/funcionMenu.js"></script>


</body>

</html>