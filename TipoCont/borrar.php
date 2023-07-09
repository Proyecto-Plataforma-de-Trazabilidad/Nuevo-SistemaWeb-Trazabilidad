<?php 
    include "conexion.php";
    $idtipo=$_GET['id'];
    $r="Delete from tipocontenedor where idTipoCont=".$idtipo;
    $comando= mysqli_query($enlace, $r);
    mysqli_close($enlace);

    header("Location: ../TiposCont.php")
?>