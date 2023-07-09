<?php
    include '../conexion.php';
    $tipo=$_POST['tipo'];

    if($tipo=="combo1"){
        $r="SELECT IdDistribuidor, Nombre FROM distribuidores";
        $comando=mysqli_query($enlace,$r);
        while($row=mysqli_fetch_array($comando)){
            echo "<option value='".$row[0]."'>".$row[1]."</option>";
        }
    }

    if($tipo==null)
    {   
        cargarTabla();
    }
    
    function cargarTabla()
    {
        include '../conexion.php';
        
        $r="SELECT v.Consecutivo, d.Nombre, v.Descripcion, v.TipoVehiculo, v.Capacidad, v.Marca, v.Placa, v.SCT FROM distribuidorvehiculos AS v inner join distribuidores as d on v.IdDistribuidor = d.IdDistribuidor";
        $comando= mysqli_query($enlace, $r);
        while($row=mysqli_fetch_array($comando)){
            echo "
            <tr>
                <td>".$row[1]."</td>
                <td>".$row[2]."</td>
                <td>".$row[3]."</td>
                <td>".$row[4]."</td>
                <td>".$row[5]."</td>
                <td>".$row[6]."</td>
                <td><a href='DistVehicArchivos/".$row[7]."'>Ver SCT</a></td>
                <td><a href='DistVehicArchivos/Consulta.php?id=".base64_encode($row[0])."'><input type='button' value='Consultar' class='btn btn-primary'></td>
            </tr>
            ";
        }
        mysqli_close($enlace);
    }
    
    if($tipo=="actualizar"){
        include '../conexion.php';
        $r="UPDATE distribuidorvehiculos SET idDistribuidor='".$_POST['indist']."', Descripcion='".$_POST['indes']."', TipoVehiculo='".$_POST['intipo']."', Capacidad='"
        .$_POST['incap']."', Marca='".$_POST['inmarca']."', Placa='".$_POST['inplaca']."' where Consecutivo=".$_POST['Consecutivo'];
        $comando= mysqli_query($enlace, $r);
        mysqli_close($enlace);
    }

?>