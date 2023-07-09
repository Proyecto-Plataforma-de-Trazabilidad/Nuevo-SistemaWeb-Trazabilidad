<?php
    include "../conexion.php";

    $iduser =(isset($_POST['iduser'])) ? $_POST['iduser'] : '';
    $nuevapsw =(isset($_POST['nuevapsw'])) ? $_POST['nuevapsw'] : '';
    $reppsw =(isset($_POST['reppsw'])) ? $_POST['reppsw'] : '';

    $nnn = $nuevapsw;
    $rrr = $reppsw;


    if (strcmp($nnn, $rrr) === 0) {
        $consulta = "UPDATE usuarios set Contrasena= MD5('$nuevapsw') where IdUsuario = $iduser";
        $resultado = mysqli_query($enlace, $consulta);
    } 
    else{
        $dato= null;
    }

    print json_encode($dato);

    mysqli_close($enlace);

?>