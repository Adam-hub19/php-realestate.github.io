<?php 
session_start();
include_once('admin/classess/config.php');
include_once('admin/classess/function.php');
$admin= new ADMIN(); 
$error = false;
$err_msg = '';
$page_id = 1;

$option ='';

$recentproperty = $admin->getAllRecentPropertysFrontEnd(20);
$recentpropertyfooter = $admin->getAllRecentPropertysFrontEnd(3);

$area ='';
$category ='';
$location ='';
$bedroom ='';
$bathroom ='';
$pricemax='';
$pricemin='';

//var_dump($_GET);
if(isset($_GET['area']))
 {
	$area = $_GET['area'];
 }
 
 if(isset($_GET['category']))
 {
	$category = $_GET['category'];
 }
 


if (isset($_GET['location'])) {

   $location = $_GET['location'];

    //echo "<h1> Location is set to : $location </h1>"

   // var_dump($_GET);
} 


 
 if(isset($_GET['bedroom']))
 {
	$bedroom = $_GET['bedroom'];
 }
 
 if(isset($_GET['bathroom']))
 {
	$bathroom = $_GET['bathroom'];
 }

 if(isset($_GET['pricemax']))
 {
    $pricemax = $_GET['pricemax'];

    //echo "<h1> pricenax is set : {$pricemax} </h1>" ;

    //if (is_numeric($pricemax)) { echo "Yes"; } else { echo "No"; }
 }
 if(isset($_GET['pricemin']))
 {
    $pricemin = $_GET['pricemin'];
 }


if(isset($_REQUEST['action']) && $_REQUEST['action'] =='propertylist')
    {
//   
    $adjacents = 2;
    $records_per_page =10;
    $page = (int) (isset($_POST['page_id']) ? $_POST['page_id'] : 1);
    $page = ($page == 0 ? 1 : $page);
    $start = ($page-1) * $records_per_page;
	
    $tdata = array();
	
	$tdata['area'] = $_REQUEST['area']!='' ? $_REQUEST['area'] : '';
	$tdata['category'] = $_REQUEST['category']!='' ? $_REQUEST['category'] : '';
	$tdata['location'] = $_REQUEST['location']!='' ? $_REQUEST['location'] : '';
	$tdata['bedroom'] = $_REQUEST['bedroom']!='' ? $_REQUEST['bedroom'] : '';
	$tdata['bathroom'] = $_REQUEST['bathroom']!='' ? $_REQUEST['bathroom'] : '';
    $tdata['pricemax'] = $_REQUEST['pricemax']!='' ? $_REQUEST['pricemax'] : '';
    //$tdata['bathroom'] = $_REQUEST['bathroom']!='' ? $_REQUEST['bathroom'] : '';
    $tdata['pricemin'] = $_REQUEST['pricemin']!='' ? $_REQUEST['pricemin'] : '';
	
	echo "<h5 class='form-group'> Search Location is set to: {$tdata['location']} </h5>";
    //echo "<h1> {$tdata['pricemax']} </h1>";
    //echo "<h1> {$tdata['pricemin']} </h1>";

    //var_dump($tdata);


    $property = $admin->getAllPropertysFrontEnd($tdata,$start,$records_per_page);

    if(empty($property)) {echo "<h12 class='alert alert-dark'>No results found for the given search criteria. Please adjust your search criteria </h12>"; }
     
  
    $count=$admin->countAllPropertyFrontEnd($tdata);
    //
    $next = $page + 1;    
    $prev = $page - 1;
    $last_page = ceil($count/$records_per_page);
    $second_last = $last_page - 1;
    $i = (($page * $records_per_page) - ($records_per_page - 1));
    $pagination = "";
	if($last_page > 1)
            {
        $pagination .= "<div class='pagination'>";
        if($page > 1)
            $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($prev).");'>&laquo; Previous&nbsp;&nbsp;</a>";
        else
            $pagination.= "<spn class='disabled'>&laquo; Previous&nbsp;&nbsp;</spn>";   
	if($last_page < 7 + ($adjacents * 2))
            {   
            for ($counter = 1; $counter <= $last_page; $counter++)
                {
                if ($counter == $page)
                    $pagination.= "<spn class='current'>$counter</spn>";
                else
                    $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($counter).");'>$counter</a>";     
                }
            }
        elseif($last_page > 5 + ($adjacents * 2))
            {
            if($page < 1 + ($adjacents * 2))
                {
                for($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                    {
                    if($counter == $page)
                        $pagination.= "<spn class='current'>$counter</spn>";
                    else
                        $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($counter).");'>$counter</a>";     
                    }
                $pagination.= "...";
                $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($second_last).");'> $second_last</a>";
                $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($last_page).");'>$last_page</a>";   
           
                }
           elseif($last_page - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                {
               $pagination.= "<a href='javascript:void(0);' onClick='change_page(1);'>1</a>";
               $pagination.= "<a href='javascript:void(0);' onClick='change_page(2);'>2</a>";
               $pagination.= "...";
               for($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                    {
                   if($counter == $page)
                       $pagination.= "<spn class='current'>$counter</spn>";
                   else
                       $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($counter).");'>$counter</a>";     
                    }
               $pagination.= "..";
               $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($second_last).");'>$second_last</a>";
               $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($last_page).");'>$last_page</a>";   
                }
           else
                {
               $pagination.= "<a href='javascript:void(0);' onClick='change_page(1);'>1</a>";
               $pagination.= "<a href='javascript:void(0);' onClick='change_page(2);'>2</a>";
               $pagination.= "..";
               for($counter = $last_page - (2 + ($adjacents * 2)); $counter <= $last_page; $counter++)
               {
                   if($counter == $page)
                        $pagination.= "<spn class='current'>$counter</spn>";
                   else
                        $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($counter).");'>$counter</a>";     
               }
           }
        }
        if($page < $counter - 1)
            $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($next).");'>Next &raquo;</a>";
        else
            $pagination.= "<spn class='disabled'>Next &raquo;</spn>";
	    $pagination.= "</div>";       
        }
    
      //End pagination
$option.='<div class="row">';
                    if(is_array($property) && count($property) > 0)
                            {
                       
                                foreach($property as $record)
                                    {  
                                       
        $option.='<div class="property-box-5">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-pad">
                            <div class="property-thumbnail">
                                <a href="properties-details.html" class="property-img">
                                    <div class="tag button alt featured">Featured</div>
                                    <div class="price-ratings-box">
                                        <p class="price">
                                            £ '.$record['price'].'
                                        </p>
                                        <div class="ratings">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                    </div>
									
                                     <img src="admin/images/'.$record['image'].'" style="height:210px; width:300px" alt="property-1" class="img-fluid">
									
                                </a>
                                <div class="property-overlay">
								
                                    <a  class="overlay-link" onclick="addWishlistData('.$record['id'].','.$record['price'].');return false;">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 align-self-center col-pad">
                            <div class="detail">
                                <!-- title -->
                                <h1 class="title">
                                    <a href="property-detail.php?id='.base64_encode($record['id']).'">'.substr($record['name'], 0, 30).'</a>
                                </h1>
                                <!-- Location -->
                                <div class="location">
                                    <a href="properties-details.html">
                                        <i class="fa fa-map-marker"></i>'.$record['location'].'
                                    </a>
                                </div>
                                <!-- Paragraph -->
                                <p>'.$record['propert_des'].'</p>
                                <!--  Facilities list -->
                                <ul class="facilities-list clearfix">
                                    <li>
                                        <i class="flaticon-bed"></i> '.$record['bedroom'].' Beds
                                    </li>
                                    <li>
                                        <i class="flaticon-bath"></i> '.$record['bathroom'].' Baths
                                    </li>
                                    <li>
                                        <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft:'.$record['area'].'
                                    </li>
                                    <li>
                                        <i class="flaticon-car-repair"></i> '.$record['garage'].' Garage
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                ';
                                        $i++;
                                     }
                                     }
                        else
                            {
                            $option.='<div class="property-box-5">
                                        <div class="row">
                                          <div class="col-lg-5 col-md-5 col-pad">
										  </div>
										</div> 
                         			 </div>';
                            }
                         $option.='</div>';
                            $option.=$pagination;        
                         echo $option;
                         exit(0);
    }  



?>

<!DOCTYPE html>
<html lang="en">
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
            <h1>Properties</h1>
            <ul class="breadcrumbs">
                <li><a href="index.php">Home</a></li>
                <li class="active">Properties</li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub banner end -->




<!-- properties list rightside start -->
<div class="properties-list-rightside content-area-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
			<!--
                <div class="option-bar d-none d-xl-block d-lg-block d-md-block d-sm-block">
                    <div class="row clearfix">
                        <div class="col-xl-4 col-lg-5 col-md-5 col-sm-5">
                            <h4>
                                <span class="heading-icon">
                                    <i class="fa fa-caret-right icon-design"></i>
                                    <i class="fa fa-th-list"></i>
                                </span>
                                <span class="heading">Properties List</span>
                            </h4>
                        </div>
                        <div class="col-xl-8 col-lg-7 col-md-7 col-sm-7">
                            <div class="sorting-options clearfix">
                                <a href="properties-list-rightside.html" class="change-view-btn active-view-btn"><i class="fa fa-th-list"></i></a>
                                <a href="properties-grid-rightside.html" class="change-view-btn"><i class="fa fa-th-large"></i></a>
                            </div>
                            <div class="search-area">
                                <select class="selectpicker search-fields" name="location">
                                    <option>High to Low</option>
                                    <option>Low to High</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>-->
                <div class="subtitle">
                    <!-- 20 Result Found -->
                </div>
                <div id="propertylist"></div>
                
                <!--<div class="pagination-box hidden-mb-45 text-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#"><span aria-hidden="true">«</span></a></li>
                            <li class="page-item"><a class="page-link active" href="properties-list-rightside.html">1</a></li>
                            <li class="page-item"><a class="page-link" href="properties-list-leftside.html">2</a></li>
                            <li class="page-item"><a class="page-link" href="properties-list-fullwidth.html">3</a></li>
                            <li class="page-item"><a class="page-link" href="properties-list-leftside.html"><span aria-hidden="true">»</span></a></li>
                        </ul>
                    </nav>
                </div>-->
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="sidebar mbl">
                    <!-- Search area start -->
                   <!-- Categories start -->

                    <div class="widget categories search-area">
                        <h5 class="sidebar-title">Advanced Search</h5>

                   <?php 

                       if (!isset($_GET['location']) || $_GET['location']=="") {
                                echo ' <div class="row">
                            

                            <div class="col">
                            
                                <div class="form-group">
                                    <input class="form-control" name="location" id="location" type="text" placeholder="Search Location" required>

                                </div>
                           </div>


                        </div>';
                                
                            }

                            // else


                            // {
                            //      $lc=$_GET['location'];

                            //     echo "<h1> location is set  to - {$lc} </h1>";
                            // }
                       

                   ?>
                        <div class="row">
    


                         <div class="col">
                                <div class="form-group">
                                    <select  name="category" id="category" class="selectpicker search-fields" required>
                                        <option value="">Property type</option>
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
                            
                        <div class="col">
                            <div class="form-group">
                                <select class="selectpicker search-fields" name="bedroom" id="bedroom">
                                    <option value="">No. of bedrooms</option>
                                    <option value="1">1 Bedrooms</option>
                                    <option value="2">2 Bedrooms</option>
                                    <option value="3">3 Bedrooms</option>
                                    <option value="4">4 Bedrooms</option>
                                    <option value="5">5 Bedrooms</option>
                                    
                                </select>
                            </div>
                        </div>


                        </div>


                      <div class="row">
                            
                        <div class="col">
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

                       

                        <div class="col">
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

                            <div class="col">
                                    <div class="form-group">
                                        <select class="selectpicker search-fields" name="bathroom"id="bathroom">
                                            <option value="">No. of bathrooms</option>
                                            <option value="1">1 Bathrooms</option>
                                            <option value="2">2 Bathrooms</option>
                                            <option value="3">3 Bathrooms</option>
                                            <option value="4">4 Bathrooms</option>
                                            <option value="5">5 Bathrooms</option>
                                        </select>
                                    </div>
                           </div>
                        


                        </div>


                        <div class="row">


                            <div class=" col form-group">
                                <button class="btn btn-color btn-md" onclick="try();return false;" name="btnsubmit" type="submit">Find properties</button>
                            </div>
                            


                        </div>
                        
                    </div>
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
                                <p><?php echo date('d M Y',strtotime($rec['name']));?></p>
                                <p> <strong>£ <?php echo $rec['price'];?></strong></p>
                            </div>
                        </div>
						<?php }?>
                        
                    </div>

                    <!-- Recent comments start -->
                 </div>
            </div>
        </div>
    </div>
</div>
<!-- properties list rightside end -->

<!-- Footer start -->
<?php require_once 'footer.php'; ?>


<script>

    function try(){

        window.alert("blalala");

    }
function getPropertySearch()
{

 //window.alert(location);

    var area = '';
    var location = "<?php  echo $_GET['location']; ?>";

      //window.alert(location);

   

    if (location === "") { 
        location=$('#location').val();
    }

    
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
     //window.alert(bathroom);

     //return;

   // window.alert(pricemax);

    
    window.location.href ="property.php?area="+area+"&category="+category+"&location="+location+"&bedroom="+bedroom+"&bathroom="+bathroom+"&pricemax="+pricemax+"&pricemin="+pricemin;
}
</script>

<script>
$(document).ready(function()
    {
    var page_id='<?php echo isset($_GET['page_id']) && $_GET['page_id']!='' ? $_GET['page_id'] :''?>';
    
	var area = '<?php echo $area;?>';
	var category = '<?php echo $category;?>';
	var location = '<?php echo $location;?>';
	var bedroom = '<?php echo $bedroom;?>';
	var bathroom = '<?php echo $bathroom; ?>';
    var pricemax = '<?php echo $pricemax; ?>';
    var pricemin =  '<?php echo $pricemin; ?>';
	
     $.ajax({  
        type: "POST",  
        url: 'property.php',  
        data: 'page_id='+page_id+'&area='+area+'&category='+category+'&location='+location+'&bedroom='+bedroom+'&bathroom='+bathroom +'&pricemax='+pricemax+'&pricemin='+pricemin+'&action=propertylist',  
        success: function(result)
            { 
//             alert(result);  
            $('#propertylist').html(result);
            }
       });
       
 });
    
function change_page(page_id)
    {
//    var name=$('#name').val();
    var area = '<?php echo $area;?>';
	var category = '<?php echo $category;?>';
	var location = '<?php echo $location;?>';
	var bedroom = '<?php echo $bedroom;?>';
	var bathroom = '<?php echo $bathroom;?>';
    var pricemax = '<?php echo $pricemax; ?>';
    var pricemin =  '<?php echo $pricemin; ?>';
	
    var dataString ='page_id='+page_id+'&area='+area+'&category='+category+'&location='+location+'&bedroom='+bedroom+'&bathroom='+bathroom +'&pricemax='+pricemax+'&pricemin='+pricemin+'&action=propertylist';
    $.ajax({
           type: "POST",
           url: 'property.php', 
           data: dataString,
           cache: false,
           success: function(result)
                {
               $('#propertylist').html(result);
               }
      });
    }
</script>

</body>
</html>