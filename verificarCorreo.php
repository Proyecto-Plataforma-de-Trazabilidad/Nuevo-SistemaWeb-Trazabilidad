<?php
error_reporting(0);
include 'conexion.php';
$correo    = $_REQUEST['incorr'];

//Verificando si existe algun cliente en bd ya con dicha correo asignada
//Preparamos un arreglo que es el que contendrá toda la información
$jsonData = array();
$selectQuery   = ("SELECT Correo FROM usuarios WHERE Correo='".$correo."' ");
$query         = mysqli_query($enlace, $selectQuery);
$totalUsuarios  = mysqli_num_rows($query);

  //Validamos que la consulta haya retornado información
  if( $totalUsuarios <= 0 ){
    $jsonData['success'] = 0;
    //$jsonData['message'] = 'No existe Correo ' .$correo;
    $jsonData['message'] = '';
} else{
    //Si hay datos entonces retornas algo
    $jsonData['success'] = 1;
    $jsonData['message'] = '<p style="color:red;">Ya existe el correo <strong>(' .$correo.')<strong></p>';
  }

//Mostrando mi respuesta en formato Json
header('Content-type: application/json; charset=utf-8');
echo json_encode( $jsonData );
?>