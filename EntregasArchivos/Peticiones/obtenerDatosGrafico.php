<?php
include("../../conexion.php");
//verificar conexion
if ($enlace->connect_error) {
    //mandar mensaje y salir
    die("Conexion fallida: " . $enlace->connect_error);
} else { //si todo funciona correctamente

    if (isset($_POST['idContenedor'])) {
        $comando = mysqli_query($enlace, "SELECT Capacidad, CapacidadStatus FROM contenedores WHERE IdContenedor = ".$_POST['idContenedor'].";") or die(mysqli_error());
        if (mysqli_num_rows($comando) == 0) {          //Valida si hay registro en la db
            $contenedor = "Error al traer datos contenedor";
        }else {
            $fila = mysqli_fetch_array($comando);
            $contenedor = (object) [
                'Capacidad' => $fila[0],
                'Status' => $fila[1]
            ];
        }
        mysqli_free_result($comando);

        $datos = json_encode($contenedor);
        echo $datos;
    }

    if (isset($_POST['idProductor'])) {
        $comando = mysqli_query($enlace, "SELECT TotalPiezasOrden, TotalPiezasEntregadas FROM productores WHERE IdProductor = ".$_POST['idProductor'].";") or die(mysqli_error());
        if (mysqli_num_rows($comando) == 0) {          //Valida si hay registro en la db
            $productor = "Error al traer piezas orden";
        }else {
            $fila = mysqli_fetch_array($comando);
            $productor = (object) [
                'TotalPiezasOrden' => $fila[0],
                'TotalPiezasEntregadas' => $fila[1]
            ];
        }
        mysqli_free_result($comando);

        $datos = json_encode($productor);
        echo $datos;
    }

    mysqli_close($enlace);
}
?>