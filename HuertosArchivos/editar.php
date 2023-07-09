<?php
  include "../Layout/navMenu2.php";
  $consulta = "SELECT * FROM usuarios where Correo = '$varses'";
  $res = mysqli_query($enlace, $consulta);      
  $filas = mysqli_fetch_array($res);

?>
<script type="text/javascript" src="../jquery-3.6.0.min.js"></script>

<div class="container">
  <h1>Consulta Huerto</h1>
</div>
<br>

    <?php
        include "../conexion.php";
        $idtipo=$_GET['id'];
        $nueva = base64_decode($idtipo);
        $r="SELECT h.IdHuerto, h.IdProductor, p.Nombre, h.Latitud, h.Longitud, h.HUE FROM huertos AS h INNER JOIN productores AS p ON h.IdProductor=p.IdProductor WHERE h.IdHuerto=".$nueva;
        $comando= mysqli_query($enlace, $r);
        $row=mysqli_fetch_array($comando);
        
    ?>
      <form class="row g-4 container-fluid" id="frm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" onsubmit="return valdez()">

        <div class="col-2"> 
            <label for="inid" class="form-label">IdHuerto</label>
            <input type="number" class="form-control" id="inid" maxlength="10" name="inid" readonly value="<?php echo($row[0]);?>">
        </div>

        <div class="col-sm-4"> 
            <label for="inprod" class="form-label">Productor</label>
            <select name="inprod" id="inprod" class="form-select" disabled>
                <option value="<?php echo($row[1]);?>"><?php echo($row[2]);?></option>
            </select>
        </div>

        <div class="col-sm-2"> 
            <label for="inhue" class="form-label">HUE</label>
            <input type="number" class="form-control" id="inhue" disabled maxlength="10" name="inhue" required placeholder="Ingrese el HUE" value="<?php echo($row[5]);?>">
        </div>
        <div class="col-sm-2"> 
            <label for="inlat" class="form-label">Latitud</label>
            <input type="text" class="form-control" id="inlat" maxlength="10" disabled name="inlat" required placeholder="Ingrese la latitud" value="<?php echo($row[3]);?>">
        </div>
        <div class="col-sm-2"> 
            <label for="inlon" class="form-label">Longitud</label>
            <input type="text" class="form-control" id="inlon" maxlength="10" disabled name="inlon" required placeholder="Ingrese la longitud" value="<?php echo($row[4]);?>">
        </div>

        <div class="col-2">
          <button type="button" class="btn btn-primary" onclick="Habilitar()" id="btnEditar" name="Registrar">Editar</button>
        </div>

        <div class="col-3">
          <button type="button" class="btn btn-success" onclick="" id="btnGuardar" disabled name="Registrar">Guardar</button>
        </div>

        <div class="row g-4 container-fluid">
          <div class="col-md-12">
              <div id="mapa" style="width: 100%; height: 500px">

              </div>
          </div>
        </div>

      </form>
        <?php
          mysqli_close($enlace);
        ?>
      <br>
      
      <br>
       <script>
        function Habilitar(){
          document.getElementById("inprod").disabled=false;
          document.getElementById("inhue").disabled=false;
          document.getElementById("inlon").disabled=false;
          document.getElementById("inlat").disabled=false;
          document.getElementById("btnGuardar").disabled=false;
        }
        function initMap(){
          let latitud=document.getElementById("inlat").value;
          let longitud=document.getElementById("inlon").value;
          cordenadas={lat:latitud, lng:longitud}

          generarMapa(cordenadas);

        }
        function generarMapa(coordenadas){
          let mapa=new google.maps.Map(document.getElementById('mapa'),{
            zoom: 16,
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
            if (rol == 4) {
              $(function(){
                $('#btnGuardar').hide();
                $('btnEditar').hide();
              });
            }   
      </script>

      <script type="text/javascript" src="../jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="funcionesEditar.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASLyp51V8W65RPg92rTcqaFWCOXz6KrOg&callback=initMap"></script>
      <script src="../js/menujs.js"></script>
</body>
</html>