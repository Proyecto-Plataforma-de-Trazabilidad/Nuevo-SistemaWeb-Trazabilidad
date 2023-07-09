<?php
include("../conexion.php"); //$enlace es la conexion a db
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
    <script src="https://kit.fontawesome.com/c65c1f4f0a.js" crossorigin="anonymous"></script>
    <title>Reporte-PDF</title>

    
</head>

<body>
<script>
        <?php
    $fileTemp = $_FILES['imagen']['tmp_name'];
    ?>
        // Lo convertimos a un objeto de tipo objectURL
        const objectURL = URL.createObjectURL(fileTemp);
        // Y a la fuente de la imagen le ponemos el objectURL
        $imagenPrevisualizacion.src = objectURL;
    </script>

<img id="imagenPrevisualizacion">


</body>
</html>

