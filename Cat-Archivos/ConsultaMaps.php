<?php
  include "../Layout/navMenu2.php";
?>

<br><br>
<div class="container">
  <h1>Ubicación de Centros de Acopio Temporales</h1>
</div>
<br>
    
      <form class="row g-4 container-fluid" id="frm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" onsubmit="return 0">
        <div class="row g-4 container-fluid">
          <div class="col-md-12">
              <div id="mapa" style="width: 100%; height: 500px">

              </div>
          </div>
        </div>
      </form>
      <br><br>
      
      <script>
        function initMap(){
          var map;
          var bounds = new google.maps.LatLngBounds();
          var mapOptions = {
              mapTypeId: 'roadmap'
          };
          map = new google.maps.Map(document.getElementById('mapa'), {
              mapOptions
          });

          map.setTilt(50);

          var marcadores = [<?php include('marcadores.php');?>];
          var ventanaInfo = [
              <?php include('infoMarcadores.php');?>
          ];
          var mostrarMarcadores = new google.maps.InfoWindow(),
              marcadores, i;

          for (i = 0; i < marcadores.length; i++) {
                var position = new google.maps.LatLng(marcadores[i][0], marcadores[i][1]);
                bounds.extend(position);
                marker = new google.maps.Marker({
                position: position,
                map: map,
                icon: "../Logos/Marcador.png",
                });

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                  return function() {
                      mostrarMarcadores.setContent(ventanaInfo[i][0]);
                      mostrarMarcadores.open(map, marker);
                  }
              })(marker, i));
              map.fitBounds(bounds);
            }
            google.maps.event.addDomListener(window, 'load', initMap);
        }
      </script>
      

      
    <script type="text/javascript" src="../jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="funConsulta.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASLyp51V8W65RPg92rTcqaFWCOXz6KrOg&callback=initMap"></script>
    <script src="../Layout/menujs.js"></script>
</body>
</html>