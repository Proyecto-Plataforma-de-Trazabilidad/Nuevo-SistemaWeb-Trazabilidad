<?php 
    include "../conexion.php";
    $idtipo=$_GET['id'];
    $r="DELETE FROM huertos WHERE IdHuerto=".$idtipo;
    $comando= mysqli_query($enlace, $r);
    mysqli_close($enlace);

    header("Location: ../Huertos.php");
?>