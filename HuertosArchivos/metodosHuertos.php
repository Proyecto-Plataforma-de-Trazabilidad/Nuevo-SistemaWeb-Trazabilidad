<?php

    include '../conexion.php';
    $tipo=$_POST['tipo'];

    if($tipo=="combo1"){
        $r="SELECT IdProductor, Nombre FROM productores";
        $comando=mysqli_query($enlace,$r);
        while($row=mysqli_fetch_array($comando)){
            echo "<option value='".$row[0]."'>".$row[1]."</option>";
        }
    }

    if($tipo==null)
    {   
        cargarTabla();
    }
    
    if($tipo=="registrar")
    {
        $prod=$_POST['prod'];
        $hue=$_POST['hue'];
        $lat=$_POST['lat'];
        $lon=$_POST['lon'];
        $r="INSERT INTO huertos VALUES(null,".$prod.",".$lat.", ".$lon.",'".$hue."')";
        mysqli_query($enlace,$r);
        cargarTabla();
    }
    
    function cargarTabla()
    {
        include '../conexion.php';
        $r="SELECT h.IdHuerto, p.Nombre, h.HUE FROM huertos AS h INNER JOIN productores as p ON h.IdProductor=p.IdProductor";
        
        $comando= mysqli_query($enlace, $r);
        while($row=mysqli_fetch_array($comando)){
            echo "
            <tr>
                <td>".$row[0]."</td>
                <td>".$row[1]."</td>
                <td>".$row[2]."</td>
                <td><a href='HuertosArchivos/editar.php?id=".base64_encode($row[0])."'><input type='button' value='Consultar' id='btnEditar' class='btn btn-primary'></td>
            </tr>
            ";
        }
        mysqli_close($enlace);
    }
    if($tipo=="actualizar"){
        include '../conexion.php';
        $id=$_POST["id"];
        $prod=$_POST['prod'];
        $hue=$_POST['hue'];
        $lat=$_POST['lat'];
        $lon=$_POST['lon'];
        $r="UPDATE huertos SET IdProductor=".$prod.", Latitud=".$lat.", Longitud=".$lon.", HUE='".$hue."' WHERE IdHuerto=".$id;
        $comando= mysqli_query($enlace, $r);
        if($comando){
            echo"<script>window.location='../Huertos.php';</script>";
        }
        else{
            echo(mysqli_error($enlace));
        }
        mysqli_close($enlace);
    }

    if($tipo=='borrar')
    {
        include 'conexion.php';
        $r="Delete from Cat where idCAT=".$_POST['idcat'];
        $comando= mysqli_query($enlace, $r);
        mysqli_close($enlace);
    }

?>