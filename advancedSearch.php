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
                            <h1 data-animation="animated fadeInDown delay-05s"> Find Your home right here</h1>
                            <p data-animation="animated fadeInUp delay-10s">
                               <!-- This is real estate website template based on Bootstrap 4 framework.-->
                            </p>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="slider_image/slider2.jpg" alt="banner">
                <div class="carousel-caption banner-slider-inner d-flex h-100 text-center">
                    <div class="carousel-content container">
                        <div class="t-right">
                            <h1 data-animation="animated fadeInDown delay-05s"></h1>
                            <p data-animation="animated fadeInUp delay-10s">
                              <!--  This is real estate website template based on Bootstrap 4 framework.-->
                            </p>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="slider_image/slider3.jpg" alt="banner">
                <div class="carousel-caption banner-slider-inner d-flex h-100 text-center">
                    <div class="carousel-content container">
                        <div class="t-left">
                         
                            <p data-animation="animated fadeInUp delay-10s">
                             
                            </p>
                            
                            
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
        <h5 class="sidebar-title">Advanced Search</h5>
        <div class="search-area-inner">
            <div class="search-contents ">
                <form  method="GET">
                    
                    <div class="row">

                        <div class="col-lg-6 col-md-7  ">
                            
                            <div class="form-group">
                                <input class="form-control" id="location" name="location" type="text" placeholder="Search Location" required>

                            </div>
                        </div>

                    </div>


                            <div class="row">
                            
                        <div class="col-6 col-lg-3 col-md-3">
                            <div class="form-group">
                              
                                 <select class="selectpicker search-fields" name="pricemin" id="pricemin" >
                                    <option value="">Min Price</option>
                                    <option value="0">£0 </option>
                                    <option value="50000">£50000</option>
                                    <option value="100000">£100000</option>
                                    <option value="150000">£150000</option>
                                    <option value="200000">£200000</option>
                                    
                                </select>


                            </div>
                        </div>

                       

                        <div class="col-6 col-lg-3 col-md-3">
                            <div class="form-group">
                              
                               <select class="selectpicker search-fields" name="pricemax" id="pricemax" >
                                    <option value="">Max Price</option>
                                    <option value="0">£0 </option>
                                    <option value="50000">£50000</option>
                                    <option value="100000">£100000</option>
                                    <option value="150000">£150000</option>
                                    <option value="200000">£200000</option>
                                    
                                </select>

                              
                            </div>
                        </div>


                        </div>
                    <div class="row">
                        
                 
                        
                       <!--  <div class="col-6 col-lg-3 col-md-3">
                            <div class="form-group">
                                <input type="text" placeholder="Search Location" name="location" id="location" class="form-control" required>
                            </div>
                        </div> -->
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
                                <button class="search-button btn-md btn-color" onclick="getPropertySearch();return false;" name="btnsubmit" type="submit">search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Search area end -->



<!-- Footer start -->
<?php require_once 'footer.php'; ?>

<script>
function getPropertySearch()
{

   // window.alert("david");



	var area = "";
	var location = $('#location').val();
	var category = $('#category').val();
	var bedroom = $('#bedroom').val();
	var bathroom = $('#bathroom').val();
    var pricemax =  $('#pricemax').val();
    var pricemin =  $('#pricemin').val();

if (pricemin != "" &&  pricemax != "" ){
    if (pricemin > pricemax) {

        window.alert(" Minmum price cannot be greater than maximum price");

        return;
    }
}

	
	window.location.href ="property.php?area="+area+"&category="+category+"&location="+location+"&bedroom="+bedroom+"&bathroom="+bathroom+"&pricemax="+pricemax+"&pricemin="+pricemin;
    //window.alert(location);
    //return;

   // window.location.href ="property.php?location="+location;
}
</script>
</body>
</html>