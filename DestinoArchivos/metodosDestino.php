<?php 
    include "../conexion.php";
    $tipo_funcion=$_POST["tipo"];

    if($tipo_funcion==null)
    {
        cargarTabla();
    }

    function cargarTabla(){
        include "../conexion.php";
        $r="SELECT IdDestino, RazonSocial, Domicilio, Telefono, Correo, SEMARNAT FROM empresadestino";
        $comando= mysqli_query($enlace, $r);
        while($row=mysqli_fetch_array($comando)){
            echo "
            <tr>
                <td>".$row[0]."</td>
                <td>".$row[1]."</td>
                <td>".$row[2]."</td>
                <td>".$row[3]."</td>
                <td>".$row[4]."</td>
                <td><a href='DestinoArchivos/".$row[5]."'>Ver Licencia</a></td>
                <td><a href='DestinoArchivos/Consulta.php?id=".base64_encode($row[0])."'><input type='button' value='Consultar' class='btn btn-primary'></td>
            </tr>";
        }
        mysqli_close($enlace);
    }
    if($tipo_funcion=="actualizar"){
        include '../conexion.php';
        $r="UPDATE contenedores SET Capacidad=".$_POST['cap'].", Descripcion='".$_POST['des']."', UltimaFechaRecoleccion='".$_POST['ulti']."', LatitudLongitud='".$_POST['lat']."', InstruccionesManejo='".$_POST['man']."' where idContenedor=".$_POST['idcon'];
        $comando= mysqli_query($enlace, $r);
        mysqli_close($enlace);
    }
?>