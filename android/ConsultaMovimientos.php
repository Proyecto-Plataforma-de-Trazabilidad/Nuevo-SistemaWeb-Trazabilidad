<?php
if($_SERVER['REQUEST_METHOD']=='POST'){ 
    include('database.php');
   $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);

    
    switch($_POST['opcion']){
        case 'OrP'://ordenes por productor y periodo
            $pro=$_POST['pro'];//productor combo
            $fi=$_POST['fi'];//fecha inicial
            $ff=$_POST['ff'];//fecha final

            $query="SELECT O.IdOrden,P.Nombre AS Productor,D.Nombre AS Distribuidor, O.NumFactura,O.NumReceta FROM ordenproductos AS O INNER JOIN productores AS P ON O.IdProductor=P.IdProductor INNER JOIN distribuidores AS D ON O.IdDistribuidor=D.IdDistribuidor WHERE P.Nombre='SAEN' and O.Fecha BETWEEN '$fi' and '$ff'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
             
        break;
        case 'DOrP'://detalle orden productor
            $id=$_POST['IdOrden'];
            $query="SELECT DO.Consecutivo,T.Concepto,DO.TipoEnvase,DO.Color,DO.CantidadPiezas FROM `detalleorden` AS DO INNER JOIN tipoquimico AS T ON DO.IdTipoQuimico=T.IdTipoQuimico WHERE DO.IdOrden='$id' group by DO.Consecutivo";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        //-------------------------Extraviados del productor ------------------------------------------------
        case 'ExP'://ordenes por productor y periodo
            $pro=$_POST['pro'];//productor combo
            $fi=$_POST['fi'];//fecha inicial
            $ff=$_POST['ff'];//fecha final

            $query="SELECT E.IdExtraviados,E.TipoEnvaseVacio,E.CantidadPiezas,E.Aclaracion,E.fecha FROM extraviados as E INNER JOIN productores as P on E.IdProductor=P.IdProductor where P.Nombre='$pro' and E.fecha BETWEEN '$fi' and '$ff'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
             
        break;
        //------------------------Entregas Productor-----------------------------------
        case 'EnP':
            $pro=$_POST['pro'];//productor combo
            $fi=$_POST['fi'];//fecha inicial
            $ff=$_POST['ff'];//fecha final
            $query="SELECT E.IdEntrega,E.ResponsableEntrega,E.fecha FROM entregas AS E INNER JOIN productores AS P ON E.IdProductor=P.IdProductor WHERE P.Nombre='$pro' AND E.fecha BETWEEN '$fi' and '$ff' ORDER BY E.IdEntrega";
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
        //-------------------Entregas distribuidor,Muni,ERP--------------------------------------------
        case 'EnDME':
            $re=$_POST['re'];
            $fi=$_POST['fi'];//fecha inicial
            $ff=$_POST['ff'];//fecha final
            $query="SELECT E.IdEntrega,E.ResponsableRecepcion,E.fecha FROM entregas AS E INNER JOIN usuarios AS U ON E.IdUsuario=U.IdUsuario  WHERE U.Nombre='$re' and E.fecha BETWEEN '$fi' and '$ff' ORDER BY E.IdEntrega";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        //----------------Salidas distribuidor,Muni,ERP--------------------------------------------
        case 'SaDME':
            $re=$_POST['re'];
            $fi=$_POST['fi'];//fecha inicial
            $ff=$_POST['ff'];//fecha final
            $query="SELECT S.IdSalida,S.IdContenedor,S.Responsable,S.Cantidad,S.fecha FROM salidas AS S INNER JOIN usuarios AS U ON S.IdUsuario=U.IdUsuario where S.Fecha BETWEEN '$fi' and '$ff' and U.Nombre='$re'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        //---------------detalle contenedor salidas-------------------------------------------
        case 'DetCont':
            $id=$_POST['id'];
            $query="SELECT TC.Concepto,C.Origen,C.Capacidad,C.Descripcion,C.CapacidadStatus FROM contenedores as C INNER JOIN tipocontenedor as TC on TC.IdTipoCont = C.IdTipoCont WHERE C.IdContenedor='$id'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    }
    echo json_encode($res);
    $conn = null; //Limpia la conexión
}
?>