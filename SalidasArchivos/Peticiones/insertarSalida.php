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
    $IdUsuario = $fila[0];
    mysqli_free_result($comando);

    //traer los datos ajax
    if (isset($_POST['salidas'])) { //validar que se mando bien la opcion

        //Creación de directorios

        $tipo = $_POST['salidas']['accion'];
        if ($tipo == "registrarSalidas") {
            //Extraviados
            $recolector = $_POST['salidas']['idRec'];
            $contenedor = $_POST['salidas']['Contenedor'];
            $responsable = $_POST['salidas']['Responsable'];  
            $peso = $_POST['salidas']['peso'];         
            $fecha = $_POST['salidas']['fecha'];

            //desabilitar el autocommit
            mysqli_autocommit($enlace, false); // Deshabilitar el autocommit
            //iniciar con la transaccion
            $enlace->begin_transaction();
            try {
                //querySalidas
                $registro = "INSERT INTO salidas VALUES (null, $contenedor, $recolector, '$responsable', $peso , '$fecha')";
                //echo($registro);
                mysqli_query($enlace, $registro);
                
                //query de actualizar el estatus del contenedor
                $queryContenedor = "UPDATE contenedores SET CapacidadStatus = CapacidadStatus - " . $_POST['salidas']['peso'] . " WHERE IdUsuario = ". $IdUsuario;
                mysqli_query($enlace, $queryContenedor);
                
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