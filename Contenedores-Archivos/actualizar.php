<?php

    include '../conexion.php';

    $id=$_POST['inid'];
    $tipoorigen=$_POST['intipoorigen'];
    $tipocont=$_POST['intipocont'];
    $cap=$_POST['incap'];
    $des=$_POST['indes'];
    $lat=$_POST["inlat"];
    $lon=$_POST['inlon'];
    $ulti=$_POST['inulti'];
    $manejo=$_POST['inman'];

    echo $id;
    var_dump($_FILES["infile"]["tmp_name"]);
    $permitidos=array('jpg','png','jpeg','pdf');

    // if($_FILES["infile"]["tmp_name"]){
    //     $nombre_base=basename(($_FILES["infile"]["name"]));
    //     $arregloArchivo=explode(".",$nombre_base);
    //     $extension=strtolower(end($arregloArchivo));
    //     if(in_array($extension, $permitidos)){
    //         $ruta="PermisosContenedor/" .$id."".$extension;
    //         $r="SELECT ReferenciaPermiso FROM contenedores WHERE IdContenedor=".$id;
    //         $comando=mysqli_query($enlace,$r);
    //         $row=mysqli_fetch_array($comando);
    //         if(file_exists($row[0])){
    //             unlink($row[0]);
    //         }
    //         $subir_archivo=move_uploaded_file($_FILES["infile"]["tmp_name"], $ruta);
    //         if($subir_archivo){
    //             $r="UPDATE contenedores SET IdTipoCont=".$tipocont.", Origen='".$tipoorigen."', Capacidad=".$cap.",
    //             Descripcion='".$des."', Latitud=".$lat.", Longitud=".$lon.", UltimaFechaRecoleccion='".$ulti."',
    //             InstruccionesManejo='".$manejo."', CapacidadStatus=".$cap.", ReferenciaPermiso='".$ruta."' WHERE IdContenedor=".$id;
    //             $resultado=mysqli_query($enlace,$r);
    //             if($resultado){
    //                 echo "<script> window.location='../Contenedores.php'</script>";
    //             }
    //             else{
    //             printf("Errormessage: %s\n" , mysqli_error($enlace));
    //             }
    //         }
    //     }
    //     else{
    //         echo "<script>
    //         Swal.fire({
    //             icon: 'error',
    //             title: 'Solo se permiten archivos con extensión .pdf, .jpg, .jpeg, .png',
    //             text: 'Intentar de nuevo.',
    //           });
    //         </script>";
    //     }
    // }
    // else{
    //     $r="UPDATE contenedores SET IdTipoCont=".$tipocont.", Origen='".$tipoorigen."', Capacidad=".$cap.",
    //             Descripcion='".$des."', Latitud=".$lat.", Longitud=".$lon.", UltimaFechaRecoleccion='".$ulti."',
    //             InstruccionesManejo='".$manejo."', CapacidadStatus=".$cap." WHERE IdContenedor=".$id;
    //             $resultado=mysqli_query($enlace,$r);
    //             if($resultado){
    //                 echo "<script>alert('Datos actualizados correctamente'); window.location='../Contenedores.php'</script>";
    //             }
    //             else{
    //             printf("Errormessage: %s\n" , mysqli_error($enlace));
    //             }
    // }

?>