<?php
session_start();
require_once '../classess/config.php';
require_once '../classess/function.php';

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