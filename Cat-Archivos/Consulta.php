<?php
  include "../Layout/navMenu2.php";
  $consulta = "SELECT * FROM usuarios where Correo = '$varses'";
  $res = mysqli_query($enlace, $consulta);      
  $filas = mysqli_fetch_array($res);
?>
<script type="text/javascript" src="../jquery-3.6.0.min.js"></script>

<div class="container">
  <h1>Consulta Centro de Acopio Temporal</h1>
</div>

<br>
    <?php
    include "../conexion.php";
    $idtipo = $_GET['id'];
    $nueva = base64_decode($idtipo);
        $r="SELECT c.IdCAT, c.IdResponsableCAT, r.Nombre, c.NombreCentro, c.NumRegAmbiental, c.InformacionAdicional, 
        c.Domicilio, c.CP, c.Municipio, c.Estado, c.Telefono, c.Correo, c.HorarioDiasLaborales, c.Latitud, c.Longitud,
        c.PlanManejo FROM centroacopiotemporal AS c INNER JOIN responsablecat AS r ON c.IdResponsableCAT=r.IdCAT WHERE c.IdCAT=".$nueva;
        $comando= mysqli_query($enlace, $r);
        if($comando){
          
        }
        else{
          echo (mysqli_error($enlace));
        }
        $row=mysqli_fetch_array($comando);

        
        
    ?>
      <form class="row g-4 container-fluid" id="frm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" onsubmit="return 0">

      <div class="col-sm-1">
          <label for="incat" class="form-label">IdCat</label>
          <input type="text" class="form-control" id="incat"  name="indes" maxlength="60" disabled="" required value="<?php echo($row[0]);?>">
      </div>
      <div class="col-sm-4">
          <label for="inres" class="form-label">Responsable</label>
          <select name="inres" id="inres" class="form-select" disabled required>
            <option value="<?php echo($row[1]);?>"><?php echo($row[2]);?></option>
          </select>
      </div>
      
      <div class="col-sm-4">
          <label for="innom" class="form-label">Nombre Centro</label>
          <input type="text" class="form-control" id="innom"  name="innom" maxlength="30"  disabled required placeholder="Ingresa un nombre" value="<?php echo($row[3]);?>">
        </div>

      <div class="col-sm-3">
            <label for="innra" class="form-label">Número de registro ambiental</label>
            <input type="number" class="form-control" id="innra" maxlength="10" name="innra" disabled required value="<?php echo($row[4]);?>">
        </div>

        <div class="col-sm-4">
          <label for="indom" class="form-label">Domicilio</label>
          <input type="text" class="form-control" id="indom"  name="indom" maxlength="60" disabled required value="<?php echo($row[6]);?>">
        </div>
      
        <div class="col-4">
            <label for="incp" class="form-label">Código Postal</label>
            <input type="number" class="form-control" id="incp" maxlength="5" name="incp" disabled required value="<?php echo($row[7]);?>">
        </div>

        <div class="col-sm-4">
          <label for="inmuni" class="form-label">Municipio</label>
          <input type="text" class="form-control" id="inmuni"  name="inmuni" maxlength="60" disabled required value="<?php echo($row[8]);?>">
        </div>

        <div class="col-sm-4">
          <label for="inest" class="form-label">Estado</label>
          <input type="text" class="form-control" id="inest"  name="inest" maxlength="60" disabled required value="<?php echo($row[9]);?>">
        </div>

        <div class="col-sm-4">
            <label for="intel" class="form-label">Teléfono</label>
            <input type="number" class="form-control" id="intel" maxlength="10" name="intel" disabled required value="<?php echo($row[10]);?>">
        </div>

        <div class="col-sm-4">
          <label for="incorr" class="form-label">Correo</label>
          <input type="text" class="form-control" id="incorr"  name="incorr" maxlength="60" disabled required value="<?php echo($row[11]);?>">
        </div>
        
        <div class="col-sm-4">
          <label for="inhor" class="form-label">Horarios días laborales</label>
          <input type="text" class="form-control" id="inhor"  name="inhor" maxlength="60" disabled required value="<?php echo($row[12]);?>">
        </div>

        <div class="col-sm-4">
          <label for="inplan" class="form-label">Plan de manejo</label>
          <textarea id="inplan" cols="30" rows="3" name="inplan" class="form-control" maxlength="200" disabled placeholder="Escribe el plan manejo..." value="<?php echo($row[15]);?>"><?php echo($row[15]);?></textarea>
        </div>

        <div class="col-sm-4">
          <label for="info" class="form-label">Información adicional</label>
          <textarea id="info" cols="30" rows="3" name="info" class="form-control" maxlength="200" disabled placeholder="Escribe la informacion adicional..." value="<?php echo($row[5]);?>"><?php echo($row[5]);?></textarea>
        </div>

        <div class="col-sm-3">
            <label for="inlat" class="form-label">Latitud</label>
            <input type="text" class="form-control" id="inlat" maxlength="20" name="inlat" disabled required placeholder="Ingresa la latitud" value="<?php echo($row[13]);?>">
        </div>

        <div class="col-sm-3">
            <label for="inlon" class="form-label">Longitud</label>
            <input type="text" class="form-control" id="inlon" maxlength="20" name="inlon" required disabled placeholder="Ingresa la longitud" value="<?php echo($row[14]);?>">
        </div>
        <div class="col-sm-6">
            
        </div>
        
        
          <div class="col-3">
            <button type="button" class="btn btn-primary" onclick="habilitar()" id="editar">Editar</button>
          </div>
          <div class="col-3">
            <button type="button" class="btn btn-success" disabled name="guardar" id="guardar">Guardar</button>
          </div>
        

        <?php 
            mysqli_close($enlace)
        ?>
        <div class="row g-4 container-fluid">
          <div class="col-md-12">
              <div id="mapa" style="width: 100%; height: 500px">

              </div>
          </div>

      </form>
      <script>
        function habilitar()
        {
          $('#frm :input').not('#incat').prop("disabled", false);
          document.getElementById("guardar").disabled=false;
          document.getElementById("editar").disabled=true;

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
            if (rol == 2 || rol == 3 || rol == 4 || rol == 6 || rol == 11) {
              $(function(){
                $('#editar').hide();
                $('#guardar').hide();
              });
            }   
      </script>
      

      
    <script type="text/javascript" src="../jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="funcionesConsulta.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASLyp51V8W65RPg92rTcqaFWCOXz6KrOg&callback=initMap"></script>
    <script src="../Layout/menujs.js"></script>
</body>
</html>