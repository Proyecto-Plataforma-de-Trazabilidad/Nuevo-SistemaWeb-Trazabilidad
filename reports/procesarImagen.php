<?php 
    $my_base64_string = $_POST['img']; //Se recupera la imagen codificada enviada por ajax
    //echo $base64_string;
    function base64ToImage($base64_string, $output_file) {
        $file = fopen($output_file, "wb"); //se indica que se va a crear un archivo (la 'wb' son los permisos de escritura)
    
        $data = explode(',', $base64_string); //La imagen esta codificada en base64 y para poder decodificar se le quita la descripcion   
    
        fwrite($file, base64_decode($data[1])); //Se decodifica la imagen y se escribe en el archivo que se abrio 
        fclose($file); //Se cierra el archivo ya que se termino de escribir
        return $output_file; //retorna el archivo de la imagen
    }

    $image = base64ToImage( $my_base64_string, 'imagen.png' ); //Se llama a la funcion con la imagen codifica y el nombre del archivo que se va agenerar
?>