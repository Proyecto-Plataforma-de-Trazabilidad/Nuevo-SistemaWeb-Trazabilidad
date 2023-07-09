<?php
    include "../conexion.php";
    $idtipo=$_GET['id'];
        $r="SELECT Latitud, Longitud FROM huertos WHERE idHuerto =".$idtipo;
        $comando= mysqli_query($enlace, $r);
        while ($row = mysqli_fetch_array($comando)) {
            echo '[' . $row[0] . ', ' . $row[1] . '],';
        }
        mysqli_close($enlace);
?>