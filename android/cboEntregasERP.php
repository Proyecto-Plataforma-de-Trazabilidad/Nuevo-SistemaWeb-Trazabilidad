<?php
if($_SERVER['REQUEST_METHOD']=='POST'){ 
    
    include('database.php');

    $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);


    $query="SELECT  Nombre FROM usuarios WHERE 	Idtipousuario='5' ";
    $resultado=$conn->prepare($query);
    $resultado->execute();
    $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        
    echo json_encode($res);
    $conn = null; //Limpia la conexión
}
?>