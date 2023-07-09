<?php

include("../../conexion.php");
if ($_POST['IdEntrega']) {

    $comando = mysqli_query($enlace, "select * from detalleentrega where IdEntrega = ".$_POST['IdEntrega']);
    if(!$comando) {
        die("Error");
    }else{
        while ($datos = mysqli_fetch_assoc($comando)) {
            $consultaEntrega["data"][] = $datos;
        }
        
         echo json_encode($consultaEntrega);
    }
    mysqli_free_result($comando);
}
mysqli_close($enlace);

?>