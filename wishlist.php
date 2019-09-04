<?php 
session_start();
include_once('admin/classess/config.php');
include_once('admin/classess/function.php');
$admin= new ADMIN(); 


$allwishlistdata = $admin->getAllWishlistFrontEnd();
$recentpropertyfooter = $admin->getAllRecentPropertysFrontEnd(3);

if(isset($_REQUEST['action']) && $_REQUEST['action'] =='deletewishlist')
    {
        
    $response=array();
    $id=$_REQUEST['id']!='' ? $_REQUEST['id'] : '';
    if($admin->DeleteWishlist($id))
        {
        $response['status']=1;
        }
    echo json_encode(array($response));
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
<div class="sub-banner overview-bgi">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>Wishlist</h1>
            <ul class="breadcrumbs">
                <li><a href="index.php">Home</a></li>
                <li class="active">Wishlist</li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub banner end -->

<!-- Shop cart start -->
<div class="shop-cart content-area-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-2">
                    <h4>Wishlist</h4>
                    
                </div>
            </div>
            <div class="col-lg-8">
                <table class="shop-table cart">
                    <thead>
                    <tr>
                        <th  class="product-name">Property</th>
						<th  class="product-name">Property Name</th>
                        <th class="product-price">Description</th>
                        <th class="product-price">Price</th>
                        <th class="product-subtotal">Total</th>
                        <th class="product-remove">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php foreach($allwishlistdata as $rec) {
						$propertydata = $admin->getEditPropertyDetailsById($rec['property_id']);
						?>
                    <tr>
                        <td class="product-thumbnail"><img src="admin/images/<?php echo $propertydata['image'];?>" alt="shop-1"></td>
                        <td class="product-name"><center ><?php echo $propertydata['name'];?></center></td>
 
                        <td class="product-description">
                            <a ><?php echo substr($propertydata['propert_des'], 0, 30);?></a>
                        </td>
                        <td>£ <?php echo $rec['price'];?></td>
                        <td>£ <?php echo $rec['price'];?></td>
                        <td class="product-remove"><a onclick="deletewishlist(<?php echo $rec['wishlist_id'];?>);return false;"><i class="fa fa-close"></i></a></td>
                    </tr>
					<?php }?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="cart-total-box bg-white hdn-mb-30 mb-30">
                    <h5>Wishlish Totals</h5>
                    <hr>
                    <ul>
					    <?php 
						$grandtotal = 0;
						foreach($allwishlistdata as $record) { 
						$propertydatatotal = $admin->getEditPropertyDetailsById($rec['property_id']);
						
						$grandtotal = $record['price']+$grandtotal;
						?>
                        <li>
                            <?php echo $propertydatatotal['name'];?><span class="pull-right">£ <?php echo $record['price'];?></span>
                        </li>
						<?php }?>
                       </ul>
                    <hr>
                    <p class="mar-b-50">
                        Grand Total<span class="pull-right">£ <?php echo $grandtotal;?></span>
                    </p>
                    <br>

                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop cart end -->

<!-- Footer start -->


<!-- External JS libraries -->
<?php require_once 'footer.php'; ?>
<script>
function deletewishlist(id)
    {
		
     
            $.ajax({  
            type: "POST",  
             url: 'wishlist.php',
            data:'id='+id+'&action=deletewishlist',  
            success: function(resp)
                {
					
                var JSONObject = JSON.parse(resp);
                var rslt=JSONObject[0]['status'];
				
                if(rslt==1)
                    {
                         window.location.href = 'wishlist.php';
                    }
                 
                }
               });   
             
    }
    
</script>
</body>
</html>