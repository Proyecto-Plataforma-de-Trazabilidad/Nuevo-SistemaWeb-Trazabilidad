<?php
    include("../../conexion.php");

    session_start();

    $comando = mysqli_query($enlace, "SELECT count(*) from ordenproductos");
    $fila = mysqli_fetch_array($comando);
    $row =  $fila[0] + 1;
    mysqli_free_result($comando);

    $comando = mysqli_query($enlace, "SELECT * from tipoquimico");
    if (mysqli_num_rows($comando) == 0) {          //Valida si hay tipos de químico registrados en la db
        $quimicos = "No hay quimicos";
    }else {
        while($fila = mysqli_fetch_array($comando)){
            $quimicos[] = array(
                'IdTipo' => $fila[0],
                'Concepto' => $fila[1]
            );
        }
    }    
    mysqli_free_result($comando);

    $comando = mysqli_query($enlace, "SELECT * FROM productores") or die(mysqli_error());
    if (mysqli_num_rows($comando) == 0) {          //Valida si hay productores registrados en la db
        $productores = "No hay productores";
    }else {
        while($fila1 = mysqli_fetch_array($comando)){
            $productores[] = array(
                'IdProductor' => $fila1[0],
                'Nombre' => $fila1[1]
            );
        }
    }
    mysqli_free_result($comando);

    $comando = mysqli_query($enlace, "SELECT IdDistribuidor, Nombre FROM distribuidores WHERE  Correo = '".$_SESSION['usuario']."' ") or die(mysqli_error());
    if (mysqli_num_rows($comando) == 0) {  //Valida si hay distribuidores registrados en la db
        $nombreDistri = "No hay distribuidor";
        $idDistribu = "No hay distribuidor";
    }else{
        $filaDistri =  mysqli_fetch_array($comando);
        $idDistribu = $filaDistri[0];
        $nombreDistri = $filaDistri[1];
    }
    mysqli_free_result($comando);

    //Mando datos al front
    $datos = json_encode(array('orden' => $row, 'nomDristri' => $nombreDistri, 'quimicos' => $quimicos, 'produtores' => $productores, 'IdDistri' => $idDistribu));
    echo $datos;
    
    mysqli_close($enlace);
?>