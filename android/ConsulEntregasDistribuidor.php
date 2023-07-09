<?php
if($_SERVER['REQUEST_METHOD']=='POST'){ 
    include('database.php');
   $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);

    
    switch($_POST['opcion']){
        case 'ConsulEntregaGen':

            $id=$_POST['IdUsuario'];

            $query="SELECT E.IdEntrega,E.ResponsableRecepcion,E.fecha FROM entregas AS E INNER JOIN usuarios AS U ON E.IdUsuario=U.IdUsuario  WHERE U.IdUsuario='$id' ORDER BY E.IdEntrega";

            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
             
        break;

        case 'ConsulEntregaxProductor':

            $id=$_POST['IdUsuario'];
            $productor=$_POST['productor'];

            $query="SELECT E.IdEntrega,E.ResponsableRecepcion,E.fecha FROM entregas AS E INNER JOIN productores AS P ON E.IdProductor=P.IdProductor INNER JOIN usuarios AS U ON E.IdUsuario=U.IdUsuario  WHERE U.IdUsuario='$id' and P.Nombre='$productor' ORDER BY E.IdEntrega";

            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        
        case 'DetEntrega':
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