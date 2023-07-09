<?php
    include '../conexion.php';

    $nombre = $_POST['innom'];
    $Email = $_POST['incorr'];
    $roluser = $_POST['tipousuario'];
    $data = null;
    //funcion que genera contraseñas aleatorias
    function generateRandomString($length = 5) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];}
    return $randomString;}

    $psw = generateRandomString();

    if($nombre != null && $Email != null && $roluser != null){
    $r = "INSERT INTO usuarios values(null, '".$roluser."','".$nombre."', MD5('".$psw."'), '".$Email."' )";
    $data = mysqli_query($enlace, $r); //Si el query se realiza correctamente va a devolver true
    }
    else{
        $data=null;
    }



    print json_encode($data);

    mysqli_close($enlace);
?>