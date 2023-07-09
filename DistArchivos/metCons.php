<?php
    cargarTabla();

    function cargarTabla(){
        include "../conexion.php";
        $r="SELECT IdDistribuidor, Nombre, Representante, Domicilio, Ciudad, Edo, Telefono, Correo, CapacitacionBUMA, SEMARNAT, LicenciaMunicipio FROM distribuidores";
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
                <td><a href='DistArchivos/".$row[8]."'>Ver BUMA</a></td>
                <td><a href='DistArchivos/".$row[9]."'>Ver SEMARNAT</a></td>
                <td><a href='DistArchivos/".$row[10]."'>Ver Licencia</a></td>
                <td><a href='DistArchivos/Consulta.php?id=".$row[0]."'><input type='button' value='Consultar' class='btn btn-primary'></td>
            </tr>";
        }
        mysqli_close($enlace);
    }
?>