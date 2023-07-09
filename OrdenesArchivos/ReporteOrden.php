<?php 

ob_start();//iniciar el buffer para poder guardar la informacion html en una variable 

?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/movimientos/Orden/ConsultaOrden.css"> <!-- estilo principal -->
    <link rel="stylesheet" href="../bootstrap-5.1.3-dist/css/bootstrap.min.css"> <!-- estilo boostrap -->
    <link rel="stylesheet" href="../menucss.css"> <!-- estilo menu lateral -->
    <script src="https://kit.fontawesome.com/c65c1f4f0a.js" crossorigin="anonymous"></script> <!-- iconos -->
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <!-- js de tabla  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <title>APEJAL-Consulta Ordenes</title>

    <style type="text/css">
        body {
            background: #ffffff;
            width: 195mm;
            height: 279.4mm;
            border: solid;
        }
    </style>

</head>

<body>

    <?php
    include("../conexion.php");
    $queryOrden = "select * from ordenproductos;";
    $comando = mysqli_query($enlace, $queryOrden);

    //rutas de imagenes
    $amocali= ""
    ?>

    <header>
        <img src="/sistemaWeb-Trazabilidad/Logos/ASICA.jpg" alt="logo">
    </header>


    <section class="Orden-tabla">
        <h3>Ordenes</h3>
        <div class="form-Orden-table">
            <table class="table table-striped" id="orden">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Distribuidor</th>
                        <th scope="col">Productor</th>
                        <th scope="col">Factura</th>
                        <th scope="col">Archivo Factura</th>
                        <th scope="col">Cédula Receta</th>
                        <th scope="col">Archivo Receta</th>
                        <th scope="col">Fecha</th>
                        <!-- aqui agregamos el icono y funcion de eliminar por si se equivoca en algo -->
                    </tr>
                </thead>
                <tbody id="bodyTabla1">
                    <?php foreach ($comando as $orden) { ?>
                        <tr>
                            <td>
                                <?php echo $orden['IdOrden']; ?>
                            </td>
                            <td>
                                <?php echo $orden['IdDistribuidor']; ?>
                            </td>
                            <td>
                                <?php echo $orden['IdProductor']; ?>
                            </td>
                            <td>
                                <?php echo $orden['NumFactura']; ?>
                            </td>
                            <td>
                                <?php echo $orden['Factura']; ?>
                            </td>
                            <td>
                                <?php echo $orden['NumReceta']; ?>
                            </td>
                            <td>
                                <?php echo $orden['Receta']; ?>
                            </td>
                            <td>
                                <?php echo $orden['Fecha']; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<!-- jquery para traer los datos con ajax y json -->
<script type="text/javascript" src="../jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>


<?php 

$html= ob_get_clean();
//echo$html;


require_once '../Librerias/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf(); //crear objeto 

//opciones para mostrar imagenes 
$options = $dompdf->getOptions();
$options-> set(array('isRemoteEnable' =>true));
$dompdf-> setOptions($options);

//el contenido del pdf 
$dompdf->loadHtml($html);

//crear el archivo 
$dompdf->setPaper(('letter'));

//para cambiar propiedades de la hoja de pdf
//$dompdf->setPaper('A4','landscape');

//render 
$dompdf->render();

//poder trabajar el archivo           para poder descargarlo o solo abrirlo
$dompdf->stream("archivo_.pdf", array("Attachment" => false));

?>