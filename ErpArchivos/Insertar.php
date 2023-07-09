<?php
    include '../conexion.php';
    error_reporting(0);
    $nom=$_POST['innom'];
    $dom=$_POST['indom'];
    $tel=$_POST['intel'];
    $cp=$_POST['incp'];
    $lat=$_POST["inlat"];
    $lon=$_POST["inlon"];
    $muni=$_POST['jmr_contacto_municipio'];
    $edo=$_POST['jmr_contacto_estado'];
    $corr=$_POST['incorr'];
    $giro=$_POST['ingiro'];
    $res=$_POST['inres'];
    
    $directorio = "SEMARNATERP";
    $directorio2 = "PermisosERP";
    if (file_exists($directorio)) {

    } 
    else {
    mkdir("SEMARNATERP", true);
    }
    if (file_exists($directorio2)) {

    } 
    else {
    mkdir("PermisosERP", true);
    }
    $permitidos=array('jpg','png','jpeg','pdf');

    if($_FILES["infile1"]["tmp_name"] && $_FILES["infile2"]["tmp_name"]){

        $nombre_base=basename(($_FILES["infile1"]["name"]));
        $arregloArchivo=explode(".",$nombre_base);
        $extension=strtolower(end($arregloArchivo));

        $nombre_base2=basename(($_FILES["infile2"]["name"]));
        $arregloArchivo2=explode(".",$nombre_base2);
        $extension2=strtolower(end($arregloArchivo2));

        if(in_array($extension, $permitidos) && in_array($extension2, $permitidos)){
            $r="INSERT INTO empresarecolectoraprivada VALUES(NULL,'0','".$nom."','".$dom."','".$tel."','".$cp."','".$muni."','".$edo."','".$corr."','".$lat."','".$lon."','".$giro."','0','".$res."')";
            $resultado=mysqli_query($enlace,$r);
            $lastid=mysqli_insert_id($enlace);
            
            $ruta1="SEMARNATERP/" .$lastid.".".$extension2;
            $ruta2="PermisosERP/" .$lastid.".".$extension;

            $subir_archivo=move_uploaded_file($_FILES["infile1"]["tmp_name"], $ruta2);
            $subir_archivo2=move_uploaded_file($_FILES["infile2"]["tmp_name"], $ruta1);
            
            if($subir_archivo && $subir_archivo2){
                $r="UPDATE empresarecolectoraprivada SET Permiso='".$ruta2."', SEMARNAT='".$ruta1."' WHERE IdERP=".$lastid;
                $resultado=mysqli_query($enlace,$r);
                if($resultado){
                    $data="archivos subidos";//all se ha ejecutado correctamente
                }
                else{
                    $data = "server fail";//error del servidor
                }
            }
            else{
                $data = "error";//Error al subir el archivo
            }
        }else{
            $data="extension";//Solo se permiten archivos con extensión .pdf .jpg .jpeg .png 
        }
    }
    else{
        $data=null; //si ninguno de los 3 archivos es valido 
    }

    print json_encode($data);
    mysqli_close($enlace);

?>