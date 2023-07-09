<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");

    $host="156.67.73.0";
    $usuario="u517350403_admindb";
    $contrasena="Te-k3li-L!";
    $baseDeDatos="u517350403_campolimpiojal";

    //Establecer conexion con la base de datos
    $conn = mysqli_connect($host, $usuario, $contrasena, $baseDeDatos);

    //Verificar la conexion
    if(!$conn){
        die("Error al conectar a la base de datos: ".mysqli_connect_error());
    }

    //Obtener las credenciales enviadas desde la aplicación de React Native
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    echo 'Email: ' . $email . '<br>';
echo 'Password: ' . $password . '<br>';

    //Transformar la contraseña a MD5
    $psw = md5($password);

    //Realizar la consulta para verificar las credenciales
    $query = "SELECT * From usuarios where Correo = ? AND Contrasena = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $email, $psw);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    header('Content-Type: application/json');

    //Verificar si se encontró el usuario
    if(mysqli_num_rows($resultado) > 0){
        //Los datos son correctos, se puede iniciar sesión
        $response = array("success" => true, "message" => "Bienvenido");

    } else{
        //Los datos no son válidos, no se puede iniciar sesión
        $response = array("success" => false, "message" => "Datos incorrectos. Intentar de nuevo");
    }

    //Devolver la respuesta como JSON
    echo json_encode($response);

    //Cerrar la conexión
    mysqli_close($conn);


?>