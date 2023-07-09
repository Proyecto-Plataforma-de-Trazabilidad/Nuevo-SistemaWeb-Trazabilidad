<?php
include '../conexion.php';
$id=$_POST['inid'];
$res=$_POST['inres'];
$nom=$_POST['innom'];
$dom=$_POST['indom'];
$cp=$_POST['incp'];
$est=$_POST['inest'];
$tel=$_POST['intel'];
$corr=$_POST['incorr'];
$lat=$_POST['inlat'];
$lon=$_POST['inlon'];

$permitidos=array('jpg','png','jpeg','pdf');
$nombre_base=basename(($_FILES["infile"]["name"]));
if($_FILES["infile"]["tmp_name"]){
    $nombre_base=basename(($_FILES["infile"]["name"]));
    $arregloArchivo=explode(".",$nombre_base);
    $extension=strtolower(end($arregloArchivo));
    if(in_array($extension, $permitidos)){
        $r="SELECT SEMARNAT FROM municipio WHERE IdMunicipio=".$id;
        $resultado=mysqli_query($enlace,$r);
        $row=mysqli_fetch_array($resultado);
        $sema=$row[0];

        $ruta="SEMARNATMunicipio/".$id.".".$extension;
        if(file_exists($sema)){
            unlink($sema);
        }
            $subir_archivo=move_uploaded_file($_FILES["infile"]["tmp_name"], $ruta);
            if($subir_archivo){
                $r="UPDATE municipio SET NombreLugar='".$nom."', Domicilio='".$dom."', Telefono='".$tel."', CP='".$cp."', 
                Edo='".$est."', Correo='".$corr."', Latitud=".$lat.", Longitud=".$lon.", Responsable='".$res."', 
                SEMARNAT='".$ruta."' WHERE IdMunicipio=".$id;
                $resultado=mysqli_query($enlace,$r);
                if($resultado){
                    echo "<script>alert('Archivo subido'); window.location='../Municipio.php'</script>";
                }
                else{
                printf("Errormessage: %s\n" , mysqli_error($enlace));
                }
            }   
            else{
                echo "<script>alert('Error al subir el archivo'); window.location='../Municipio.php'</script>";
            }
    }
    else{
        echo "<script>alert('Solo se permiten archivos con extensión .pdf .jpg .jpeg .png'); window.location='../Municipio.php'</script>";
    }
}
else{
    $r="UPDATE municipio SET NombreLugar='".$nom."', Domicilio='".$dom."', Telefono='".$tel."', CP='".$cp."', 
        Edo='".$est."', Correo='".$corr."', Latitud=".$lat.", Longitud=".$lon.", Responsable='".$res."' WHERE IdMunicipio=".$id;
    mysqli_query($enlace,$r);
    echo "<script>alert('paso por aqui'); window.location='../Municipio.php'</script>";
}

?>