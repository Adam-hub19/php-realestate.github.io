<?php
session_start();
require_once '../classess/config.php';
require_once '../classess/function.php';

$admin=new ADMIN();

if(isset($_POST['sub']))
{   
    $tdata=array();
    $tdata['location']=$_POST['location'];
    $tdata['name']=$_POST['name'];
    $tdata['price']=$_POST['price'];
    $tdata['propert_des']=$_POST['propert_des'];
    $tdata['bedroom']=$_POST['bedroom'];
    $tdata['bathroom']=$_POST['bathroom'];
    $tdata['full_address']=$_POST['full_address'];
    $tdata['garage']=$_POST['garage'];
	
    $tdata['image']=  time().'_'.$_FILES['image']['name'][0];
	
	
    $tdata['status']=$_POST['status'];
	$tdata['category']=$_POST['category'];
    $tdata['add_date'] = date('Y-m-d');
    
    if ($admin->addProperty($tdata)) 
    {
		 $target_path = "../images/";
         $target_path = $target_path .$tdata['image'];

         move_uploaded_file($_FILES['image']['tmp_name'][0], $target_path);
       
		$property_id = $admin->lastInsertIdFromPropertyTable($tdata['image']);
		
		for($i=1;$i<count($_FILES['image']['name']);$i++)
	     {
		   $image=  time().'_'.$_FILES['image']['name'][$i];
		   $admin->addPropertyImage($image,$property_id);
		   
		   $target_path1 = "../slider_image/";
           $target_path1 = $target_path1 .$image;
            
            move_uploaded_file($_FILES['image']['tmp_name'][$i], $target_path1);
       
	     }
		 
      
       $err_msg = "add one record successfully ";
       $response = array('msg'=>$err_msg,'status'=>1);
       echo json_encode($response);
    
    }
   
    
}
  