<?php
session_start();

    include '../conexion.php';
    $tipo=$_POST['tipo'];

    if($tipo==null)
    {   
        cargarTabla();
    }
    
    if($tipo=="registrar")
    {
        $conc=$_POST['conc'];
        $r="INSERT into tipocontenedor values(null, '".$conc."')";
        mysqli_query($enlace,$r);
        cargarTabla();
    }
    
    function cargarTabla()
    {
        include '../conexion.php';
        $r="select * from tipocontenedor";
        
        $comando= mysqli_query($enlace, $r);
        while($row=mysqli_fetch_array($comando)){
            echo "
            <tr>
                <td>".$row[0]."</td>
                <td>".$row[1]."</td>
                <td><a href='TipoCont/editar.php?id=".base64_encode($row[0])."'><input type='button' value='Consultar' id='btnEditar' class='btn btn-primary'></td>
            </tr>
            ";
        }
        mysqli_close($enlace);
    }
    if($tipo=="actualizar"){
        include '../conexion.php';
        $r="UPDATE tipocontenedor SET Concepto='".$_POST['conc']."' WHERE IdTipoCont=".$_POST['idtipo'];
        $comando= mysqli_query($enlace, $r);
        mysqli_close($enlace);
    }

    if($tipo=='borrar')
    {
        include '../conexion.php';
        $r="Delete from tipocontenedor where idCAT=".$_POST['idTipoCont'];
        $comando= mysqli_query($enlace, $r);
        mysqli_close($enlace);
    }

?>