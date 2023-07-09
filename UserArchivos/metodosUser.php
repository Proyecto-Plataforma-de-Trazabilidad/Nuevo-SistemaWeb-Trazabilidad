<?php
    include '../conexion.php';
    $tipo = $_POST['tipo'];

    if ($tipo == "combo1") {
        $r = "SELECT Idtipousuario, Descripcion FROM tipousuario";
        $comando = mysqli_query($enlace, $r);
        while ($row = mysqli_fetch_array($comando)) {
            echo "<option value='".$row[0]."'>".$row[1]."</option>";
        }
    }


    if ($tipo == null) {
        cargarTabla();
    }

    

    function cargarTabla(){
        include '../conexion.php';
        $r = "SELECT U.IdUsuario, U.Nombre, U.Correo, T.Descripcion FROM usuarios as U inner join tipousuario as T on U.IdtipoUsuario = T.Idtipousuario";
        $comando = mysqli_query($enlace, $r);
        while($row = mysqli_fetch_array($comando)){
            echo "
                <tr>
                    <td>".$row[0]."</td>
                    <td>".$row[1]."</td>
                    <td>".$row[2]."</td>
                    <td>".$row[3]."</td>
                    <td><a href='UserArchivos/editar.php?id=".base64_encode($row[0])."'><input type='button' value='Consultar' class='btn btn-primary'></td>
                </tr>
            ";
        }
        mysqli_close($enlace);
    }

    if($tipo=="actualizar"){
        include '../conexion.php';
        $iduser=$_POST["iduser"];
        $nomb=$_POST["nomb"];
        $tuser=$_POST['tuser'];
        $correo=$_POST['correo'];
        $contra=$_POST['contra'];
        $r="UPDATE usuarios SET Idtipousuario=".$tuser.", Nombre='".$nomb."', Contrasena=MD5('".$contra."'), Correo='".$correo."' WHERE IdUsuario=".$iduser;
        $comando= mysqli_query($enlace, $r);
        if($comando){
            echo"<script>window.location='../rusers.php';</script>";
        }
        else{
            echo(mysqli_error($enlace));
        }
        mysqli_close($enlace);
    }

?>