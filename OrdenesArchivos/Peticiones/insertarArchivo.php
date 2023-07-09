<?php 


    $directorio = "Facturas";
    $directorio2 = "Recetas";
    if (!file_exists($directorio)) 
        mkdir("Facturas", true);
    if (!file_exists($directorio2)) 
        mkdir("Recetas", true);

    $permitidos=array('jpg','png','jpeg','pdf');
    $mensaje = array('rutaArchFac' => '', 'rutaArchRece' => '', 'extCorrectaArchFac' => '', 'extCorrectaArchRece' => '', 'guardadoArchFac' => '', 'guardadoArchRece' =>  '');
        
        //!Se guarda archivo de la factura
        if ($_FILES["archFac"]["tmp_name"]) {   
            $nombreArchFac = basename($_FILES["archFac"]["name"]); //Obtiene el nombre completo del archivo 
            $arregloArchFac = explode(".", $nombreArchFac); //Separa el nombre del archivo y su estencion en un arreglo
            $extensionArchFac = strtolower(end($arregloArchFac)); //Obtiene la extencion del archivo y los convierte a minusculas
            
            if (in_array($extensionArchFac, $permitidos)) {
                $rutaArchFac = "Facturas/f" . $_POST["IdOrden"] .".". $extensionArchFac;
                
                if (move_uploaded_file($_FILES["archFac"]["tmp_name"], $rutaArchFac)) {
                    $mensaje['guardadoArchFac'] = "Correcto";
                    $mensaje['rutaArchFac'] = $rutaArchFac;
                }else
                    $mensaje['guardadoArchFac'] = "Fallido";

            }else
                $mensaje['extCorrectaArchFac'] =  "No permitida";
            
        }else
        $mensaje['rutaArchFac'] = "Faltante";
        
        //!Se guarda archivo de la receta
        if ($_FILES["archRece"]["tmp_name"]) {

            $nombreArchRece=basename(($_FILES["archRece"]["name"])); //Obtiene el nombre completo del archivo 
            $arregloArchRece = explode(".", $nombreArchRece); //Separa el nombre del archivo y su estencion en un arreglo
            $extensionArchRece = strtolower(end($arregloArchRece)); //Obtiene la extencion del archivo y los convierte a minusculas
            
            if (in_array($extensionArchRece, $permitidos)) {
                $rutaArchRece = "Recetas/r" . $_POST["IdOrden"] .".". $extensionArchRece;

                if (move_uploaded_file($_FILES["archRece"]["tmp_name"], $rutaArchRece)) {
                    $mensaje['guardadoArchRece'] = "Correcto";
                    $mensaje['rutaArchRece'] = $rutaArchRece;
                }else
                    $mensaje['guardadoArchRece'] = "Fallido";

            }else
                $mensaje['extCorrectaArchRece'] =  "No permitida";

        }else
        $mensaje['rutaArchRece'] = "Faltante";

        $datos =json_encode($mensaje);
        echo $datos;
?>