<?php
include "../Layout/navMenu2.php";

?>

<h1>Distribuidores</h1>
<br>


<div class="col-3">
    <a href="consultaMaps.php"><button type="button" class="btn btn-primary" onclick="" name="Registrar">Ubicaciones</button></a>
</div>



<br>

<div class="container col-12">
    <center>
        <table class="table table-striped" id="tabla">
            <thead>
                <tr>
                    <th scope="col">Id Distribuidor</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Representante</th>
                    <th scope="col">Domicilio</th>
                    <th scope="col">Ciudad</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Email</th>
                    <th scope="col">BUMA</th>
                    <th scope="col">SEMARNAT</th>
                    <th scope="col">Licencia</th>
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
<script type="text/javascript" src="funcCons.js"></script>
<script src="../Layout/menujs.js"></script>

</body>

</html>