<?php
if($_SERVER['REQUEST_METHOD']=='POST'){ 
    include('database.php');
   $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);

    
    switch($_POST['opcion']){
        case 'ConsulEntrada':
            $correo=$_POST['correo'];//correo usuario
            $usu=$_POST['usu'];

            $query="SELECT E.IdEntrega,E.ResponsableEntrega,E.fecha FROM entregas AS E INNER JOIN productores AS P ON E.IdProductor=P.IdProductor INNER JOIN usuarios AS U ON E.IdUsuario=U.IdUsuario  WHERE P.Correo='$correo' AND U.Nombre='$usu' ORDER BY E.IdEntrega";

            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
             
        break;
        
        case 'DetEntrada':
            $id=$_POST['id'];
            $query="SELECT Consecutivo,TipoEnvaseVacio,CantidadPiezas,Peso,Observaciones FROM `detalleentrega` WHERE IdEntrega='$id' ORDER BY Consecutivo";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    }
    echo json_encode($res);
    $conn = null; //Limpia la conexión
}
?>