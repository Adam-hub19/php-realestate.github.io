<?php
session_start();
require_once 'classess/config.php';
require_once 'classess/function.php';

$admin= new ADMIN();
if(isset($_POST['sub']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    if(($email=='')||($password==''))
    {
        $err_msg="enter both the field";
        $response=array('msg'=>$err_msg,'status'=>0);
        echo json_encode($response);
        exit(0);
    }
    elseif ($admin->isAdminLoggedIn()) 
    {
        $err_msg="already login";
        $response=array('msg'=>$err_msg,'status'=>1);
        echo json_encode($response);
        exit(0);
    }
    elseif (!$admin->chkAdmin($email,$password))
    {
       $err_msg="enter the correct Email-Id and Password";
       $response=array('msg'=>$err_msg,'status'=>0);
       echo json_encode($response);
       exit(0);
    }
    
    elseif ($admin->doAdminLogIn($email)) 
    {
       $err_msg="login success";
       $response=array('msg'=>$err_msg,'status'=>1);
       echo json_encode($response);
       exit(0);
    }
}
?>
<html>
<head>
    <?php include_once 'head.php';?>
    <link rel="stylesheet" type="text/css" href="css/logincss.css">
    <link rel="stylesheet" type="text/css" href="../scss/login.scss">
    <meta charset="utf-8" />
   <title>Login</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
       
</head>
<body>

    <form method="POST" id="loginform">
        <div class="login-form">
        
  
        <div class="form-group ">
            <input type="text" class="form-control" placeholder="Email-Id" id="email" name="email">
            <i class="fa fa-user"></i>
           </div>
       <div class="form-group">
           <input type="password" class="form-control" placeholder="Password" id="password" name="password">
            <i class="fa fa-lock"></i>
            </div>
<!--        <span class="alert">Invalid Credentials</span>-->
       
        <button type="button" class="log-btn" name="sub" onclick="loginproceeds();return false;">Log in</button>
        </div>
    </form>
<script src="js/jquery-1.8.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-dialog.js"></script>
<script src="js/index.js"></script> 
<script src="validation/frontend_login.js"></script>  

</body>

</html>
