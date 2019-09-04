<?php 
session_start();
include_once('admin/classess/config.php');
include_once('admin/classess/function.php');

$admin = new ADMIN(); 

if(isset($_REQUEST['action']) && $_REQUEST['action'] =='addUserData')
    {
    $tdata=array(); 
   // $tdata['username'] = $_REQUEST['username']!='' ? $_REQUEST['username'] : '';
  
    $tdata['email'] = $_REQUEST['email']!='' ? $_REQUEST['email'] : '';
    $tdata['password'] = $_REQUEST['password']!='' ? $_REQUEST['password'] : '';
    $tdata['confirm_password'] = $_REQUEST['confirm_password']!='' ? $_REQUEST['confirm_password'] : '';
    $tdata['first_name'] = $_REQUEST['first_name']!='' ? $_REQUEST['first_name'] : '';
    $tdata['last_name'] = $_REQUEST['last_name']!='' ? $_REQUEST['last_name'] : '';
   
    $tdata['is_admin'] = 0;
   
    
    
    if($tdata['password']=='' || $tdata['email']=='' || $tdata['confirm_password']=='' || $tdata['first_name']=='' || $tdata['last_name']==''  )
    {
        echo '1';
        die();
    }
	else if (!filter_var($tdata['email'], FILTER_VALIDATE_EMAIL))
     {
       echo '2'; 
       die();
     } 
   
     else if ($admin->chkEmail($tdata['email']))
        {
            echo '3';
            die();
        } 
    else if ($tdata['password']!=$tdata['confirm_password'])
        {
            echo '4';
            die();
        }     
    else if ($admin->addCustomer($tdata)) 
        {
           echo '5';
           exit(0);
        }
    }
$recentpropertyfooter = $admin->getAllRecentPropertysFrontEnd(3);	
?>
<!DOCTYPE html>
<html >
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
<!-- Register page start -->
<div class="register-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-5 cnt-bg-photo d-none d-xl-block d-lg-block d-md-block" >
                <div class="register-info">
                    <a href="index.php">
                        Adam's real estate agent
                    </a>
                    <p></p>
                </div>
            </div>
            <div class="col-lg-8 col-md-7 col-sm-12 align-self-center">
                <div class="content-form-box register-box">
                    <div class="login-header"><h4>Create Your account</h4></div>
                    <form action="#" method="GET">
                        <div class="form-group">
                            <input type="text" class="form-control" id="first_name"  name="first_name" placeholder="First Name">
                        </div>	
                        <div class="form-group">
                            <input type="text" class="form-control" id="last_name"  name="last_name" placeholder="Last Name">
                        </div>
                        <!--
                        <div class="form-group">
                           <input type="number" class="form-control" id="contact_no" name="contact_no" placeholder="Mobile Number">
							<p style="color:red;" id="error3">Invalid Mobile number Format</p>
							<p style="color:red;" id="error4">Enter Another Mobile Number</p>
                        </div>-->
						<div class="form-group"> 
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
							<p style="color:red;" id="error2">Invalid Email Format</p>
							<p style="color:red;" id="error3">Enter another email address</p>
                        </div>
                        <div class="form-group">
                            <input type="Password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="Password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                        </div>
						<p style="color:red;" id="error4">Your Password And Confirmation Password Do Not Match</p>
						<p style="color:red;" id="error1">Enter All The Fields</p>
					
					
					
                        <div class="form-group">
						  
                            <button type="submit" class="btn btn-color btn-md btn-block" onclick="addUserData();">Create New Account</button>
                        </div>
                        <div class="login-footer text-center">
                            <p>Already have an account?<a href="login.php"> Sign In</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register page end -->
<!-- properties list rightside end -->

<!-- Footer start -->
<?php require_once 'footer.php'; ?>
 <script>
  $(document).ready(function () {
        
         $('#error1').hide();
         $('#error2').hide();
         $('#error3').hide();
         $('#error4').hide();
        
	 });	 
    
	function addUserData()
         {
              var username = $('#full_name').val();

			  var first_name = $('#first_name').val();
              var last_name = $('#last_name').val();
              var email = $('#email').val();
              var password = $('#password').val();
              var confirm_password = $('#confirm_password').val();
             
             
			  

              var dataString = 'first_name='+first_name+  '&last_name='+last_name+  '&email='+email+'&confirm_password='+confirm_password+'&password='+password+'&action=addUserData'; 
              $.ajax({
                   type: "POST",
                   url: 'register.php', 
                   data: dataString,
                   cache: false,
                   success: function(result)
                        {
                           
                         if(result==1)
                         {
                            
                             $('#error1').show();
                             $('#error2').hide();
                             $('#error3').hide();
                             $('#error4').hide();
                            
                         }
                         else if(result==2)
                         {
                             
                             $('#error1').hide();
                             $('#error2').show();
                             $('#error3').hide();
                             $('#error4').hide();
                         
                         }
                         else if(result==3)
                         {
                             $('#error1').hide();
                             $('#error2').hide();
                             $('#error3').show();
                             $('#error4').hide();
                           
                         }
                         else if(result==4)
                         {
                             $('#error1').hide();
                             $('#error2').hide();
                             $('#error3').hide();
                             $('#error4').show();
                         
                         }
                     
                         else  if(result==5)
                         {
                             alert('Sign Up Successfully');
                             window.location.href = "login.php";
                         }
                         else
                         {
                              alert(result);
                         }
                        }
              });

         }
        </script>


</body>
</html>