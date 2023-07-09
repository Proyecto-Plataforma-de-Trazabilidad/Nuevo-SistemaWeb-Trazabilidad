<?php
include("../../conexion.php"); //$enlace es la conexion a db

//verificar conexion
if ($enlace->connect_error) {
    //mandar mensaje y salir
    die("Conexion fallida: " . $enlace->connect_error);
} else{//si todo funciona correctamente
    
    if ($_POST['orden']['NumOrden']) {

        $SiActualizo = false;

        $query = "UPDATE ordenproductos SET ";

        if ($_POST['orden']['idProd'] != "Selecciona un productor registrado") {
            //echo("Actualizo productor");
            $query = $query . " IdProductor = " . $_POST['orden']['idProd'] .",";
            $SiActualizo = true;
        }

        if ($_POST['orden']['NumFac'] != "") {
            //echo("Actualizo numero factura");
            $query = $query . " NumFactura = '" . $_POST['orden']['NumFac'] ."',";
            $SiActualizo = true;
        }
        if ($_POST['orden']['factura'] != "Faltante") {
            //echo("Actualizo factura");
            $query = $query . " Factura = '" . $_POST['orden']['factura'] ."',";
            $SiActualizo = true;
        }

        if ($_POST['orden']['numRec'] != "") {
            //echo("Actualizo numero receta");
            $query = $query . " NumReceta = '" . $_POST['orden']['numRec'] ."',";
            $SiActualizo = true;
        }

        if ($_POST['orden']['receta'] != "Faltante") {
            //echo("Actualizo receta");
            $query = $query . " Receta = '" . $_POST['orden']['receta'] ."',";
            $SiActualizo = true;
        }

        if (!$SiActualizo) {
            echo("No actualizo nada");
        }else{
            $query = trim($query, ',');
            $query = $query . " WHERE IdOrden = " . $_POST['orden']['NumOrden'];
            //echo $query;
            
            $comando = mysqli_query($enlace, $query);
            if ($comando) 
                echo("Correcto");
            else    
                echo("Error");
            //var_dump($comando);
        }
    }
}  


?>