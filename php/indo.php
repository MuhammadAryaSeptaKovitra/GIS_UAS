<?php 
$indo = json_decode(file_get_contents('https://api.kawalcorona.com/indonesia/'),true);
$prov = json_decode(file_get_contents('https://api.kawalcorona.com/indonesia/provinsi/'),true);


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Peta Tematik</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="../assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="../assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
    <!-- TABLE STYLES-->
    <link href="../assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    
    <!-- leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

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
          <a class="navbar-brand" href="index.html"> COVID-19 </a>
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
              <a class="active-menu" href="indo.php"><i class="fa fa-globe"></i>Indonesia</a>
            </li>
            <li>
              <a href="global.php"><i class="fa fa-globe"></i>Global</a>
            </li>
            <li>
              <a href="pemetaanIndo.php"><i class="bi bi-geo-alt-fill"></i>Pemetaaan Indonesia</a>
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
              <h2>Data Indonesia</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary text-center no-boder bg-color-red">
                    <div class="panel-body">
                        <i class="bi bi-plus-lg fa-5x"></i>
                        <h3><?=$indo['0']['positif'];?></h3>
                    </div>
                    <div class="panel-footer back-footer-red">
                    Total Positif</div>
                </div>            
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary text-center no-boder bg-color-green">
                    <div class="panel-body">
                        <i class="bi bi-emoji-smile fa-5x"></i>
                        <h3><?=$indo['0']['sembuh'];?> </h3>
                    </div>
                    <div class="panel-footer back-footer-green">
                    Total Sembuh</div>
                </div>            
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary text-center no-boder bg-color-red">
                    <div class="panel-body">
                        <i class="bi bi-emoji-frown fa-5x"></i>
                        <h3><?=$indo['0']['meninggal'];?> </h3>
                    </div>
                    <div class="panel-footer back-footer-red">
                    Total meninggal</div>
                </div>            
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary text-center no-boder bg-color-green">
                    <div class="panel-body">
                        <i class="bi bi-heart fa-5x"></i>
                        <h3><?=$indo['0']['dirawat'];?> </h3>
                    </div>
                    <div class="panel-footer back-footer-green">
                    Total Dirawat</div>
                </div>            
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                    Data
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Provinsi</th>
                                        <th class="text-center">Positif</th>
                                        <th class="text-center">Sembuh</th>
                                        <th class="text-center">Meninggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no=1; foreach($prov as $key) :?>
                                    <tr>
                                        <td><?= $no++;?></td>
                                        <td> <span ><?= $key["attributes"]["Provinsi"];?></span></td>
                                        <td> <span class="badge badge-red "><?= $key["attributes"]["Kasus_Posi"];?></span></td>
                                        <td> <span class="badge badge-success"><?= $key["attributes"]["Kasus_Semb"];?></span></td>
                                        <td> <span class="badge badge-danger"><?= $key["attributes"]["Kasus_Meni"];?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <!--End Advanced Tables -->
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
    <!-- DATA TABLE SCRIPTS -->
<script src="../assets/js/dataTables/jquery.dataTables.js"></script>
<script src="../assets/js/dataTables/dataTables.bootstrap.js"></script>
<script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
</script>
        <!-- CUSTOM SCRIPTS -->
<script src="../assets/js/custom.js"></script>

</body>
</html>
