<?php 
session_start();
include_once('classess/config.php');
include_once('classess/function.php');

$admin_obj= new ADMIN(); 
$error = false;
$err_msg = '';


if(!$admin_obj->isadminLoggedIn())
    {
    header("Location:login.php");
    exit(0);
    }
    
if(isset($_POST['sub']))
{
    $tdata['name']=$_POST['name'];
    $tdata['designation']=$_POST['designation'];
    
	$tdata['facebook']=$_POST['facebook'];
    $tdata['twitter']=$_POST['twitter'];
    $tdata['linkdin']=$_POST['linkdin'];
    $tdata['instagram']=$_POST['instagram'];
    
	$tdata['image']=  $_FILES['images']['name'];
	$tdata['status']=$_POST['status'];
    $tdata['add_date'] = date('Y-m-d');
   
   if ($admin_obj->addAgent($tdata)) 
    {
	   $target_path1 = "images/";
       $target_path1 = $target_path1 .$tdata['image'];

       move_uploaded_file($_FILES['images']['tmp_name'], $target_path1);
	   
       header("Location:manage-agent.php");
       exit(0);
    
    }
    
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
                                                <h3>ADD AGENT DETAILS</h3>
                                            </div>
                                        </div>
                                        <hr>
                                        <center><div id="error_msg"></div></center>
                                        <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                                        
										<div class="form-group"><label class="col-lg-3 control-label">Name</label>
                                            <div class="col-lg-5"><input type="text" placeholder="Name" name="name" id="name" class="form-control" required></div>
                                        </div>
										
                                        <div class="form-group"><label class="col-lg-3 control-label">Designation</label>
                                            <div class="col-lg-5"><textarea placeholder="Designation" name="designation" id="designation" class="form-control" required></textarea></div>
                                        </div>
                                        
                                        <div class="form-group"><label class="col-lg-3 control-label">Facebook</label>
                                            <div class="col-lg-5"><input type="text" placeholder="Facebook" name="facebook" id="facebook" class="form-control" required></div>
                                        </div>
										<div class="form-group"><label class="col-lg-3 control-label">Twitter</label>
                                            <div class="col-lg-5"><input type="text" placeholder="Twitter" name="twitter" id="twitter" class="form-control" required></div>
                                        </div>
										<div class="form-group"><label class="col-lg-3 control-label">Linkdin</label>
                                            <div class="col-lg-5"><input type="text" placeholder="Linkdin" name="linkdin" id="linkdin" class="form-control" required></div>
                                        </div>
										<div class="form-group"><label class="col-lg-3 control-label">Instagram</label>
                                            <div class="col-lg-5"><input type="text" placeholder="Instagram" name="instagram" id="instagram" class="form-control" required></div>
                                        </div>
										
                                        <div class="form-group"><label class="col-lg-3 control-label">Agent Image</label>
                                            <div class="col-lg-5"><input type="file" placeholder="Testinomial Image" name="images" id="images" class="form-control" required></div>
                                        </div>
                                       
                                        <div class="form-group"><label class="col-lg-3 control-label">Select Status</label>
                                             <div class="col-lg-5">
                                                <select  type="text"  name="status" id="status" class="form-control">
                                                    <option value="1">Active</option>
                                                    <option value="2">Inactive</option>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                           
                                       <div class="form-group">
                                            <div class="col-lg-offset-3 col-lg-10">
                                                <div class="pull-left">
                                                    <button class="btn btn-primary rounded" type="submit" name="sub" id="sub">Submit</button>
                                                    <a href="manage-agent.php"><button type="button" class="btn btn-danger rounded" >Cancel</button></a>
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
        <script src="validation/add-location.js" type="text/javascript"></script>

    </body>
</html>