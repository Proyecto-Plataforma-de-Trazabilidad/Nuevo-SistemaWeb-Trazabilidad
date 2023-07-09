<?php
    include '../conexion.php';

        $roluser = $_POST['tipUser'];
        $nombre = $_POST['nom'];
        $psw = $_POST['cont'];
        $Email = $_POST['incorr'];

        $r = "INSERT INTO usuarios values(null, '".$roluser."','".$nombre."', MD5('".$psw."'), '".$Email."' )";
        mysqli_query($enlace, $r);

        echo "<script>window.location='../rusers.php'</script>";

?>