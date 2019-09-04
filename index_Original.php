<?php 
session_start();
include_once('admin/classess/config.php');
include_once('admin/classess/function.php');
$admin= new ADMIN(); 
$error = false;
$err_msg = '';
$page_id = 1;

$option ='';

$recentproperty = $admin->getAllRecentPropertysFrontEnd(4);
$featureproperty = $admin->getAllFeaturedPropertysFrontEnd('1',10);
$testinomialdata = $admin->getAllTestinomialFrontEnd(3);

$agentdata = $admin->getAllAgentFrontEnd(4);
$twoblog = $admin->getAllBlogLimitFrontEnd(2);

//$areablog = $admin->getAllAreaFrontEnd();

$recentpropertyfooter = $admin->getAllRecentPropertysFrontEnd(3);

if(isset($_REQUEST['action']) && $_REQUEST['action'] =='addWishlistData')
    {
		$tdata['id'] = $_REQUEST['id']!='' ? $_REQUEST['id'] : '';
		$tdata['price'] = $_REQUEST['price']!='' ? $_REQUEST['price'] : '';
		$optiondata =''; 
		
		if ($admin->chkWishlist($tdata['id']))
           {     
                echo '1';
	            die();
				
           }
		else if ($admin->addWishlist($tdata))
		{
			
			$count = $admin->countWishlist();
			$optiondata.= '<span id="wishlist_header_count">'.$count.'</span>';
			print_r($optiondata);die();
	        
		}			
	}
	

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <?php require_once 'head.php'; ?>

</head>
<body id="top" >

<div class="page_loader"></div>

<!-- main header start -->
<?php require_once 'header.php'; ?>
<!-- main header end -->

<!-- Banner start -->
<div class="banner" id="banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="slider_image/slider1.jpg" alt="banner">
                <div class="carousel-caption banner-slider-inner d-flex h-100 text-center">
                    <div class="carousel-content container">
                        <div class="t-center">
                            <h1 data-animation="animated fadeInDown delay-05s">We love make things <br/>amazing and simple</h1>
                            <p data-animation="animated fadeInUp delay-10s">
                               <!-- This is real estate website template based on Bootstrap 4 framework.-->
                            </p>
                            <a data-animation="animated fadeInUp delay-10s" href="#" class="btn btn-lg btn-round btn-theme">Get Started Now</a>
                            <a data-animation="animated fadeInUp delay-10s" href="#" class="btn btn-lg btn-round btn-white-lg-outline">Free Download</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="slider_image/slider2.jpg" alt="banner">
                <div class="carousel-caption banner-slider-inner d-flex h-100 text-center">
                    <div class="carousel-content container">
                        <div class="t-right">
                            <h1 data-animation="animated fadeInDown delay-05s">Find Your <br/> Dream Properties</h1>
                            <p data-animation="animated fadeInUp delay-10s">
                              <!--  This is real estate website template based on Bootstrap 4 framework.-->
                            </p>
                            <a data-animation="animated fadeInUp delay-10s" href="#" class="btn btn-lg btn-round btn-theme">Get Started Now</a>
                            <a data-animation="animated fadeInUp delay-10s" href="#" class="btn btn-lg btn-round btn-white-lg-outline">Free Download</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="slider_image/slider3.jpg" alt="banner">
                <div class="carousel-caption banner-slider-inner d-flex h-100 text-center">
                    <div class="carousel-content container">
                        <div class="t-left">
                            <h1 data-animation="animated fadeInUp delay-05s">Best Place For <br/> Sell Properties</h1>
                            <p data-animation="animated fadeInUp delay-10s">
                              <!--  This is real estate website template based on Bootstrap 4 framework.-->
                            </p>
                            <a data-animation="animated fadeInUp delay-10s" href="#" class="btn btn-lg btn-round btn-theme">Get Started Now</a>
                            <a data-animation="animated fadeInUp delay-10s" href="#" class="btn btn-lg btn-round btn-white-lg-outline">Free Download</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="slider-mover-left" aria-hidden="true">
                <i class="fa fa-angle-left"></i>
            </span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="slider-mover-right" aria-hidden="true">
                <i class="fa fa-angle-right"></i>
            </span>
        </a>
    </div>
</div>
<!-- banner end -->


<!-- Search area start -->
<div class="search-area" id="search-area-1">
    <div class="container">
        <div class="search-area-inner">
            <div class="search-contents ">
                <form  method="POST">
                    
                    <div class="row">

                        <div class="col-lg-6 col-md-7  ">
                            
                            <div class="form-group">
                                <input class="form-control" id="myInput" type="text" placeholder="Search Location" required>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        
                        
                        <div class="col-6 col-lg-3 col-md-3">

                            
                            <div class="form-group">
                                <select class="selectpicker search-fields" name="area" id="area">
                                    <option value="">Select Sqft</option>
									<?php foreach($areablog as $record) {?>
                                    <option <?php echo $record['area'];?>><?php echo $record['area'];?></option>
									<?php }?>
                                    
                                </select>
                            </div>
                        </div>
                        
                       <!--  <div class="col-6 col-lg-3 col-md-3">
                            <div class="form-group">
                                <input type="text" placeholder="Search Location" name="location" id="location" class="form-control" required>
							</div>
                        </div> -->
                        <div class="col-6 col-lg-3 col-md-3">
                            <div class="form-group">
                                <select  name="category" id="category" class="selectpicker search-fields" required>
                                    <option value="">Category</option>
                                    <option value="1">Features</option>
                                    <option value="2">Apartments</option>
                                    <option value="3">Houses</option>
                                    <option value="4">Family Houses</option>
                                    <option value="5">Offices</option>
                                    <option value="6">Villas</option>
                                    <option value="7">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-lg-3 col-md-3">
                            <div class="form-group">
                                <select class="selectpicker search-fields" name="bedroom" id="bedroom">
                                    <option value="">Select Bedrooms</option>
                                    <option value="1">1 Bedrooms</option>
                                    <option value="2">2 Bedrooms</option>
                                    <option value="3">3 Bedrooms</option>
                                    <option value="4">4 Bedrooms</option>
                                    <option value="5">5 Bedrooms</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-3">
                            <div class="form-group">
                                <select class="selectpicker search-fields" name="bathroom"id="bathroom">
                                    <option value="">Select Bathrooms</option>
                                    <option value="1">1 Bathrooms</option>
                                    <option value="2">2 Bathrooms</option>
                                    <option value="3">3 Bathrooms</option>
                                    <option value="4">4 Bathrooms</option>
                                    <option value="5">5 Bathrooms</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-6 col-lg-3 col-md-3">
                            <div class="form-group">
                                <button class="search-button btn-md btn-color" onclick="getPropertySearch();return false;" name="btnsubmit" type="submit">For sale</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Search area end -->


<div> <!-- Start container -->

<!-- Featured properties start -->
<div class="featured-properties content-area-7">
    <div class="container-fluid">
        <div class="main-title">
            <h1>Featured Properties</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div class="row slick-fullwidth">
		
		<?php foreach($featureproperty as $record) {?>
            <div class="slick-slide-item">
                <div class="property-box">
                    <div class="property-thumbnail">
                        <a href="properties-details.html" class="property-img">
                            <div class="tag button alt featured">Featured</div>
                            <div class="price-ratings-box">
                                <p class="price">
                                   £ <?php echo $record['price'];?>
                                </p>
                                <div class="ratings">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                            </div>
                            <img src="admin/images/<?php echo $record['image'];?>" style="height:280px" alt="property-1" class="img-fluid">
                        </a>
                        <div class="property-overlay">
                                    <a  class="overlay-link" onclick="addWishlistData(<?php echo $record['id'];?>,<?php echo $record['price'];?>);return false;">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                    
                                </div>
                    </div>
                    <div class="detail">
                        <h1 class="title">
                            <a href="property-detail.php?id=<?php echo base64_encode($record['id']);?>"><?php echo substr($record['name'], 0, 30);?></a>
                        </h1>
                        <div class="location">
                            <a href="properties-details.html">
                                <i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i><?php echo $record['location'];?>
                            </a>
                        </div>
                        <ul class="facilities-list clearfix">
                            <li>
                                <i class="flaticon-bed"></i> <?php echo $record['bedroom'];?> Bedrooms
                            </li>
                            <li>
                                <i class="flaticon-bath"></i> <?php echo $record['bathroom'];?> Bathrooms
                            </li>
                            <li>
                                <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft:<?php echo $record['area'];?>
                            </li>
                            <li>
                                <i class="flaticon-car-repair"></i> <?php echo $record['garage'];?> Garage
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>
		<?php }?>
            <div class="slick-prev slick-arrow-buton">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="slick-next slick-arrow-buton">
                <i class="fa fa-angle-right"></i>
            </div>
        </div>
    </div>
</div>
<!-- Featured properties end -->

<!-- services start -->
<div class="services content-area-20 bg-white">
    <div class="container">
        <div class="main-title">
            <h1>What Are you Looking For?</h1>
            
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 services-info-3 s-brd-2 wow fadeInLeft delay-04s">
                <i class="flaticon-hotel-building"></i>
                <h5>Apartments Clean</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 services-info-3 s-brd-1 wow fadeInUp delay-04s">
                <i class="flaticon-house"></i>
                <h5>Houses</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 services-info-3 s-brd-3 wow fadeInDown delay-04s">
                <i class="flaticon-call-center-agent"></i>
                <h5>Support 24/7</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 services-info-3 wow fadeInRight delay-04s">
                <i class="flaticon-office-block"></i>
                <h5>Commercial</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
            </div>
        </div>
    </div>
</div>
<!-- services end -->

<!-- Recent Properties start -->
<div class="recent-properties content-area-2">
    <div class="container">
        <div class="main-title">
            <h1>Recent Properties</h1>
            
        </div>
        <div class="row">
		
		<?php foreach($recentproperty as $record) {?>
            <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInLeft delay-04s">
                <div class="property-box-8">
                    <div class="property-photo">
                        <img src="admin/images/<?php echo $record['image'];?>" style="height:300px; width:300px" alt="recent-property" class="img-fluid">
                        <div class="date-box">For Sale</div>
                    </div>
                    <div class="detail">
                        <div class="heading">
                            <h3>
                                <a href="property-detail.php?id=<?php echo base64_encode($record['id']);?>"><?php echo substr($record['name'], 0, 30);?></a>
                            </h3>
                            <div class="location">
                                <a href="property-detail.php?id=<?php echo base64_encode($record['id']);?>">
                                    <i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i><?php echo $record['location'];?>
                                </a>
                            </div>
							
                        </div>
                        <div class="properties-listing">
                            <span><?php echo $record['bedroom'];?> Beds</span>
                            <span><?php echo $record['bathroom'];?> Baths</span>
                            <span><?php echo $record['area'];?> sqft</span>
                        </div>
                    </div>
                </div>
            </div>
		<?php }?>
        </div>
    </div>
</div>
<!-- Recent Properties end -->




<!-- Testimonial start -->
<div class="testimonial overview-bgi wow fadeInUp delay-04s" style="background-image: url(http://placehold.it/1920x541)">
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
<!-- Testimonial end -->

<!-- Blog start -->
<div class="blog content-area-2">
    <div class="container">
        <div class="main-title">
            <h1>Latest Blog</h1>
            
        </div>
        <div class="row wow fadeInUp delay-04s">
		
		<?php foreach($twoblog as $record) {?>
		
            <div class="col-lg-6 col-md-6">
                <div class="row blog-3">
                    <div class="col-lg-5 col-md-12 col-pad ">
                        <div class="photo">
                            <img src="admin/images/<?php echo $record['image'];?>" alt="blog-6" class="img-fluid">
                            <div class="date-box">
                                <span><?php echo date('d M', strtotime($record['add_date']));?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12 col-pad align-self-center">
                        <div class="detail">
                            <h3>
                                <a href="blog-detail.php?id=<?php echo base64_encode($record['blog_id']); ?>"><?php echo $record['title'];?></a>
                            </h3>
                            <div class="post-meta">
                                <span><a href="#"><i class="fa fa-user"></i><?php echo $record['author_name'];?></a></span>
                                <span><a href="#"><i class="fa fa-clock-o"></i><?php echo $record['comment'];?> Comment</a></span>
                            </div>
                            <p>
							<?php echo substr($record['description'], 0, 100);?>
							</p>
                        </div>
                    </div>
                </div>
            </div>
		<?php }?>
        </div>
    </div>
</div>

</div>
<!-- Blog start -->

<!-- intro section start -->

<!-- intro section end -->

<!-- Footer start -->
<?php require_once 'footer.php'; ?>

<script>
function getPropertySearch()
{
	var area = $('#area').val();
	var location = $('#location').val();
	var category = $('#category').val();
	var bedroom = $('#bedroom').val();
	var bathroom = $('#bathroom').val();
	
	window.location.href ="property.php?area="+area+"&category="+category+"&location="+location+"&bedroom="+bedroom+"&bathroom="+bathroom;
}
</script>
</body>
</html>