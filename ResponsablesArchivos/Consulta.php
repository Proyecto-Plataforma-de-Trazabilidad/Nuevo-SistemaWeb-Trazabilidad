<?php
  include "../Layout/navMenu2.php";
  $consulta = "SELECT * FROM usuarios where Correo = '$varses'";
  $res = mysqli_query($enlace, $consulta);      
  $filas = mysqli_fetch_array($res);
?>
<script type="text/javascript" src="../jquery-3.6.0.min.js"></script>

<header>
<link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="Datatables-1.11.3/css/dataTables.bootstrap5.min.css">
</header>

<br><br>
<div class="container">
  <h1>Consulta Responsable del CAT</h1>
</div>
<br>

        <?php 
            include '../conexion.php';
            $idtipo = $_GET['id'];
            $nueva = base64_decode($idtipo);
            $r="SELECT * FROM responsablecat WHERE IdCAT=".$nueva;
            $comando=mysqli_query($enlace, $r);
            $row=mysqli_fetch_array($comando);
        ?>

      <form class="row g-4 container-fluid" id="frm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" onsubmit="return 0">
        <div class="col-4">
            <label for="inidcat" class="form-label">idResponsableCAT</label>
            <input type="text" id="inidcat" name="inidcat" class="form-control" maxlength="40" disabled value="<?php echo($row[0]);?>">
        </div>

        <div class="col-sm-4">
            <label for="innombre" class="form-label">Nombre</label>
            <input type="text" id="innombre" name="innombre" class="form-control" maxlength="40" disabled required value="<?php echo($row[1]);?>">
        </div>

        <div class="col-sm-4">
            <label for="indom" class="form-label">Domicilio</label>
            <input type="text" id="indom" name="indom" class="form-control" maxlength="40" disabled required value="<?php echo($row[2]);?>">
        </div>

        <div class="col-4">
            <label for="incp" class="form-label">Código Postal</label>
            <input type="number" id="incp" name="incp" class="form-control" maxlength="5" disabled required value="<?php echo($row[3]);?>">
        </div>

        <div class="col-4">
            <label for="inmuni" class="form-label">Municipio</label>
            <input type="text" id="inmuni" name="inmuni" class="form-control" maxlength="40" disabled required value="<?php echo($row[4]);?>">
        </div>

        <div class="col-4">
            <label for="inedo" class="form-label">Estado</label>
            <input type="text" id="inedo" name="inedo" class="form-control" maxlength="40" disabled required value="<?php echo($row[5]);?>">
        </div>

        <div class="col-sm-4">
            <label for="intel" class="form-label">Teléfono</label>
            <input type="number" id="intel" name="intel" class="form-control" maxlength="5" disabled required value="<?php echo($row[6]);?>">
        </div>

        <div class="col-sm-4">
            <label for="incorr" class="form-label">Correo</label>
            <input type="text" id="incorr" name="incorr" class="form-control" maxlength="40" disabled required value="<?php echo($row[7]);?>">
        </div>

        <div class="col-sm-4">
            <label for="inestado" class="form-label">Estado</label>
            <select name="inestado" id="inestado" class="form-select" disabled value="<?php echo($row[8]);?>">
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
        </div>
        <?php 
            mysqli_close($enlace);
        ?>

        <div class="col-3">
          <button type="button" class="btn btn-primary" onclick="" id="btnEditar" name="Editar">Editar</button>
        </div>
        <div class="col-3">
          <button type="button" class="btn btn-success" onclick="" id="btnGuardar" name="Registrar">Guardar</button>
        </div>
        
      </form>
    
      <br><br>


    <!--Código PHP para obtener el IDtiporol del usuario que inició sesión-->
    <?php
        $rol = $filas['Idtipousuario'];
      ?>

      <!--Código de JS para mandar a una variable de js el valor de una variable php-->
      <script type="text/javascript">

            var rol = "<?php echo $rol; ?>";

            //Si el id del rol obtenido, únicamente puede consultar -> ocultar los botones de guardar y editar
            if (rol == 4 || rol == 6) {
              $(function(){
                $('#editar').hide();
                $('#guardar').hide();
              });
            }   
      </script>

    <script type="text/javascript" src="../jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../datatables.min.js"></script>
    <script type="text/javascript" src="funcionConsulta.js"></script>
    <script src="../Layout/menujs.js"></script>
</body>
</html>