<?php
session_start();
require_once 'admin/classess/config.php';
require_once 'admin/classess/function.php';

$admin= new ADMIN();

if(isset($_POST['sub']))
    {
    $tdata=array(); 
    $tdata['password'] = $_POST['password']!='' ? $_POST['password'] : '';
    $tdata['email_id'] = $_POST['email_id']!='' ? $_POST['email_id'] : '';
    
     if($tdata['password']=='' || $tdata['email_id']=='')
            {
                $err_msg = "Please enter both fields";
                $response = array('msg'=>$err_msg,'status'=>0);
                echo json_encode($response);
	            die();
		    }
    elseif (!$admin->chkCustomer($tdata['email_id'],$tdata['password']))
           {     
            
                $err_msg = "Enter the correct email and password";
                $response = array('msg'=>$err_msg,'status'=>0);
                echo json_encode($response);
	            die();
				
           }
        
      elseif ($admin->doCustomerLogIn($tdata['email_id']))
            {
                
                $err_msg = "Login Success";
                $response = array('msg'=>$err_msg,'status'=>1);
                echo json_encode($response);
	            die();
            }

          

          
    
    
     
    }    
	
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
            
        </div>
    </div>
</div>
<!-- Sub banner end -->

<!-- properties list rightside start -->
<div class="properties-list-rightside content-area-2">
    <div class="container">
            
        <div class="row">
		<div class="col-lg-4">
		</div>
            <div class="col-lg-6">
                <div class="content-form-box forgot-box clearfix">
                    <div class="login-header clearfix">
                        <div class="pull-left">
                            <a href="index.php">
                                <!--<img src="assets/img/logos/black-logo.png" alt="logo">-->
							Adam's real estate
                            </a>
                        </div>
                        <div class="pull-right">
                            <h4>Login</h4>
                        </div>
                    </div>
                    <p>Please enter your email address and password to login</p>
                    <form method="POST" id="loginform">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email_id" id="email_id" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <input type="Password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <div class="form-check checkbox-theme">
                                <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">
                                    Keep Me Signed In
                                </label>
                            </div>
                        </div>
						 <button type="submit" class="btn btn-color btn-md pull-right" onclick="loginproceeds();return false;" name="sub" id="sub">Login</button>
                        
						<div class="login-footer text-center">
                            <p>Dont have an account?<a href="register.php"> Sign Up</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

		</div>
    </div>
</div>
<!-- properties list rightside end -->

<!-- Footer start -->
<?php require_once 'footer.php'; ?>
<script src="admin/validation/frontend_login.js"></script>  


</body>
</html>