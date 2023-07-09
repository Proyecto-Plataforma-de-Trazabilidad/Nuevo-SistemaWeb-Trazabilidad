<?php
include("../../conexion.php");

session_start();


if (isset($_SESSION['usuario'])) {
    $correo = $_SESSION['usuario'];
    //tipo de usuario
    $comando = mysqli_query($enlace, "SELECT U.IdUsuario FROM usuarios as U inner join tipousuario as T on U.IdtipoUsuario = T.Idtipousuario where U.Correo = '" . $correo . "'");
    $fila = mysqli_fetch_array($comando);
    $IdUsuario = $fila[0];
    mysqli_free_result($comando);

    function realizarConsulta($queryCorrecto){
        include("../../conexion.php");
        //echo $queryCorrecto;
        $comando = mysqli_query($enlace, $queryCorrecto);
        
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

    $queryExtraviado = "SELECT E.IdExtraviados, P.Nombre, E.TipoEnvaseVacio, E.CantidadPiezas, E.Aclaracion, E.fecha FROM extraviados as E inner join productores as P on E.IdProductor = P.IdProductor";
    if (isset($_POST['Opcion'])) {
        switch ($_POST['Opcion']) { 
            //Admin
            case 'ConsultaGeneral':
                realizarConsulta($queryExtraviado);
                break;
            case "ConsultaXFecha":
                $queryExtraviado = $queryExtraviado . " WHERE E.Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' ";
                realizarConsulta($queryExtraviado);
                break;
            //Productor
                case "ProductorConsultaGeneral":
                $queryExtraviado = $queryExtraviado . " WHERE P.IdProductor = " . $_POST['IdProdu'];
                realizarConsulta($queryExtraviado);
                break;
            case "ProductorConsultaXFecha":
                $queryExtraviado = $queryExtraviado . " WHERE P.IdProductor = " . $_POST['IdProdu'] ." AND E.Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' ";
                realizarConsulta($queryExtraviado);
                break;
        }  
    }

    mysqli_close($enlace);
} else {
    echo ('la variable de usuario no entro correctamente');
}





?>