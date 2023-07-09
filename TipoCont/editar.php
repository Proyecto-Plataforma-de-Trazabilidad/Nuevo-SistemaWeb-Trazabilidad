<?php
  include "../Layout/navMenu2.php";
  $consulta = "SELECT * FROM usuarios where Correo = '$varses'";
  $res = mysqli_query($enlace, $consulta);      
  $filas = mysqli_fetch_array($res);
?>
<script type="text/javascript" src="../jquery-3.6.0.min.js"></script>

<div class="container">
  <h1>Tipo de Contenedor</h1>
</div>
<br>

    <?php
        include "../conexion.php";
        $idtipo=$_GET['id'];
        $nueva = base64_decode($idtipo);
        $r="SELECT * FROM tipocontenedor WHERE idTipoCont=".$nueva;
        $comando= mysqli_query($enlace, $r);
        $row=mysqli_fetch_array($comando);
        
    ?>
      <form class="row g-4 container-fluid" id="frm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" onsubmit="return 0">
      <div class="col-4">
            <label for="inid" class="form-label">idTipoCont</label>
            <input type="number" class="form-control" id="inid" maxlength="5" name="inid" disabled value="<?php echo($row[0]);?>">
        </div>

      <div class="col-md-6">
          <label for="inconc" class="form-label">Concepto</label>
          <input type="text" class="form-control" id="inconc"  name="inconc" maxlength="60" required value="<?php echo($row[1]);?>">
        </div>
       
        <div class="col-12">
          <button type="button" class="btn btn-primary" id="btnGuardar" name="Registrar">Guardar</button>
        </div>
      </form>
      <?php
        mysqli_close($enlace);
      ?>
      <br><br>
      <br>

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
              });
            }   
      </script>
    
    <script type="text/javascript" src="../jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../datatables.min.js"></script>
    <script type="text/javascript" src="editar.js"></script>
    <script src="../Layout/menujs.js"></script>
    
</body>
</html>