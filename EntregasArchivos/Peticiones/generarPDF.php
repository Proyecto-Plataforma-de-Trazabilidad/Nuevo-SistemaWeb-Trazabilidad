<?php
include("../../conexion.php"); //$enlace es la conexion a db
session_start();

ob_start(); //iniciar el buffer para poder guardar la informacion html en una variable 
$currentsite = getcwd();
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="../css/movimientos/Entregas/entregasPdf.css" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css" />
    <script src="https://kit.fontawesome.com/c65c1f4f0a.js" crossorigin="anonymous"></script>
    <title>APEJAL-PDF</title>

    <style>
        body {
            width: 195mm;
            height: 279.4mm;
            background: #ffffff; 
            /* border: solid; */
        }

        .bgimage {
            background-image: url(https://campolimpiojal.com/Logos/AMOCALI-fondo.png) no-repeat center center fixed;
            -webkit-background-size: contain;
            -moz-background-size: contain;
            -o-background-size: contain;
            background-size: contain;
            background-position: center;
            /* background: #ffffff; */
            width: 170mm;
            height: 255mm;
            opacity: 0.3;
            /* border: solid; */
        }

        .container-encabezado-imagen {
            text-align: center;
            width: 80%;
            height: 10%;
            margin-left: 16%;
            margin-right: auto;
            margin-top: 40px;
        }

        .container-identificacion {
            margin-top: 0%;
        }

        .logo {
            display: inline-block;
            width: 80px;
            height: 80px;
            margin-right: 90px;
        }

        .container-encabezado-recolector {
            text-align: center;
            width: 270px;
            height: 100px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 10px;

        }

        .container-identificacion {
            padding-left: 10px;
            padding-right: 25px;
            margin-top: 0px;
        }

        .container-identificacion-fecha {
            float: left;
            margin-left: 15px;
        }

        .container-identificacion-numero {
            float: right;
            margin-right: 15px;
        }

        .recolector-nombre {
            text-align: center;
            font-size: .85rem;
            font-weight: bold;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .recolector-domicilio {
            text-align: center;
            font-size: .60rem;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }


        .identificacion-texto {
            text-align: center;
            font-size: .90rem;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .numRecibo {
            font-weight: bold;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            color: #a91818;
        }

        /* datos productor */
        .container-productor {
            border: solid;
            margin-top: 50px;
            border-color: darkgreen;
            border-width: 3px;
            margin-bottom: 30px;
            margin-left: 15px;
            margin-right: 25px;
            padding-bottom: 5px;
            border-end-end-radius: 10px;
            border-start-end-radius: 10px;
            padding-left: 10px;
        }

        .container-productor p {
            font-size: .90rem;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .titulo {
            font-size: 1rem;
            font-weight: bold;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .container-productor-nombre,
        .container-productor-lugar {
            margin-right: 10px;
        }

        /* tabla */
        .container-entrega {
            border: solid;
            border-color: darkgreen;
            border-width: 3px;
            margin-bottom: 10px;
            margin-left: 15px;
            margin-right: 25px;
            padding-bottom: 5px;
            border-end-end-radius: 10px;
            border-start-end-radius: 10px;
            padding-left: 10px;
        }

        .entrega-tabla {
            width: 650px;
            margin-left: auto;
            margin-right: auto;
            padding-bottom: 10px;
        }

        .tabla {
            width: 650px;
            text-align: center;
            border: solid 1px #000000;
            border-collapse: collapse;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .tabla thead {
            background-color: darkgreen;
            text-align: center;
            color: #ffffff;
            font-size: .85rem
        }

        .declaracion-mensaje {
            text-align: center;
            padding: 0 10 0 10;
        }

        .container-firmaDeclaracion {
            width: 80%;
            display: inline-block;
        }

        .declaracion-firmas p {
            float: left;
            width: 80%;
            /* Ajusta el ancho según tus necesidades */
            box-sizing: border-box;
        }

        .container-responsables {
            width: 80%;
            margin-top: 10%;
            text-align: left;


        }

        .responsables-entrega {
            width: 50%;
            float: left;

        }

        .responsables-recepcion {
            width: 50%;
            float: right;

        }
    </style>
</head>


<body>
    <!-- <div class="bgimage"> -->
        <!-- encabezado -->
        <section class="container-encabezado">
            <div class="container-encabezado-imagen">
                <img src="https://campolimpiojal.com/Logos/APEAJAL2.jpg" alt="Logo" class="logo" />
                <img src="https://campolimpiojal.com/Logos/AMOCALI.jpg" alt="Logo" class="logo" />
                <img src="https://campolimpiojal.com/Logos/ASICA.jpg" alt="Logo" class="logo" />
            </div>

            <div class="container-encabezado-recolector">
                <p class="recolector-nombre">
                    CENTRO DE ACOPIO TEMPORAL ENVASES VACÍOS DE AGROQUÍMICOS Y
                    AFINES
                    CIUDAD GUZMAN, JALISCO
                </p>
                <p class="recolector-domicilio">
                    Dirección: Carretera tonila, km 64.3 comunidad la valencia
                    de san
                    francisco
                </p>
            </div>
        </section>

        <!-- fecha y numero de recibo -->
        <section class="container-identificacion">
            <div class="container-identificacion-fecha">
                <p class="identificacion-texto">Fecha:
                    <?php echo $_POST['entrega']['fecha'] ?>
                </p>
            </div>
            <div class="container-identificacion-numero">
                <p class="identificacion-texto">
                    Recibo de Entrega-Recepción: <em class="numRecibo">
                        <?php echo $_POST['entrega']['idEntrega'] ?>
                    </em>
                </p>
            </div>
        </section>


        <?php
        $comando = mysqli_query($enlace, "SELECT * FROM productores WHERE IdProductor = '" . $_POST['entrega']['idProduc'] . "'");
        $fila = mysqli_fetch_array($comando);
        mysqli_free_result($comando);

        ?>
        <!-- datos del productor que entrega -->
        <section class="container-productor">
            <div class="container-productor-titulo">
                <h1 class="titulo">Datos del productor</h1>
            </div>

            <div class="container-productor-nombre">
                <p><strong>Nombre:</strong>
                    <?php echo $fila[1] ?>
                </p>
                <p><strong>Telefono:</strong>
                    <?php echo $fila[8] ?>
                </p>
            </div>

            <div class="container-productor-domicilio">
                <p>
                    <strong>Domicilio:</strong>
                    <?php echo $fila[3] ?>
                </p>
            </div>

            <div class="container-productor-lugar">
                <p><strong>Municipio:</strong>
                    <?php echo $fila[6] ?>
                </p>
                <p><strong>Estado:</strong>
                    <?php echo $fila[7] ?>
                </p>
            </div>
        </section>

        <!-- datos de entrega -->
        <section class="container-entrega">
            <div class="entrega-titulo">
                <h1 class="titulo">Datos de entrega</h1>
            </div>
            <div class="entrega-tabla">
                <table class="tabla">
                    <thead>
                        <tr>
                            <th>Tipo Envase</th>
                            <th>Piezas</th>
                            <th>Peso</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $detalle = $_POST['detalle'];
                        foreach ($detalle as $t) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $t['tipoEnvase'] ?>
                                </td>
                                <td>
                                    <?php echo $t['cantidad'] ?>
                                </td>
                                <td>
                                    <?php echo $t['peso'] ?>kg
                                </td>
                                <td>
                                    <?php echo $t['observa'] ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- mensaje de declaracion -->
        <section class="container-declaracion">
            <div class="declaracion-mensaje">
                <p>
                    DECLARO QUE LOS ENVASES ENTREGADOS ESTÁN SECOS Y SE LES
                    REALIZO EL
                    TRIPLE LAVADO A LOS ENVASES LAVABLES, EN CASO CONTRARIO
                    CUBRIRÉ EL
                    IMPORTE POR LA INCINERACIÓN CONTROLADA EN HORNOS
                    AUTOMATIZADOS POR LA
                    AUTORIDAD FEDERAL
                </p>
            </div>
        </section>

        <section class="container-firmaDeclaracion">
            <div class="declaracion-firmas">
                <p><strong>Nombre:</strong>________________________________</p>
                <p><strong>Firma:</strong>_______________________</p>
            </div>
        </section>

        <!-- datos del responsable y firma -->
        <section class="container-responsables">
            <div class="responsables-titulo">
                <h1 class="titulo">Datos de Responsable</h1>
            </div>
            <div class="responsables-entrega">
                <p>_________________________________ </p>
                <strong>
                    <?php echo $_POST['entrega']['nomResEntrega'] ?>
                </strong>
                <p> Responsable de entrega</p>
            </div>

            <div class="responsables-recepcion">
                <p>_________________________________</p>
                <strong>
                    <?php echo $_POST['entrega']['nomResRecibe'] ?>
                </strong>
                <p>Responsable de recepción</p>
            </div>
        </section>
    <!-- </div> -->

</body>

</html>


<?php

$html = ob_get_clean();
//echo$html;


require_once '../../Librerias/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf(); //crear objeto 

// //opciones para mostrar imagenes 
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnable' => true));
$dompdf->setOptions($options);

//el contenido del pdf 
$dompdf->loadHtml($html);

// //crear el archivo 
$dompdf->setPaper('letter');

// //para cambiar propiedades de la hoja de pdf
// //$dompdf->setPaper('A4','landscape');

//render 
$dompdf->render();

// //poder trabajar el archivo           para poder descargarlo o solo abrirlo
echo base64_encode($dompdf->stream("archivo_.pdf", array("Attachment" => false)));

?>