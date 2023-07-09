<?php
if($_SERVER['REQUEST_METHOD']=='POST'){ //comprobar si la peticion es POST si no no hace nada, medida de seguridad
    
    //las variables se van a decodificar en json para enviar y recibir peticiones de valores de variables
    include('database.php');

   // $conn=mysqli_connect($host_name,$host_user,$host_password,$database);
    $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);
    
    //se rescatan y se buscan en la BD
            $query="SELECT Municipio FROM empresarecolectoraprivada GROUP BY Municipio";
            $resultado=$conn->prepare($query);
            $resultado->execute();
          
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        
   // mysqli_close($conn);
    //codificar los datos en json que se enviaran a la app en android
    echo json_encode($res);//lo que imprima como respuesta se manda a voley para interpretarlo mediante JSon
    $conn = null; //Limpia la conexión
}
?>