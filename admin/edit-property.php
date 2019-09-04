<?php 
session_start();
include_once('classess/config.php');
include_once('classess/function.php');

$admin= new ADMIN(); 
$error = false;
$err_msg = '';

if(!$admin->isadminLoggedIn())
    {
    header("Location:login.php");
    exit(0);
    }
	
if(isset($_REQUEST['action']) && $_REQUEST['action'] =='DeleteMoreImage')
    {
		$tdata['id'] = $_REQUEST['id']!='' ? $_REQUEST['id'] : '';
		
		if($admin->DeleteMoreImage($tdata['id']))
		{
			echo '1';die();
		}
		else
		{
			echo 'Something went wrong';die();
		}
			
	}	
else if(isset($_REQUEST['action']) && $_REQUEST['action'] =='addMoreImage')
    {
		$tdata['image_count'] = $_REQUEST['image_count']!='' ? $_REQUEST['image_count'] : '';
		$image_count = $tdata['image_count']+1;
		$optiondata =''; 
		
			$optiondata.= '         <div  id="removemore_'.$image_count.'">
			                             
			                            <div class="form-group">
										    <label class="col-lg-3 control-label">Slider New Image </label>
                                            <div class="col-lg-5">
											   <input type="file" placeholder="Property Image" name="sliderimage[]" id="sliderimage'.$tdata['image_count'].'" class="form-control" required>
											</div>
											<div class="col-lg-1">
											   <span class="btn btn-primary rounded" onclick="removeMoreImage('.$image_count.');return false;" ><i class="fa fa-minus"></i></span>
											</div>
                                        </div>
										</div>
									
										<div  id="addmore_'.$image_count.'">';
		
			print_r($optiondata);die();
	        
			
	}	
	
	
    $id=base64_decode($_GET['id']);
    $propertydata = $admin->getEditPropertyDetailsById($id);
	$AllpropertyImagedata = $admin->getAllPropertyImageByPropertyId($propertydata['id']);
    //print_r($AllpropertyImagedata);die();
//print_r($locationdata);
//exit(0);


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
      
        <?php require_once 'head.php'; ?>
        <link href="assets/plugins/summernote/summernote.css" rel="stylesheet">
    </head>
    <body hoe-navigation-type="vertical" hoe-nav-placement="left" theme-layout="wide-layout">

        <!--side navigation start-->
        <div id="hoeapp-wrapper" class="hoe-hide-lpanel" hoe-device-type="desktop">
           <?php require_once 'header.php'; ?>
            <div id="hoeapp-container" hoe-color-type="lpanel-bg7" hoe-lpanel-effect="shrink">
                <?php require_once 'side-menu.php'; ?>
                <!--start main content-->
                <section id="main-content">
                   <div class="container">
                     <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row mail-header">
                                            <div class="col-md-6">
                                                <h3>EDIT PROPERTY DETAILS</h3>
                                            </div>
                                        </div>
                                        <hr>
                                        <center><div id="error_msg"></div></center>
                                        <form role="form" class="form-horizontal" method="post" id="edit-property-form">
                                          
                                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                                        <input type="hidden" name="old_image" id="old_image" value="<?php echo $propertydata['image']; ?>">
                                        <input type="hidden"  name="image_count" id="image_count" value="0" class="form-control">    
                                             
										<div class="form-group"><label class="col-lg-3 control-label">Select Category</label>
                                             <div class="col-lg-5">
                                                <select  name="category" id="category" class="form-control" required>
                                                    <option value="">Select Category</option>
                                                    <option value="1" <?php if($propertydata['category']==1){echo 'selected';}?>>Features</option>
                                                    <option value="2" <?php if($propertydata['category']==2){echo 'selected';}?>>Apartments</option>
                                                    <option value="3" <?php if($propertydata['category']==3){echo 'selected';}?>>Houses</option>
                                                    <option value="4" <?php if($propertydata['category']==4){echo 'selected';}?>>Family Houses</option>
                                                    <option value="5" <?php if($propertydata['category']==5){echo 'selected';}?>>Offices</option>
                                                    <option value="6" <?php if($propertydata['category']==6){echo 'selected';}?>>Villas</option>
                                                    <option value="7" <?php if($propertydata['category']==7){echo 'selected';}?>>Other</option>
                                                   
                                                </select>
                                            </div>
                                        </div>
										
                                         <div class="form-group"><label class="col-lg-3 control-label">Location</label>
                                            <div class="col-lg-5"><input type="text" placeholder="Location" value="<?php echo $propertydata['location']; ?> " name="location" id="location" class="form-control" required></div>
                                        </div>
                                        <div class="form-group"><label class="col-lg-3 control-label">Full Address</label>
                                            <div class="col-lg-5"><textarea placeholder="Full Address" name="full_address" class="form-control"><?php echo $propertydata['full_address']; ?></textarea></div>
                                        </div>
                                        
                                        <div class="form-group"><label class="col-lg-3 control-label">Property Name</label>
                                            <div class="col-lg-5"><input type="text" placeholder="Property Name" name="name" class="form-control" value="<?php echo $propertydata['name']; ?>"></div>
                                        </div>
                                        
                                        <div class="form-group"><label class="col-lg-3 control-label">Bed Room</label>
                                            <div class="col-lg-5"><input type="number" placeholder="Bed Room"  value="<?php echo $propertydata['bedroom']; ?>" name="bedroom" id="bedroom" class="form-control" required></div>
                                        </div>
                                        <div class="form-group"><label class="col-lg-3 control-label">Bath Room</label>
                                            <div class="col-lg-5"><input type="number" placeholder="Bath Room" value="<?php echo $propertydata['bathroom']; ?>" name="bathroom" id="bathroom" class="form-control" required></div>
                                        </div>
                                        <!--
										<div class="form-group"><label class="col-lg-3 control-label">Area</label>
                                            <div class="col-lg-5"><input type="number" placeholder="Area" name="area" value="<?php echo $propertydata['area']; ?>" id="area" class="form-control" required></div>
                                        </div>
                                        -->
										<div class="form-group"><label class="col-lg-3 control-label">Garage</label>
                                            <div class="col-lg-5"><input type="number" placeholder="Garage" name="garage" value="<?php echo $propertydata['garage']; ?>"  id="garage" class="form-control" required></div>
                                        </div>
										<div class="form-group"><label class="col-lg-3 control-label">Price</label>
                                            <div class="col-lg-5"><input type="number" placeholder="Price" name="price" value="<?php echo $propertydata['price']; ?>" id="price" class="form-control" required></div>
                                        </div>
										<div class="form-group"><label class="col-lg-3 control-label">Property Description</label>
                                            <div class="col-lg-5"><textarea placeholder="Property Description" name="propert_des" class="form-control"><?php echo $propertydata['propert_des']; ?></textarea></div>
                                        </div>
										<?php if(count($AllpropertyImagedata) >0) {?>
                                        <div class="form-group">
										    
										    <label class="col-lg-3 control-label">Slider Old Image</label>
											<div class="col-lg-5">
											<div class="form-group">
											<?php foreach($AllpropertyImagedata as $rec) {?>
                                            
											    <div class="col-lg-3">
											      <img src="slider_image/<?php echo $rec['image'];?>" height="100" style="margin-bottom:10px" width="100">
												     <center><span class="btn btn-primary rounded" onclick="DeleteMoreImage(<?php echo $rec['image_id'];?>);return false;" ><i class="fa fa-trash "></i></span></center>
											
												</div>  
											 
                                            <?php }?>
											</div></div>
										</div>
										<?php }?>
										<div class="form-group">
										    <label class="col-lg-3 control-label">Slider New Image</label>
                                            <div class="col-lg-5">
											   <input type="file" placeholder="Property Image" name="sliderimage[]" id="sliderimage" class="form-control" >
											</div>
											<div class="col-lg-1">
											   <span class="btn btn-primary rounded" onclick="addMoreImage();return false;" ><i class="fa fa-plus"></i></span>
											</div>
                                        </div>
										<div  id="addmore_1">
										</div>
										
                                        <div class="form-group"><label class="col-lg-3 control-label">Property Old Image</label>
                                            <div class="col-lg-5"><img src="images/<?php echo $propertydata['image'];?>" height="200" width="200"></div>
                                        </div>
                                       
										<div class="form-group">
										    <label class="col-lg-3 control-label">Property New Image</label>
                                            <div class="col-lg-5">
											   <input type="file" placeholder="Property Image" name="image" id="image" class="form-control" >
											</div>
											
                                        </div>
										
                                        <div class="form-group"><label class="col-lg-3 control-label"> Status</label>
                                            <div class="col-lg-5">
                                                <select name="status" id="status" class="form-control" >
                                                    <option value="1" <?php if($propertydata['status']==1){echo 'selected';}?>>Active</option>
                                                    <option value="2" <?php if($propertydata['status']==2){echo 'selected';}?>>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                       <div class="form-group">
                                            <div class="col-lg-offset-3 col-lg-10">
                                                <div class="pull-left">
                                                    <button class="btn btn-primary rounded" type="submit" name="sub" id="sub">Submit</button>
                                                    <a href="manage-property.php"><button type="button" class="btn btn-danger rounded" >Cancel</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div><!--col end-->
                        </div>
                   </div> <!--end container-->

                    <?php require_once 'footer.php'; ?>
                </section><!--end main content-->
            </div>
        </div><!--end wrapper-->
        <!--Common plugins-->
        <?php require_once 'script.php'; ?>
        <script src="assets/plugins/summernote/summernote.min.js"></script>

        <!--page scripts-->
        
        <!-- Flot chart js -->
         <script src="assets/js/bootstrap-dialog.js"></script>
        <script type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script src="validation/edit-property.js" type="text/javascript"></script>
<script>


function addMoreImage()
         {
              var old_image_count = $('#image_count').val();
			  var image_count = Number(old_image_count)+1;
			  //alert(image_count);
              var dataString = 'image_count='+image_count+'&action=addMoreImage'; 
              $.ajax({
                   type: "POST",
                   url: 'edit-property.php', 
                   data: dataString,
                   cache: false,
                   success: function(result)
                        {
                            
                             $('#addmore_'+image_count).html(result);
                             $('#image_count').val(image_count);
                        }
              });
			
         }
function DeleteMoreImage(id)
         {
             
              var dataString = 'id='+id+'&action=DeleteMoreImage'; 
              $.ajax({
                   type: "POST",
                   url: 'edit-property.php', 
                   data: dataString,
                   cache: false,
                   success: function(result)
                        {
                            
                             if(result==1)
							 {
								 window.location.href = 'edit-property.php?id=<?php echo $_GET['id'];?>';
							 }
                        }
              });
			
         }		 
		 
		 
function removeMoreImage(remove_id)
         {
			 var id =remove_id-1;
              $('#removemore_'+remove_id).html('');
             // $('#image_count').val(image_count);
              
         }		 
</script>
    </body>
</html>