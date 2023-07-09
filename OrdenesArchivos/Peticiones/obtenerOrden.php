<?php

include("../../conexion.php");
session_start();

$comando = mysqli_query($enlace, "SELECT T.Descripcion FROM usuarios as U inner join tipousuario as T on U.IdtipoUsuario = T.Idtipousuario where U.Correo = '" . $_SESSION['usuario'] . "'");
$fila = mysqli_fetch_array($comando);
$tipoUser = $fila[0];
mysqli_free_result($comando);



if ($tipoUser == 'admin') {

    $queryOrden = "CALL OrdenConsulta('admin','" . $_POST['FI'] . "','" . $_POST['FF'] . "', '" . $_POST['IdProdu'] . "');";
    //echo $queryOrden;
    $comando = mysqli_query($enlace, $queryOrden);
    
    if (mysqli_num_rows($comando) == 0) {
        echo ("Error");
    } else {
        while ($datos = mysqli_fetch_assoc($comando)) {
            $consulta["data"][] = $datos;
        } 
        echo (json_encode($consulta));
    }
    mysqli_free_result($comando);
}elseif($tipoUser == 'Distribuidores'){

    $comando = mysqli_query($enlace, "SELECT IdDistribuidor FROM distribuidores WHERE  Correo = '".$_SESSION['usuario']."' ") or die(mysqli_error());
    $fila = mysqli_fetch_array($comando);
    $distribuidor = $fila[0];
    mysqli_free_result($comando);

    $queryOrden = "CALL OrdenConsulta('" . $distribuidor . "','" . $_POST['FI'] . "','" . $_POST['FF'] . "', '" . $_POST['IdProdu'] . "');";
    //echo $queryOrden;
    $comando = mysqli_query($enlace, $queryOrden);
    
    if (mysqli_num_rows($comando) == 0) {
        echo ("Error");
    } else {
        while ($datos = mysqli_fetch_assoc($comando)) {
            $consulta["data"][] = $datos;
        } 
        echo (json_encode($consulta));
    }
    mysqli_free_result($comando);

}elseif($tipoUser == 'Productores'){

    $queryOrden = "CALL OrdenConsulta('admin','" . $_POST['FI'] . "','" . $_POST['FF'] . "', '" . $_POST['IdProdu'] . "');";

    $comando = mysqli_query($enlace, $queryOrden);
    
    if (mysqli_num_rows($comando) == 0) {
        echo ("Error");
    } else {
        while ($datos = mysqli_fetch_assoc($comando)) {
            $consulta["data"][] = $datos;
        } 
        echo (json_encode($consulta));
    }
    mysqli_free_result($comando);

}

mysqli_close($enlace);

?>