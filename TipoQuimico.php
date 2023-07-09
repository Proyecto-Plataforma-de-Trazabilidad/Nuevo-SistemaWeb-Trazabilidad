<?php
include "Layout/navMenu.php";
$r = "SELECT * FROM usuarios where Correo = '$varses'";
$res = mysqli_query($enlace, $r);
$filas = mysqli_fetch_array($res);
?>
<script type="text/javascript" src="jquery-3.6.0.min.js"></script>

<div class="container">
  <h1>Registrar Tipo de Químico</h1>
</div>
<br>
<form class="row g-4 container-fluid" id="frm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return 0">
  <div class="col-md-6">
    <label for="inconc" class="form-label">Concepto</label>
    <input type="text" class="form-control" id="inconc" name="inconc" maxlength="60" placeholder="Ingresa el concepto">
  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-primary" onclick="" name="Registrar">Registrar</button>
  </div>
</form>

<br><br>
<div class="container text-center">
  <h5>Tpos de Químico Registrados</h5>
</div>
<div class="container col-12">
  <center>
    <table class="table table-striped" id="tabla">
      <thead>
        <tr>
          <th scope="col">idTipoQuímico</th>
          <th scope="col">Concepto</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody id="bodyTabla">

      </tbody>
    </table>
  </center>
</div>
<br>

<!--Código PHP para obtener el IDtiporol del usuario que inició sesión-->
<?php
$rol = $filas['Idtipousuario'];
?>

<!--Código de JS para mandar a una variable de js el valor de una variable php-->
<script type="text/javascript">
  var rol = "<?php echo $rol; ?>";

  //Si el id del rol obtenido, únicamente puede consultar -> ocultar el formulario
  if (rol == 4) {
    $(function() {
      $('#frm').hide();
    });
  }
</script>

<script type="text/javascript" src="jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="datatables.min.js"></script>
<script type="text/javascript" src="QuimicoArchivos/funcionesQuimico.js"></script>
<script src="Layout/menujs.js"></script>

</body>

</html>