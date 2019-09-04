<?php 
session_start();
include_once('classess/config.php');
include_once('classess/function.php');
$admin= new ADMIN(); 
$error = false;
$err_msg = '';
$page_id = 1;
//print_r($_SESSION['admin_user_type']);
//exit(0);
if(!$admin->isAdminLoggedIn())
    {
    header("Location:login.php");
    exit(0);
    }
 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <?php require_once 'head.php'; ?>
    </head>
    <body hoe-navigation-type="vertical" hoe-nav-placement="left" theme-layout="wide-layout">

        <!--side navigation start-->
        <div id="hoeapp-wrapper" class="hoe-hide-lpanel" hoe-device-type="desktop">
           <?php require_once 'header.php'; ?>
            <div id="hoeapp-container" hoe-color-type="lpanel-bg7" hoe-lpanel-effect="shrink">
                <?php require_once 'side-menu.php'; ?>
                <!--start main content-->
                <section id="main-content">
                    <div class="space-30"></div>
                    <div class="container">
                        <!--widget box row-->
                        <div class="row">
                            <div class="col-sm-6 col-md-3 margin-b-30">
                                <div class="statistic-widget-box bg-primary">
                                    <i class="fa fa-users"></i>
                                    <div class="content overflow-hidden">
                                        <h1></h1>
                                        <p>Property</p>
                                    </div>
                                </div><!--statistic box end-->
                            </div><!--col end-->
                            <div class="col-sm-6 col-md-3 margin-b-30">
                                <div class="statistic-widget-box bg-danger">
                                    <i class="fa fa-language"></i>
                                    <div class="content overflow-hidden">
                                         <h1></h1>
                                        <p>Location</p>
                                    </div>
                                </div><!--statistic box end-->
                            </div><!--col end-->

                        </div>
                       
                    </div><!--end container-->

                    <?php require_once 'footer.php'; ?>
                </section><!--end main content-->
            </div>
        </div><!--end wrapper-->



        <!--Common plugins-->
        <?php require_once 'script.php'; ?>
        <!--page scripts-->
        
        <!-- Flot chart js -->
        <script src="assets/plugins/flot/jquery.flot.js"></script>
        <script src="assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.resize.js"></script>
        <script src="assets/plugins/flot/jquery.flot.pie.js"></script>
        <script src="assets/plugins/flot/jquery.flot.time.js"></script>
        <!--vector map-->
        <script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- ChartJS-->
        <script src="assets/plugins/chartJs/Chart.min.js"></script>
        <!--dashboard custom script-->
        <script src="assets/js/dashboard.js"></script>
    </body>
</html>