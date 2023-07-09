<?php
    include '../conexion.php';
    error_reporting(0);
    $res=$_POST['inres'];
    $nom=$_POST['innom'];
    $reg=$_POST['inNra'];
    $muni=$_POST['jmr_contacto_municipio'];
    $edo=$_POST['jmr_contacto_estado'];
    $cp=$_POST['incp'];
    $dom=$_POST['indom'];
    $tel=$_POST['intel'];  
    $correo=$_POST['incorr'];
    $hor=$_POST['inhor'];
    $plan=$_POST['inplan'];
    $info=$_POST['info'];
    $lat=$_POST["inlat"];
    $lon=$_POST["inlon"];
    
    if($nom != null && $correo != null){
        $r="INSERT INTO centroacopiotemporal VALUES(NULL,'".$res."','".$nom."','".$reg."','".$info."','".$dom."','".$cp."','".$muni."','".$edo."','".$tel."','".$correo."','".$hor."',".$lat.",".$lon.",'".$plan."')";
        mysqli_query($enlace,$r);
        $data = "bien";
    }
    else{
        $data= null;
    }

    print json_encode($data);

    mysqli_close($enlace);
?>