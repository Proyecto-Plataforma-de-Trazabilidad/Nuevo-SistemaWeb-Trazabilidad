<?php
include("../../conexion.php");

session_start();


if (isset($_SESSION['usuario'])) {
    //tipo de usuario
    $comando = mysqli_query($enlace, "SELECT U.IdUsuario FROM usuarios as U inner join tipousuario as T on U.IdtipoUsuario = T.Idtipousuario where U.Correo = '" . $_SESSION['usuario'] . "'");
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
    
    $querySalidas = "SELECT S.IdSalida, C.Origen, U.Nombre, S.Responsable, S.Cantidad, S.fecha FROM salidas AS S INNER JOIN contenedores AS C ON S.IdContenedor= C.IdContenedor INNER JOIN usuarios AS U ON S.IdUsuario=U.IdUsuario INNER JOIN tipousuario AS T ON T.Idtipousuario=U.Idtipousuario";
    if (isset($_POST['Opcion'])) {
        switch ($_POST['Opcion']) { 
            //Admin
            case 'ConsultaGeneral':
                realizarConsulta($querySalidas);
                break;
            case "ConsultaXFecha":
                $querySalidas = $querySalidas . " WHERE S.Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' ";
                realizarConsulta($querySalidas);
                break;
            case "ConsultaXTipos":
                $querySalidas = $querySalidas . " WHERE T.Descripcion = '" . $_POST['TipoRecol'] . "' ";
                realizarConsulta($querySalidas);
                break; 
            case "ConsultaXTiposYFecha":
                $querySalidas = $querySalidas . " WHERE T.Descripcion = '" . $_POST['TipoRecol'] . "' AND S.Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "'";
                realizarConsulta($querySalidas);
                break; 

        }  
    }

    $querySalidas2 = "SELECT S.IdSalida, C.Origen, S.Responsable, S.Cantidad, S.fecha FROM salidas as S inner join contenedores as C on S.IdContenedor= C.IdContenedor inner join usuarios as U on S.IdUsuario = U.IdUsuario";
    if (isset($_POST['Opcion2'])) {
        $opc = "";
        if (strpos($_POST['Opcion2'], 'ConsultaGeneral') !== false) 
            $opc = "ConsultaGeneral";
        else if (strpos($_POST['Opcion2'], 'ConsultaXFecha') !== false) 
            $opc = "ConsultaXFecha";
            
        switch ($opc) {
            case "ConsultaGeneral":
                $querySalidas2 = $querySalidas2 . " WHERE U.IdUsuario = " . $IdUsuario;
                realizarConsulta($querySalidas2);
                break;
            case "ConsultaXFecha":
                $querySalidas2 = $querySalidas2 . " WHERE U.IdUsuario = " . $IdUsuario . " AND S.Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "'";
                realizarConsulta($querySalidas2);
                break;
            default:
                break;
        }
    }


    mysqli_close($enlace);
} else {
    echo ('la variable de usuario no entro correctamente');
}

?>