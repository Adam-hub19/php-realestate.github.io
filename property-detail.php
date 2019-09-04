<?php 
session_start();
include_once('admin/classess/config.php');
include_once('admin/classess/function.php');
$admin= new ADMIN(); 
$error = false;
$err_msg = '';
$page_id = 1;

$option ='';


$recentproperty = $admin->getAllRecentPropertysFrontEnd(15);
$recentpropertyfooter = $admin->getAllRecentPropertysFrontEnd(3);


if(isset($_GET['id']))
{
  $propertydetail = $admin->getEditPropertyDetailsById(base64_decode($_GET['id']));
  $AllpropertyImagedata = $admin->getAllPropertyImageByPropertyId(base64_decode($_GET['id']));
}
else
{
	header("Location:property.php");
    exit(0);
}
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
            <h1>Property Detail</h1>
            <ul class="breadcrumbs">
                <li><a href="index.php">Home</a></li>
                <li class="active">Property Detail</li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub banner end -->

<!-- Properties details page start -->
<div class="properties-details-page content-area-15">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-xs-12 slider">
                <div id="propertiesDetailsSlider" class="carousel properties-details-sliders slide mb-60">
                    <div class="heading-properties">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left">
                                    <h3><?php echo $propertydetail['name'];?></h3>
                                    <p><i class="fa fa-map-marker"></i> <?php echo strip_tags($propertydetail['location']);?></p>
                                </div>
                                <div class="p-r">
                                    <h3>£ <?php echo $propertydetail['price'];?></h3>
                                    <p><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- main slider carousel items -->
                    
					<!-- main slider carousel items -->
                    <div class="carousel-inner">
					
					    <div class="active item carousel-item" data-slide-number="0">
                            <img src="admin/images/<?php echo $propertydetail['image'];?>" class="blog-theme img-fluid" style="height:500px;width:1000px" alt="property-4">
                        </div>
					    <?php foreach($AllpropertyImagedata as $rec) {?>
                        
                        <div class="item carousel-item" data-slide-number="1">
                            <img src="admin/slider_image/<?php echo $rec['image'];?>" style="height:500px;width:1000px" class="blog-theme img-fluid" alt="property-6">
                        </div>
						<?php }?>
                        
                        <a class="carousel-control left" href="#propertiesDetailsSlider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                        <a class="carousel-control right" href="#propertiesDetailsSlider" data-slide="next"><i class="fa fa-angle-right"></i></a>

                    </div>
                    <!-- main slider carousel nav controls -->
                    <ul class="carousel-indicators smail-properties list-inline nav nav-justified">
                        <li class="list-inline-item active">
                            <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#propertiesDetailsSlider">
                                <img src="admin/images/<?php echo $propertydetail['image'];?>" class="img-fluid" alt="property-4">
                            </a>
                        </li>
						<?php 
						$c =1;
						foreach($AllpropertyImagedata as $rec) {?>
                        <li class="list-inline-item">
                            <a id="carousel-selector-<?php echo $c;?>" data-slide-to="<?php echo $c;?>" data-target="#propertiesDetailsSlider">
                                <img src="admin/slider_image/<?php echo $rec['image'];?>" class="img-fluid" alt="property-6">
                            </a>
                        </li>
						<?php $c++;
						}?>
                        
                    </ul>
                    <!-- main slider carousel nav controls -->
                    <!--<img class="blog-theme img-fluid" src="admin/images/<?php //echo $propertydetail['image'];?>" alt="blog-3">-->
                </div>
                <!-- Search area start -->
                <!-- Tabbing box start -->
                <div class="tabbing tabbing-box mb-60">
                    <ul class="nav nav-tabs" id="carTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="one" aria-selected="false">Description</a>
                       </li>
                       <!-- <li class="nav-item">
                            <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="two" aria-selected="false">Floor Plans</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="three" aria-selected="true">Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="4-tab" data-toggle="tab" href="#4" role="tab" aria-controls="4" aria-selected="true">Video</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="5-tab" data-toggle="tab" href="#5" role="tab" aria-controls="5" aria-selected="true">Location</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="6-tab" data-toggle="tab" href="#6" role="tab" aria-controls="6" aria-selected="true">Related Properties</a>
                        </li>-->
                    </ul>
                    <div class="tab-content" id="carTabContent">
                        <div class="tab-pane fade active show" id="one" role="tabpanel" aria-labelledby="one-tab">
                            <h3 class="heading">Property Description</h3>
                           <p>
						   <?php echo strip_tags($propertydetail['propert_des']);?>
						   </p>
						</div>
                        <div class="tab-pane fade" id="two" role="tabpanel" aria-labelledby="two-tab">
                            <div class="floor-plans mb-60">
                                <h3 class="heading">Floor Plans</h3>
                                <table>
                                    <tbody><tr>
                                        <td><strong>Size</strong></td>
                                        <td><strong>Rooms</strong></td>
                                        <td><strong>2 Bathrooms</strong></td>
                                    </tr>
                                    <tr>
                                        <td>1600</td>
                                        <td>3</td>
                                        <td>2</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <img src="http://placehold.it/730x370" alt="floor-plans" class="img-fluid">
                            </div>
                        </div>
                        <div class="tab-pane fade " id="three" role="tabpanel" aria-labelledby="three-tab">
                            <div class="property-details">
                                <h3 class="heading">Property Details</h3>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <ul>
                                            <li>
                                                <strong>Property Id:</strong>215
                                            </li>
                                            <li>
                                                <strong>Price:</strong>$1240/ Month
                                            </li>
                                            <li>
                                                <strong>Property Type:</strong>House
                                            </li>
                                            <li>
                                                <strong>Bathrooms:</strong>3
                                            </li>
                                            <li>
                                                <strong>Bathrooms:</strong>2
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <ul>
                                            <li>
                                                <strong>Property Lot Size:</strong>800 ft2
                                            </li>
                                            <li>
                                                <strong>Land area:</strong>230 ft2
                                            </li>
                                            <li>
                                                <strong>Year Built:</strong>2018
                                            </li>
                                            <li>
                                                <strong>Available From:</strong>2018
                                            </li>
                                            <li>
                                                <strong>Garages:</strong>2
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <ul>
                                            <li>
                                                <strong>Sold:</strong>Yes
                                            </li>
                                            <li>
                                                <strong>City:</strong>Usa
                                            </li>
                                            <li>
                                                <strong>Parking:</strong>Yes
                                            </li>
                                            <li>
                                                <strong>Property Owner:</strong>Sohel Rana
                                            </li>
                                            <li>
                                                <strong>Zip Code: </strong>2451
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="4" role="tabpanel" aria-labelledby="4-tab">
                            <div class="property-video">
                                <h3 class="heading">Property Vedio</h3>
                                <iframe src="https://www.youtube.com/embed/m5_AKjDdqaU"></iframe>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="5" role="tabpanel" aria-labelledby="5-tab">
                            <div class="section location">
                                <h3 class="heading">Property Location</h3>
                                <div class="map">
                                    <div id="contactMap" class="contact-map"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="6" role="tabpanel" aria-labelledby="6-tab">
                            <div class="related-properties">
                                <h3 class="heading">Related Properties</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="property-box">
                                            <div class="property-thumbnail">
                                                <a href="properties-details.html" class="property-img">
                                                    <div class="tag button alt featured">Featured</div>
                                                    <div class="price-ratings-box">
                                                        <p class="price">
                                                            $178,000
                                                        </p>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                    </div>
                                                    <img src="http://placehold.it/350x233" alt="property-2" class="img-fluid">
                                                </a>
                                                <div class="property-overlay">
                                                    <a href="properties-details.html" class="overlay-link">
                                                        <i class="fa fa-link"></i>
                                                    </a>
                                                    <a class="overlay-link property-video" title="Test Title">
                                                        <i class="fa fa-video-camera"></i>
                                                    </a>
                                                    <div class="property-magnify-gallery">
                                                        <a href="http://placehold.it/750x540" class="overlay-link">
                                                            <i class="fa fa-expand"></i>
                                                        </a>
                                                        <a href="http://placehold.it/750x540" class="hidden"></a>
                                                        <a href="http://placehold.it/750x540" class="hidden"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="detail">
                                                <h1 class="title">
                                                    <a href="properties-details.html">Modern Family Home</a>
                                                </h1>
                                                <div class="location">
                                                    <a href="properties-details.html">
                                                        <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                                                    </a>
                                                </div>
                                                <ul class="facilities-list clearfix">
                                                    <li>
                                                        <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> 3 Bedrooms
                                                    </li>
                                                    <li>
                                                        <i class="flaticon-bath"></i> 2 Bathrooms
                                                    </li>
                                                    <li>
                                                        <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft:3400
                                                    </li>
                                                    <li>
                                                        <i class="flaticon-car-repair"></i> 1 Garage
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="footer">
                                                <a href="#">
                                                    <i class="fa fa-user"></i> Jhon Doe
                                                </a>
                                                <span>
                                                     <i class="fa fa-calendar-o"></i> 2 years ago
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="property-box">
                                            <div class="property-thumbnail">
                                                <a href="properties-details.html" class="property-img">
                                                    <div class="tag button alt featured">Featured</div>
                                                    <div class="price-ratings-box">
                                                        <p class="price">
                                                            $178,000
                                                        </p>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                    </div>
                                                    <img src="http://placehold.it/350x233" alt="property-7" class="img-fluid">
                                                </a>
                                                <div class="property-overlay">
                                                    <a href="properties-details.html" class="overlay-link">
                                                        <i class="fa fa-link"></i>
                                                    </a>
                                                    <a class="overlay-link property-video" title="Test Title">
                                                        <i class="fa fa-video-camera"></i>
                                                    </a>
                                                    <div class="property-magnify-gallery">
                                                        <a href="http://placehold.it/750x540" class="overlay-link">
                                                            <i class="fa fa-expand"></i>
                                                        </a>
                                                        <a href="http://placehold.it/750x540" class="hidden"></a>
                                                        <a href="http://placehold.it/750x540" class="hidden"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="detail">
                                                <h1 class="title">
                                                    <a href="properties-details.html">Relaxing Apartment</a>
                                                </h1>
                                                <div class="location">
                                                    <a href="properties-details.html">
                                                        <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                                                    </a>
                                                </div>
                                                <ul class="facilities-list clearfix">
                                                    <li>
                                                        <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> 3 Bedrooms
                                                    </li>
                                                    <li>
                                                        <i class="flaticon-bath"></i> 2 Bathrooms
                                                    </li>
                                                    <li>
                                                        <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft:3400
                                                    </li>
                                                    <li>
                                                        <i class="flaticon-car-repair"></i> 1 Garage
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="footer">
                                                <a href="#">
                                                    <i class="fa fa-user"></i> Jhon Doe
                                                </a>
                                                <span>
                                                    <i class="fa fa-calendar-o"></i> 2 years ago
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Amenities box start -->
                <div class="amenities-box mb-60">
                    <h3 class="heading">Features</h3>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <ul>
                                <li><span><i class="flaticon-bed"></i> <?php echo $propertydetail['bedroom'];?> Beds</span></li>
                                <li><span><i class="flaticon-bath"></i> <?php echo $propertydetail['bathroom'];?> Bathroom</span></li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <ul>
                                <li><span><i class="flaticon-car-repair"></i> <?php echo $propertydetail['garage'];?> Garage</span></li>
                                
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <ul>
                                <li><span><i class="flaticon-square-layouting-with-black-square-in-east-area"></i> <?php echo $propertydetail['area'];?> sq ft</span></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Features opions start -->
               </div>
            <div class="col-lg-4 col-md-12">
                <div class="sidebar mbl">
                    <!-- Search area start -->
                    <!-- Categories start -->
                    <div class="widget categories">
                        <h5 class="sidebar-title">Categories</h5>
                        <ul>
                            <li><a href="property.php?category=1">Features<span>(<?php echo $admin->countAllPropertyByCategory(1);?>)</span></a></li>
                            <li><a href="property.php?category=2">Apartments<span>(<?php echo $admin->countAllPropertyByCategory(2);?>)</span></a></li>
                            <li><a href="property.php?category=3">Houses<span>(<?php echo $admin->countAllPropertyByCategory(3);?>)</span></a></li>
                            <li><a href="property.php?category=4">Family Houses<span>(<?php echo $admin->countAllPropertyByCategory(4);?>)</span></a></li>
                            <li><a href="property.php?category=5">Offices<span>(<?php echo $admin->countAllPropertyByCategory(5);?>)</span></a></li>
                            <li><a href="property.php?category=6">Villas<span>(<?php echo $admin->countAllPropertyByCategory(6);?>)</span></a></li>
                            <li><a href="property.php?category=7">Other<span>(<?php echo $admin->countAllPropertyByCategory(7);?>)</span></a></li>
                        </ul>
                    </div>
                    <!-- Recent posts start -->
                    <div class="widget recent-posts">
                        <h5 class="sidebar-title">Recent Properties</h5>
                        <?php foreach($recentproperty as $rec) {?>
                        <div class="media mb-4">
                            <a href="property-detail.php?id=<?php echo base64_encode($rec['id'])?>">
                                <img src="admin/images/<?php echo $rec['image'];?>" alt="sub-property">
                            </a>
                            <div class="media-body align-self-center">
                                <h5>
                                    <a href="property-detail.php?id=<?php echo base64_encode($rec['id'])?>"><?php echo $rec['name'];?></a>
                                </h5>
                                <p><?php echo date('d M',strtotime($rec['name']));?></p>
                                <p> <strong>£ <?php echo $rec['price'];?></strong></p>
                            </div>
                        </div>
						<?php }?>
                    </div>

                    <!-- Social list start -->
                   </div>
            </div>
        </div>

        <a class="btn btn-primary btn-lg btn-block" 
        href="contact.php?subject=<?php echo $propertydetail['name'],',' ,$propertydetail['location'];?>"> Request Details</a>
        <p> or call: <b> 020 8012 4428 </b> </p>
    </div>
</div>
<!-- Properties details page end -->

<!-- Footer start -->
<?php require_once 'footer.php'; ?>
</body>
</html>