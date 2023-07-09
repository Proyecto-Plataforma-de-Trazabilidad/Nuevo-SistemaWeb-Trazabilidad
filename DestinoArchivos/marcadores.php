<?php
    include "../conexion.php";
        $r="SELECT Latitud, Longitud FROM empresadestino";
        $comando= mysqli_query($enlace, $r);
        while ($row = mysqli_fetch_array($comando)) {
            echo '[' . $row[0] . ', ' . $row[1] . '],';
        }
        mysqli_close($enlace);
?>