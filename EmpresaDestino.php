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


<h1>Empresas Destino</h1>


<form class="row g-4 container-fluid" id="frm" method="POST" action="DestinoArchivos/Insertar.php" onsubmit="return valdez()" enctype="multipart/form-data">

  <div class="col-sm-4">
    <label for="innom" class="form-label">Razón Social</label>
    <input type="text" id="innom" name="innom" class="form-control" maxlength="40" placeholder="Ingrese la Razón social">
  </div>


  <div class="col-sm-4">
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



  <div class="col-sm-4">
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



  <div class="col-sm-4">
    <label for="indom" class="form-label">Domicilio</label>
    <input type="text" id="indom" name="indom" class="form-control" maxlength="40" placeholder="Ingrese el domicilio">
  </div>

  <div class="col-sm-4">
    <label for="incp" class="form-label">Código Postal</label>
    <input type="number" id="incp" name="incp" class="form-control" maxlength="5" placeholder="p.ej. 49000">
  </div>

  <div class="col-sm-4">
    <label for="intel" class="form-label">Teléfono</label>
    <input type="number" id="intel" name="intel" class="form-control" maxlength="14" placeholder="p.ej. 5521234567">
  </div>

  <div class="col-sm-4">
    <label for="incorr" class="form-label">Correo</label>
    <input type="text" id="incorr" name="incorr" class="form-control" maxlength="40" placeholder="p.ej. ejemplo@gmail.com">
    <div id="respuesta"> </div>
  </div>

  <div class="col-sm-8">
    <label for="infile" class="form-label">SEMARNAT</label>
    <br>
    <input type="file" name="infile" id="infile" class="form-file">
  </div>

  <div class="col-sm-4">
    <label for="inlat" class="form-label">Latitud</label>
    <input type="text" class="form-control" id="inlat" maxlength="10" name="inlat" placeholder="Ingrese la latitud">
  </div>

  <div class="col-sm-4">
    <label for="inlon" class="form-label">Longitud</label>
    <input type="text" class="form-control" id="inlon" maxlength="10" name="inlon" placeholder="Ingrese la longitud">
  </div>
  <div class="col-sm-4">
  </div>

  <div class="col-3">
    <button type="submit" class="btn btn-success" onclick="" name="Registrar">Registrar</button>
  </div>
  <div class="col-3">
    <a href="DestinoArchivos/consultaMaps.php"><button type="button" class="btn btn-primary" onclick="" name="Registrar">Ubicaciones</button></a>
  </div>

  <div class="row g-4 container-fluid">
    <div class="col-md-12">
      <div id="mapa" style="width: 100%; height: 500px">

      </div>
    </div>
  </div>
</form>


<br><br>
<div class="container text-center">
  <h5>Empresas Destino Registradas</h5>
</div>
<div class="container">
  <center>
    <table class="table table-striped" id="tabla">
      <thead>
        <tr>
          <th scope="col">idDestino</th>
          <th scope="col">Razón Social</th>
          <th scope="col">Domicilio</th>
          <th scope="col">Teléfono</th>
          <th scope="col">Correo</th>
          <th scope="col">SEMARNAT</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody id="bodyTabla">

    </table>
  </center>
</div>
<br>
<script>
  function valdez() {
    let tel = document.getElementById("intel").value;
    let cp = document.getElementById("incp").value;
    if (tel.length < 10 || tel.length > 10) {
      alert("El campo Telefono, debe ser de 10 digitos");
      return false;
    }
    if (cp.length < 5 || cp.length > 5) {
      alert("El campo Código postal, debe ser de 5 digitos");
      return false;
    }
    return 0;
  }

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
</script>

<!--Código PHP para obtener el IDtiporol del usuario que inició sesión-->
<?php
$rol = $filas['Idtipousuario'];
?>

<!--Código de JS para mandar a una variable de js el valor de una variable php-->
<script type="text/javascript">
  var rol = "<?php echo $rol; ?>";

  //Si el id del rol obtenido, únicamente puede consultar -> ocultar el formulario
  if (rol == 2 || rol == 3 || rol == 4 || rol == 11) {
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
<script type="text/javascript" src="DestinoArchivos/funcionesDestino.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASLyp51V8W65RPg92rTcqaFWCOXz6KrOg&callback=initMap"></script>
<script src="Layout/menujs.js"></script>
<script src="poper\popper.min.js"></script>
</body>

</html>