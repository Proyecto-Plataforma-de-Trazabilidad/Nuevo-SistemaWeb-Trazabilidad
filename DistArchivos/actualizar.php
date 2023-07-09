<?php
    include '../conexion.php';
    $id=$_POST["inid"];
    $nom=$_POST['innom'];
    $rep=$_POST['inrep'];
    $dom=$_POST['indom'];
    $cp=$_POST['incp'];
    $ciu=$_POST['inciu'];
    $muni=$_POST['inmuni'];
    $edo=$_POST['inest'];
    $tel=$_POST['intel'];
    $corr=$_POST['incorr'];
    $lat=$_POST["inlat"];
    $lon=$_POST["inlon"];
    $giro=$_POST['ingiro'];
    
    $permitidos=array('jpg','png','jpeg','pdf');
    if(!$_FILES["infile1"]["tmp_name"] && !$_FILES["infile2"]["tmp_name"] && !$_FILES["infile3"]["tmp_name"]){
        $r="UPDATE distribuidores SET Nombre='".$nom."', Representante='".$rep."', Domicilio='".$dom."', CP='".$cp."',
        Ciudad='".$ciu."', Municipio='".$muni."', Edo='".$edo."', Telefono='".$tel."',  Correo='".$corr."', 
        Latitud=".$lat.", Longitud=".$lon.", ActividadGiro='".$giro."' WHERE IdDistribuidor=".$id;
        mysqli_query($enlace,$r);
        echo "<script>window.location='../Distribuidores.php'</script>";
    }
    else{
    if($_FILES["infile1"]["tmp_name"] && $_FILES["infile2"]["tmp_name"] && $_FILES["infile3"]["tmp_name"]){
        $nombre_base=basename(($_FILES["infile1"]["name"]));
        $nombre_base2=basename(($_FILES["infile2"]["name"]));
        $nombre_base3=basename(($_FILES["infile3"]["name"]));

        $arregloArchivo=explode(".",$nombre_base);
        $arregloArchivo2=explode(".",$nombre_base2);
        $arregloArchivo3=explode(".",$nombre_base3);

        $extension=strtolower(end($arregloArchivo));
        $extension2=strtolower(end($arregloArchivo2));
        $extension3=strtolower(end($arregloArchivo3));

        if(in_array($extension, $permitidos) && in_array($extension2, $permitidos) && in_array($extension3, $permitidos)){
            $r="SELECT CapacitacionBUMA, SEMARNAT, LicenciaMunicipio FROM distribuidores WHERE IdDistribuidor=".$id;
            $resultado=mysqli_query($enlace,$r);
            $row=mysqli_fetch_array($resultado);
            $buma=$row[0];
            $sema=$row[1];
            $lic=$row[2];
            $ruta1="SEMARNATDistribuidores/" .$id.".".$extension2;
            $ruta2="LicenciaDistribuidores/" .$id.".".$extension3;
            $ruta3="BUMADistribuidores/" .$id.".".$extension;
            if(file_exists($buma)){
                unlink($buma);
            }
            if(file_exists($sema)){
                unlink($sema);
            }
            if(file_exists($lic)){
                unlink($lic);
            }
                $subir_archivo=move_uploaded_file($_FILES["infile1"]["tmp_name"], $ruta3);
                $subir_archivo2=move_uploaded_file($_FILES["infile2"]["tmp_name"], $ruta1);
                $subir_archivo3=move_uploaded_file($_FILES["infile3"]["tmp_name"], $ruta2);
                if($subir_archivo && $subir_archivo2 && $subir_archivo3){
                    $r="UPDATE distribuidores SET Nombre='".$nom."', Representante='".$rep."', Domicilio='".$dom."', CP='".$cp."',
                    Ciudad='".$ciu."', Municipio='".$muni."', Edo='".$edo."', Telefono='".$tel."',  Correo='".$corr."', 
                    Latitud=".$lat.", Longitud=".$lon.", ActividadGiro='".$giro."', CapacitacionBUMA='".$ruta3."', 
                    SEMARNAT='".$ruta1."', LicenciaMunicipio='".$ruta2."' WHERE IdDistribuidor=".$id;
                    $resultado=mysqli_query($enlace,$r);
                    if($resultado){
                        echo "<script>alert('Archivos subidos'); window.location='../Distribuidores.php'</script>";
                        return false;
                    }
                    else{
                        printf("Errormessage: %s\n" , mysqli_error($enlace));
                        return false;
                    }
                }
                else{
                    echo "<script>alert('Error al subir el archivo');</script>";
                    return false;
                }
        }
        else{
            echo "<script>alert('Solo se permiten archivos con extensión .pdf .jpg .jpeg .png');</script>";
            return false;
        }
        
    }
    else{
        

        if($_FILES["infile1"]["tmp_name"] && $_FILES["infile2"]["tmp_name"]){
            $nombre_base=basename(($_FILES["infile1"]["name"]));
            $nombre_base2=basename(($_FILES["infile2"]["name"]));
    
            $arregloArchivo=explode(".",$nombre_base);
            $arregloArchivo2=explode(".",$nombre_base2);
    
            $extension=strtolower(end($arregloArchivo));
            $extension2=strtolower(end($arregloArchivo2));
    
            if(in_array($extension, $permitidos) && in_array($extension2, $permitidos)){
                $r="SELECT CapacitacionBUMA, SEMARNAT FROM distribuidores WHERE IdDistribuidor=".$id;
                $resultado=mysqli_query($enlace,$r);
                $row=mysqli_fetch_array($resultado);
                $buma=$row[0];
                $sema=$row[1];
                $ruta1="SEMARNATDistribuidores/" .$id.".".$extension2;
                $ruta3="BUMADistribuidores/" .$id.".".$extension;
                if(file_exists($buma)){
                    unlink($buma);
                }
                if(file_exists($sema)){
                    unlink($sema);
                }
                    $subir_archivo=move_uploaded_file($_FILES["infile1"]["tmp_name"], $ruta3);
                    $subir_archivo2=move_uploaded_file($_FILES["infile2"]["tmp_name"], $ruta1);
                    if($subir_archivo && $subir_archivo2){
                        $r="UPDATE distribuidores SET Nombre='".$nom."', Representante='".$rep."', Domicilio='".$dom."', CP='".$cp."',
                        Ciudad='".$ciu."', Municipio='".$muni."', Edo='".$edo."', Telefono='".$tel."',  Correo='".$corr."', 
                        Latitud=".$lat.", Longitud=".$lon.", ActividadGiro='".$giro."', CapacitacionBUMA='".$ruta3."', SEMARNAT='".$ruta1."' WHERE IdDistribuidor=".$id;
                        $resultado=mysqli_query($enlace,$r);
                        if($resultado){
                            echo "<script>alert('Archivos subidos en file1 y file 2'); window.location='../Distribuidores.php'</script>";
                            return false;
                        }
                        else{
                            printf("Errormessage: %s\n" , mysqli_error($enlace));
                            return false;
                        }
                    }
                    else{
                        echo "<script>alert('Error al subir el archivo');</script>";
                        return false;
                    }
            }
            else{
                echo "<script>alert('Solo se permiten archivos con extensión .pdf .jpg .jpeg .png');</script>";
                return false;
            }
            
        }
        
        if($_FILES["infile1"]["tmp_name"] && $_FILES["infile3"]["tmp_name"]){
            $nombre_base=basename(($_FILES["infile1"]["name"]));
            $nombre_base3=basename(($_FILES["infile3"]["name"]));
    
            $arregloArchivo=explode(".",$nombre_base);
            $arregloArchivo3=explode(".",$nombre_base3);
    
            $extension=strtolower(end($arregloArchivo));
            $extension3=strtolower(end($arregloArchivo3));
    
            if(in_array($extension, $permitidos) && in_array($extension3, $permitidos)){
                $r="SELECT CapacitacionBUMA, LicenciaMunicipio FROM distribuidores WHERE IdDistribuidor=".$id;
                $resultado=mysqli_query($enlace,$r);
                $row=mysqli_fetch_array($resultado);
                $buma=$row[0];
                $lic=$row[0];
                $ruta2="LicenciaDistribuidores/" .$id.".".$extension3;
                $ruta3="BUMADistribuidores/" .$id.".".$extension;
                if(file_exists($buma)){
                    unlink($buma);
                }
                if(file_exists($lic)){
                    unlink($lic);
                }
                    $subir_archivo=move_uploaded_file($_FILES["infile1"]["tmp_name"], $ruta3);
                    $subir_archivo3=move_uploaded_file($_FILES["infile3"]["tmp_name"], $ruta2);
                    if($subir_archivo && $subir_archivo3){
                        $r="UPDATE distribuidores SET Nombre='".$nom."', Representante='".$rep."', Domicilio='".$dom."', CP='".$cp."',
                        Ciudad='".$ciu."', Municipio='".$muni."', Edo='".$edo."', Telefono='".$tel."',  Correo='".$corr."', 
                        Latitud=".$lat.", Longitud=".$lon.", ActividadGiro='".$giro."', CapacitacionBUMA='".$ruta3."', LicenciaMunicipio='".$ruta2."' WHERE IdDistribuidor=".$id;
                        $resultado=mysqli_query($enlace,$r);
                        if($resultado){
                            echo "<script>alert('Archivos subidos en file1 y file3'); window.location='../Distribuidores.php'</script>";
                            return false;
                        }
                        else{
                            printf("Errormessage: %s\n" , mysqli_error($enlace));
                            return false;
                        }
                    }
                    else{
                        echo "<script>alert('Error al subir el archivo');</script>";
                        return false;
                    }
            }
            else{
                echo "<script>alert('Solo se permiten archivos con extensión .pdf .jpg .jpeg .png');</script>";
                return false;
            }
            
        }
        
        if($_FILES["infile2"]["tmp_name"] && $_FILES["infile3"]["tmp_name"]){
            $nombre_base=basename(($_FILES["infile1"]["name"]));
            $nombre_base2=basename(($_FILES["infile2"]["name"]));
            $nombre_base3=basename(($_FILES["infile3"]["name"]));
    
            $arregloArchivo2=explode(".",$nombre_base2);
            $arregloArchivo3=explode(".",$nombre_base3);
    
            $extension2=strtolower(end($arregloArchivo2));
            $extension3=strtolower(end($arregloArchivo3));
    
            if(in_array($extension2, $permitidos) && in_array($extension3, $permitidos)){
                $r="SELECT SEMARNAT, LicenciaMunicipio FROM distribuidores WHERE IdDistribuidor=".$id;
                $resultado=mysqli_query($enlace,$r);
                $row=mysqli_fetch_array($resultado);
                $sema=$row[0];
                $lic=$row[1];
                $ruta1="SEMARNATDistribuidores/" .$id.".".$extension2;
                $ruta2="LicenciaDistribuidores/" .$id.".".$extension3;
                if(file_exists($sema)){
                    unlink($sema);
                }
                if(file_exists($lic)){
                    unlink($lic);
                }
                    $subir_archivo2=move_uploaded_file($_FILES["infile2"]["tmp_name"], $ruta1);
                    $subir_archivo3=move_uploaded_file($_FILES["infile3"]["tmp_name"], $ruta2);
                    if($subir_archivo2 && $subir_archivo3){
                        $r="UPDATE distribuidores SET Nombre='".$nom."', Representante='".$rep."', Domicilio='".$dom."', CP='".$cp."',
                        Ciudad='".$ciu."', Municipio='".$muni."', Edo='".$edo."', Telefono='".$tel."',  Correo='".$corr."', 
                        Latitud=".$lat.", Longitud=".$lon.", ActividadGiro='".$giro."', SEMARNAT='".$ruta1."', LicenciaMunicipio='".$ruta2."' WHERE IdDistribuidor=".$id;
                        $resultado=mysqli_query($enlace,$r);
                        if($resultado){
                            echo "<script>alert('Archivos subidos en file2 y file3'); window.location='../Distribuidores.php'</script>";
                            return false;
                        }
                        else{
                            printf("Errormessage: %s\n" , mysqli_error($enlace));
                        }
                    }
                    else{
                        echo "<script>alert('Error al subir el archivo');</script>";
                        return false;
                    }
            }
            echo "<script>alert('Solo se permiten archivos con extensión .pdf .jpg .jpeg .png');</script>";
            return false;
            
        }
        if($_FILES["infile1"]["tmp_name"]){
            $nombre_base=basename(($_FILES["infile1"]["name"]));
    
            $arregloArchivo=explode(".",$nombre_base);
    
            $extension=strtolower(end($arregloArchivo));
    
            if(in_array($extension, $permitidos)){
                $r="SELECT CapacitacionBUMA FROM distribuidores WHERE IdDistribuidor=".$id;
                $resultado=mysqli_query($enlace,$r);
                $row=mysqli_fetch_array($resultado);
                $buma=$row[0];
                $ruta3="BUMADistribuidores/".$id.".".$extension;
                if(file_exists($buma)){
                    unlink($buma);
                }
                    $subir_archivo=move_uploaded_file($_FILES["infile1"]["tmp_name"], $ruta3);
                    if($subir_archivo){
                        $r="UPDATE distribuidores SET Nombre='".$nom."', Representante='".$rep."', Domicilio='".$dom."', CP='".$cp."',
                        Ciudad='".$ciu."', Municipio='".$muni."', Edo='".$edo."', Telefono='".$tel."',  Correo='".$corr."', 
                        Latitud=".$lat.", Longitud=".$lon.", ActividadGiro='".$giro."', CapacitacionBUMA='".$ruta3."' WHERE IdDistribuidor=".$id;
                        $resultado=mysqli_query($enlace,$r);
                        if($resultado){
                            echo "<script>alert('Archivo subido file1'); window.location='../Distribuidores.php'</script>";
                            return false;
                        }
                        else{
                            printf("Errormessage: %s\n" , mysqli_error($enlace));
                            return false;
                        }
                    }
                    else{
                        echo "<script>alert('Error al subir el archivo');</script>";
                        return false;
                    }
            }
            else{
                echo "<script>alert('Solo se permiten archivos con extensión .pdf .jpg .jpeg .png');</script>";
                return false;
            }
            
        }
        
        if($_FILES["infile2"]["tmp_name"]){
            
            $nombre_base2=basename(($_FILES["infile2"]["name"]));
    
            $arregloArchivo2=explode(".",$nombre_base2);
    
            $extension2=strtolower(end($arregloArchivo2));
    
            if(in_array($extension2, $permitidos)){
                $r="SELECT SEMARNAT FROM distribuidores WHERE IdDistribuidor=".$id;
                $resultado=mysqli_query($enlace,$r);
                $row=mysqli_fetch_array($resultado);
                $sema=$row[0];
                $ruta1="SEMARNATDistribuidores/".$id.".".$extension2;
                if(file_exists($sema)){
                    unlink($sema);
                }
                    $subir_archivo2=move_uploaded_file($_FILES["infile2"]["tmp_name"], $ruta1);
                    if($subir_archivo2){
                        $r="UPDATE distribuidores SET Nombre='".$nom."', Representante='".$rep."', Domicilio='".$dom."', CP='".$cp."',
                        Ciudad='".$ciu."', Municipio='".$muni."', Edo='".$edo."', Telefono='".$tel."',  Correo='".$corr."', 
                        Latitud=".$lat.", Longitud=".$lon.", ActividadGiro='".$giro."', SEMARNAT='".$ruta1."' WHERE IdDistribuidor=".$id;
                        $resultado=mysqli_query($enlace,$r);
                        if($resultado){
                            echo "<script>alert('Archivo subido file2'); window.location='../Distribuidores.php'</script>";
                            return false;
                        }
                        else{
                            printf("Errormessage: %s\n" , mysqli_error($enlace));
                            return false;
                        }
                    }
                    else{
                        echo "<script>alert('Error al subir el archivo');</script>";
                        return false;
                    }
                
            }
            else{
                echo "<script>alert('Solo se permiten archivos con extensión .pdf .jpg .jpeg .png');</script>";
                return false;
            }
        }
        
        if($_FILES["infile3"]["tmp_name"]){
            $nombre_base3=basename(($_FILES["infile3"]["name"]));
    
            $arregloArchivo3=explode(".",$nombre_base3);
    
            $extension3=strtolower(end($arregloArchivo3));
    
            if(in_array($extension3, $permitidos)){
                $r="SELECT LicenciaMunicipio FROM distribuidores WHERE IdDistribuidor=".$id;
                $resultado=mysqli_query($enlace,$r);
                $row=mysqli_fetch_array($resultado);
                $lic=$row[0];
                $ruta2="LicenciaDistribuidores/" .$id.".".$extension3;
                if(file_exists($lic)){
                    unlink($lic);
                }
                
                    $subir_archivo3=move_uploaded_file($_FILES["infile3"]["tmp_name"], $ruta2);
                    if($subir_archivo3){
                        $r="UPDATE distribuidores SET Nombre='".$nom."', Representante='".$rep."', Domicilio='".$dom."', CP='".$cp."',
                        Ciudad='".$ciu."', Municipio='".$muni."', Edo='".$edo."', Telefono='".$tel."',  Correo='".$corr."', 
                        Latitud=".$lat.", Longitud=".$lon.", ActividadGiro='".$giro."', LicenciaMunicipio='".$ruta2."' WHERE IdDistribuidor=".$id;
                        $resultado=mysqli_query($enlace,$r);
                        if($resultado){
                            echo "<script>alert('Archivo subido file3'); window.location='../Distribuidores.php'</script>";
                            return false;
                        }
                        else{
                            printf("Errormessage: %s\n" , mysqli_error($enlace));
                            return false;
                        }
                    }
                    else{
                        echo "<script>alert('Error al subir el archivo');</script>";
                        return false;
                    }
            }
            else{
                echo "<script>alert('Solo se permiten archivos con extensión .pdf .jpg .jpeg .png');</script>";
                return false;
            }
        }
    }
    
}
?>