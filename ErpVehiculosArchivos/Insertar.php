<?php

    include '../conexion.php';
    $erp=$_POST['inerp'];
    $des=$_POST['indes'];
    $tipo=$_POST['intipo'];
    $cap=$_POST['incap'];
    $marca=$_POST['inmarca'];
    $placa=$_POST['inplaca'];
    
    $directorio = "SCTERP";
    if (file_exists($directorio)) {
    
    } 
    else {
    mkdir("SCTERP", true);
    }
    $permitidos=array('jpg','png','jpeg','pdf');
    
    if($_FILES["infile"]["tmp_name"]){
        $nombre_base=basename(($_FILES["infile"]["name"]));
        $arregloArchivo=explode(".",$nombre_base);
        $extension=strtolower(end($arregloArchivo));
        if(in_array($extension, $permitidos)){
            $r="INSERT INTO erpvehiculos VALUES(null,".$erp.",'".$des."','".$tipo."',".$cap.",'".$marca."','".$placa."','0')";
            $resultado=mysqli_query($enlace,$r);
            $lastid=mysqli_insert_id($enlace);
            $nombre_base=basename(($_FILES["infile"]["name"]));
            $ruta="SCTERP/" .$lastid."".$erp.".".$extension;
            $subir_archivo=move_uploaded_file($_FILES["infile"]["tmp_name"], $ruta);
            if($subir_archivo){
                $r="UPDATE erpvehiculos SET SCT='".$ruta."' WHERE Consecutivo=".$lastid;
                $resultado=mysqli_query($enlace,$r);
                if($resultado){
                    echo "<script>alert('Archivo subido'); window.location='../ErpVehiculos.php'</script>";
                }
                else{
                    printf("Errormessage: %s\n" , mysqli_error($enlace));
                }
            }
            else{
                echo "<script>alert('Error al subir archivo'); window.location='../ErpVehiculos.php'</script>";
            }
        }
        else{
            echo "<script>alert('Solo se permiten archivos de formato: pdf, jpg, jpeg, png')</script>";
        }
    }
    else{
        echo "<script>alert('Seleccione un archivo valido');</script>";
    }

?>