<?php
  // Agregamos el nombre y dirección a la ventana de información de cada marcador, puedes agregar la información que desees, nosotros agregaremos 'nombre' y 'direccion' 
  include "../conexion.php";
  $r="SELECT p.Nombre, h.HUE FROM huertos AS h INNER JOIN productores AS p ON h.IdProductor=p.IdProductor";
  $comando= mysqli_query($enlace, $r);
    while($row = mysqli_fetch_array($comando)){ ?>
    
    ['<div class="info_content">' + '<h3><?php echo $row[0]; ?></h3>' + '<p><?php echo $row[1]; ?></p>' + '</div>'], 
 
    <?php }
    mysqli_close($enlace);
 
?>