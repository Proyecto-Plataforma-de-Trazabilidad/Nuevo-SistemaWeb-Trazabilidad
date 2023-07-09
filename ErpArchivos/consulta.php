<?php
  include "../Layout/navMenu2.php";
  $consulta = "SELECT * FROM usuarios where Correo = '$varses'";
  $res = mysqli_query($enlace, $consulta);      
  $filas = mysqli_fetch_array($res);
?>
<script type="text/javascript" src="../jquery-3.6.0.min.js"></script>

<br><br>
<div class="container">
  <h1>Consulta Empresa Recolectora Privada</h1>
</div>
<br>
        
        <?php
            include "../conexion.php";
            $idtipo = $_GET['id'];
            $nueva = base64_decode($idtipo);
            $r="SELECT * FROM empresarecolectoraprivada WHERE IdERP=".$nueva;
            $comando= mysqli_query($enlace, $r);
            $row=mysqli_fetch_array($comando);
        ?>

      <form class="row g-4 container-fluid" id="frm" method="POST" action="actualizar.php" onsubmit="return valdez()" enctype="multipart/form-data">

        <div class="col-2">
          <label for="inid" class="form-label">idERP</label>
          <input type="text" class="form-control" id="inid"  name="inid" maxlength="60" disabled required value="<?php echo($row[0]);?>">
        </div>

        <div class="col-sm-4">
          <label for="innom" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="innom"  name="innom" maxlength="60" disabled required value="<?php echo($row[2]);?>">
        </div>

        <div class="col-sm-3">
          <label for="indom" class="form-label">Domicilio</label>
          <input type="text" class="form-control" id="indom"  name="indom" maxlength="60" disabled required value="<?php echo($row[3]);?>">
        </div>

        <div class="col-sm-3">
            <label for="intel" class="form-label">Teléfono</label>
            <input type="number" class="form-control" id="intel" maxlength="10" name="intel" disabled required value="<?php echo($row[4]);?>">
        </div>
      
        <div class="col-4">
            <label for="incp" class="form-label">Código Postal</label>
            <input type="number" class="form-control" id="incp" maxlength="5" name="incp" disabled required value="<?php echo($row[5]);?>">
        </div>

        <div class="col-4">
          <label for="inmuni" class="form-label">Municipio</label>
          <input type="text" class="form-control" id="inmuni"  name="inmuni" maxlength="60" disabled required value="<?php echo($row[6]);?>">
        </div>

        <div class="col-4">
          <label for="inest" class="form-label">Estado</label>
          <input type="text" class="form-control" id="inest"  name="inest" maxlength="60" disabled required value="<?php echo($row[7]);?>">
        </div>

        <div class="col-sm-4">
          <label for="incorr" class="form-label">Correo</label>
          <input type="text" class="form-control" id="incorr"  name="incorr" maxlength="60" disabled required value="<?php echo($row[8]);?>">
        </div>

        <div class="col-sm-4">
          <label for="inres" class="form-label">Responsable</label>
          <input type="text" class="form-control" id="inres"  name="inres" maxlength="60" disabled required value="<?php echo($row[13]);?>">
        </div>

        <div class="col-sm-4">
          <label for="ingiro" class="form-label">Actividad giro</label>
          <br>
          <textarea name="ingiro" id="ingiro" cols="30" rows="4" class="form-control" maxlength="200" disabled value="<?php echo($row[11]);?>"><?php echo($row[11]);?></textarea>
        </div>

        <div class="col-md-2">
          <label for="inarch2" class="form-label">Permiso Actual</label>
          <a href="<?php echo($row[1]);?>" class="form-control">Permiso</a>
        </div>

        <div class="col-4">
          <label for="infile1" class="form-label">Permiso &nbsp;&nbsp;&nbsp;</label>
          <input type="file" name="infile1" id="infile1" class="form-file">
        </div>


        <div class="col-md-2">
          <label for="inarch" class="form-label">SEMARNAT Actual</label>
          <a href="<?php echo($row[12]);?>" class="form-control">SEMARNAT</a>
        </div>

        <div class="col-4">
          <label for="infile2" class="form-label">SEMARNAT</label>
          <input type="file" name="infile2" id="infile2" class="form-file">
        </div>

        <div class="col-sm-3">
            <label for="inlat" class="form-label">Latitud</label>
            <input type="text" class="form-control" id="inlat" maxlength="20" name="inlat" disabled required value="<?php echo($row[9]);?>">
        </div>

        <div class="col-sm-3">
            <label for="inlon" class="form-label">Longitud</label>
            <input type="text" class="form-control" id="inlon" maxlength="20" name="inlon" disabled required value="<?php echo($row[10]);?>">
        </div>
        <div class="col-sm-6">
          
        </div>
        <div class="col-4">
          <button type="button" class="btn btn-primary" id="btnEditar" onclick="habilitar()" name="Editar">Editar</button>
        </div>
        <div class="col-4">
          <button type="submit" class="btn btn-success" id="btnGuardar" onclick="hab()" disabled name="Guardar">Guardar</button>
        </div>

        <div class="row g-4 container-fluid">
          <div class="col-md-12">
              <div id="mapa" style="width: 100%; height: 500px">

              </div>
          </div>
        </div>

      </form>
      

      <br><br>
      <br>
    <script>
      function habilitar(){
        document.getElementById("innom").disabled=false;
        document.getElementById("indom").disabled=false;
        document.getElementById("intel").disabled=false;
        document.getElementById("incp").disabled=false;
        document.getElementById("inest").disabled=false;
        document.getElementById("incorr").disabled=false;
        document.getElementById("inmuni").disabled=false;
        document.getElementById("ingiro").disabled=false;
        document.getElementById("inres").disabled=false;
        document.getElementById("inlat").disabled=false;
        document.getElementById("inlon").disabled=false;
        document.getElementById("btnGuardar").disabled=false;
      }
      function hab(){
        document.getElementById("inid").disabled=false;
      }
      function valdez(){
        let tel=document.getElementById("intel").value;
        let cp=document.getElementById("incp").value;
        if(tel.length<10 || tel.length>10){
          alert("El campo: Telefono, debe ser de 10 digitos");
          return false;
        }
        if(cp.length<5 || cp.length>5){
          alert("El campo: Codigo Postal, debe ser de 5 digitos");
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
            if (rol == 2 || rol == 3 || rol == 4 || rol == 11) {
              $(function(){
                $('#btnEditar').hide();
                $('#btnGuardar').hide();
              });
            }   
      </script>

      <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../datatables.min.js"></script>
    <script type="text/javascript" src="../tablas.js"></script>
    <script type="text/javascript" src="funcionesErp.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASLyp51V8W65RPg92rTcqaFWCOXz6KrOg&callback=initMap"></script>
    <script src="../Layout/menujs.js"></script>
</body>
</html>