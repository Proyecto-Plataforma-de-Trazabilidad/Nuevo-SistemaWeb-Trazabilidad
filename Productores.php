<?php
include "Layout/navMenu.php";
include 'conexion.php';
$r = "SELECT * FROM usuarios where Correo = '$varses'";
$res = mysqli_query($enlace, $r);
$filas = mysqli_fetch_array($res);
?>

    <!--SweetAlert en linea-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <!--SweetAlert en local por mis webos-->
    <link rel="stylesheet" href="..\plugins\Sweetalert2\sweetalert2.min.css">
    <script src="..\plugins\Sweetalert2\sweetalert2.all.min.js"></script>
    <!--Combos responsivos-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<div class="container">
  <h1>Productores</h1>
</div>
<br>
<form class="row g-4 container-fluid" id="frm" method="POST" action="ProductoresArchivos/Insertar.php" onsubmit="return 0">

  <div class="col-sm-4">
    <label for="innom" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="innom" name="innom" maxlength="40" pattern="[A-Za-z nÑáéíóúÁÉÍÓÚ.'´_-,]{1,40}" placeholder="Ingresa el nombre">
  </div>

  <div class="col-sm-4">
    <label for="inreg" class="form-label">RegistroProductor</label>
    <input type="date" class="form-control" id="inreg" name="inreg" maxlength="15" pattern="[1-9A-Za-z nÑáéíóúÁÉÍÓÚ.'´_-,]{1,30}" placeholder="Ingresa el registro">
  </div>

  <div class="col-4">
    <label for="indom" class="form-label">Domicilio</label>
    <input type="text" class="form-control" id="indom" name="indom" maxlength="30" pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" placeholder="Ingresa el domicilio">
  </div>

  <div class="col-4">
    <label for="incp" class="form-label">Código Postal</label>
    <input type="text" class="form-control" id="incp" maxlength="5" name="incp" pattern="[0-9]{5}" placeholder="p.ej. 49000">
  </div>

  <div class="col-4">
            <label for="inest" class="form-label" >Estado</label>
            <br>
            <select id="jmr_contacto_estado" name="jmr_contacto_estado" class="js-example-basic-multiple form-control" id="Estado" multiple="multiple"><option>Selecciona tu estado</option></select>
        </div>
  
        <script>
                $(document).ready(function () {
                $('#jmr_contacto_estado').select2();
                });
        </script>


        <div class="col-4">
               <label for="muni" class="form-label">Municipio</label>
               <br>
               <select id="jmr_contacto_municipio" name="jmr_contacto_municipio" class="js-example-basic-multiple form-control"  multiple="multiple"><option>Selecciona tu municipio</option></select>
        </div>

        <script>
                $(document).ready(function () {
                $('#jmr_contacto_municipio').select2();
                });
        </script>

  <div class="col-4">
    <label for="inciu" class="form-label">Ciudad</label>
    <input type="text" class="form-control" id="inciu" name="inciu" maxlength="30" placeholder="Ingresa la ciudad">
  </div>


  <div class="col-4">
    <label for="intel" class="form-label">Teléfono</label>
    <input type="text" class="form-control" id="intel" maxlength="14" name="intel" pattern="[0-9]{10}" placeholder="5521234567">
  </div>

  <div class="col-sm-4">
    <label for="incorr" class="form-label">Correo</label>
    <input type="text" class="form-control" id="incorr" name="incorr" maxlength="60" pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#@0-_9.,-]{1,30}" placeholder="ejemplo@gmail.com">
    <div id="respuesta"> </div>
  </div>

  <div class="col-4">
    <label for="inpuntos" class="form-label">Puntos Acumulados</label>
    <input type="text" class="form-control" id="inpuntos" name="inpuntos" maxlength="20" pattern="[0-9]{1,10}" placeholder="Ingresa los puntos">
  </div>

  <div class="col-4">
    <label for="inorden" class="form-label">Total Piezas Orden</label>
    <input type="text" class="form-control" id="inorden" name="inorden" maxlength="11" placeholder="Ingresa num. de piezas">
  </div>

  <div class="col-4">
    <label for="inentrega" class="form-label">Total Piezas Entregadas</label>
    <input type="text" class="form-control" id="inentrega" name="inentrega" maxlength="11" placeholder="Ingresa num. de piezas">
  </div>

  <div class="col-sm-6">
    <label for="ingiro" class="form-label">Actividad Giro</label>
    <textarea name="ingiro" id="ingiro" cols="30" rows="4" class="form-control" placeholder="Ingresa la actividad o el giro..."></textarea>
  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-success" onclick="" name="Registrar" id="Registrar">Registrar</button>
  </div>

</form>


<br><br>
<div class="container text-center">
  <h5>Productores Registrados</h5>
</div>
<div class="container col-12">
  <center>
    <table class="table table-striped" id="tabla">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Nombre</th>
          <th scope="col">Fecha Registro</th>
          <th scope="col">Domicilio</th>
          <th scope="col">Municipio</th>
          <th scope="col">Estado</th>
          <th scope="col">Teléfono</th>
          <th scope="col">Puntos</th>
          <th scope="col">Piezas Orden</th>
          <th scope="col">Piezas entregadas</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody id="bodyTabla">

      </tbody>
    </table>
  </center>
</div>
<br>

</script>

<!--Código PHP para obtener el IDtiporol del usuario que inició sesión-->
<?php
$rol = $filas['Idtipousuario'];
?>

<!--Código de JS para mandar a una variable de js el valor de una variable php-->
<script type="text/javascript">
  var rol = "<?php echo $rol; ?>";

  //Si el id del rol obtenido, únicamente puede consultar -> ocultar el formulario
  if (rol == 3 || rol == 4 || rol == 11) {
    $(function() {
      $('#frm').hide();
    });
  }


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

<script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="datatables.min.js"></script>
<script type="text/javascript" src="ProductoresArchivos/funcionesProd.js"></script>
<script src="Layout/menujs.js"></script>
<script src="poper\popper.min.js"></script>

</body>

</html>