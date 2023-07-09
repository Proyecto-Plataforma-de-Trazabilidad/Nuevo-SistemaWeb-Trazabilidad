<?php
    include '../conexion.php';

    $tipo = $_POST['tipo'];

    if($tipo == "comboEst"){
        $r = "SELECT id, nombre from estados";
        $comando = mysqli_query($enlace, $r);
        while($row = mysqli_fetch_array($comando)){
            echo "<option value='".$row[0]."'>".$row[1]."</option>";
        }
    }
?>