<?php
    include '../conexion.php';
    $id=$_POST['inid'];
    $nom=$_POST['innom'];
    $dom=$_POST['indom'];
    $tel=$_POST['intel'];
    $cp=$_POST['incp'];
    $lat=$_POST["inlat"];
    $lon=$_POST["inlon"];
    $muni=$_POST['inmuni'];
    $edo=$_POST['inest'];
    $corr=$_POST['incorr'];
    $giro=$_POST['ingiro'];
    $res=$_POST['inres'];
    
    $permitidos=array('jpg','png','jpeg','pdf');
    if(!$_FILES["infile1"]["tmp_name"] && !$_FILES["infile2"]["tmp_name"]){
        $r="UPDATE empresarecolectoraprivada SET Nombre='".$nom."', Domicilio='".$dom."', Telefono='".$tel."', 
            CP='".$cp."', Municipio='".$muni."', Edo='".$edo."', Correo='".$corr."', Latitud='".$lat."', 
            Longitud='".$lon."', ActividadGiro='".$giro."' WHERE IdERP=".$id;
        mysqli_query($enlace,$r);
        echo "<script>window.location='../EmpresaRecPrivada.php'</script>";
    }
    else{
    if($_FILES["infile1"]["tmp_name"] && $_FILES["infile2"]["tmp_name"]){

        $nombre_base=basename(($_FILES["infile1"]["name"]));
        $arregloArchivo=explode(".",$nombre_base);
        $extension=strtolower(end($arregloArchivo));

        $nombre_base2=basename(($_FILES["infile2"]["name"]));
        $arregloArchivo2=explode(".",$nombre_base2);
        $extension2=strtolower(end($arregloArchivo2));
        
        if(in_array($extension, $permitidos) && in_array($extension2, $permitidos)){
            $r="SELECT Permiso, SEMARNAT FROM empresarecolectoraprivada WHERE IdERP=".$id;
            $resultado=mysqli_query($enlace,$r);
            $row=mysqli_fetch_array($resultado);
            $permiso=$row[0];
            $sema=$row[1];

            $ruta1="SEMARNATERP/" .$id.".".$extension2;
            $ruta2="PermisosERP/" .$id.".".$extension;
            if(file_exists($sema)){
                unlink($sema);
            }
            if(file_exists($permiso)){
                unlink($permiso);
            }
                $subir_archivo=move_uploaded_file($_FILES["infile1"]["tmp_name"], $ruta2);
                $subir_archivo2=move_uploaded_file($_FILES["infile2"]["tmp_name"], $ruta1);
                if($subir_archivo && $subir_archivo2){
                $r="UPDATE empresarecolectoraprivada SET Nombre='".$nom."', Domicilio='".$dom."', Telefono='".$tel."', 
                CP='".$cp."', Municipio='".$muni."', Edo='".$edo."', Correo='".$corr."', Latitud='".$lat."', 
                Longitud='".$lon."', ActividadGiro='".$giro."', Permiso='".$ruta2."', SEMARNAT='".$ruta1."' WHERE IdERP=".$id;
                $resultado=mysqli_query($enlace,$r);
                if($resultado){
                    echo "<script>alert('Archivo subido'); window.location='../EmpresaRecPrivada.php'</script>";
                }
                else{
                    printf("Errormessage: %s\n" , mysqli_error($enlace));
                }
            }
            else{
                echo("Error al subir el archivo");
            }
        }
        else{
            echo "<script>alert('Solo se permiten archivos con extensión .pdf .jpg .jpeg .png'); window.location='../EmpresaRecPrivada.php'</script>";
        }   
    }
    else{
        if($_FILES["infile1"]["tmp_name"]){
            $nombre_base=basename(($_FILES["infile1"]["name"]));
            $arregloArchivo=explode(".",$nombre_base);
            $extension=strtolower(end($arregloArchivo));
            
            if(in_array($extension, $permitidos)){
                $r="SELECT Permiso FROM empresarecolectoraprivada WHERE IdERP=".$id;
                $resultado=mysqli_query($enlace,$r);
                $row=mysqli_fetch_array($resultado);
                $permiso=$row[0];
                $ruta2="PermisosERP/" .$id.".".$extension;
                if(file_exists($permiso)){
                    unlink($permiso);
                }
                    $subir_archivo=move_uploaded_file($_FILES["infile1"]["tmp_name"], $ruta2);
                    if($subir_archivo){
                    $r="UPDATE empresarecolectoraprivada SET Nombre='".$nom."', Domicilio='".$dom."', Telefono='".$tel."', 
                    CP='".$cp."', Municipio='".$muni."', Edo='".$edo."', Correo='".$corr."', Latitud='".$lat."', 
                    Longitud='".$lon."', ActividadGiro='".$giro."', Permiso='".$ruta2."' WHERE IdERP=".$id;
                    $resultado=mysqli_query($enlace,$r);
                    if($resultado){
                        echo "<script>alert('Archivo subido'); window.location='../EmpresaRecPrivada.php'</script>";
                    }
                    else{
                        printf("Errormessage: %s\n" , mysqli_error($enlace));
                    }
                }
                else{
                    echo("Error al subir el archivo");
                }
            }
            else{
                echo "<script>alert('Solo se permiten archivos con extensión .pdf .jpg .jpeg .png'); window.location='../EmpresaRecPrivada.php'</script>";
            }   
        }
        else{
            if($_FILES["infile2"]["tmp_name"]){
                $nombre_base2=basename(($_FILES["infile2"]["name"]));
                $arregloArchivo2=explode(".",$nombre_base2);
                $extension2=strtolower(end($arregloArchivo2));
                
                if(in_array($extension2, $permitidos)){
                    $r="SELECT SEMARNAT FROM empresarecolectoraprivada WHERE IdERP=".$id;
                    $resultado=mysqli_query($enlace,$r);
                    $row=mysqli_fetch_array($resultado);
                    $sema=$row[0];
        
                    $ruta1="SEMARNATERP/" .$id.".".$extension2;
                    if(file_exists($sema)){
                        unlink($sema);
                    }
                        $subir_archivo2=move_uploaded_file($_FILES["infile2"]["tmp_name"], $ruta1);
                        if($subir_archivo2){
                        $r="UPDATE empresarecolectoraprivada SET Nombre='".$nom."', Domicilio='".$dom."', Telefono='".$tel."', 
                        CP='".$cp."', Municipio='".$muni."', Edo='".$edo."', Correo='".$corr."', Latitud='".$lat."', 
                        Longitud='".$lon."', ActividadGiro='".$giro."', SEMARNAT='".$ruta1."' WHERE IdERP=".$id;
                        $resultado=mysqli_query($enlace,$r);
                        if($resultado){
                            echo "<script>alert('Archivo subido'); window.location='../EmpresaRecPrivada.php'</script>";
                        }
                        else{
                            printf("Errormessage: %s\n" , mysqli_error($enlace));
                        }
                    }
                    else{
                        echo("Error al subir el archivo");
                    }
                    
                }
                else{
                    echo "<script>alert('Solo se permiten archivos con extensión .pdf .jpg .jpeg .png'); window.location='../EmpresaRecPrivada.php'</script>";
                }   
            }
        }
    }
    
}
?>