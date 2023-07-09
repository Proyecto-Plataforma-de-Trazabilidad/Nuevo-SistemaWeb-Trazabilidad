<?php
if($_SERVER['REQUEST_METHOD']=='POST'){ 
    include('database.php');
   $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);

    
    switch($_POST['opcion']){
        case 'OrdenDistribuidor':
            $correo=$_POST['correo'];
            
            $query="SELECT O.IdOrden,P.Nombre AS Productor,D.Nombre AS Distribuidor, O.NumFactura,O.NumReceta FROM ordenproductos AS O INNER JOIN productores AS P ON O.IdProductor=P.IdProductor INNER JOIN distribuidores AS D ON O.IdDistribuidor=D.IdDistribuidor WHERE D.Correo='$correo'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        
        
        case 'DetOrdDistribuidor':
            $id=$_POST['IdOrden'];
            $query="SELECT DO.Consecutivo,T.Concepto,DO.TipoEnvase,DO.Color,DO.CantidadPiezas FROM `detalleorden` AS DO INNER JOIN tipoquimico AS T ON DO.IdTipoQuimico=T.IdTipoQuimico WHERE DO.IdOrden='$id'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        
        case 'consulTQorden':
            $tq=$_POST['tq'];
            $nombre=$_POST['nombre'];

            $query="SELECT O.IdOrden,D.Nombre AS Distribuidor, P.Nombre as Productor, O.NumFactura,O.NumReceta FROM ordenproductos AS O INNER JOIN distribuidores AS D ON O.IdDistribuidor=D.IdDistribuidor INNER JOIN detalleorden AS DOR ON O.IdOrden=DOR.IdOrden INNER JOIN tipoquimico AS TQ ON DOR.IdTipoQuimico=TQ.IdTipoQuimico  INNER JOIN productores AS P ON O.IdProductor=P.IdProductor WHERE DOR.IdTipoQuimico=TQ.IdTipoQuimico AND TQ.Concepto='$tq' and D.Correo='$correo'";
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        
        case 'consulDetTQorden':
            $quimi=$_POST['quimi'];
            $id=$_POST['id'];

            $query="SELECT DO.Consecutivo,T.Concepto,DO.TipoEnvase,DO.Color,DO.CantidadPiezas FROM `detalleorden` AS DO INNER JOIN tipoquimico AS T ON DO.IdTipoQuimico=T.IdTipoQuimico WHERE T.Concepto='$quimi'and DO.IdOrden='$id'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
            
        case 'consulEorden':
             $e=$_POST['envase'];
             $correo=$_POST['correo'];

            $query="SELECT O.IdOrden,D.Nombre AS Distribuidor,P.Nombre as Productor, O.NumFactura,O.NumReceta FROM ordenproductos AS O INNER JOIN distribuidores AS D ON O.IdDistribuidor=D.IdDistribuidor INNER JOIN detalleorden AS DOR ON O.IdOrden=DOR.IdOrden  INNER JOIN productores AS P ON O.IdProductor=P.IdProductor WHERE DOR.TipoEnvase='$e' and D.Correo='$correo' GROUP BY O.IdOrden";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;  
        
        case 'consulEdetord':
            $id=$_POST['id'];
            $e=$_POST['envase'];
            $query="SELECT DO.Consecutivo,T.Concepto,DO.TipoEnvase,DO.Color,DO.CantidadPiezas FROM `detalleorden`  AS DO INNER JOIN tipoquimico AS T ON DO.IdTipoQuimico=T.IdTipoQuimico WHERE DO.IdOrden='$id' AND DO.TipoEnvase='$e'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        
        case 'consulOfecha':
            $correo=$_POST['correo'];
            $fi=$_POST['fi'];//fecha inicial
            $ff=$_POST['ff'];//fecha final

            $query="SELECT O.IdOrden,P.Nombre AS Productor,D.Nombre AS Distribuidor, O.NumFactura,O.NumReceta FROM ordenproductos AS O INNER JOIN productores AS P ON O.IdProductor=P.IdProductor INNER JOIN distribuidores AS D ON O.IdDistribuidor=D.IdDistribuidor where O.Fecha BETWEEN '$fi' and '$ff' and D.Correo='$correo'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        
        case 'consuldetfecha':
            $id=$_POST['id'];
            $query="SELECT DO.Consecutivo,T.Concepto,DO.TipoEnvase,DO.Color,DO.CantidadPiezas FROM `detalleorden`  AS DO INNER JOIN tipoquimico AS T ON DO.IdTipoQuimico=T.IdTipoQuimico WHERE DO.IdOrden='$id'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        
    }
    echo json_encode($res);
    $conn = null; //Limpia la conexión
}
?>