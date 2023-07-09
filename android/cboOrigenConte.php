<?php
if($_SERVER['REQUEST_METHOD']=='POST'){ //comprobar si la peticion es POST si no no hace nada, medida de seguridad
    
    include('database.php');

    $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);

            $query="SELECT origen FROM contenedores GROUP BY origen";
            $resultado=$conn->prepare($query);
            $resultado->execute();
          
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($res);
    $conn = null; //Limpia la conexión
}
?>