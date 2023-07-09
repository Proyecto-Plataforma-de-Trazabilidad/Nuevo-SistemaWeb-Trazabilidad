<?php
    include '../conexion.php';
    error_reporting(0);
    $nom=$_POST['innom'];
    $rep=$_POST['inrep'];
    $dom=$_POST['indom'];
    $cp=$_POST['incp'];
    $ciu=$_POST['inciu'];
    $muni=$_POST['jmr_contacto_municipio'];
    $edo=$_POST['jmr_contacto_estado'];
    $tel=$_POST['intel'];
    $corr=$_POST['incorr'];
    $lat=$_POST["inlat"];
    $lon=$_POST["inlon"];
    $giro=$_POST['ingiro'];
    
    $directorio = "SEMARNATDistribuidores";
    $directorio2 = "LicenciaDistribuidores";
    $directorio3 = "BUMADistribuidores";

    if (!file_exists($directorio)) {
        mkdir("SEMARNATDistribuidores", true);
    } 

    if (!file_exists($directorio2)) {
        mkdir("LicenciaDistribuidores", true);
    } 

    if (!file_exists($directorio3)) {
        mkdir("BUMADistribuidores", true);
    } 
    $permitidos=array('jpg','png','jpeg','pdf');

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
            $r="INSERT INTO distribuidores VALUES(NULL,'".$nom."','".$rep."','".$dom."','".$cp."','".$ciu."','".$muni."','".$edo."','".$tel."','".$corr."',".$lat.",".$lon.",'".$giro."','0','0','0')";
            $resultado=mysqli_query($enlace,$r);
            $lastid=mysqli_insert_id($enlace);
            $num = $lastid;
    
            $ruta1="SEMARNATDistribuidores/" .$num.".".$extension2;
            $ruta2="LicenciaDistribuidores/" .$num.".".$extension3;
            $ruta3="BUMADistribuidores/" .$num.".".$extension;
            
            $subir_archivo=move_uploaded_file($_FILES["infile1"]["tmp_name"], $ruta3);
            $subir_archivo2=move_uploaded_file($_FILES["infile2"]["tmp_name"], $ruta1);
            $subir_archivo3=move_uploaded_file($_FILES["infile3"]["tmp_name"], $ruta2);
            
            if($subir_archivo && $subir_archivo2 && $subir_archivo3){
                //$r="UPDATE distribuidores SET CapacitacionBUMA='".$ruta3."', SEMARNAT='".$ruta1."', LicenciaMunicipio='".$ruta2."' WHERE IdDistribuidor=".$lastid;
                $r = "UPDATE distribuidores SET SEMARNAT = '$ruta1', LicenciaMunicipio = '$ruta2', CapacitacionBUMA = '$ruta3' WHERE IdDistribuidor = '$num' ";
                
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
        }
        else{
            $data="extension";//Solo se permiten archivos con extensión .pdf .jpg .jpeg .png
        }
        
    }
    else{
        $data=null; //si ninguno de los 3 archivos es valido 
    }

    print json_encode($data);

    mysqli_close($enlace);
?>