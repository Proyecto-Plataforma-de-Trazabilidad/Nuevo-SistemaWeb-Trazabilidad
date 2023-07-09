<?php
include "Layout/navMenu.php";
include 'conexion.php';
$r = "SELECT * FROM usuarios where Correo = '$varses'";
$res = mysqli_query($enlace, $r);
$filas = mysqli_fetch_array($res);
?>
<script type="text/javascript" src="jquery-3.6.0.min.js"></script>

<!--SweetAlert en linea-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
<!--SweetAlert en local-->
<link rel="stylesheet" href="..\plugins\Sweetalert2\sweetalert2.min.css">
<script src="..\plugins\Sweetalert2\sweetalert2.all.min.js"></script>

<!--Combos responsivos-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="container">
  <h2>Centro de Acopio Temporal</h2>
</div>
<br>
<form class="row g-4 container-fluid" id="frm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return 0">

  <div class="col-sm-4">
    <label for="inres" class="form-label">Responsable</label>
    <select name="inres" id="inres" class="form-select">

    </select>
  </div>

  <div class="col-sm-4">
    <label for="innom" class="form-label">Nombre Centro</label>
    <input type="text" class="form-control" id="innom" name="innom" maxlength="30" pattern="[A-Za-z nÑáéíóúÁÉÍÓÚ.'´_-,]{1,30}" placeholder="Ingresa un nombre">
  </div>

  <div class="col-sm-4">
    <label for="inNra" class="form-label">Número de registro ambiental</label>
    <input type="number" class="form-control" id="inNra" maxlength="10" name="inNra" placeholder="Ingresa el número de registro">
  </div>

  <div class="col-4">
    <label for="inest" class="form-label">Estado</label>
    <br>
    <select id="jmr_contacto_estado" name="jmr_contacto_estado" class="js-example-basic-multiple form-control" id="Estado">
      <option>Selecciona el estado</option>
    </select>
  </div>

  <script>
    $(document).ready(function() {
      $('#jmr_contacto_estado').select2();
    });
  </script>

  <div class="col-4">
    <label for="inmuni" class="form-label">Municipio</label>
    <br>
    <select id="jmr_contacto_municipio" name="jmr_contacto_municipio" class="js-example-basic-multiple form-control" id="Estado">
      <option>Selecciona tu municipio</option>
    </select>
  </div>

  <script>
    $(document).ready(function() {
      $('#jmr_contacto_municipio').select2();
    });
  </script>

  <div class="col-4">
    <label for="incp" class="form-label">Código Postal</label>
    <input type="number" class="form-control" id="incp" maxlength="5" name="incp" pattern="[0-9]{5}" placeholder="49000">
  </div>

  <div class="col-4">
    <label for="indom" class="form-label">Domicilio</label>
    <input type="text" class="form-control" id="indom" name="indom" maxlength="30" pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" placeholder="Ingresa un domicilio">
  </div>


  <div class="col-4">
    <label for="intel" class="form-label">Teléfono</label>
    <input type="text" class="form-control" id="intel" maxlength="10" name="intel" pattern="[0-9]{10}" placeholder="p.ej. 5531234567">
  </div>

  <div class="col-sm-4">
    <label for="incorr" class="form-label">Correo</label>
    <input type="text" class="form-control" id="incorr" name="incorr" maxlength="60" pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#@0-_9.,-]{1,30}" placeholder="ejemplo@gmail.com">
    <div id="respuesta"> </div>
  </div>

  <div class="col-4">
    <label for="inhor" class="form-label">Horarios días laborales</label>
    <input type="text" class="form-control" id="inhor" name="inhor" maxlength="40" pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ0-9.:,-]{1,30}" placeholder="p.ej. Lun-Vie-08-16">
  </div>

  <div class="col-4">
    <label for="inplan" class="form-label">Plan de manejo</label>
    <textarea id="inplan" cols="30" rows="3" name="inplan" class="form-control" maxlength="200" placeholder="Escribe el plan manejo..."></textarea>
  </div>

  <div class="col-sm-4">
    <label for="info" class="form-label">Información adicional</label>
    <textarea id="info" cols="30" rows="3" name="info" class="form-control" maxlength="200" placeholder="Escribe la información adicional..."></textarea>
  </div>

  <div class="col-sm-4">
    <label for="inlat" class="form-label">Latitud</label>
    <input type="text" class="form-control" id="inlat" maxlength="20" name="inlat" placeholder="Ingresa la latitud">
  </div>

  <div class="col-sm-4">
    <label for="inlon" class="form-label">Longitud</label>
    <input type="text" class="form-control" id="inlon" maxlength="20" name="inlon" placeholder="Ingresa la longitud">
  </div>


  <div class="col-sm-4">

  </div>
  <div class="col-3">
    <button type="submit" class="btn btn-success" name="Registrar">Registrar</button>
  </div>
  <div class="col-3">
    <a href="Cat-Archivos/ConsultaMaps.php"><button type="button" class="btn btn-primary" onclick="" name="Registrar">Ubicaciones</button></a>
  </div>

  <div class="row g-4 container-fluid">
    <div class="col-md-12">
      <div id="mapa" style="width: 100%; height: 500px">

      </div>
    </div>
  </div>

</form>


<br><br>

<div class="container col-12" id="consulta">
  <div class="container text-center">
    <h5>Acopios Temporales Registrados</h5>
  </div>
  <center>
    <table class="table table-striped" id="tabla">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Responsable</th>
          <th scope="col">Nombre Centro</th>
          <th scope="col">Núm. de Reg. Ambiental</th>
          <th scope="col">Domicilio</th>
          <th scope="col">Municipio</th>
          <th scope="col">Teléfono</th>
          <th scope="col">Horarios</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody id="bodyTabla">

      </tbody>
    </table>
  </center>
</div>
<br>
<script>
  function initMap() {
    let latitud = 19.7047732
    let longitud = -103.5031816;
    cordenadas = {
      lat: latitud,
      lng: longitud
    }

    generarMapa(cordenadas);

  }

  function generarMapa(coordenadas) {
    let mapa = new google.maps.Map(document.getElementById('mapa'), {
      zoom: 12,
      center: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
    });

    marcador = new google.maps.Marker({
      map: mapa,
      draggable: true,
      position: new google.maps.LatLng(coordenadas.lat, coordenadas.lng),
      icon: "Logos/Marcador.png",
    });

    marcador.addListener("dragend", function(event) {
      document.getElementById("inlat").value = this.getPosition().lat();
      document.getElementById("inlon").value = this.getPosition().lng();
    })
  }

  function obtenerTamaño() {
    let ancho = document.documentElement.clientWidth;
    ancho.addListener("change", function(event) {

    })
  }

  //Validando si existe el Correo en BD antes de enviar el Form
  $("#incorr").on("keyup", function() {
    var incorr = $("#incorr").val(); //CAPTURANDO EL VALOR DE INPUT CON ID Correo
    var longitudCorreo = $("#incorr").val().length; //CUENTO LONGITUD
    //Valido la longitud 
    if (longitudCorreo >= 3) {
      var dataString = 'incorr=' + incorr;
      $.ajax({
        url: 'verificarCorreo.php',
        type: "GET",
        data: dataString,
        dataType: "JSON",
        success: function(datos) {
          if (datos.success == 1) {
            $("#respuesta").html(datos.message);
            $("input#incorr").attr('disabled', false); //Habilitando el input correo
            $("#Registrar").attr('disabled', true); //Desabilito el Botton
          } else {
            $("#respuesta").html(datos.message);
            $("#Registrar").attr('disabled', false); //Habilito el Botton
          }
        }
      });
    }
  });
</script>

<!--Código PHP para obtener el IDtiporol del usuario que inició sesión-->
<?php
$rol = $filas['Idtipousuario'];
?>

<!--Código de JS para mandar a una variable de js el valor de una variable php-->
<script type="text/javascript">
  var rol = "<?php echo $rol; ?>";

  //Si el id del rol obtenido, únicamente puede consultar -> ocultar el formulario
  if (rol == 2 || rol == 3 || rol == 4 || rol == 6 || rol == 11) {
    $(function() {
      $('#frm').hide();
    });
  }
</script>

<script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="datatables.min.js"></script>
<script type="text/javascript" src="Cat-Archivos/funcionesCat.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASLyp51V8W65RPg92rTcqaFWCOXz6KrOg&callback=initMap"></script>
<script src="poper\popper.min.js"></script>
<script src="Layout/menujs.js"></script>
</main>
</body>

</html>