<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{ 
    include('database.php');
    //$conn=mysqli_connect($hostname,$host_user,$host_password,$database);
    $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);
    
    
    //$option SI es insercion,actualizacion, consulta ,login... y tenerlo en este mismo documento
    switch($_POST['opcion']){
        case 'contenedores':
            //se rescatan y se buscan en la BD
            $query="SELECT C.Latitud,C.Longitud,C.Origen,TC.Concepto FROM contenedores as C inner join tipocontenedor as TC on C.idTipoCont = TC.idTipoCont";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        case 'distribuidores':
            //se rescatan y se buscan en la BD
            $query="SELECT Latitud,Longitud,Nombre,Domicilio FROM distribuidores";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        case 'Edestino':
            $query="SELECT Latitud,Longitud,Razonsocial,Domicilio,Municipio FROM empresadestino";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        case 'Erecolectoras':
            //se rescatan y se buscan en la BD
            $query="SELECT Latitud,Longitud,Nombre,Domicilio FROM empresarecolectoraprivada";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        case 'cat':
            //se rescatan y se buscan en la BD
            $query="SELECT Latitud,Longitud,NombreCentro,Domicilio FROM centroacopiotemporal";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    }

    echo json_encode($res);
    $conn = null; //Limpia la conexión
}
?>