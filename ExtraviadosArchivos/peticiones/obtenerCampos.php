<?php
    include("../../conexion.php");

    session_start();

    $comando = mysqli_query($enlace, "SELECT count(*) from extraviados");
    $fila = mysqli_fetch_array($comando);
    $row =  $fila[0] + 1;
    mysqli_free_result($comando);

    //productor
    $comando = mysqli_query($enlace, "SELECT IdProductor, Nombre FROM productores WHERE  Correo = '".$_SESSION['usuario']."' ") or die(mysqli_error());
    if (mysqli_num_rows($comando) == 0) {  //Valida si hay productores registrados en la db
        $nombreProductor = "No hay Productor";
        $idProductor = "No hay Productor";
    }else{
        $filaProd =  mysqli_fetch_array($comando);
        $idProductor = $filaProd[0];
        $nombreProductor = $filaProd[1];
    }
    mysqli_free_result($comando);

    //Mando datos al front
    $datos = json_encode(array('extraviados' => $row , 'idProduc' => $idProductor, 'nomProduc' => $nombreProductor ));

    echo $datos;

    mysqli_close($enlace);

?>