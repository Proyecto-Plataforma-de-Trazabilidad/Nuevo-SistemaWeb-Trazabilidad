<?php
    include "conexion.php";
    $usuario=$_POST["usuario"];
    $contra=$_POST["contra"];

    $consulta="SELECT * FROM usuarios WHERE Nombre='".$usuario."' AND Contrasena='".$contra."'";
    $resultado=mysqli_query($enlace,$consulta);
    $filas=mysqli_num_rows($resultado);

    if($filas){
        session_start();
        $_SESSION["usuario"]=$usuario;
        header("location:inicio.php");
    }
    else{
        ?>
        <script>alert("Usuario o Contraseña invalidos");</script>
        <script>window.location='loggin.php';</script>
        <?php
    }
?>