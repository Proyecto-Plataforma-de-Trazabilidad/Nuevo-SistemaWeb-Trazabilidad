<?php 
//var_dump($_FILES['archRecibo']);

$directorio = "Recibos";
if (!file_exists($directorio)) 
    mkdir("Recibos", true);


    $permitidos=array('pdf');
    $mensaje = array('rutaRecibo' => '', 'extCorrectaRecibo' => '', 'guardadoRecibo' => '');

    //!Se guarda archivo del recibo
    if ($_FILES["archRecibo"]["tmp_name"]) {   
        $nombreArchReci = basename($_FILES["archRecibo"]["name"]); //Obtiene el nombre completo del archivo 
        $arregloArcReci = explode(".", $nombreArchReci); //Separa el nombre del archivo y su extension en un arreglo
        $extensionArchReci = strtolower(end($arregloArcReci)); //Obtiene la extencion del archivo y los convierte a minusculas
        
        if (in_array($extensionArchReci, $permitidos)) {
            $rutaArchReci = "Recibos/re" . $_POST["IdEntrega"] .".". $extensionArchReci;
            
            if (move_uploaded_file($_FILES["archRecibo"]["tmp_name"], $rutaArchReci)) {
                $mensaje['guardadoRecibo'] = "Correcto";
                $mensaje['rutaRecibo'] = $rutaArchReci;
            }else
                $mensaje['guardadoRecibo'] = "Fallido";
        }else
            $mensaje['extCorrectaRecibo'] =  "No permitida";
        
    }else
    $mensaje['rutaRecibo'] = "Faltante";
    $datos =json_encode($mensaje);
    echo $datos;

?>