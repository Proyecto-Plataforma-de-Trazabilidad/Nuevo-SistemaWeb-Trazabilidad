<?php
  include "../Layout/navMenu2.php";
  $consulta = "SELECT * FROM usuarios where Correo = '$varses'";
  $res = mysqli_query($enlace, $consulta);      
  $filas = mysqli_fetch_array($res);
?>
<script type="text/javascript" src="../jquery-3.6.0.min.js"></script>

<div class="container">
  <h1>Consulta Productores</h1>
</div>
<br>
        <?php 
            include '../conexion.php';
            $idtipo = $_GET['id'];
            $nueva = base64_decode($idtipo);
            $r="SELECT * FROM productores WHERE IdProductor=".$nueva;
            $comando=mysqli_query($enlace, $r);
            $row=mysqli_fetch_array($comando);
        ?>
      <form class="row g-4 container-fluid" id="frm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" onsubmit="return 0">

        <div class="col-2">
          <label for="inid" class="form-label">IdProductor</label>
          <input type="text" class="form-control" id="inid"  name="inid" maxlength="60" disabled required value="<?php echo($row[0]);?>">
        </div>

        <div class="col-md-2">
          <label for="innom" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="innom"  name="innom" maxlength="60" disabled required value="<?php echo($row[1]);?>">
        </div>

        <div class="col-md-2">
          <label for="inreg" class="form-label">RegistroProductor</label>
          <input type="text" class="form-control" id="inreg"  name="inreg" maxlength="60" disabled required value="<?php echo($row[2]);?>">
        </div>

        <div class="col-sm-3">
          <label for="indom" class="form-label">Domicilio</label>
          <input type="text" class="form-control" id="indom"  name="indom" maxlength="60" disabled required value="<?php echo($row[3]);?>">
        </div>

        <div class="col-3">
            <label for="incp" class="form-label">Código Postal</label>
            <input type="number" class="form-control" id="incp" maxlength="5" name="incp" disabled required value="<?php echo($row[4]);?>">
        </div>

        <div class="col-3">
          <label for="inmuni" class="form-label">Municipio</label>
          <input type="text" class="form-control" id="inmuni"  name="inmuni" maxlength="60" disabled required value="<?php echo($row[6]);?>">
        </div>

        <div class="col-3">
          <label for="inest" class="form-label">Estado</label>
          <input type="text" class="form-control" id="inest"  name="inest" maxlength="60" disabled required value="<?php echo($row[7]);?>">
        </div>

        <div class="col-sm-3">
          <label for="inciu" class="form-label">Ciudad</label>
          <input type="text" class="form-control" id="inciu"  name="inciu" maxlength="60" disabled required value="<?php echo($row[5]);?>">
        </div>

        <div class="col-sm-2">
            <label for="intel" class="form-label">Teléfono</label>
            <input type="number" class="form-control" id="intel" maxlength="10" name="intel" disabled required value="<?php echo($row[8]);?>">
        </div>

        <div class="col-sm-4">
          <label for="incorr" class="form-label">Correo</label>
          <input type="text" class="form-control" id="incorr"  name="incorr" maxlength="60" disabled required value="<?php echo($row[9]);?>">
        </div>

        <div class="col-4">
          <label for="inpuntos" class="form-label">Puntos Acumulados</label>
          <input type="number" class="form-control" id="inpuntos"  name="inpuntos" maxlength="20" disabled required value="<?php echo($row[10]);?>">
        </div>

        <div class="col-4">
          <label for="inorden" class="form-label">Total Piezas Orden</label>
          <input type="text" class="form-control" id="inorden"  name="inorden" maxlength="11" disabled required value="<?php echo($row[11]);?>">
        </div>
        
        <div class="col-4">
          <label for="inentrega" class="form-label">Total Piezas Entregadas</label>
          <input type="text" class="form-control" id="inentrega"  name="inentrega" maxlength="11" disabled required value="<?php echo($row[12]);?>">
        </div>

        <div class="col-sm-6">
            <label for="ingiro" class="form-label">Actividad Giro</label>
            <input type="text" class="form-control" id="ingiro" maxlength="100" name="ingiro" disabled required value="<?php echo($row[13]);?>">
        </div>

        <div class="col-3">
          <button type="button" class="btn btn-primary" onclick="" id="btnEditar" name="Registrar">Editar</button>
        </div>

        <div class="col-3">
          <button type="button" class="btn btn-success" onclick="" id="btnGuardar" name="Registrar">Guardar</button>
        </div>

      </form>
      

      <br><br>
      <br>
       
    </script>

      <!--Código PHP para obtener el IDtiporol del usuario que inició sesión-->
    <?php
        $rol = $filas['Idtipousuario'];
    ?>

      <!--Código de JS para mandar a una variable de js el valor de una variable php-->
    <script type="text/javascript">

            var rol = "<?php echo $rol; ?>";

            //Si el id del rol obtenido, únicamente puede consultar -> ocultar los botones de guardar y editar
            if (rol == 3 || rol == 4 || rol == 11) {
              $(function(){
                $('#btnEditar').hide();
                $('#btnGuardar').hide();
              });
            }   
    </script>    

    <script type="text/javascript" src="../jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../datatables.min.js"></script>
    <script type="text/javascript" src="../tablas.js"></script>
    <script type="text/javascript" src="funcionesConsulta.js"></script>
    <script src="../Layout/menujs.js"></script>
</body>
</html>