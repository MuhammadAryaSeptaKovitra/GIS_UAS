<?php 
    $nasional_lokasi = json_decode(file_get_contents('https://services5.arcgis.com/VS6HdKS0VfIhv8Ct/arcgis/rest/services/COVID19_Indonesia_per_Provinsi/FeatureServer/0/query?where=1%3D1&outFields=*&outSR=4326&f=json'),true);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pemetaan Indonesia</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="../assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="../assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
      <!-- Cluster -->
    <link rel="stylesheet" href="../cluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="../cluster/dist/MarkerCluster.Default.css" />
    <link rel="stylesheet" href="../cluster/dist/">
	  <script src="../cluster/dist/leaflet.markercluster-src.js"></script>
    <!-- Plugin search -->
    <link rel="stylesheet" href="../leaflet-search-master/src/leaflet-search.css" />
    <script src="../leaflet-search-master/src/leaflet-search.js"></script>

  </head>
  <body>
    <div id="wrapper">
      <nav class="navbar navbar-default navbar-cls-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">COVID-19</a>
        </div>
        <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px">
          Tanggal :<?=date("d M Y")?>
          &nbsp; <a href="login.html" class="btn btn-danger square-btn-adjust">login</a>
        </div>
      </nav>
      <!-- /. NAV TOP  -->
      <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
          <ul class="nav" id="main-menu">
          <li class="text-center">
              <img src="../assets/img/find_user.png" class="user-image img-responsive" />
            </li>
            <li>
              <a  href="indo.php"><i class="fa fa-globe"></i>Indonesia</a>
            </li>
            <li>
              <a href="global.php"><i class="fa fa-globe"></i>Global</a>
            </li>
            <li>
              <a class="active-menu" href="pemetaanIndo.php"><i class="bi bi-geo-alt-fill"></i>Pemetaaan Indonesia</a>
            </li>
            <li>
              <a href="pemetaanGlobal.php"><i class="bi bi-geo-alt-fill"></i> Pemetaan Global</a>
            </li>
            <li>
              <a   href="geotage.php"><i class="bi bi-pin-map-fill"></i> Geotage Rumah Sakit</a>
            </li>
          </ul>
        </div>
      </nav>
      <!-- /. NAV SIDE  -->
      <div id="page-wrapper">
        <div id="page-inner">
          <div class="row">
            <div class="col-md-12">
              <h2>Pemetaan Indonesia</h2>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12">
                <div id="mapid" style=" height: 500px;"></div>
                <script>
                    // Base Map
                    var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    id: 'mapbox/streets-v11'
                    });
                    var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    id: 'mapbox/satellite-v9'
                });
                  var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                });
                  var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                  attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                      '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                      'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                  id: 'mapbox/dark-v10'
              });
                  var mymap = L.map('mapid', {
                  center: [-1.6343400452136536,113.18104785169665],
                  zoom: 5,
                  layers: [peta1]
            });
                  var baseMaps = {
                      "<span style='color: gray'>Light</span>": peta1,
                      "Satelite": peta2,
                      "Streets": peta3,
                      "Dark": peta4
                  };
                  L.control.layers(baseMaps).addTo(mymap);
                    var markers = L.markerClusterGroup();
                    <?php  foreach($nasional_lokasi["features"] as $key) :?>
                        var lokasi =L.marker([<?= $key["geometry"]["y"];?>, <?= $key["geometry"]["x"];?>]).bindPopup("Negara: <?= $key["attributes"]["Provinsi"];?><br>"+
                          "Positif : <?= $key["attributes"]["Kasus_Posi"];?><br>" +
                          "Sembuh : <?= $key["attributes"]["Kasus_Semb"];?><br>" +
                          "Meninggal : <?= $key["attributes"]["Kasus_Meni"];?><br>" );
                        markers.addLayer(lokasi);
                        mymap.addLayer(markers);
                        mymap.fitBounds(markers.getBounds());
                    <?php endforeach; ?>

                </script>
            </div>
        </div>
        </div>

        <!-- /. PAGE INNER  -->
      </div>
      <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
    <!-- MORRIS CHART SCRIPTS -->
    <script src="../assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="../assets/js/morris/morris.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
  </body>
</html>
