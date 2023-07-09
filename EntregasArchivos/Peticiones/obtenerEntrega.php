<?php

include("../../conexion.php");
session_start();

$comando = mysqli_query($enlace, "SELECT T.Descripcion, U.IdUsuario FROM usuarios as U inner join tipousuario as T on U.IdtipoUsuario = T.Idtipousuario where U.Correo = '" . $_SESSION['usuario'] . "'");
$fila = mysqli_fetch_array($comando);
$tipoUser = $fila[0];
$IdUsuario = $fila[1];
mysqli_free_result($comando);

$queryEntrega = "SELECT E.IdEntrega, T.Descripcion AS 'TipoRecolector', U.Nombre AS 'NomRecolector', P.Nombre AS 'Productor', E.Recibo, E.ResponsableEntrega, E.ResponsableRecepcion, E.fecha FROM entregas AS E INNER JOIN productores AS P ON E.IdProductor=P.IdProductor INNER JOIN usuarios AS U ON E.IdUsuario=U.IdUsuario INNER JOIN tipousuario AS T ON T.Idtipousuario=U.Idtipousuario";
if (isset($_POST['Opcion'])) {
    switch ($_POST['Opcion']) { 
        //Admin
        case 'ConsultaGeneral':
            realizarConsulta($queryEntrega);
            break;
        case "ConsultaXFecha":
            $queryEntrega = $queryEntrega . " WHERE E.Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' ";
            realizarConsulta($queryEntrega);
            break;
        case "ConsultaXProductor":
            $queryEntrega = $queryEntrega . " WHERE E.IdProductor = '" . $_POST['IdProdu'] . "'";
            realizarConsulta($queryEntrega);
            break;
        case "ConsultaXFechaYProduct":
            $queryEntrega = $queryEntrega . " WHERE E.IdProductor = '" . $_POST['IdProdu'] . "' AND E.Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "'";
            realizarConsulta($queryEntrega);
            break; 
        case "ConsultaXTipos":
            $queryEntrega = $queryEntrega . " WHERE T.Descripcion = '" . $_POST['TipoRecol'] . "' ";
            realizarConsulta($queryEntrega);
            break; 
        case "ConsultaXTiposYFecha":
            $queryEntrega = $queryEntrega . " WHERE T.Descripcion = '" . $_POST['TipoRecol'] . "' AND E.Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "'";
            realizarConsulta($queryEntrega);
            break; 
        case "ConsultaXTiposProductor":
            $queryEntrega = $queryEntrega . " WHERE T.Descripcion = '" . $_POST['TipoRecol'] . "' AND E.IdProductor = '" . $_POST['IdProdu'] . "' ";
            realizarConsulta($queryEntrega);
            break; 
        case "ConsultaXTiposYFechaYProduct":
            $queryEntrega = $queryEntrega . " WHERE T.Descripcion = '" . $_POST['TipoRecol'] . "' AND E.IdProductor = '" . $_POST['IdProdu'] . "' AND E.Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "'";
            realizarConsulta($queryEntrega);
            break; 
        //Productor
        case "ProductorConsultaGeneral":
            $queryEntrega = $queryEntrega . " WHERE E.IdProductor = '" . $_POST['IdProdu'] . "'";
            realizarConsulta($queryEntrega);
            break;
        case "ProductorConsultaXFecha":
            $queryEntrega = $queryEntrega . " WHERE E.IdProductor = '" . $_POST['IdProdu'] . "' AND E.Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "'";
            realizarConsulta($queryEntrega);
            break;
    }
}


$queryEntrega2 = "SELECT E.IdEntrega, P.Nombre AS 'Productor', E.Recibo, E.ResponsableEntrega, E.ResponsableRecepcion, E.fecha FROM entregas AS E INNER JOIN productores AS P ON E.IdProductor=P.IdProductor INNER JOIN usuarios AS U ON E.IdUsuario=U.IdUsuario INNER JOIN tipousuario AS T ON T.Idtipousuario=U.Idtipousuario";
if (isset($_POST['Opcion2'])) {
    $opc = "";
    if (strpos($_POST['Opcion2'], 'ConsultaGeneral') !== false) 
        $opc = "ConsultaGeneral";
    else if (strpos($_POST['Opcion2'], 'ConsultaXFechaYProduct') !== false) 
        $opc = "ConsultaXFechaYProduct";
    else if (strpos($_POST['Opcion2'], 'ConsultaXProductor') !== false) 
        $opc = "ConsultaXProductor";
    else if (strpos($_POST['Opcion2'], 'ConsultaXFecha') !== false) 
        $opc = "ConsultaXFecha";    

    switch ($opc) {
        case "ConsultaGeneral":
            $queryEntrega2 = $queryEntrega2 . " WHERE U.IdUsuario = " . $IdUsuario;
            realizarConsulta($queryEntrega2);
            break;
        case "ConsultaXFecha":
            $queryEntrega2 = $queryEntrega2 . " WHERE U.IdUsuario = " . $IdUsuario . " AND E.Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "'";
            realizarConsulta($queryEntrega2);
            break;
        case "ConsultaXProductor":
            $queryEntrega2 = $queryEntrega2 . " WHERE U.IdUsuario = " . $IdUsuario . " AND E.IdProductor = '" . $_POST['IdProdu'] . "'";
            realizarConsulta($queryEntrega2);
            break;
        case "ConsultaXFechaYProduct":
            $queryEntrega2 = $queryEntrega2 . " WHERE U.IdUsuario = " . $IdUsuario . " AND E.IdProductor = '" . $_POST['IdProdu'] . "' AND E.Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "'";
            realizarConsulta($queryEntrega2);
            break; 
        default:
            # code...
            break;
    }
}

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

?>