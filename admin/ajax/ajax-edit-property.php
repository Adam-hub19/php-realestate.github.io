<?php
session_start();
require_once '../classess/config.php';
require_once '../classess/function.php';

$admin = new ADMIN();

if(isset($_POST['sub']))
{
    $tdata=array();
    $tdata['id']=$_POST['id'];
    $tdata['location']=$_POST['location'];
    $tdata['price']=$_POST['price'];
    $tdata['name']=$_POST['name'];
    $tdata['propert_des']=$_POST['propert_des'];
    $tdata['bedroom']=$_POST['bedroom'];
    $tdata['bathroom']=$_POST['bathroom'];
    //$tdata['area']=$_POST['area'];
    $tdata['full_address']=$_POST['full_address'];
    $tdata['garage']=$_POST['garage'];
	
    $tdata['image']= $_FILES['image']['name']!=''? time().'_'.$_FILES['image']['name']:$_POST['old_image'];
	
    $tdata['status']=$_POST['status'];
	$tdata['category']=$_POST['category'];
    $tdata['updated_date']= date('Y-m-d');
    
    if($admin->editProperty($tdata)) 
    {
        $target_path = "../images/";
        $target_path = $target_path .$tdata['image'];
        move_uploaded_file($_FILES['image']['tmp_name'], $target_path);
		
        
	    for($i=0;$i<count($_FILES['sliderimage']['name']);$i++)
	     {
		  if($_FILES['sliderimage']['name'][$i]!='')
		  {
		   $sliderimage=  time().'_'.$_FILES['sliderimage']['name'][$i];
		   $admin->addPropertyImage($sliderimage,$tdata['id']);
		   
		   $target_path1 = "../slider_image/";
           $target_path1 = $target_path1 .$sliderimage;
            
            move_uploaded_file($_FILES['sliderimage']['tmp_name'][$i], $target_path1);
		  }
	     }
		 
	   
       $err_msg = "Successfully Edited ";
       $response = array('msg'=>$err_msg,'status'=>1);
       echo json_encode($response);
       exit();
    
    }
   
    
}