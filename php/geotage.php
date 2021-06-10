
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Geotagging</title>
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
<!-- Link leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<!-- Cluster -->
<link rel="stylesheet" href="../cluster/dist/MarkerCluster.css" />
<link rel="stylesheet" href="../cluster/dist/MarkerCluster.Default.css" />
<script src="../cluster/dist/leaflet.markercluster-src.js"></script>
<!-- rute -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

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
            <a href="pemetaanIndo.php"><i class="bi bi-geo-alt-fill"></i>Pemetaaan Indonesia</a>
        </li>
        <li>
            <a   href="pemetaanGlobal.php"><i class="bi bi-geo-alt-fill"></i> Pemetaan Global</a>
        </li>
        <li>
            <a class="active-menu"  href="geotage.php"><i class="bi bi-pin-map-fill"></i> Geotagging Rumah Sakit</a>
        </li>
        </ul>
    </div>
    </nav>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
        <div class="col-md-12">
            <h2>Rumah Sakit</h2>
        <p class="text-muted">
            <span class="text-muted color-bottom-txt"><i class="fa fa-edit"></i>
            Silahkan Gerakkan  Marker Untuk menggunakan Fitur Direction
            </span>
        </p>
        </div>
        </div>
        <div class="row">
        <div class="col-md-12 col-sm-12">
            <div id="mapid" style=" height: 500px;"></div>
            <script src="../assets/leaflet.ajax.js"></script>
            <script>
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
        center: [-0.16371462273136703, 101.3277409307369 ],
        zoom: 6,
        layers: [peta1]
    });
        var baseMaps = {
            "<span style='color: gray'>Light</span>": peta1,
            "Satelite": peta2,
            "Streets": peta3,
            "Dark": peta4
        };
        L.control.layers(baseMaps).addTo(mymap);
                // rute
                L.Routing.control({
                waypoints: [L.latLng(-0.16371462273136703,101.3277409307369 ), L.latLng(-2.565707838281269, 104.30382676021402)],
                routeWhileDragging: true,
                }).addTo(mymap);
                // popup
                function popUp(f,l){
                var out = [];
                if (f.properties){
                    if(f.geometry){
                    // for(key in f.properties){
                    //      out.push(key+": "+f.properties[key]);
                    // }
                    out.push("Nama Rumah Sakit: "+f.properties["Remarks"]);
                    out.push("Alamat: "+f.properties["Alamat"]);
                    out.push('<img width="200px;" src="../assets/Photos/'+String(f.properties["Photo"]) + '">');
                    out.push("Koordinate "+f.geometry["coordinates"]);
                    l.bindPopup(out.join("<br />"));
                    }
                    }
                }
            var jsonTest = new L.GeoJSON.AJAX(["../assets/main.geojson"],{onEachFeature:popUp}).addTo(mymap);  
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
