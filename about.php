<?php 
session_start();
include_once('admin/classess/config.php');
include_once('admin/classess/function.php');
$admin= new ADMIN(); 
$error = false;
$err_msg = '';
$page_id = 1;

$option ='';

$testinomialdata = $admin->getAllTestinomialFrontEnd(3);

$agentdata = $admin->getAllAgentFrontEnd(4);

$recentpropertyfooter = $admin->getAllRecentPropertysFrontEnd(3);


?>


<!DOCTYPE html>
<html lang="zxx">
<head>
    <?php require_once 'head.php'; ?>
</head>
<body id="top">

<div class="page_loader"></div>

<!-- main header start -->
<?php require_once 'header.php'; ?>
<!-- main header end -->

<!-- Sub banner start -->
<div class="sub-banner ">
<img class="" src="slider_image/slider1 - Copy.jpg" alt="banner" width="100%" height="auto" >
    <div class="container">
        <div class="breadcrumb-area">
            <h1>About Us</h1>
            <ul class="breadcrumbs">
                <li><a href="index.html">Home</a></li>
                <li class="active">About Us</li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub banner end -->

<!-- About us start -->
<div class="about-us content-area-8 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="properties-service-v">
                    <img src="slider_image/images.jpg" alt="admin" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-7 align-self-center">
                <div class="about-text more-info">
                    <h3>Why Choose Us?</h3>
                    <div id="faq" class="faq-accordion">
                        <div class="card m-b-0">
                            <div class="card-header">
                                <a class="card-title collapsed" data-toggle="collapse" data-parent="#faq" href="#collapse1">
                                    Impeccable Customer Service
                                </a>
                            </div>
                            <div id="collapse1" class="card-block collapse">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel, dapibus tempus nulla. Donec vel nulla dui. Pellentesque sed ante sed ligula hendrerit condimentum. Suspendisse rhoncus fringilla ipsum.</p>
                            </div>

                            <div class="card-header">
                                <a class="card-title collapsed" data-toggle="collapse" data-parent="#faq" href="#collapse2">
                                    Worldwide charity programs
                                </a>
                            </div>
                            <div id="collapse2" class="card-block collapse">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel, dapibus tempus nulla. Donec vel nulla dui. Pellentesque sed ante sed ligula hendrerit condimentum. Suspendisse rhoncus fringilla ipsum.</p>
                            </div>

                            <div class="card-header">
                                <a class="card-title collapsed" data-toggle="collapse" data-parent="#faq" href="#collapse3">
                                    Honesty and integrity
                                </a>
                            </div>
                            <div id="collapse3" class="card-block collapse">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel, dapibus tempus nulla. Donec vel nulla dui. Pellentesque sed ante sed ligula hendrerit condimentum. Suspendisse rhoncus fringilla ipsum.</p>
                            </div>

                            <div class="card-header bd-none">
                                <a class="card-title collapsed" data-toggle="collapse" data-parent="#faq" href="#collapse4">
                                    Online donation system with different methods
                                </a>
                            </div>
                            <div id="collapse4" class="card-block collapse">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel, dapibus tempus nulla. Donec vel nulla dui. Pellentesque sed ante sed ligula hendrerit condimentum. Suspendisse rhoncus fringilla ipsum.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About us end -->

<!-- agent start -->
<div class="agent content-area-2">
    <div class="container">
        <div class="main-title">
            <h1>Meet Our Agents</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div class="row">
        <?php foreach($agentdata as $record) {?>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 wow fadeInLeft delay-04s">
                <div class="agent-2">
                    <div class="agent-photo">
                        <a >
                            <img src="admin/images/<?php echo $record['image'];?>" alt="avatar-5" class="img-fluid">
                        </a>
                    </div>
                    <div class="agent-details">
                        <h5><a ><?php echo $record['name'];?></a></h5>
                        <p><?php echo $record['designation'];?></p>
                        <ul class="social-list clearfix">
                            <li><a href="<?php echo $record['facebook'];?>" class="facebook" target="_blanck"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?php echo $record['twitter'];?>" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="<?php echo $record['linkdin'];?>" class="instagram"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="<?php echo $record['instagram'];?>" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
		<?php }?>	
		</div>
    </div>
</div >
<!-- agent end -->

<!-- Counters start -->
<div class="counters overview-bgi" style="background-image: url(http://placehold.it/1920x268)">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="counter-box">
                    <i class="flaticon-tag"></i>
                    <h1 class="counter">500</h1>
                    <h5>Lines of Sale</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="counter-box">
                    <i class="flaticon-badge"></i>
                    <h1 class="counter">254</h1>
                    <h5>Listings For Rent</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="counter-box">
                    <i class="flaticon-call-center-agent"></i>
                    <h1 class="counter">510</h1>
                    <h5>Agents</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="counter-box">
                    <i class="flaticon-job"></i>
                    <h1 class="counter">94</h1>
                    <h5>Brokers</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Counters end -->

<!-- Testimonial 3 start -->
<div class="testimonial testimonial-3">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="testimonial-inner">
                    <header class="testimonia-header">
                        <h1>Testimonial</h1>
                    </header>
                    <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <?php foreach($testinomialdata as $record)
							{?>
							<?php if($record['testinomial_id']==1) {?>
                            <div class="carousel-item active" >
                                <div class="avatar">
                                    <img src="admin/images/<?php echo $record['image'];?>" alt="avatar-2" class="img-fluid rounded-circle">
                                </div>
                                <p class="lead">
                                <?php echo $record['description'];?>
								</p>
                                <div class="author-name">
                                   <?php echo $record['name'];?>
                                </div>
                            </div>
							<?php } else {?>
							<div class="carousel-item" >
                                <div class="avatar">
                                    <img src="admin/images/<?php echo $record['image'];?>" alt="avatar-2" class="img-fluid rounded-circle">
                                </div>
                                <p class="lead">
                                <?php echo $record['description'];?>
								</p>
                                <div class="author-name">
                                   <?php echo $record['name'];?>
                                </div>
                            </div>
							<?php }}?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial 3 end -->

<!-- Footer start -->
<?php require_once 'footer.php'; ?>
</body>
</html>