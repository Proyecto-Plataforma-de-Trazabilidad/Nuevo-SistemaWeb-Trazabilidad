<?php
if($_SERVER['REQUEST_METHOD']=='POST'){ 
    include('database.php');
   $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);

    
    switch($_POST['opcion']){
        case 'ConsulSalidasGen':
            $correo=$_POST['correo'];//correo usuario 
            
            $query="SELECT S.IdSalida,S.IdContenedor,S.Responsable,S.Cantidad,S.fecha FROM salidas AS S  INNER JOIN usuarios AS U ON S.IdUsuario=U.IdUsuario WHERE U.Correo='$correo' ORDER BY S.IdSalida;";

            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
             
        break;

        case 'consulSalidasfecha':
            $correo=$_POST['correo'];
            $fi=$_POST['fi'];//fecha inicial
            $ff=$_POST['ff'];//fecha final

            $query="SELECT S.IdSalida,S.IdContenedor,S.Responsable,S.Cantidad,S.fecha FROM salidas AS S INNER JOIN usuarios AS U ON S.IdUsuario=U.IdUsuario where S.Fecha BETWEEN '$fi' and '$ff' and U.Correo='$correo'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        
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