<?php
error_reporting(0);
include '../conexion.php';
$nom=$_POST['innom'];
$reg=$_POST["inreg"];
$dom=$_POST['indom'];
$cp=$_POST['incp'];
$ciu=$_POST["inciu"];
$muni=$_POST['jmr_contacto_municipio'];
$est=$_POST['jmr_contacto_estado'];
$tel=$_POST['intel'];
$corr=$_POST['incorr'];
$puntos=$_POST["inpuntos"];
$orden=$_POST["inorden"];
$entrega=$_POST["inentrega"];
$giro=$_POST["ingiro"];

if($nom != null && $corr != null){
    $r="INSERT INTO productores VALUES(NULL,'".$nom."','".$reg."','".$dom."','".$cp."','".$ciu."','".$muni."','".$est."','".$tel."','".$corr."',".$puntos.",".$orden.",".$entrega.",'".$giro."')";
    mysqli_query($enlace,$r);
    $data = "bien";
}
else{
    $data= null;
}

print json_encode($data);

mysqli_close($enlace);
 ?>