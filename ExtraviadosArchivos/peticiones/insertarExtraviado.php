<?php
include("../../conexion.php"); //$enlace es la conexion a db

//verificar conexion
if ($enlace->connect_error) {
    //mandar mensaje y salir
    die("Conexion fallida: " . $enlace->connect_error);
} else { //si todo funciona correctamente

    //traer los datos ajax
    if (isset($_POST['extraviados'])) { //validar que se mando bien la opcion

        //Creación de directorios

        $tipo = $_POST['extraviados']['accion'];
        if ($tipo == "registrarExtraviados") {
            //Extraviados
            $prod = $_POST['extraviados']['idProd'];
            $tipoEnv = $_POST['extraviados']['tipoEnv'];
            $piezas = $_POST['extraviados']['piezas'];  
            $aclaracion = $_POST['extraviados']['aclaracion'];         
            $fecha = $_POST['extraviados']['fecha'];

            //desabilitar el autocommit
            mysqli_autocommit($enlace, false); // Deshabilitar el autocommit
            //iniciar con la transaccion
            $enlace->begin_transaction();
            try {
                //queryOrden idExtraviados, idProductor, TipoEnvaceVacio, CantidadPiezas, Aclaracion, fecha
                $registro = "INSERT INTO extraviados VALUES (null, $prod, '$tipoEnv', $piezas, '$aclaracion','$fecha')";
                //echo($registro);
                mysqli_query($enlace, $registro);
                
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
//volver activar el autocommit
mysqli_autocommit($enlace, false);

//cerrar conexion
mysqli_close($enlace);

?>