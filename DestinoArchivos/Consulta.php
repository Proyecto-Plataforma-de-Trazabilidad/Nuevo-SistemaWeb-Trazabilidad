<?php
  include "../Layout/navMenu2.php";
  $consulta = "SELECT * FROM usuarios where Correo = '$varses'";
  $res = mysqli_query($enlace, $consulta);      
  $filas = mysqli_fetch_array($res);
?>
<script type="text/javascript" src="../jquery-3.6.0.min.js"></script>


<div class="container">
  <h1>Consulta Empresas Destino</h1>
</div>
<br>
         <?php 
            include '../conexion.php';
            $idtipo = $_GET['id'];
            $nueva = base64_decode($idtipo);
            $r="SELECT * FROM empresadestino WHERE IdDestino=".$nueva;
            $comando=mysqli_query($enlace, $r);
            $row=mysqli_fetch_array($comando);
        ?>
      <form class="row g-4 container-fluid" id="frm" method="POST" action="actualizar.php" onsubmit="return 0" enctype="multipart/form-data">

        <div class="col-2">
            <label for="inid" class="form-label">IdDestino</label>
            <input type="number" id="inid" name="inid" class="form-control" readonly maxlength="5" required placeholder="p.ej. 49000" value="<?php echo($row[0]);?>">
        </div>

        <div class="col-sm-4">
            <label for="inraz" class="form-label">Razón Social</label>
            <input type="text" id="inraz" name="inraz" class="form-control" disabled maxlength="40" required placeholder="Ingrese la Razón social" value="<?php echo($row[1]);?>">
        </div>

        <div class="col-sm-2">
            <label for="indom" class="form-label">Domicilio</label>
            <input type="text" id="indom" name="indom" class="form-control" disabled maxlength="40" required placeholder="Ingrese el domicilio" value="<?php echo($row[3]);?>">
        </div>

        <div class="col-4">
            <label for="incp" class="form-label">Código Postal</label>
            <input type="number" id="incp" name="incp" class="form-control" disabled maxlength="5" required placeholder="p.ej. 49000" value="<?php echo($row[4]);?>">
        </div>

        <div class="col-4">
            <label for="inmuni" class="form-label">Municipio</label>
            <input type="text" id="inmuni" name="inmuni" class="form-control" disabled maxlength="40" required placeholder="Ingrese el municipio" value="<?php echo($row[5]);?>">
        </div>

        <div class="col-4">
            <label for="inedo" class="form-label">Estado</label>
            <input type="text" id="inedo" name="inedo" class="form-control" disabled maxlength="40" required placeholder="Ingrese el estado" value="<?php echo($row[6]);?>">
        </div>

        <div class="col-sm-4">
            <label for="intel" class="form-label">Teléfono</label>
            <input type="number" id="intel" name="intel" class="form-control" disabled maxlength="14" required placeholder="p.ej. 5521234567" value="<?php echo($row[7]);?>">
        </div>

        <div class="col-sm-4">
            <label for="incorr" class="form-label">Correo</label>
            <input type="text" id="incorr" name="incorr" class="form-control" disabled maxlength="40" required placeholder="p.ej. ejemplo@gmail.com" value="<?php echo($row[8]);?>">
        </div>

        <div class="col-sm-4">
            <label for="inarch" class="form-label">SEMARNAT Actual</label>
            <a href="<?php echo($row[2]);?>" class="form-control">SEMARNAT</a>    
        </div>
        
        <div class="col-sm-4">
            <label for="inputDom" class="form-label">SEMARNAT</label>
            <input type="file" name="infile" id="infile" class="form-file">
        </div>

        <div class="col-sm-3">
            <label for="inlat" class="Latitud">Latitud</label>
            <input type="text" id="inlat" name="inlat" class="form-control" disabled maxlength="40" required placeholder="Ingrese la latitud" value="<?php echo($row[9]);?>">
        </div>

        <div class="col-sm-3">
            <label for="inlon" class="Longitud">Longitud</label>
            <input type="text" id="inlon" name="inlon" class="form-control" disabled maxlength="40" required placeholder="Ingrese la longitud" value="<?php echo($row[10]);?>">
        </div>
        <div class="col-sm-6">
        </div>
        
<?php
    mysqli_close($enlace);
?>
        <div class="col-2">
          <button type="button" class="btn btn-primary" id="btnEditar" onclick="habilitar()" name="Registrar">Editar</button>
        </div>
        <div class="col-3">
          <button type="submit" class="btn btn-success" id="btnGuardar" onclick="" disabled name="Registrar">Guardar</button>
        </div>

        <div class="row g-4 container-fluid">
          <div class="col-md-12">
              <div id="mapa" style="width: 100%; height: 500px">

              </div>
          </div>
        </div>
      </form>
      

      
      <br>
       <script>
        function habilitar()
        {
          document.getElementById("inraz").disabled=false;
          document.getElementById("indom").disabled=false;
          document.getElementById("incp").disabled=false;
          document.getElementById("inmuni").disabled=false;
          document.getElementById("inedo").disabled=false;
          document.getElementById("intel").disabled=false;
          document.getElementById("incorr").disabled=false;
          document.getElementById("inlat").disabled=false;
          document.getElementById("inlon").disabled=false;
          document.getElementById("btnGuardar").disabled=false;
        }
          function valdez()
        {
            let tel=document.getElementById("intel").value;
            let cp=document.getElementById("incp").value;
            if(tel.length<10 || tel.length>10){
              alert("El campo Telefono, debe ser de 10 digitos");
              return false;
            }
            if(cp.length<5 || tel.length>5){
              alert("El campo Código postal, debe ser de 5 digitos");
              return false;
            }
            return 0;
        }
        function initMap(){
          let latitud=document.getElementById("inlat").value;
          let longitud=document.getElementById("inlon").value;
          cordenadas={lat:latitud, lng:longitud}

          generarMapa(cordenadas);

        }
        function generarMapa(coordenadas){
          let mapa=new google.maps.Map(document.getElementById('mapa'),{
            zoom: 12,
            center: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
          });

          marcador = new google.maps.Marker({
            map: mapa,
            draggable: true,
            position: new google.maps.LatLng(coordenadas.lat, coordenadas.lng),
            icon: "../Logos/Marcador.png",
          });

          marcador.addListener("dragend", function(event){
            document.getElementById("inlat").value=this.getPosition().lat();
            document.getElementById("inlon").value=this.getPosition().lng();
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

            //Si el id del rol obtenido, únicamente puede consultar -> ocultar los botones de guardar y editar
            if (rol == 2 || rol == 3 || rol == 4 || rol == 11) {
              $(function(){
                $('#btnEditar').hide();
                $('#btnGuardar').hide();
              });
            }   
    </script>


    <script type="text/javascript" src="../jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../datatables.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
    <script type="text/javascript" src="funcionesConsulta.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASLyp51V8W65RPg92rTcqaFWCOXz6KrOg&callback=initMap"></script>
    <script src="../Layout/menujs.js"></script>
</body>
</html>