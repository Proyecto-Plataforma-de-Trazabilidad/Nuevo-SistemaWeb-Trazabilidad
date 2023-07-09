<?php 
    include "../conexion.php";
    $idtipo=$_GET['id'];
    $r="DELETE FROM tipoquimico WHERE IdTipoQuimico=".$idtipo;
    $comando= mysqli_query($enlace, $r);
    mysqli_close($enlace);

    header("Location: ../TipoQuimico.php")
?>