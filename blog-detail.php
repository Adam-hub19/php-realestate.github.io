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
  $blogdetail = $admin->getEditBlogDetailsById(base64_decode($_GET['id']));
}
else
{
	header("Location:blog.php");
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
            <h1>Blog Details </h1>
            <ul class="breadcrumbs">
                <li><a href="index.html">Home</a></li>
                <li class="active">Blog Details</li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub banner end -->

<!-- Blog section start -->
<div class="blog-section content-area-13">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <!-- Blog grid box start -->
                <div class="blog-1">
                    <img class="blog-theme img-fluid" src="admin/images/<?php echo $blogdetail['image'];?>" alt="blog-3">
                    <div class="detail">
                        <div class="date-box">
                            <h5><?php echo date('d', strtotime($blogdetail['add_date']));?></h5>
                            <h5><?php echo date('M',strtotime($blogdetail['add_date']));?></h5>
                        </div>
                        <h2>
                            <a href="blog.php"><?php echo $blogdetail['title'];?></a>
                        </h2>
                        <div class="post-meta">
                            <span><a href="#"><i class="fa fa-user"></i><?php echo $blogdetail['author_name'];?></a></span>
                            <span><a><i class="fa fa-clock-o"></i><?php echo date('M d', strtotime($blogdetail['add_date']));?></a></span>
                            <span><a href="#"><i class="fa fa-commenting-o"></i><?php echo $blogdetail['comment'];?> Comment</a></span>
                        </div>
                        <p>
						<?php echo strip_tags($blogdetail['description']);?>
						</p>
                        
						
                    </div>
                </div>
                <!-- Blog grid box end -->

               
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="sidebar mbl mb-50">
                    <!-- Search box start -->
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
                                <p> <strong>Rs <?php echo $rec['price'];?></strong></p>
                            </div>
                        </div>
						<?php }?>
                        
                    </div>

                    <!-- Tags start -->
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog section end -->

<!-- Footer start -->
<?php require_once 'footer.php'; ?>
</body>
</html>