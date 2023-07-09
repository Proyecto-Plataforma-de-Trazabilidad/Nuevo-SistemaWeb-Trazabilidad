<?php
include("../../conexion.php"); //$enlace es la conexion a db
session_start();

//verificar conexion
if ($enlace->connect_error) {
    //mandar mensaje y salir
    die("Conexion fallida: " . $enlace->connect_error);
} else { //si todo funciona correctamente

    $comando = mysqli_query($enlace, "SELECT IdUsuario FROM usuarios where Correo = '" . $_SESSION['usuario'] . "'");
    $fila = mysqli_fetch_array($comando);
    $User = $fila[0];
    mysqli_free_result($comando);

    $IdProductor = $_POST['entrega']['idProduc'];
    $IdUsuario = $User;
    $IdContenedor = $_POST['entrega']['idContenedor'];
    $ResponsaEntrega = $_POST['entrega']['nomResEntrega'];
    $ResponsaRecepcion = $_POST['entrega']['nomResRecibe'];
    $Recibo = $_POST['entrega']['recibo'];
    $Fecha = $_POST['entrega']['fecha'];

    //desabilitar el autocommit
    mysqli_autocommit($enlace, false); // Deshabilitar el autocommit
    //iniciar con la transaccion
    $enlace->begin_transaction();
    try {
        $entrega = "INSERT INTO entregas VALUES (null, $IdProductor, $IdUsuario, $IdContenedor, '$ResponsaEntrega','$ResponsaRecepcion','$Recibo','$Fecha')";
        //echo $entrega;
        mysqli_query($enlace, $entrega);

        //ciclo con el tamaño del arreglo de detalle entrega
        $detalle = $_POST['detalle'];
        foreach($detalle as $t){
            $peso = 0;
            if ($t['peso'] != "") 
                $peso = $t['peso'];
            
            //query detalle orden                      IdEntrega, Consecutivo, IdQuimico, tipoEnvase, Color, Cantidad Piezas
            $detalle = "INSERT INTO detalleentrega VALUES (" . $t['idEntrega'] . "," . $t['consecutivo'] . ",'" . $t['tipoEnvase'] . "'," . $t['cantidad'] . "," . $peso . ",'" . $t['observa'] . "')";
            //echo($detalle);
            mysqli_query($enlace, $detalle);                        
            //query de actualizar numero de piezas entregadas al productor
            $productor = "UPDATE productores SET TotalPiezasEntregadas = TotalPiezasEntregadas + " . $t['cantidad'] . " WHERE IdProductor = " . $IdProductor;
            //echo($productor); 
            mysqli_query($enlace, $productor);
            //query de actualizar el estatus del contenedor
            $queryContenedor = "UPDATE contenedores SET CapacidadStatus = CapacidadStatus + " . $t['cantidad'] . " WHERE IdUsuario = ". $IdUsuario;
            mysqli_query($enlace, $queryContenedor);
        }

        //ejecutar transacción
        $enlace->commit();

        //mandar response 
        echo ("correcto");

    } catch (Exception $ex) {
        $enlace->rollback();
        // Manejar la excepción
        echo "Error: " . $ex->getMessage();
    }
}
//volver activar el autocommit
mysqli_autocommit($enlace, false);

//cerrar conexion
mysqli_close($enlace);

?>