<?php
if($_SERVER['REQUEST_METHOD']=='POST'){ 

    //conexion
    include('database.php');
    $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);
    
    switch($_POST['opcion']){
        case 'recupera':
            $email=$_POST['email'];
            
            //funcion
            function generateRandomString($length = 10) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                     $randomString .= $characters[rand(0, strlen($characters) - 1)];
                     }
                  return $randomString;
                }
                    
                    $query="Select email from usuarios where email='$email'";
                    $resultado=$conn->prepare($query);
                    $resultado->execute();
                    $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
                    
                    if(isset($resultado)) {
                        $password = generateRandomString();
                        
                        //Cambiar la contraseña
                        $query2="UPDATE usuarios SET `password` = MD5('$password') WHERE email = '$email'";
                        $ejec=$conn->prepare($query2);
                        $ejec->execute();
                        
                        //enviarsela por correo
                        mail($email,"Cambio de contraseña","Tu nueva contraseña es : ".$password,"Deberas entrar con ella, despues podras cambiarla en el apartado de usuario.");
                        $r="ENVIADO";
                    }
                    else { $r="Fallo"; }
    
        break;
        case 'cambia':
                    $nuevacontra=$_POST['ncontra'];
            $email=$_POST['email'];
            
             $query="Select email from usuarios where email='$email'";
                    $resultado=$conn->prepare($query);
                    $resultado->execute();
                    $res = $resultado->fetchAll(PDO::FETCH_ASSOC);

            if(isset($resultado)){
                $query2="UPDATE usuarios SET `password` = MD5('$nuevacontra') WHERE email = '$email'";
                $ejec=$conn->prepare($query2);
                $ejec->execute();
                
                $r="CAMBIADO";
            }
            else{ $r="FALLÓ";}
          
        break;
    }
    echo $r;
    $conn = null;
}
?>