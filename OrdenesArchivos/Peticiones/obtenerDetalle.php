<?php

include("../../conexion.php");
if ($_POST['IdOrden']) {

    $comando = mysqli_query($enlace, "select * from detalleorden where IdOrden = ".$_POST['IdOrden']);
    if(!$comando) {
        die("Error");
    }else{
        while ($datos = mysqli_fetch_assoc($comando)) {
            $consultaOrden["data"][] = $datos;
        }
        
         echo json_encode($consultaOrden);
    }
    mysqli_free_result($comando);
}
mysqli_close($enlace);

?>