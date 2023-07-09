<?php
include("../../conexion.php"); //$enlace es la conexion a db

//verificar conexion
if ($enlace->connect_error) {
    //mandar mensaje y salir
    die("Conexion fallida: " . $enlace->connect_error);
} else { //si todo funciona correctamente

    //traer los datos ajax
    if (isset($_POST['orden'])) { //validar que se mando bien la orden
        if (isset($_POST['detalle'])) { //validar que se mando bien el detalle

            //Creación de directorios

            $tipo = $_POST['orden']['accion'];
            if ($tipo == "registrarOrden") {
                //orden
                $dis = $_POST['orden']['idDis'];
                $prod = $_POST['orden']['idProd'];
                $numFac = $_POST['orden']['NumFac'];
                $factura = $_POST['orden']['factura'];
                $numRec = $_POST['orden']['numRec'];
                $receta = $_POST['orden']['receta'];
                $fecha = $_POST['orden']['fecha'];

                //desabilitar el autocommit
                mysqli_autocommit($enlace, false); // Deshabilitar el autocommit
                //iniciar con la transaccion
                $enlace->begin_transaction();
                try {
                    //queryOrden num, idDistri, idProduc, numFact, Factura, NumReceta, Receta, fecha
                    $orden = "INSERT INTO ordenproductos VALUES (null, $dis, $prod, '$numFac', '$factura', '$numRec', '$receta', '$fecha')";
                    //echo($orden);
                    mysqli_query($enlace, $orden);

                    //ciclo con el tamaño del arreglo de detalle ordenes
                    $detalle = $_POST['detalle'];
                    foreach($detalle as $t){
                        //query detalle orden                      idOrden, Consecutivo, IdQuimico, tipoEnvase, Color, Cantidad Piezas
                        $detalle = "INSERT INTO detalleorden VALUES (" . $t['idOrden'] . "," . $t['consecutivo'] . "," . $t['idquimico'] . ",'" . $t['tipoEnvase'] . "','" . $t['color'] . "'," . $t['piezas'] . ")";
                        //echo($detalle);
                        mysqli_query($enlace, $detalle);                        
                        //query de actualizar numero de envases al productor
                        $productor = "UPDATE productores SET TotalPiezasOrden = TotalPiezasOrden + " . $t['piezas'] . " WHERE IdProductor = " . $prod;
                        //echo($productor);
                        mysqli_query($enlace, $productor);
                    }
                    //ejecutar transaccion
                    $enlace->commit();

                    //mandar response 
                    echo ("correcto");

                } catch (Exception $ex) {
                    $enlace->rollback();
                    // Manejar la excepción
                    echo "Error: " . $ex->getMessage();
                }
            }
        }

    }
}
//volver activar el autocommit
mysqli_autocommit($enlace, false);

//cerrar conexion
mysqli_close($enlace);

?>