<?php
session_start();
//koneksi ke database
include 'koneksi.php';

if (!isset($_SESSION['employee'])) {
    echo "<script>alert('Anda Harus Login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');

    exit();
}
?>
<?php $ambil=$koneksi->query("SELECT*FROM SBO_CMNP_KK.USER_SAP ");
$detpem=$ambil->fetch(PDO::FETCH_ASSOC) ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User</title>
    <!-- Favicon-->
    <link rel="shortcut icon" href="assets/foto_logo_perusahaan/favicon.ico" type="image/x-icon">
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

   <link rel="stylesheet"  href="assets/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

   <script src="assets/js/jquery-1.10.2.js"></script>

   <script src="assets/ckeditor/ckeditor.js"></script>
   
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand center" href="link ke web user">CMNP</a>    
            </div>

        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
					</li>
					
                    <li><a class="active-menu"  href="index.php"><i class="fa fa-dashboard "></i> Beranda</a></li>
                    <li><a class="active-menu"  href="index.php?halaman=produk"><i class="fa fa-tags"></i> Activity SAP</a></li>
                    <li><a class="active-menu"  href="index.php?halaman=activitystatus"><i class="fa fa-tags"></i> Activity Status SAP</a></li>
                    <li><a class="active-menu"  href="index.php?halaman=activitysolved"><i class="fa fa-tags"></i> Activity Solved SAP</a></li>
                    <li><a class="active-menu"  href="index.php?halaman=profil"><i class="fa fa-cogs"></i> Pengaturan</a></li>
                    <li><a class="active-menu"  href="index.php?halaman=logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
               <?php 
               if (isset($_GET['halaman'])) 
               {
                    if ($_GET['halaman']=="produk")
                    {
                       include 'produk/produk.php'; 
                    }
                    elseif ($_GET['halaman']=="pembelian")
                    {
                        include 'pembelian.php'; 
                    }
                    elseif ($_GET['halaman']=="pelanggan")
                    {
                        include 'pelanggan.php'; 
                    }
                    elseif ($_GET['halaman']=="detail")
                    {
                        include 'detail.php'; 
                    }
                    elseif ($_GET['halaman']=="tambahproduk")
                    {
                        include 'produk/tambahproduk.php'; 
                    }
                    elseif ($_GET['halaman']=="hapusproduk")
                    {
                        include 'produk/hapusproduk.php'; 
                    }
                    elseif ($_GET['halaman']=="ubahproduk")
                    {
                        include 'produk/ubahproduk.php'; 
                    }
                    elseif ($_GET['halaman']=="logout") 
                    {
                        include 'logout.php';
                        echo "<script>location='logout.php';</script>";
                    }
                    elseif ($_GET['halaman']=="activitystatus") 
                    {
                        include 'activitystatus/activitystatus.php';
                    }
                    elseif ($_GET['halaman']=="ubahactivitystatus") 
                    {
                        include 'activitystatus/ubahactivitystatus.php';
                    }
                    elseif ($_GET['halaman']=="detailactivity") 
                    {
                        include 'activitystatus/detailactivity.php'; 
                    }
                    elseif ($_GET['halaman']=="activitysolved") 
                    {
                        include 'activitysolved/activitysolved.php';
                    }
                    elseif ($_GET['halaman']=="ubahactivitysolved") 
                    {
                        include 'activitysolved/ubahactivitysolved.php';
                    }
                    elseif ($_GET['halaman']=="detailactivitysolved") 
                    {
                        include 'activitysolved/detailactivitysolved.php';
                    }
                    elseif ($_GET['halaman']=="detailproduk") 
                    {
                        include 'produk/detailproduk.php';
                    }
                    elseif ($_GET['halaman']=="hapusfotoproduk") 
                    {
                        include 'produk/hapusfotoproduk.php';
                    }
                  
               }
               else
               {
                    include 'home.php';
               } 
               ?>
            </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="assets/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="assets/DataTables/Buttons-1.5.6/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/DataTables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="assets/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="assets/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="assets/DataTables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script src="assets/DataTables/Buttons-1.5.6/js/buttons.print.min.js"></script>
    <script src="assets/DataTables/Buttons-1.5.6/js/buttons.colvis.min.js"></script>
    <script src="../admin/assets/js/morris/morris.js"></script>

    <script>
        $(document).ready(function(){
            var table =$('#table').DataTable ({
                buttons: ['csv','print','excel','pdf'],
                dom:
                "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>"+
                "<'row'<'col-md-12'tr>>"+
                "<'row'<'col-md-5'i><'col-md-7'p>>",
                lengthMenu:[
                    [5,10,25,50,100,-1],
                    [5,10,25,50,100,"ALL"]
                ]
            });

            table.buttons().container()
            .appendTo('#table_wrapper .col-md-5:eq(0)');
        });
    </script>   
   
</body>
</html>