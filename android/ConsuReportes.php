<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{ 
    include('database.php');
    $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);

    
    switch($_POST['opcion']){
        case 'RepGCat':
            $query="select count(*) as Total_CATs from `centroacopiotemporal`";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepECat':
            $query="select Estado,count(Estado)as TotalE from centroacopiotemporal GROUP BY Estado";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepMCat':
            $muni=$_POST['muni'];
            $query="select Municipio,count(Municipio)as TotalM from centroacopiotemporal where Estado='$muni' GROUP BY Municipio;";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepGD':
            $query="select count(*) as TotalD from `distribuidores`";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepED':
            $query="select Edo,count(Edo)as TotalE from distribuidores GROUP BY Edo";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepMD':
            $muni=$_POST['muni'];
            $query="select Municipio,count(Municipio)as TotalM from distribuidores where Edo='$muni' GROUP BY Municipio;";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepVD':
            $query="select D.Nombre,count(*)as TotalVD from distribuidorvehiculos as VD inner join distribuidores as D on D.IdDistribuidor=VD.IdDistribuidor GROUP BY VD.IdDistribuidor";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepGP':
            $query="select count(*) as TotalP from  `productores`";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepEP':
            $query="select Edo,count(Edo)as TotalE from productores GROUP BY Edo";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepMP':
            $muni=$_POST['muni'];
            $query="select Municipio,count(Municipio)as TotalM from productores where Edo='$muni' GROUP BY Municipio";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'Rep2P':
            $query="SELECT Nombre,PuntosAcumulados as Puntos,TotalPiezasOrden as Orden,TotalPiezasEntregadas as Entregas,(TotalPiezasOrden-TotalPiezasEntregadas) As SaldoPiezas FROM `productores` GROUP by Nombre";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;  
        case 'Rep1H':
            $query="select p.Nombre,count(*) as TotalH FROM `huertos` as h INNER join productores as p on h.IdProductor=p.IdProductor group by p.IdProductor";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;  
        case 'Rep1EERP':
            $query="SELECT Edo,count(Edo) as TotalE FROM `empresarecolectoraprivada` GROUP by Edo;";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;  
        case 'Rep1MERP':
            $edo=$_POST['edo'];
            $query="select Municipio,count(Municipio)as TotalM from empresarecolectoraprivada where Edo='$edo' GROUP BY Municipio";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;  
        case 'Rep1VERP':
            $query="SELECT ERP.Nombre,count(*) as TotalVE FROM `erpvehiculos` as VE INNER JOIN empresarecolectoraprivada as ERP on VE.IdERP=ERP.IdERP GROUP by ERP.IdERP";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break; 
        case 'Rep1Co':
            $ori=$_POST['ori'];
            $tc=$_POST['tc'];
            $query="select C.IdContenedor,C.Capacidad,C.CapacidadStatus,(C.Capacidad-C.CapacidadStatus)as EspacioD from contenedores as C inner join tipocontenedor as T on C.IdTipoCont=T.idTipoCont where C.Origen='$ori' and T.Concepto='$tc'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break; 
        case 'Rep1EEDF':
            $query="SELECT Edo,count(Edo) as TotalE FROM empresadestino GROUP by Edo;";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;  
        case 'Rep1MEDF':
            $edo=$_POST['edo'];
            $query="select Municipio,count(Municipio)as TotalM from empresadestino where Edo='$edo' GROUP BY Municipio;";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break; 
        case 'RepGMu':
            $query="select count(*) as TotalMu from municipio";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break; 
        case 'Rep1VMu':
            $query="SELECT M.NombreLugar,count(*) as TotalVMu FROM municipiovehiculos as VM INNER JOIN municipio as M on VM.IdMunicipio=M.IdMunicipio GROUP by M.IdMunicipio";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
    //---------------Movimientos-Reportes-----------------------------------
         case 'RepTPP':
            $pro=$_POST['pro'];
            $fi=$_POST['fi'];
            $ff=$_POST['ff'];

            $query="select P.Nombre,SUM(D.CantidadPiezas) As TotalPiezas FROM detalleorden as D INNER JOIN ordenproductos AS O on D.IdOrden=O.IdOrden inner join productores as P on O.IdProductor=P.IdProductor where P.Nombre='$pro' and O.Fecha BETWEEN '$fi' and '$ff'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepTQP':
            $pro=$_POST['pro'];
            $tq=$_POST['tq'];
            
            $query="select P.Nombre,Sum(D.CantidadPiezas) As TotalPiezas FROM detalleorden as D INNER JOIN ordenproductos AS O on D.IdOrden=O.IdOrden inner join productores as P on O.IdProductor=P.IdProductor INNER join tipoquimico as TQ on D.IdTipoQuimico=TQ.IdTipoQuimico where TQ.Concepto='$tq' and P.Nombre='$pro'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepTEP':
            $pro=$_POST['pro'];
            $te=$_POST['te'];
            
            $query="select P.Nombre,Sum(D.CantidadPiezas) As TotalPiezas FROM detalleorden as D INNER JOIN ordenproductos AS O on D.IdOrden=O.IdOrden inner join productores as P on O.IdProductor=P.IdProductor where D.TipoEnvase='$te' and P.Nombre='$pro'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
         case 'RepEPP':
            $pro=$_POST['pro'];
            $fi=$_POST['fi'];
            $ff=$_POST['ff'];

            $query="select P.Nombre,SUM(E.CantidadPiezas) As TotalPiezas FROM extraviados as E inner join productores as P on E.IdProductor=P.IdProductor where P.Nombre='$pro' and E.fecha BETWEEN '$fi' and '$ff'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepODis':
            $dis=$_POST['dis'];
            $fi=$_POST['fi'];
            $ff=$_POST['ff'];

            $query="select D.Nombre,count(*) as TotalE FROM ordenproductos as O INNER JOIN distribuidores as D on O.IdDistribuidor=D.IdDistribuidor where D.Nombre='$dis' and O.Fecha BETWEEN '$fi' and '$ff'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
            //Reporte Envases mas ordenados1
        case '1':
            $query = "SELECT TipoEnvase, SUM(CantidadPiezas) as Total from detalleorden GROUP BY TipoEnvase order by Total DESC";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;

        //Reporte de distribuidores más concurridos 2
        case '2':
            $query = "SELECT D.Nombre , COUNT(*) as total FROM ordenproductos as OP INNER JOIN distribuidores as D on OP.IdDistribuidor = D.IdDistribuidor GROUP by D.Nombre ORDER BY total ASC";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;

        //Reporte de contenedores más concurridos 3
        case '3':
            $query = "SELECT CONCAT(c.IdContenedor,',',c.Origen) as Contenedor,count(*) as Total from entregas as E INNER JOIN contenedores as c on E.IdContenedor=c.IdContenedor group BY Contenedor order by Total DESC";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        //Reporte de productores con más ordenes 4
        case '4':
            $query = "SELECT P.Nombre, count(*) as Total from productores as P INNER JOIN ordenproductos as OP on P.IdProductor = OP.IdProductor GROUP by P.Nombre Order By Total DESC";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        //Reporte de municipios con menos entregas 5
        case '5':
            $query = "SELECT U.Nombre, count(*) as Total from entregas as E inner JOIN usuarios as U on E.IdUsuario = U.IdUsuario inner join tipousuario as TU on U.Idtipousuario=TU.Idtipousuario where TU.Idtipousuario=4 GROUP by U.Nombre Order BY total ASC";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        //Reporte de distribuidores con menos entregas 6
        case '6':
            $query = "SELECT U.Nombre, count(*) as Total from entregas as E inner JOIN usuarios as U on E.IdUsuario = U.IdUsuario inner join tipousuario as TU on U.Idtipousuario=TU.Idtipousuario where TU.Idtipousuario='3' GROUP by U.Nombre Order BY total ASC";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
    }
        echo json_encode($res);
        $conn = null; //Limpia la conexión
}
?>