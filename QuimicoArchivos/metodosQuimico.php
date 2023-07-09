<?php
    include '../conexion.php';
    $tipo=$_POST['tipo'];

    if($tipo==null)
    {   
        cargarTabla();
    }
    
    if($tipo=="registrar")
    {
        $conc=$_POST['conc'];
        $r="INSERT INTO tipoquimico VALUES(null, '".$conc."')";
        mysqli_query($enlace,$r);
        cargarTabla();
    }
    
    function cargarTabla()
    {
        include '../conexion.php';
        $r="SELECT * FROM tipoquimico";
        
        $comando= mysqli_query($enlace, $r);
        while($row=mysqli_fetch_array($comando)){
            echo "
            <tr>
                <td>".$row[0]."</td>
                <td>".$row[1]."</td>
                <td><a href='QuimicoArchivos/editar.php?id=".base64_encode($row[0])."'><input type='button' value='Consultar' id='btnEditar' class='btn btn-primary'></td>
            </tr>
            ";
        }
        mysqli_close($enlace);
    }
    if($tipo=="actualizar"){
        include '../conexion.php';
        $r="UPDATE tipoquimico SET Concepto='".$_POST['conc']."' where IdTipoQuimico=".$_POST['idtipo'];
        $comando= mysqli_query($enlace, $r);
        mysqli_close($enlace);
    }

    if($tipo=='borrar')
    {
        include '../conexion.php';
        $r="Delete from tipoquimico where IdTipoQuimico=".$_POST['idtipo'];
        $comando= mysqli_query($enlace, $r);
        mysqli_close($enlace);
    }

?>