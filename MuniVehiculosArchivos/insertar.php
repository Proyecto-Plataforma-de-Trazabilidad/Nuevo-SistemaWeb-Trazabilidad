<?php

    include '../conexion.php';
    $inmuni=$_POST['inmuni'];
    $des=$_POST['indes'];
    $tipo=$_POST['intipo'];
    $cap=$_POST['incap'];
    $marca=$_POST['inmarca'];
    $placa=$_POST['inplaca'];
    
    $directorio = "SCTMunicipio";
    if (file_exists($directorio)) {
    
    } 
    else {
    mkdir("SCTMunicipio", true);
    }
    $permitidos=array('jpg','png','jpeg','pdf');
    
    if($_FILES["infile"]){
        $nombre_base=basename(($_FILES["infile"]["name"]));
        $arregloArchivo=explode(".",$nombre_base);
        $extension=strtolower(end($arregloArchivo));
        if(in_array($extension, $permitidos)){
            $r="INSERT INTO municipiovehiculos VALUES(NULL,".$inmuni.",'".$des."','".$tipo."',".$cap.",'".$marca."','".$placa."','0')";
            $resultado=mysqli_query($enlace,$r);
            $lastid=mysqli_insert_id($enlace);
            $ruta="SCTMunicipio/" .$lastid."".$inmuni.".".$extension;
            $subir_archivo=move_uploaded_file($_FILES["infile"]["tmp_name"], $ruta);
            if($subir_archivo){
                $r="UPDATE municipiovehiculos SET SCT='".$ruta."' WHERE Consecutivo=".$lastid;
                $resultado=mysqli_query($enlace,$r);
                if($resultado){
                    echo "<script>alert('Archivo subido'); window.location='../MuniVehiculos.php'</script>";
                }
                else{
                printf("Errormessage: %s\n" , mysqli_error($enlace));
                }
            }
        }
        else{
            echo "<script>alert('Solo se permiten archivos con extensión .pdf .jpg .jpeg .png');</script>";
        }
    }
    else{
        echo "<script>alert('Seleccione un archivo!!!');</script>";
    }

?>