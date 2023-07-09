<?php
  include "../Layout/navMenu2.php";
  $consulta = "Select * from usuarios where Correo = '$varses'";
  $res = mysqli_query($enlace, $consulta);
  $filas = mysqli_fetch_array($res);
?>
<script type="text/javascript" src="../jquery-3.6.0.min.js"></script>


<div class="container">
  <h1>Consulta Contenedor</h1>
</div>
<br>
    <?php
    include "../conexion.php";
    $idtipo = $_GET['id'];
    $nueva = base64_decode($idtipo);
        $r="SELECT c.IdContenedor, t.Concepto, c.Origen, u.Nombre AS 'Responsables', c.Capacidad, c.Descripcion, c.Latitud, c.Longitud, c.UltimaFechaRecoleccion, c.InstruccionesManejo, c.ReferenciaPermiso, t.idTipoCont FROM tipocontenedor as t inner join contenedores as c on c.IdTipoCont=t.idTipoCont INNER JOIN usuarios AS u ON c.IdUsuario=u.IdUsuario WHERE c.IdContenedor= ".$nueva;
        $comando= mysqli_query($enlace, $r);
        $row=mysqli_fetch_array($comando);
        
    ?>
      <form class="row g-4 container-fluid" id="frm" method="POST" action="actualizar.php"  enctype="multipart/form-data">

      <div class="col-md-2">
          <label for="inid" class="form-label">IdContenedor</label>
          <input type="text" class="form-control" id="inid"  name="inid" maxlength="60" required value="<?php echo($row[0]);?>" readonly>
        </div>

        <div class="col-md-2">
          <label for="intipocont" class="form-label">Tipo de contenedor</label>
          <select name="intipocont" id="intipocont" class="form-select" disabled required>
            <option value="<?php echo($row[11]);?>"><?php echo($row[1]);?></option>
            </select>
        </div>

        <div class="col-sm-2">
          <label for="intipoorigen" class="form-label">Tipo de origen</label>
          <select name="intipoorigen" id="intipoorigen" class="form-select" disabled>
            <option value="<?php echo($row[2]);?>"><?php echo($row[2]);?></option>
            <option value="AMOCALI">Amocalli</option>
            <option value="Distribuidores">Dist.</option> //Este si registra entregas
            <option value="CAT">CAT</option>
            <option value="Empresa Recicladora">Recicladora</option> 
            <option value="Municipios">Municipio</option> //Este si registra entregas
            <option value="Empresa Recolectora">Empresa</option> //Este si registra entregas
          </select>
        </div>

        <div class="col-4">
          <label for="inrespon" class="form-label">Responsable</label>
          <select name="inrespon" id="inrespon" class="form-select" disabled>
            <option hidden><?php echo($row[3]);?></option>
          </select>
        </div>
      
        <div class="col-2">
            <label for="incap" class="form-label">Capacidad (Kg)</label>
            <input type="number" class="form-control" id="incap" maxlength="10" name="incap" disabled required value="<?php echo($row[4]);?>">
        </div>

        <div class="col-sm-4">
          <label for="indes" class="form-label">Descripción</label>
          <input type="text" class="form-control" id="indes"  name="indes" maxlength="60" disabled required value="<?php echo($row[5]);?>">
        </div>
        
        <div class="col-sm-4">
          <label for="inulti" class="form-label">Última recolección</label>
          <input type="date" class="form-control" id="inulti"  name="inulti" maxlength="60" disabled required value="<?php echo($row[8]);?>">
        </div>

        <div class="col-md-4">
          <label for="infile" class="form-label">Referencia o permiso</label>
          <input type="file" name="infile" id="infile" class="form-file">
        </div>

        <div class="col-md-4">
          <label for="inarch" class="form-label">Permiso Actual</label>
          <a href="<?php echo($row[10]);?>" class="form-control">Permiso</a>
        </div>

        <div class="col-sm-4">
          <label for="inman" class="form-label">Instrucciones de manejo</label>
          <br>
          <textarea name="inman" id="inman" cols="30" rows="4" class="form-control" disabled required placeholder="Escribe las instrucciones" value="<?php echo($row[9]);?>"><?php echo($row[9]);?></textarea>
        </div>
        
        <div class="col-sm-4">
          <label for="inlat" class="form-label">Latitud</label>
          <input type="text" class="form-control" id="inlat"  name="inlat" maxlength="60" disabled required value="<?php echo($row[6]);?>">
        </div>

        <div class="col-sm-4">
          <label for="inlon" class="form-label">Longitud</label>
          <input type="text" class="form-control" id="inlon"  name="inlon" maxlength="60" disabled required value="<?php echo($row[7]);?>">
        </div>

        <br><br>

        <div class="col-2">
          <button type="button" class="btn btn-primary" onclick="habilitar();" name="Editar" id="btnEditar">Editar</button>
        </div>
        <div class="col-2">
          <button type="submit" class="btn btn-success" onclick="" name="guardar" id="btnGuardar" disabled>Guardar</button>
        </div>

        <br><br>

        <div class="row g-4 container-fluid">
          <div class="col-md-12">
              <div id="mapa" style="width: 100%; height: 500px">

              </div>
          </div>
        </div>

        <?php 
            mysqli_close($enlace)
        ?>
      </form>
      <script>
        function valdez(){
          let idcon=document.getElementById("inid").value;
          let des=document.getElementById("indes").value;
          let cap=document.getElementById("incap").value;
          let ulti=document.getElementById("inulti").value;
          let lat=document.getElementById("inlat").value;
          let lon=document.getElementById("inlon").value;
          let man=document.getElementById("inman").value;
          if(cap.length<2 || cap.length>6){
            alert("El campo: Capacidad debe ser de 2 a 6 digitos");
            return false;
          }
          document.getElementById("inid").disabled=false;
          document.getElementById("intipocont").disabled=false;
          document.getElementById("intipoorigen").disabled=false;
          return 0;
        }
        function habilitar()
        { 
          $('#frm :input').not('#inid').not('#intipocont').not('#intipoorigen').not('#inrespon').prop("disabled", false);
          $('#btnGuardar').prop("disabled", false);
          $('#btnEditar').prop("disabled", true);
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
            if (rol == 3 || rol == 2 || rol == 11 || rol == 4) {
              $(function(){
                $('#btnEditar').hide();
                $('#btnGuardar').hide();
              });
            }   
      </script>
      

      
    <script type="text/javascript" src="../jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="funConculta.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASLyp51V8W65RPg92rTcqaFWCOXz6KrOg&callback=initMap"></script>
    <script src="../Layout/menujs.js"></script>
</body>
</html>