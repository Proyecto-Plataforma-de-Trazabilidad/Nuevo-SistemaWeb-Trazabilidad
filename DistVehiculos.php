<?php
include "Layout/navMenu.php";
?>

<div class="container">
  <h1>Vehículos de Distribuidores</h1>
</div>
<br>
<form class="row g-4 container-fluid" id="frm" method="POST" action="DistVehicArchivos/insertar.php" onsubmit="return valdez()" enctype="multipart/form-data">

  <div class="col-md-4">
    <label for="indist" class="form-label">Distribuidor</label>
    <select name="indist" id="indist" class="form-select">

    </select>
  </div>


  <div class="col-sm-4">
    <label for="indes" class="form-label">Descripción</label>
    <input type="text" class="form-control" id="indes" name="indes" maxlength="30"  placeholder="Ingrese la descripción">
  </div>

  <div class="col-sm-4">
    <label for="intipo" class="form-label">Tipo vehículo</label>
    <input type="text" class="form-control" id="intipo" name="intipo" maxlength="60"  placeholder="Ingrese el tipo de vehículo">
  </div>

  <div class="col-sm-4">
    <label for="inmarca" class="form-label">Marca</label>
    <input type="text" class="form-control" id="inmarca" name="inmarca" maxlength="30"  placeholder="Ingrese la marca del vehículo">
  </div>

  <div class="col-4">
    <label for="incap" class="form-label">Capacidad (kg)</label>
    <input type="number" class="form-control" id="incap" maxlength="10" name="incap"   placeholder="Ingrese la capacidad">
  </div>

  <div class="col-4">
    <label for="inplaca" class="form-label">Placa</label>
    <input type="text" class="form-control" id="inplaca" name="inplaca" maxlength="10"  placeholder="Ingrese la placa">
  </div>

  <div class="col-sm-2">
    <label for="infile" class="form-label">SCT</label>
    <input type="file" name="infile" id="infile" class="form-file">
  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-success" name="Registrar">Registrar</button>
  </div>

</form>


<br><br>
<div class="container text-center">
  <h5>Vehiculos Distribuidores Registrados</h5>
</div>
<div class="container col-12">
  <center>
    <table class="table table-striped" id="tabladistv">
      <thead>
        <tr>
          <th scope="col">Distribuidor</th>
          <th scope="col">Descripción</th>
          <th scope="col">TipoVehículo</th>
          <th scope="col">Capacidad (kg)</th>
          <th scope="col">Marca</th>
          <th scope="col">Placas</th>
          <th scope="col">SCT</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody id="bodyTabla">

      </tbody>
    </table>
  </center>
</div>
<br>

<script type="text/javascript" src="jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="datatables.min.js"></script>
<script type="text/javascript" src="DistVehicArchivos/funcionesVeiDis.js"></script>
<script src="Layout/menujs.js"></script>

</body>

</html>