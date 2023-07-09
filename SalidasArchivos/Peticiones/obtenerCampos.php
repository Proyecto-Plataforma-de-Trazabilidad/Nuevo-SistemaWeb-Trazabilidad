<?php
include("../../conexion.php");

//verificar conexion
if ($enlace->connect_error) {
    //mandar mensaje y salir
    die("Conexion fallida: " . $enlace->connect_error);
} else {
    session_start();

    $comando = mysqli_query($enlace, "SELECT count(*) from salidas");
    $fila = mysqli_fetch_array($comando);
    $row = $fila[0] + 1;
    mysqli_free_result($comando);


    //RECOLECTOR 
    $comando = mysqli_query($enlace, "SELECT T.Descripcion, U.Nombre, U.IdUsuario FROM usuarios as U inner join tipousuario as T on U.IdtipoUsuario = T.Idtipousuario where U.Correo = '" . $_SESSION['usuario'] . "'");
    $fila = mysqli_fetch_array($comando);
    $tipoRecolec = $fila[0];
    $nombreRecolec = $fila[1];
    $idRecolector = $fila[2];
    mysqli_free_result($comando);
    $mensaje = "TodoCorrecto";

    //Validaciones de recolector
    switch ($tipoRecolec) {
        case 'Distribuidores':
            $comando = mysqli_query($enlace, "SELECT Nombre FROM distribuidores WHERE Correo = '" . $_SESSION['usuario'] . "' ") or die(mysqli_error());
            if (mysqli_num_rows($comando) == 0)
                $mensaje = "NoHayDistribuidores";
            else {
                $fila = mysqli_fetch_array($comando);
                $ValidarNomRecole = $fila[0];
                if ($ValidarNomRecole != $nombreRecolec)
                    $mensaje = "RecoleUsuarioNoValido";
            }
            mysqli_free_result($comando);
            break;
        case 'Empresa Recolectora':
            $comando = mysqli_query($enlace, "SELECT Nombre FROM empresarecolectoraprivada WHERE Correo = '" . $_SESSION['usuario'] . "' ") or die(mysqli_error());
            if (mysqli_num_rows($comando) == 0) //Valida si hay distribuidores registrados en la db
                $mensaje = "NoHayERP";
            else {
                $fila = mysqli_fetch_array($comando);
                $ValidarNomRecole = $fila[0];
                if ($ValidarNomRecole != $nombreRecolec)
                    $mensaje = "RecoleUsuarioNoValido";
            }
            mysqli_free_result($comando);
            break;
        case 'Municipios':
            $comando = mysqli_query($enlace, "SELECT NombreLugar FROM municipio WHERE Correo = '" . $_SESSION['usuario'] . "' ") or die(mysqli_error());
            if (mysqli_num_rows($comando) == 0) //Valida si hay distribuidores registrados en la db
                $mensaje = "NoHayMunicipio";
            else {
                $fila = mysqli_fetch_array($comando);
                $ValidarNomRecole = $fila[0];
                if ($ValidarNomRecole != $nombreRecolec)
                    $mensaje = "RecoleUsuarioNoValido";        
            }
            mysqli_free_result($comando);
            break;
        default:
            $mensaje = "UsuarioNoPermitido";
            break;
    }

    //Búsqueda de contenedores
    $contenedores = [];
    if ($mensaje != "RecoleUsuarioNoValido" && $mensaje != "UsuarioNoPermitido") {
        $comando = mysqli_query($enlace, "SELECT * FROM contenedores WHERE IdUsuario = ".$idRecolector.";") or die(mysqli_error());
        if (mysqli_num_rows($comando) == 0) {          //Valida si hay contenedores registrados en la db
            $contenedores[] = "No hay contenedores";
        }else {
            while($fila1 = mysqli_fetch_array($comando)){
                $contenedores[] = array(
                    'IdContenedor' => $fila1[0],
                    'Descripcion' => $fila1[5],
                );
            }
        }
        mysqli_free_result($comando);
    }

    //Mando datos al front
    $datos = json_encode(array('numSalidas' => $row, 'idRec' => $idRecolector, 'nomRec' => $nombreRecolec, 'contenedores' => $contenedores, 'mensaje' => $mensaje));

    echo $datos;

    mysqli_close($enlace);
}

?>