<?php
  include "../Layout/navMenu2.php";
?>
<br><br>
<div class="container">
  <h1>Consulta Usuario</h1>
</div>
<br>

    <?php
        include "../conexion.php";
        $idtipo=$_GET['id'];
        $nueva = base64_decode($idtipo);  
        $r="SELECT U.IdUsuario, U.Nombre, U.Correo, U.Contrasena, T.Descripcion FROM usuarios as U inner join tipousuario as T on U.IdtipoUsuario = T.Idtipousuario where U.IdUsuario=".$nueva;
        $comando= mysqli_query($enlace, $r);
        $row=mysqli_fetch_array($comando);
        
    ?>
      <form class="row g-4 container-fluid" id="frm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" onsubmit="return valdez()">

      <div class="col-2"> 
            <label for="iduser" class="form-label">Id Usuario</label>
            <input type="number" class="form-control" id="iduser" maxlength="10" name="iduser" readonly value="<?php echo($row[0]);?>">
        </div>

        <div class="col-2"> 
            <label for="nomb" class="form-label">Nombre de Usuario</label>
            <input type="text" class="form-control" id="nomb" maxlength="30" name="nomb"  disabled value="<?php echo($row[1]);?>">
        </div>

        <div class="col-3"> 
            <label for="x" class="form-label">Rol actual de usuario</label>
            <input type="text" class="form-control" id="x" maxlength="30" name="x"  readonly value="<?php echo($row[4]);?>">
        </div>

        <div class="col-sm-3"> 
            <label for="tuser" class="form-label">Nuevo rol</label>
            <select name="tuser" id="tuser" class="form-select" disabled placeholder="<?php echo($row[4]);?>">
                
            </select>
        </div>

        <div class="col-sm-3"> 
            <label for="correo" class="form-label">Correo</label>
            <input type="text" class="form-control" id="correo" disabled maxlength="40" name="correo" required placeholder="Ingrese el Correo" value="<?php echo($row[2]);?>">
        </div>
        <div class="col-sm-3"> 
            <label for="contra" class="form-label">Contraseña</label>
            <input type="text" class="form-control" id="contra" maxlength="10" disabled name="contra" required placeholder="Ingrese la contraseña" value="<?php echo($row[3]);?>">
        </div>

        <div class="col-sm-3"> 
          </div>
          
          <div class="col-sm-3"> 
          </div>


        <div class="col-2">
          <button type="button" class="btn btn-primary" onclick="Habilitar()" id="btnEditar" name="Registrar">Editar</button>
        </div>

        <div class="col-3">
          <button type="button" class="btn btn-success" onclick="" id="btnGuardar" disabled name="Registrar">Guardar</button>
        </div>

      </form>
        <?php
          mysqli_close($enlace);
        ?>
      <br>
      
      <br>
       <script>
        function Habilitar(){
          document.getElementById("iduser")
          document.getElementById("nomb").disabled=false;
          document.getElementById("tuser").disabled=false;
          document.getElementById("correo").disabled=false;
          document.getElementById("contra").disabled=false;
          document.getElementById("btnGuardar").disabled=false;
        }
        
      </script>
      <script type="text/javascript" src="../jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="funcionesEditar.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoIir0y0RhmeX5MIfoHdiUgxTRQ21HE4w&callback=initMap"></script>
      <script src="../js/menujs.js"></script>
</body>
</html>