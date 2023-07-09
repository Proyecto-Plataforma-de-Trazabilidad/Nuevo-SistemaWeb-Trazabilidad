<?php 
    include "./../conexion.php";
    $tipo_funcion=$_POST["tipo"];

    if($tipo_funcion=="combo1"){ 
        $r="SELECT * FROM tipocontenedor";
        $comando= mysqli_query($enlace, $r);
        while($row=mysqli_fetch_array($comando))
        {
            echo "<option value='".$row[0]."'>".$row[1]."</option>";
        }
        mysqli_close($enlace);
    }
    if($tipo_funcion=="combo2"){ //?Porque se repite el codigo de combo
        $r="SELECT * FROM tipocontenedor";
        $comando= mysqli_query($enlace, $r);
        while($row=mysqli_fetch_array($comando))
        {
            echo "<option value='".$row[0]."'>".$row[1]."</option>";
        }
        mysqli_close($enlace);
    }

    if($tipo_funcion==null)
    {
        cargarTabla();
    }

    if ($tipo_funcion=="responsables") {

        // if ($_POST["origen"] == "Amocalli" || $_POST["origen"] == "CAT" || $_POST["origen"] == "Empresa Recicladora") {
            
        // }
        $r="SELECT U.IdUsuario, U.Nombre AS 'NomRespon' FROM usuarios AS U INNER JOIN tipousuario AS T ON T.Idtipousuario=U.Idtipousuario WHERE T.Descripcion = '".$_POST["origen"]."';";
        $comando= mysqli_query($enlace, $r);

        if (mysqli_num_rows($comando) == 0) {         
            echo("No hay responsables");
        }else {
            while($row = mysqli_fetch_array($comando)){
                echo "<option value='".$row[0]."'>".$row[1]."</option>";
            }
        }
        mysqli_free_result($comando);
    }

    function cargarTabla(){
        include "../conexion.php";
        $r="SELECT c.IdContenedor, t.Concepto, c.Origen, u.Nombre AS 'Responsables', c.Capacidad, c.CapacidadStatus, c.Descripcion, c.UltimaFechaRecoleccion, c.ReferenciaPermiso FROM tipocontenedor AS t INNER JOIN contenedores AS c ON c.IdTipoCont=t.IdTipoCont INNER JOIN usuarios AS u ON c.IdUsuario=u.IdUsuario";
        $comando= mysqli_query($enlace, $r);
        while($row=mysqli_fetch_array($comando)){
            echo "
            <tr>
                <td>".$row[0]."</td>
                <td>".$row[1]."</td>
                <td>".$row[2]."</td>
                <td>".$row[3]."</td>
                <td>".$row[4]."</td>
                <td>".$row[5]."</td>
                <td>".$row[6]."</td>
                <td>".$row[7]."</td>
                <td><a href='Contenedores-Archivos/".$row[8]."'>Permiso</a></td>                
                <td><a href='Contenedores-Archivos/Consulta.php?id=".base64_encode($row[0])."'><input type='button' value='Consultar' class='btn btn-primary'></td>
            </tr>";
        }
        mysqli_close($enlace);
    }
    // if($tipo_funcion=="actualizar"){
    //     include '../conexion.php';
    //     $r="UPDATE contenedores SET Capacidad=".$_POST['cap'].", Descripcion='".$_POST['des']."', UltimaFechaRecoleccion='".$_POST['ulti']."', LatitudLongitud='".$_POST['lat']."', InstruccionesManejo='".$_POST['man']."' where idContenedor=".$_POST['idcon'];
    //     echo $r;
    //     $comando= mysqli_query($enlace, $r);
    //     mysqli_close($enlace);
    // }
?>