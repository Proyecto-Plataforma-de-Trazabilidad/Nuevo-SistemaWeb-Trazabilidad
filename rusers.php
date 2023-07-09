<?php
    include('Layout/navMenu.php')
?>

    <h2>Registrar Nuevo Usuario</h2>
    <br>

    <form class="row g-4 container-fluid" id="frm" method="POST" action="UserArchivos/insertar.php" onsubmit="return 0">

        <div class="col-sm-4">
        <label for="tipUser" class="form-label">Tipo Usuario</label>
        <select name="tipUser" id="tipUser" class="form-select">

        </select>
        </div>

        <div class="col-sm-4">
          <label for="nom" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="nom"  name="nom" maxlength="40" pattern="[A-Za-z nÑáéíóúÁÉÍÓÚ.'´_-,]{1,30}" required placeholder="Ingresa el nombre">
        </div>

        <div class="col-sm-4">
          <label for="cont" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="cont"  name="cont" maxlength="40" pattern="[A-Za-z nÑáéíóúÁÉÍÓÚ.'´_-,]{1,30}" required placeholder="Ingresa la contraseña">
        </div>

        <div class="col-sm-4">
            <label for="incorr" class="form-label">Email</label>
            <input type="text" class="form-control" id="incorr"  name="incorr" maxlength="50" pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#@0-_9.,-]{1,30}" placeholder="Ingresa el email">
            <div id="respuesta"> </div>
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-success" onclick="" name="Registrar">Registrar</button>
        </div>
    </form>

    <br><br>

    <!--Tabla para mostrar los usuarios registrados-->
    <div class="container text-center">
        <h5>Usuarios Registrados</h5>
    </div>

    <div class="container col-12">
        <center>
            <table class="table table-striped" id="tabla">
                <thead>
                    <tr>
                        <th scope="col">Id Usuario</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Opción</th>
                        
                    </tr>
                </thead>

                <tbody id="bodyTabla">

                </tbody>

            </table>
        </center>
    </div>

    <script>
          //Validando si existe el Correo en BD antes de enviar el Form
$("#incorr").on("keyup", function() {
  var incorr = $("#incorr").val(); //CAPTURANDO EL VALOR DE INPUT CON ID Correo
  var longitudCorreo = $("#incorr").val().length; //CUENTO LONGITUD
//Valido la longitud 
  if(longitudCorreo >= 3){
    var dataString = 'incorr=' + incorr;
      $.ajax({
          url: 'verificarCorreo.php',
          type: "GET",
          data: dataString,
          dataType: "JSON",
          success: function(datos){
                if( datos.success == 1){
                $("#respuesta").html(datos.message);
                $("input#incorr").attr('disabled',false); //Habilitando el input correo
                $("#Registrar").attr('disabled',true); //Desabilito el Botton
                }else{
                $("#respuesta").html(datos.message);
                $("#Registrar").attr('disabled',false); //Habilito el Botton
                    }
                  }
                });
              }
          });
    </script>

<script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="datatables.min.js"></script>
    <script type="text/javascript" src="UserArchivos/funcionesUsuarios.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoIir0y0RhmeX5MIfoHdiUgxTRQ21HE4w&callback=initMap"></script>
    <script src="menujs.js"></script>
</body>
</html>