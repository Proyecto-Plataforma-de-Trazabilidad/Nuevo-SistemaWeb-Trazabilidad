<?php

include("conexion.php");
session_start();

$comando = mysqli_query($enlace, "SELECT T.Descripcion, U.IdUsuario FROM usuarios as U inner join tipousuario as T on U.IdtipoUsuario = T.Idtipousuario where U.Correo = '" . $_SESSION['usuario'] . "'");
$fila = mysqli_fetch_array($comando);
$tipoUser = $fila[0];
$IdUsuario = $fila[1];
mysqli_free_result($comando);

$mensaje = ""; 
$data = "";
//Validación de acceso
if ($tipoUser == 'admin' ) {

}elseif($tipoUser == 'Distribuidores' && ($_POST['movi'] == 'ordenes' || $_POST['movi'] == 'entregas') ){
    $comando = mysqli_query($enlace, "SELECT IdDistribuidor FROM distribuidores WHERE Correo = '".$_SESSION['usuario']."' ") or die(mysqli_error());
    if (mysqli_num_rows($comando) == 0)   //Valida si hay distribuidores registrados en la db
        $mensaje ="NoHayDistribuidores";
    else
        $IdDistribuidor = mysqli_fetch_column($comando);   
    mysqli_free_result($comando);
}elseif($tipoUser == 'Productores' && ($_POST['movi'] == 'ordenes' || $_POST['movi'] == 'entregas' || $_POST['movi'] == 'extraviados')){
    $comando = mysqli_query($enlace, "SELECT IdProductor FROM productores WHERE Correo = '".$_SESSION['usuario']."' ") or die(mysqli_error());
    if (mysqli_num_rows($comando) == 0)   //Valida si hay distribuidores registrados en la db
        $mensaje ="NoHayProductores";
    else
        $IdProductor = mysqli_fetch_column($comando);      
    mysqli_free_result($comando);
}elseif($tipoUser == 'Empresa Recolectora' && $_POST['movi'] == 'entregas'){
    $comando = mysqli_query($enlace, "SELECT IdERP FROM empresarecolectoraprivada WHERE Correo = '".$_SESSION['usuario']."' ") or die(mysqli_error());
    if (mysqli_num_rows($comando) == 0)   //Valida si hay distribuidores registrados en la db
        $mensaje ="NoHayERP";
    mysqli_free_result($comando);
}elseif($tipoUser == 'Municipios' && $_POST['movi'] == 'entregas'){
    $comando = mysqli_query($enlace, "SELECT IdMunicipio FROM municipio WHERE Correo = '".$_SESSION['usuario']."' ") or die(mysqli_error());
    if (mysqli_num_rows($comando) == 0)   //Valida si hay distribuidores registrados en la db
        $mensaje ="NoHayMunicipio";
    mysqli_free_result($comando);
}elseif($tipoUser == 'CAT' && $_POST['movi'] == 'entregas'){
    $comando = mysqli_query($enlace, "SELECT IdCAT FROM centroacopiotemporal WHERE Correo = '".$_SESSION['usuario']."' ") or die(mysqli_error());
    if (mysqli_num_rows($comando) == 0)   //Valida si hay distribuidores registrados en la db
        $mensaje ="NoHayCAT";
    mysqli_free_result($comando);
}else{
    $mensaje ="UsuarioNoPermitido";
}



///////////////////////////////////////////////////////////////
$fechaCorrecta = false;

//Validación de fecha

if (($_POST['FI'] == "" && $_POST['FF'] != "") || ($_POST['FI'] != "" && $_POST['FF'] == "")) {
    $mensaje ="FechaNoValida";
}else if($_POST['FI'] != "" && $_POST['FF'] != ""){
    $fecha1 = new DateTime($_POST['FI']);
    $fecha2 = new DateTime($_POST['FF']);
    if ($fecha1 > $fecha2) 
        $mensaje ="FechaMayor";
    else {
        $fechaCorrecta = true;
    }
}

//!Usuario admin-----------------------------------------------
//Validación de consulta general
if ($tipoUser == 'admin' && $_POST['IdProdu'] == "" && $_POST['FF'] == "" && $_POST['FI'] == "") {
   
    switch ($_POST['movi']) {
        case 'ordenes':
                $queryOrden = "SELECT * FROM ordenproductos LIMIT 1;";
            break;
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas LIMIT 1;";
            break;
        case 'extraviados':
                $queryOrden = "SELECT * FROM extraviados LIMIT 1;";
            break;
        case 'salidas':
            $queryOrden = "SELECT * FROM salidas LIMIT 1;";
        break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje ="NoHayDatos";
    else 
        $mensaje ="ConsultaGeneral";

    mysqli_free_result($comando);
}
//Validación de consulta por fecha
if ($tipoUser == 'admin' && $fechaCorrecta && $_POST['IdProdu'] == "") {
    switch ($_POST['movi']) {
        case 'ordenes':
                $queryOrden = "SELECT * FROM ordenproductos WHERE Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        case 'extraviados':
                $queryOrden = "SELECT * FROM extraviados WHERE Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        case 'salidas':
                $queryOrden = "SELECT * FROM salidas WHERE fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
        break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje ="NoHayDatos";
    else 
        $mensaje ="ConsultaXFecha";

    mysqli_free_result($comando);
}

//Validación de consulta a productor
if ($tipoUser == 'admin' && $_POST['IdProdu'] != "" && ($_POST['FI'] == "" && $_POST['FF'] == "")) {
    switch ($_POST['movi']) {
        case 'ordenes':
                $queryOrden = "SELECT * FROM ordenproductos WHERE IdProductor = '" . $_POST['IdProdu'] . "' LIMIT 1;";
            break;
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE IdProductor = '" . $_POST['IdProdu'] . "' LIMIT 1;";
            break;
        case 'extraviados':
                $queryOrden = "SELECT * FROM extraviados WHERE IdProductor = '" . $_POST['IdProdu'] . "' LIMIT 1;";
            break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje ="NoHayDatos";
    else 
        $mensaje ="ConsultaXProductor";
    mysqli_free_result($comando);
}

//Validación de consulta por fecha y productor
if ($tipoUser == 'admin' && $_POST['IdProdu'] != "" && $fechaCorrecta ) {
    switch ($_POST['movi']) {
        case 'ordenes':
                $queryOrden = "SELECT * FROM ordenproductos WHERE IdProductor = '" . $_POST['IdProdu'] . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE IdProductor = '" . $_POST['IdProdu'] . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        case 'extraviados':
                $queryOrden = "SELECT * FROM extraviados WHERE IdProductor = '" . $_POST['IdProdu'] . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje ="NoHayDatos";
    else 
        $mensaje = "ConsultaXFechaYProduct";
    mysqli_free_result($comando);
}
   //*Nuevas validaciones de tipo de recolector
if ($tipoUser == 'admin' && $_POST['IdTipo'] != "" && $_POST['IdProdu'] == "" && $_POST['FF'] == "" && $_POST['FI'] == "") {
    switch ($_POST['movi']) {
        case 'entregas':
                $queryOrden = "SELECT E.IdEntrega FROM entregas AS E INNER JOIN usuarios AS U ON E.IdUsuario=U.IdUsuario INNER JOIN tipousuario AS T ON T.Idtipousuario=U.Idtipousuario WHERE T.Descripcion = '" . $_POST['IdTipo'] . "' LIMIT 1;";
            break;
        case 'salidas':
            $queryOrden = "SELECT S.IdSalida FROM salidas AS S INNER JOIN usuarios AS U ON S.IdUsuario=U.IdUsuario INNER JOIN tipousuario AS T ON T.Idtipousuario=U.Idtipousuario WHERE T.Descripcion = '" . $_POST['IdTipo'] . "' LIMIT 1;";
        break;
        default:
            break;
    }
    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje ="NoHayDatos";
    else 
        $mensaje ="ConsultaXTipos";

    mysqli_free_result($comando);
}

//Validación de consulta por fecha y tipos
if ($tipoUser == 'admin' && $_POST['IdTipo'] != "" && $fechaCorrecta && $_POST['IdProdu'] == "") {
   
    switch ($_POST['movi']) {
        case 'entregas':
                $queryOrden = "SELECT E.IdEntrega FROM entregas AS E INNER JOIN usuarios AS U ON E.IdUsuario=U.IdUsuario INNER JOIN tipousuario AS T ON T.Idtipousuario=U.Idtipousuario WHERE T.Descripcion = '" . $_POST['IdTipo'] . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        case 'salidas':
                $queryOrden = "SELECT S.IdSalida FROM salidas AS S INNER JOIN usuarios AS U ON S.IdUsuario=U.IdUsuario INNER JOIN tipousuario AS T ON T.Idtipousuario=U.Idtipousuario WHERE T.Descripcion = '" . $_POST['IdTipo'] . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
        break;    
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje ="NoHayDatos";
    else 
        $mensaje ="ConsultaXTiposYFecha";

    mysqli_free_result($comando);
}

//Validación de consulta a productor y tipos
if ($tipoUser == 'admin' && $_POST['IdTipo'] != "" && $_POST['IdProdu'] != "" && ($_POST['FI'] == "" && $_POST['FF'] == "")) {
    switch ($_POST['movi']) {
        case 'entregas':
                $queryOrden = "SELECT E.IdEntrega FROM entregas AS E INNER JOIN usuarios AS U ON E.IdUsuario=U.IdUsuario INNER JOIN tipousuario AS T ON T.Idtipousuario=U.Idtipousuario WHERE T.Descripcion = '" . $_POST['IdTipo'] . "' AND IdProductor = '" . $_POST['IdProdu'] . "' LIMIT 1;";
            break;

        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje ="NoHayDatos";
    else 
        $mensaje ="ConsultaXTiposProductor";
    mysqli_free_result($comando);
}
//Validación de consulta por fecha y productor y tipos
if ($tipoUser == 'admin' && $_POST['IdTipo'] != "" && $_POST['IdProdu'] != "" && $fechaCorrecta ) {
    switch ($_POST['movi']) {
        case 'entregas':
                $queryOrden = "SELECT E.IdEntrega FROM entregas AS E INNER JOIN usuarios AS U ON E.IdUsuario=U.IdUsuario INNER JOIN tipousuario AS T ON T.Idtipousuario=U.Idtipousuario WHERE T.Descripcion = '" . $_POST['IdTipo'] . "' AND IdProductor = '" . $_POST['IdProdu'] . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje ="NoHayDatos";
    else 
        $mensaje = "ConsultaXTiposYFechaYProduct";
    mysqli_free_result($comando);
}


///!Usuario productor----------------
if ($tipoUser == 'Productores' && $_POST['FF'] == "" && $_POST['FI'] == "") {
//Consulta general del productor
    switch ($_POST['movi']) {
        case 'ordenes':
                $queryOrden = "SELECT * FROM ordenproductos WHERE IdProductor = '" . $IdProductor . "' LIMIT 1;";
            break;
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE IdProductor = '" . $IdProductor . "' LIMIT 1;";
            break;
        case 'extraviados':
                $queryOrden = "SELECT * FROM extraviados WHERE IdProductor = '" . $IdProductor . "' LIMIT 1;";
            break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje ="ProductorNoHayDatos";
    else{
        $mensaje ="ProductorConsultaGeneral";
        $data = $IdProductor;
    }
        

    mysqli_free_result($comando);
}elseif ($tipoUser == 'Productores' && $fechaCorrecta ) { 
//Consulta por fecha 
    switch ($_POST['movi']) {
        case 'ordenes':
                $queryOrden = "SELECT * FROM ordenproductos WHERE IdProductor = '" . $IdProductor . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE IdProductor = '" . $IdProductor . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        case 'extraviados':
                $queryOrden = "SELECT * FROM extraviados WHERE IdProductor = '" . $IdProductor . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje = "ProductorNoHayDatos";
    else {
        $mensaje = "ProductorConsultaXFecha";
        $data = $IdProductor;
    }
    mysqli_free_result($comando);
}

//!Usuario Distribuidor----------------
//Consulta general 
if ($tipoUser == 'Distribuidores' && $_POST['IdProdu'] == "" && $_POST['FF'] == "" && $_POST['FI'] == "") {

    switch ($_POST['movi']) {
        case 'ordenes':
                $queryOrden = "SELECT * FROM ordenproductos WHERE IdDistribuidor = '" . $IdDistribuidor . "' LIMIT 1;";
            break;
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE IdUsuario = '" . $IdUsuario . "' LIMIT 1;";
            break;
        case 'salidas':
            $queryOrden = "SELECT * FROM salidas WHERE IdUsuario = '" . $IdUsuario . "' LIMIT 1;";
        break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje ="DistribuidorNoHayDatos";
    else
        $mensaje ="DistribuidorConsultaGeneral";

    mysqli_free_result($comando);
}elseif ($tipoUser == 'Distribuidores' && $fechaCorrecta && $_POST['IdProdu'] == "") { //Validación de consulta por fecha 
    switch ($_POST['movi']) {
        case 'ordenes':
                $queryOrden = "SELECT * FROM ordenproductos WHERE IdDistribuidor = '" . $IdDistribuidor . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE IdUsuario = '" . $IdUsuario . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        case 'salidas':
            $queryOrden = "SELECT * FROM salidas WHERE IdUsuario = '" . $IdUsuario . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
        break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje = "DistribuidorNoHayDatos";
    else 
        $mensaje = "DistribuidorConsultaXFecha";

    mysqli_free_result($comando);
}elseif ($tipoUser == 'Distribuidores' && $_POST['IdProdu'] != "" && ($_POST['FI'] == "" && $_POST['FF'] == "")) { //Validación de consulta a productor
    switch ($_POST['movi']) {
        case 'ordenes':
                $queryOrden = "SELECT * FROM ordenproductos WHERE IdDistribuidor = '" . $IdDistribuidor . "' AND IdProductor = '" . $_POST['IdProdu'] . "' LIMIT 1;";
            break;
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE IdUsuario = '" . $IdUsuario . "' AND IdProductor = '" . $_POST['IdProdu'] . "' LIMIT 1;";
            break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje ="DistribuidorNoHayDatos";
    else 
        $mensaje ="DistribuidorConsultaXProductor";
    mysqli_free_result($comando);
}elseif ($tipoUser == 'Distribuidores' && $_POST['IdProdu'] != "" && $fechaCorrecta) { //Validación de consulta por fecha y productor
    switch ($_POST['movi']) {
        case 'ordenes':
                $queryOrden = "SELECT * FROM ordenproductos WHERE IdDistribuidor = '" . $IdDistribuidor . "' AND IdProductor = '" . $_POST['IdProdu'] . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE IdUsuario = '" . $IdUsuario . "' AND IdProductor = '" . $_POST['IdProdu'] . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje ="DistribuidorNoHayDatos";
    else 
        $mensaje = "DistribuidorConsultaXFechaYProduct";
    mysqli_free_result($comando);
}

//!Usuario Municipio---------------- 
//Consulta general 
if ($tipoUser == 'Municipios'  && $_POST['IdProdu'] == "" && $_POST['FF'] == "" && $_POST['FI'] == "") {

    switch ($_POST['movi']) {
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE IdUsuario = '" . $IdUsuario . "' LIMIT 1;";
            break;
        case 'salidas':
            $queryOrden = "SELECT * FROM salidas WHERE IdUsuario = '" . $IdUsuario . "' LIMIT 1;";
        break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje ="MunicipioNoHayDatos";
    else
        $mensaje ="MunicipioConsultaGeneral";

    mysqli_free_result($comando);
}elseif ($tipoUser == 'Municipios' && $fechaCorrecta && $_POST['IdProdu'] == "") { //Validación de consulta por fecha 
    switch ($_POST['movi']) {
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE IdUsuario = '" . $IdUsuario . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        case 'salidas':
            $queryOrden = "SELECT * FROM salidas WHERE IdUsuario = '" . $IdUsuario . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
        break;
        default:
            break;
    }
    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje = "MunicipioNoHayDatos";
    else 
        $mensaje = "MunicipioConsultaXFecha";

    mysqli_free_result($comando);
}elseif ($tipoUser == 'Municipios' && $_POST['IdProdu'] != "" && ($_POST['FI'] == "" && $_POST['FF'] == "")) { //Validación de consulta a productor
    switch ($_POST['movi']) {
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE IdUsuario = '" . $IdUsuario . "' AND IdProductor = '" . $_POST['IdProdu'] . "' LIMIT 1;";
            break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje ="MunicipioNoHayDatos";
    else 
        $mensaje ="MunicipioConsultaXProductor";
    mysqli_free_result($comando);
}elseif ($tipoUser == 'Municipios' && $_POST['IdProdu'] != "" && $fechaCorrecta) { //Validación de consulta por fecha y productor
    switch ($_POST['movi']) {
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE IdUsuario = '" . $IdUsuario . "' AND IdProductor = '" . $_POST['IdProdu'] . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje ="MunicipioNoHayDatos";
    else 
        $mensaje = "MunicipioConsultaXFechaYProduct";
    mysqli_free_result($comando);
}
//!Usuario Empresa Recolectora---------------- 
//Consulta general 
if ($tipoUser == 'Empresa Recolectora'  && $_POST['IdProdu'] == "" && $_POST['FF'] == "" && $_POST['FI'] == "") {

    switch ($_POST['movi']) {
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE IdUsuario = '" . $IdUsuario . "' LIMIT 1;";
            break;
        case 'salidas':
            $queryOrden = "SELECT * FROM salidas WHERE IdUsuario = '" . $IdUsuario . "' LIMIT 1;";
        break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje ="ERPNoHayDatos";
    else
        $mensaje ="ERPConsultaGeneral";

    mysqli_free_result($comando);
}elseif ($tipoUser == 'Empresa Recolectora' && $fechaCorrecta && $_POST['IdProdu'] == "") { //Validación de consulta por fecha 
    switch ($_POST['movi']) {
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE IdUsuario = '" . $IdUsuario . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        case 'salidas':
            $queryOrden = "SELECT * FROM salidas WHERE IdUsuario = '" . $IdUsuario . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
        break;
        default:
            break;
    }
    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje = "ERPNoHayDatos";
    else 
        $mensaje = "ERPConsultaXFecha";

    mysqli_free_result($comando);
}elseif ($tipoUser == 'Empresa Recolectora' && $_POST['IdProdu'] != "" && ($_POST['FI'] == "" && $_POST['FF'] == "")) { //Validación de consulta a productor
    switch ($_POST['movi']) {
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE IdUsuario = '" . $IdUsuario . "' AND IdProductor = '" . $_POST['IdProdu'] . "' LIMIT 1;";
            break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje ="ERPNoHayDatos";
    else 
        $mensaje ="ERPConsultaXProductor";
    mysqli_free_result($comando);
}elseif ($tipoUser == 'Empresa Recolectora' && $_POST['IdProdu'] != "" && $fechaCorrecta) { //Validación de consulta por fecha y productor
    switch ($_POST['movi']) {
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE IdUsuario = '" . $IdUsuario . "' AND IdProductor = '" . $_POST['IdProdu'] . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        $mensaje ="ERPNoHayDatos";
    else 
        $mensaje = "ERPConsultaXFechaYProduct";
    mysqli_free_result($comando);
}

//?Mando datos al front
$datos = json_encode(array('mensaje' => $mensaje, 'data' => $data));
echo $datos;

mysqli_close($enlace);

?>