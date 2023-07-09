<?php
    include '../conexion.php';
    $id=$_POST['inid'];
    $raz=$_POST['inraz'];
    $dom=$_POST['indom'];
    $cp=$_POST['incp'];
    $muni=$_POST['inmuni'];
    $edo=$_POST['inedo'];
    $tel=$_POST['intel'];
    $corr=$_POST['incorr'];
    $lat=$_POST["inlat"];
    $lon=$_POST["inlon"];
    
    $directorio = "SEMARNATEmpresaDest";

    if (!file_exists($directorio)) {
        mkdir("SEMARNATEmpresaDest", true);
    }

    $permitidos=array('jpg','png','jpeg','pdf');

    if($_FILES["infile"]["tmp_name"]){
        $nombre_base=basename(($_FILES["infile"]["name"]));
        $arregloArchivo=explode(".",$nombre_base);
        $extension=strtolower(end($arregloArchivo));
        if(in_array($extension, $permitidos)){
            $r="SELECT SEMARNAT FROM empresadestino WHERE IdDestino=".$id;
            $resultado=mysqli_query($enlace,$r);
            $row=mysqli_fetch_array($resultado);
            $sema=$row[0];

            $ruta="SEMARNATEmpresaDest/" .$id.".".$extension;
            if(file_exists($sema)){
                unlink($sema);
            }
            $subir_archivo=move_uploaded_file($_FILES["infile"]["tmp_name"], $ruta);
            if($subir_archivo){
                $r="UPDATE empresadestino SET RazonSocial='".$raz."', Domicilio='".$dom."', CP='".$cp."', Municipio='".$muni."', 
                Edo='".$edo."', Telefono='".$tel."', Correo='".$corr."', Latitud='".$lat."', Longitud='".$lon."', SEMARNAT='".$ruta."' WHERE IdDestino=".$id;
                $resultado=mysqli_query($enlace,$r);
                if($resultado){
                    echo "<script>alert('Archivo subido');</script>";
                }
                else{
                    printf("Errormessage: %s\n" , mysqli_error($enlace));
                }
            }
            else{
                echo "<script>alert('Error al subir el archivo'); window.location='actualizar.php'</script>";
            }
        }
        else{
            echo "<script>alert('Solo se permiten archivos con extensión .pdf .jpg .jpeg .png');</script>";
        }
    }
    else{
        $r="UPDATE empresadestino SET RazonSocial='".$raz."', Domicilio='".$dom."', CP='".$cp."', Municipio='".$muni."', 
                Edo='".$edo."', Telefono='".$tel."', Correo='".$corr."', Latitud='".$lat."', Longitud='".$lon."' WHERE IdDestino=".$id;
                mysqli_query($enlace,$r);
                echo "<script>window.location='../EmpresaDestino.php';</script>";
    }
?>