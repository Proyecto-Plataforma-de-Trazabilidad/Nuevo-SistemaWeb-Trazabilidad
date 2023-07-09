<?php
  include "../Layout/navMenu2.php";
?>

<br><br>
<div class="container">
  <h1>Consulta Vehículos ERP</h1>
</div>
<br>
        <?php 
            include '../conexion.php';
            $idtipo = $_GET['id'];
            $nueva = base64_decode($idtipo);
            $r="SELECT * FROM erpvehiculos WHERE Consecutivo=".$nueva;
            $comando= mysqli_query($enlace, $r);
            $row=mysqli_fetch_array($comando);
        ?>
      <form class="row g-4 container-fluid" id="frm" method="POST" action="actualizar.php" onsubmit="return 0" enctype="multipart/form-data">

        <div class="col-2">
          <label for="inid" class="form-label">idERP</label>
          <input type="text" class="form-control" id="inid"  name="inid" maxlength="60" readonly value="<?php echo($row[1]);?>">
        </div>

        <div class="col-sm-4">
          <label for="incon" class="form-label">Consecutivo</label>
          <input type="text" class="form-control" id="incon"  name="incon" maxlength="60" disabled required value="<?php echo($row[0]);?>">
        </div>

        <div class="col-sm-4">
          <label for="indes" class="form-label">Descripción</label>
          <input type="text" class="form-control" id="indes"  name="indes" maxlength="60" disabled required value="<?php echo($row[2]);?>">
        </div>

        <div class="col-sm-4">
          <label for="intipo" class="form-label">Tipo vehículo</label>
          <input type="text" class="form-control" id="intipo"  name="intipo" maxlength="60" required disabled value="<?php echo($row[3]);?>">
        </div>

        <div class="col-4">
            <label for="incap" class="form-label">Capacidad (kg)</label>
            <input type="number" class="form-control" id="incap" maxlength="10" name="incap" disabled required value="<?php echo($row[4]);?>">
        </div>

        <div class="col-4">
          <label for="inmarca" class="form-label">Marca</label>
          <input type="text" class="form-control" id="inmarca"  name="inmarca" maxlength="30" disabled required value="<?php echo($row[5]);?>">
        </div>

        <div class="col-4">
          <label for="inplaca" class="form-label">Placa</label>
          <input type="text" class="form-control" id="inplaca"  name="inplaca" maxlength="10" disabled required value="<?php echo($row[6]);?>">
        </div>

        <div class="col-sm-4">
          <label for="inact" class="form-label">Archivo SCT actual</label>
          <a href="<?php echo($row[7]);?>" class="form-control">SCT</a>
        </div>

        <div class="col-sm-4">
          <label for="infile" class="form-label">SCT</label>
          <input type="file" name="infile" id="infile" class="form-file">
        </div>

        <div class="col-2">
          <button type="button" class="btn btn-primary" onclick="habilitar()" id="btnEditar" name="Editar">Editar</button>
        </div>
        <div class="col-3">
          <button type="submit" class="btn btn-success" onclick="" id="btnGuardar" disabled name="Registrar">Guardar</button>
        </div>
      </form>
      

      <br><br>
      <script>
        function habilitar(){
          document.getElementById("incon").disabled=false;
          document.getElementById("indes").disabled=false;
          document.getElementById("incap").disabled=false;
          document.getElementById("inmarca").disabled=false;
          document.getElementById("inplaca").disabled=false;
          document.getElementById("intipo").disabled=false;
          document.getElementById("btnGuardar").disabled=false;
        }
        function valdez()
        {
            let placa=document.getElementById("inplaca").value
            if(placa.length<6 || placa.length>7){
              alert("El campo Placa, no es valido");
              return false;
            }
            return 0;
            
        }
      </script>
      
    <script type="text/javascript" src="../jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../datatables.min.js"></script>
    <script type="text/javascript" src="../tablas.js"></script>
    <script type="text/javascript" src="ErpVehiculosArchivos/funcionesErpVehiculos.js"></script>
    <script src="../Layout/menujs.js"></script>
</body>
</html>