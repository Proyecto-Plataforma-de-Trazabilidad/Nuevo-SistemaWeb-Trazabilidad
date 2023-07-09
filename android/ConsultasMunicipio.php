<?php
if($_SERVER['REQUEST_METHOD']=='POST'){ 
    
    include('database.php');
    //$conn=mysqli_connect($hostname,$host_user,$host_password,$database);
    $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);
    
    
    switch($_POST['opcion']){
        case 'contenedores':
            $ori=$_POST['origen'];
            $query="SELECT C.Latitud,C.Longitud,C.Capacidad,TC.Concepto,C.Origen FROM contenedores  as C inner join tipocontenedor as TC on TC.idTipoCont  = C.idTipoCont where Origen = '$ori' ";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        case 'distribuidores':
            $mun=$_POST['Municipio'];
            $query="SELECT Latitud,Longitud,Nombre,Domicilio FROM distribuidores where Municipio='$mun'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        case 'Edestino':
            $muni=$_POST['Municipio'];
            $query="SELECT Latitud,Longitud,Razonsocial,Domicilio from empresadestino where Municipio = '$muni' ";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        case 'Erecolectoras':
            $mun=$_POST['Municipio'];
            $query="SELECT Latitud,Longitud,Nombre,Domicilio FROM empresarecolectoraprivada where Municipio='$mun'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        case 'cat':
            $mun=$_POST['Municipio'];
            $query="SELECT Latitud,Longitud,NombreCentro,Domicilio FROM centroacopiotemporal where Municipio='$mun'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    }
    
    echo json_encode($res);
    $conn = null; //Limpia la conexión
} 
?>