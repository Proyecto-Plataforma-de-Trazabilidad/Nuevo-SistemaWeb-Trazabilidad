<?php
// include("../conexion.php"); //$enlace es la conexion a db
// session_start();

//Genera la imagen del grafico
$my_base64_string = $_POST['img']; //Se recupera la imagen codificada enviada por ajax
//echo $base64_string;
function base64ToImage($base64_string, $output_file)
{
    $file = fopen($output_file, "wb"); //se indica que se va a crear un archivo (la 'wb' son los permisos de escritura)

    $data = explode(',', $base64_string); //La imagen esta codificada en base64 y para poder decodificar se le quita la descripcion   

    fwrite($file, base64_decode($data[1])); //Se decodifica la imagen y se escribe en el archivo que se abrio 
    fclose($file); //Se cierra el archivo ya que se termino de escribir
    return $output_file; //retorna el archivo de la imagen
}

$image = base64ToImage($my_base64_string, 'imagen.jpg'); //Se llama a la funcion con la imagen codifica y el nombre del archivo que se va agenerar


ob_start(); //iniciar el buffer para poder guardar la informacion html en una variable 
$currentsite = getcwd();


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/c65c1f4f0a.js" crossorigin="anonymous"></script>
    <title>Reporte-PDF</title>

    <style>
        body {
            background: #ffffff;
            width: 195mm;
            height: 279.4mm;
            /* border: solid; */
        }

        .container-encabezado-imagen {
            text-align: center;
            width: 80%;
            height: 8%;
            margin-left: 16%;
            margin-right: auto;
            margin-top: 40px;
        }

        .logo {
            display: inline-block;
            width: 80px;
            height: 80px;
            margin-right: 90px;
        }

        .container-encabezado-recolector {
            text-align: center;
            width: 350px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;

        }

        .recolector-nombre {
            text-align: center;
            font-size: .85rem;
            font-weight: bold;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .container-encabezado-fecha {
            text-align: right;
            width: 120px;
            margin-top: 5px;

        }

        .fecha-fecha {
            text-align: right;
            font-size: .85rem;
            font-weight: bolder;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .container-grafica {
            text-align: center;
        }

        .grafica {
            width: 650px;
            height: 350px;
        }
    </style>
</head>

<body>
    <!-- encabezado -->
    <section class="container-encabezado">
        <div class="container-encabezado-imagen">
            <img src="https://campolimpiojal.com/Logos/AMOCALI.jpg" alt="Logo" class="logo" />
            <img src="https://campolimpiojal.com/Logos/APEAJAL2.jpg" alt="Logo" class="logo" />
            <img src="https://campolimpiojal.com/Logos/ASICA.jpg" alt="Logo" class="logo" />
        </div>

        <div class="container-encabezado-recolector">
            <p class="recolector-nombre">
                Reporte de contenedores menos concurridos
            </p>
        </div>

    </section>

    <section>
        <div class="container-encabezado-fecha">
            <p class="fecha-fecha">
                Generado: 21/06/2023
            </p>
        </div>
    </section>



    <section class="container-grafica">
        <img src="https://campolimpiojal.com/reports/imagen.jpg" style="background-color: rgba(0, 0, 0, 0)"
            class="grafica">
    </section>

</body>

</html>

<?php

$html = ob_get_clean();
//echo$html;


require_once '../Librerias/dompdf/autoload.inc.php';
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
echo base64_encode($dompdf->stream("reporte.pdf", array("Attachment" => false)));

unlink('imagen.jpg'); //Borrra la imagen para no tener el monton de imagenes ahi nomas
?>