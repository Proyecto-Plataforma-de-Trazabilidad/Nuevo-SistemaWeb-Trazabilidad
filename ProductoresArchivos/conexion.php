<?php

$host="156.67.73.0";
$puerto="3306";
$usuario="u517350403_admindb";
$contrasena="Te-k3li-L!";
$baseDeDatos="u517350403_campolimpiojal";

    $enlace=mysqli_connect($host.":".$puerto, $usuario, $contrasena, $baseDeDatos);
    if(!$enlace)
    {
        echo "Error no se pudo conectar a MySQL.".PHP_EOL;
        echo "Errno de depuracion: ".mysqli_connect_errno().PHP_EOL;
        echo "Error de depuracion: ".mysqli_connect_error().PHP_EOL;
        exit();
    }
?>