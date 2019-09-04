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
	
if(isset($_POST['sub']))
 {
	$tdata['id']=$_POST['id'];
    $tdata['name']=$_POST['name'];
    $tdata['description']=$_POST['description'];
    $tdata['image']= $_FILES['image']['name']!=''? $_FILES['image']['name']:$_POST['old_image'];
	$tdata['status']=$_POST['status'];
    $tdata['add_date'] = date('Y-m-d');
   
   if ($admin->editTestinomial($tdata)) 
    {
	   $target_path1 = "images/";
       $target_path1 = $target_path1 .$tdata['image'];

       move_uploaded_file($_FILES['image']['tmp_name'], $target_path1);
	   
       header("Location:manage-testinomial.php");
       exit(0);
    
    }
   
    
 }
else 
  {	
    $id=$_GET['id'];
    $testinomiallist = $admin->getEditTestinomialDetailsById($id);
}
//print_r($subadmin);
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
                                                <h3>EDIT TESTINOMIAL</h3>
                                            </div>
                                        </div>
                                        <hr>
                                        <center><div id="error_msg"></div></center>
										
										<form role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
										
                                        <input type="hidden" name="id" id="id" value="<?php echo $testinomiallist['testinomial_id']; ?>">
										<input type="hidden" name="old_image" id="old_image" value="<?php echo $testinomiallist['image']; ?>">
										
										<div class="form-group"><label class="col-lg-3 control-label">Name</label>
                                            <div class="col-lg-5"><input type="text" placeholder="Name" name="name" id="name" value="<?php echo $testinomiallist['name']; ?>" class="form-control" required></div>
                                        </div>
										
                                        <div class="form-group"><label class="col-lg-3 control-label">Description</label>
                                            <div class="col-lg-5"><textarea placeholder="Description" name="description" id="description" class="form-control" required><?php echo $testinomiallist['description']; ?></textarea></div>
                                        </div>
                                        										
                                        
										<div class="form-group"><label class="col-lg-3 control-label">Testinomial Old Image</label>
                                            <div class="col-lg-5"><img src="images/<?php echo $testinomiallist['image'];?>" height="200" width="200"></div>
                                        </div>
                                        
                                        <div class="form-group"><label class="col-lg-3 control-label">Testinomial New Image</label>
                                            <div class="col-lg-5"><input type="file" placeholder="Testinomial New Image" name="image" class="form-control" ></div>
                                        </div>
										
                                       
                                        <div class="form-group"><label class="col-lg-3 control-label"> Status</label>
                                            <div class="col-lg-5">
                                                <select name="status" id="status" class="form-control" >
                                                    <option value="1" <?php if($testinomiallist['status']==1){echo 'selected';}?>>Active</option>
                                                    <option value="2" <?php if($testinomiallist['status']==2){echo 'selected';}?>>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                           
                                       <div class="form-group">
                                            <div class="col-lg-offset-3 col-lg-10">
                                                <div class="pull-left">
                                                    <button class="btn btn-primary rounded" type="submit" name="sub" id="sub">Submit</button>
                                                    <a href="manage-testinomial.php"><button type="button" class="btn btn-danger rounded" >Cancel</button></a>
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
        <script src="validation/edit-location.js" type="text/javascript"></script>

    </body>
</html>