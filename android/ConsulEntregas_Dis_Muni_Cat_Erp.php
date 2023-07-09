<?php
if($_SERVER['REQUEST_METHOD']=='POST'){ 
    include('database.php');
   $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);

    
    switch($_POST['opcion']){
        case 'ConsulEntradaG':
            $correo=$_POST['correo'];//correo usuario dis, cat, muni o ERP
            
            $query="SELECT E.IdEntrega,P.Nombre, E.ResponsableEntrega,E.fecha FROM entregas AS E INNER JOIN productores AS P ON E.IdProductor=P.IdProductor INNER JOIN usuarios AS U ON E.IdUsuario=U.IdUsuario  WHERE U.Correo='$correo'  ORDER BY E.IdEntrega";

            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
             
        break;

        case 'ConsulEntradaProd':
            $correo=$_POST['correo'];//correo usuario dis, cat, muni o ERP
            $pro=$_POST['pro'];//productor

            $query="SELECT E.IdEntrega,E.ResponsableEntrega,E.fecha FROM entregas AS E INNER JOIN productores AS P ON E.IdProductor=P.IdProductor INNER JOIN usuarios AS U ON E.IdUsuario=U.IdUsuario  WHERE U.Correo='$correo' AND P.Nombre='$pro' ORDER BY E.IdEntrega";

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