<?php

require_once 'config.php';

 class ADMIN
{
    public function isadminLoggedIn()
        {
        global $link;
        $return = false;
        if( isset($_SESSION['prop_id']) && ($_SESSION['prop_id'] > 0) && ($_SESSION['prop_id'] != '') )
            {
            $prop_id = $_SESSION['prop_id'];
            if($this->chkValprop_idadmin($prop_id))
                {
                $return = true;	
                }	
            }
            return $return;
        }
    
     public function chkValprop_idadmin($prop_id)
        {
        $return=false;
        $DBH = new DatabaseHandler();
        $sql = "SELECT * FROM `tbl_user` WHERE `user_id` = '".$prop_id."'";
        $STH = $DBH->query($sql);
        if($STH->rowCount() > 0) 
            {
            $return=true;
            } 
        return $return;
        }    
   

    public function chkadmin($email,$password)
    {
        $return=false;
        $DBH=new DatabaseHandler();
        $sql="select * from `tbl_user` where `email`='".$email."' and `is_admin`='1' and `password`='".md5($password)."'";
        $STH=$DBH->query($sql);
        if($STH->rowCount()>0)
        {
            $return=true;
        }
        return $return;
    }
    
    function doAdminLogIn($email)
        {
        $return = false;
        $prop_id = $this->getAdminUser_id($email);
       
        $schooldetail= $this->getAdminUserDetailByID($prop_id);
       
        $first_name = $schooldetail['first_name'];
        $email =$schooldetail['email'];
		//$username =$schooldetail['username'];
        $password = $schooldetail['password'];
        $super_admin = $schooldetail['is_admin'];
       
        if($prop_id > 0)
            {
            $return = true;	
            $_SESSION['prop_id'] = $prop_id;
            $_SESSION['first_name'] = $first_name; 
            $_SESSION['email'] = $email; 
			//$_SESSION['username'] = $username; 
            $_SESSION['password'] = $password; 
             $_SESSION['is_super_admin'] = $super_admin;
            }	
            return $return;
        }
        public function getAdminUser_id($email)
        {
        $return=false;
        $DBH = new DatabaseHandler();
        $sql = "SELECT * FROM `tbl_user` WHERE `email` = '".$email."' ";
        $STH = $DBH->query($sql);
        if($STH->rowCount() > 0) 
            {
                $row = $STH->fetch(PDO::FETCH_ASSOC);
            $return=$row['user_id'];
            } 
        return $return;
	}  
         public function getAdminUserDetailByID($prop_id)
        {
        $return=false;
        $DBH = new DatabaseHandler();
        $sql = "SELECT * FROM `tbl_user` WHERE `user_id` = '".$prop_id."'";
        $STH = $DBH->query($sql);
        if($STH->rowCount() > 0) 
            {
         $row = $STH->fetch(PDO::FETCH_ASSOC);
            $return=$row;
            } 
        return $return;
	}
        public function adminLogout()
    {
        $return=true;
        $_SESSION['prop_id']='';
       // $_SESSION['username']='';
        $_SESSION['password']='';
        $_SESSION['super_admin']='';
        unset($_SESSION['prop_id']);
       // unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['super_admin']);
        session_start();
        session_destroy();
        
        //session_regenerate_prop_id();
        //$new_sessionprop_id= session_prop_id();
        return $return;
       }
  
    
 
    public function getAllProperty($prop_id)
        {
           $return=array();
           $DBH = new DatabaseHandler();
           $sql="select * from `tbl_property` where `location_prop_id`='".$prop_id."' ";
           $STH = $DBH->query($sql);
           if($STH->rowCount()>0)
           {
               while($row = $STH->fetch(PDO::FETCH_ASSOC))
               {
                   $return[] = $row;
               }
           }
           return $return;
        }   
    public function countProperty()
       {
       $return='';
       $DBH = new DatabaseHandler();
       $sql="select count(*) from `tbl_property` ";
       $STH = $DBH->query($sql);
       $return=$STH->fetchColumn();
       return $return;
       }   
    public function countLocation()
       {
       $return='';
       $DBH = new DatabaseHandler();
       $sql="select count(*) from `tbl_location` ";
       $STH = $DBH->query($sql);
       $return=$STH->fetchColumn();
       return $return;
       }   
    
   
   public function getAllBlog($start,$records_per_page)
       {
       $return=array();
       $DBH = new DatabaseHandler();
       $sql="select * from `tbl_blog`where 1 ORDER BY blog_id DESC  LIMIT ".$start." ,".$records_per_page."";
       $STH = $DBH->query($sql);
       if($STH->rowCount()>0)
       {
           while($row = $STH->fetch(PDO::FETCH_ASSOC))
           {
               $return[] = $row;
           }
       }
       return $return;
       }
    public function countAllBlog()
       {
       $return='';
       $DBH = new DatabaseHandler();
       $sql="select count(*) from `tbl_blog`where 1 ";
       $STH = $DBH->query($sql);
       $return=$STH->fetchColumn();
       return $return;
       }
    public function DeleteBlog($blog_id)
        {
        $return=false;
        $DBH = new DatabaseHandler();
        $sql="delete from `tbl_blog` where `blog_id`='".$blog_id."'";
        $STH = $DBH->query($sql);
        if($STH->rowCount() > 0) 
            {
            $return=true;
            } 
        return $return;
         
        }
    public function addBlog($tdata) 
        {
             
        $return=false;
        $DBH = new DatabaseHandler();
        $sql="insert into `tbl_blog` (`title`,`image`,`description`,`comment`,`author_name`,`status`,`add_date`) value('".addslashes($tdata['title'])."','".$tdata['image']."','".addslashes($tdata['description'])."','".addslashes($tdata['comment'])."','".addslashes($tdata['author_name'])."','".addslashes($tdata['status'])."','".$tdata['add_date']."')";
        $STH = $DBH->query($sql);
        if($STH->rowCount() > 0) 
            {
            $return=true;
            } 
        return $return;
        }
    public function getEditBlogDetailsById($blog_id)
        {
        $return='';
        $DBH = new DatabaseHandler();
        $sql= "SELECT * FROM `tbl_blog` WHERE `blog_id` ='".$blog_id."'";
        $STH = $DBH->query($sql);
         if($STH->rowCount() > 0) 
            {
            $row = $STH->fetch(PDO::FETCH_ASSOC);
            $return=$row;
            } 
        return $return;   
        }
    public function editBlog($tdata)
        {
            $my_DBH = new DatabaseHandler();
            $DBH = $my_DBH->raw_handle();
            $DBH->beginTransaction();
            $return = TRUE;
            try
                {
            $sql = "update `tbl_blog` set `title`='".addslashes($tdata['title'])."',`image`='".addslashes($tdata['image'])."',`description`='".addslashes($tdata['description'])."',`comment`='".addslashes($tdata['comment'])."',`author_name`='".addslashes($tdata['author_name'])."',`status`='".$tdata['status']."' where `blog_id`='".$tdata['id']."'";
            $STH = $DBH->prepare($sql);
                $STH->execute();
                $row_affected = $STH->rowCount();
                if($row_affected == 1)
                    {
                    $return = TRUE;
                    }
                $DBH->commit();
                }
            catch(Exception $e)
                {
                echo $e->getMessage();
                $DBH->rollBack();
                }
            return $return;   
   
   
        }
   public function getAllPropertys($start,$records_per_page)
       {
       $return=array();
       $DBH = new DatabaseHandler();
       $sql="select * from `tbl_property` where 1 ORDER BY id DESC  LIMIT ".$start." ,".$records_per_page."";
       $STH = $DBH->query($sql);
       if($STH->rowCount()>0)
       {
           while($row = $STH->fetch(PDO::FETCH_ASSOC))
           {
               $return[] = $row;
           }
       }
       return $return;
       }
     public function countAllProperty()
       {
       $return='';
       $DBH = new DatabaseHandler();
       $sql="select count(*) from `tbl_property` where 1";
       $STH = $DBH->query($sql);
       $return=$STH->fetchColumn();
       return $return;
       }
       public function DeleteProperty($prop_id)
        {
        $return=false;
        $DBH = new DatabaseHandler();
        $sql="delete from `tbl_property` where `id`='".$prop_id."'";
        $STH = $DBH->query($sql);
        if($STH->rowCount() > 0) 
            {
            $return=true;
            } 
        return $return;
         
        }
       public function addProperty($tdata) 
        {
             
        $return=false;
        $DBH = new DatabaseHandler();
         $sql="insert into `tbl_property` (`category`,`price`,`location`, `full_address`, `name`,`propert_des`,`bedroom`,`bathroom`,`garage`,`image`,`add_date`,`status`) value('".addslashes($tdata['category'])."','".addslashes($tdata['price'])."','".addslashes($tdata['location'])."','".addslashes($tdata['full_address'])."','".addslashes($tdata['name'])."','".addslashes($tdata['propert_des'])."','".addslashes($tdata['bedroom'])."','".addslashes($tdata['bathroom'])."','".addslashes($tdata['garage'])."','".$tdata['image']."','".addslashes($tdata['add_date'])."','".$tdata['status']."')";
        $STH = $DBH->query($sql);
        if($STH->rowCount() > 0) 
            {
            $return=true;
            } 
        return $return;
        }
        public function getEditPropertyDetailsById($prop_id)
        {
        $return='';
        $DBH = new DatabaseHandler();
        $sql= "SELECT * FROM `tbl_property` WHERE `id` ='".$prop_id."'";
        $STH = $DBH->query($sql);
         if($STH->rowCount() > 0) 
            {
            $row = $STH->fetch(PDO::FETCH_ASSOC);
            $return=$row;
            } 
        return $return;   
        }
       public function editProperty($tdata)
        {
            $my_DBH = new DatabaseHandler();
            $DBH = $my_DBH->raw_handle();
            $DBH->beginTransaction();
            $return = TRUE;
            try
                {
            $sql = "update `tbl_property` set `category`='".addslashes($tdata['category'])."',`price`='".addslashes($tdata['price'])."',`location`='".addslashes($tdata['location'])."' ,`full_address`='".addslashes($tdata['full_address'])."',`name`='".addslashes($tdata['name'])."',`propert_des`='".addslashes($tdata['propert_des'])."',`bedroom`='".addslashes($tdata['bedroom'])."',`bathroom`='".addslashes($tdata['bathroom'])."',`garage`='".addslashes($tdata['garage'])."',`image`='".$tdata['image']."',`status`='".$tdata['status']."',`updated_date`='".$tdata['updated_date']."' where `id`='".$tdata['id']."'";
            $STH = $DBH->prepare($sql);
                $STH->execute();
                $row_affected = $STH->rowCount();
                if($row_affected == 1)
                    {
                    $return = TRUE;
                    }
                $DBH->commit();
                }
            catch(Exception $e)
                {
                echo $e->getMessage();
                $DBH->rollBack();
                }
            return $return;   
   
   
        }
        
        
      public function getLocationNameByprop_id($location_prop_id)
       {
       $return='';
       $DBH = new DatabaseHandler();
       $sql="select * from `tbl_location` where `prop_id`='".$location_prop_id."' ";
       $STH = $DBH->query($sql);
       if($STH->rowCount()>0)
       {
           while($row = $STH->fetch(PDO::FETCH_ASSOC))
           {
               $return = $row['location'];
           }
       }
       return $return;
       }
      public function getAllLocationNameByprop_id()
       {
       $return=array();
       $DBH = new DatabaseHandler();
       $sql="select * from `tbl_location`where 1 ";
       $STH = $DBH->query($sql);
       if($STH->rowCount()>0)
       {
           while($row = $STH->fetch(PDO::FETCH_ASSOC))
           {
               $return[] = $row;
           }
       }
       return $return;
       }
   public function chkadminRegister($username,$password)
    {
        $return=false;
        $DBH=new DatabaseHandler();
        $sql="select * from `tbl_admin` where `username`='".$username."' and `password`='".md5($password)."'";
        $STH=$DBH->query($sql);
        if($STH->rowCount()>0)
        {
            $return=true;
        }
        return $return;
    }
    //22-02-2019
	
	public function getAllBlogFrontEnd($start,$records_per_page)
       {
       $return=array();
       $DBH = new DatabaseHandler();
       $sql="select * from `tbl_blog`where `status`='1' ORDER BY blog_id DESC  LIMIT ".$start." ,".$records_per_page."";
       $STH = $DBH->query($sql);
       if($STH->rowCount()>0)
       {
           while($row = $STH->fetch(PDO::FETCH_ASSOC))
           {
               $return[] = $row;
           }
       }
       return $return;
       }
    public function countAllBlogFrontEnd()
       {
       $return='';
       $DBH = new DatabaseHandler();
       $sql="select count(*) from `tbl_blog`where `status`='1' ";
       $STH = $DBH->query($sql);
       $return=$STH->fetchColumn();
       return $return;
       }
	   
	public function getAllRecentPropertysFrontEnd($limit)
        {
           $return=array();
           $DBH = new DatabaseHandler();
           $sql="select * from `tbl_property` where `status`=1 order by `id` DESC limit 0,".$limit."";
           $STH = $DBH->query($sql);
           if($STH->rowCount()>0)
           {
               while($row = $STH->fetch(PDO::FETCH_ASSOC))
               {
                   $return[] = $row;
               }
           }
           return $return;
        }
		
	public function getAllPropertysFrontEnd($tdata,$start,$records_per_page)
       {
		   
		$area ='';
        $category ='';
        $location ='';
        $bedroom ='';
        $bathroom ='';
        $price='';

        if($tdata['area']!='')
          {
	        $area = "And `area`='".$tdata['area']."'";
          }
 
        if($tdata['category']!='')
          {
	        $category = "And `category`='".$tdata['category']."'";
          }
 
        if($tdata['location']!='')
          {
          	$location = "And `location` LIKE '%".$tdata['location']."%'";
          }
 
        if($tdata['bedroom']!='')
          {
	        $bedroom = "And `bedroom`='".$tdata['bedroom']."'";
          }
 
        if($tdata['bathroom']!='')
          {
	        $bathroom = "And `bathroom`='".$tdata['bathroom']."'";
          }


          if($tdata['pricemax']!='' ||  $tdata['pricemin']!='')
          {

           if($tdata['pricemax']==''){
               
               $price = "And `price`>='".$tdata['pricemin']."'";

           } 

           elseif($tdata['pricemin']==''){
               
               $price = "And `price`<='".$tdata['pricemax']."'";

           } 
           else{

                 $price = "And `price`>='".$tdata['pricemin']. "' And `price`<='". $tdata['pricemax'] ."'";


           }
          
          }
			
       $return=array();
       $DBH = new DatabaseHandler();
       $sql="select * from `tbl_property` where `status`='1' ".$area." ".$category." ".$location." ".$bedroom." ".$bathroom." ".$price
       ." ORDER BY id DESC  LIMIT ".$start." ,".$records_per_page."";

       //var_dump($sql);

       $STH = $DBH->query($sql);
       if($STH->rowCount()>0)
       {
           while($row = $STH->fetch(PDO::FETCH_ASSOC))
           {
               $return[] = $row;
           }
       }
       return $return;
       }
    public function countAllPropertyFrontEnd($tdata)
       {
		   
	   $area ='';
        $category ='';
        $location ='';
        $bedroom ='';
        $bathroom ='';

        if(isset($tdata['area']))
          {
	        $area = "And `area`='".$tdata['area']."'";
          }
 
        if(isset($tdata['category']))
          {
	        $category = "And `category`='".$tdata['category']."'";
          }
 
        if(isset($tdata['location']))
          {
          	$location = "And `location` LIKE '%".$tdata['location']."%'";
          }
 
        if(isset($tdata['bedroom']))
          {
	        $bedroom = "And `bedroom`='".$tdata['bedroom']."'";
          }
 
        if(isset($tdata['bathroom']))
          {
	        $bathroom = "And `bathroom`='".$tdata['bathroom']."'";
          }
		  
       $return='';
       $DBH = new DatabaseHandler();
       $sql="select count(*) from `tbl_property` where `status`='1' ".$area." ".$category." ".$location." ".$bedroom." ".$bathroom."";
       $STH = $DBH->query($sql);
       $return=$STH->fetchColumn();
       return $return;
       }	
	   
	public function DeleteTestinomial($testinomial_id)
        {
        $return=false;
        $DBH = new DatabaseHandler();
        $sql="delete from `tbl_testinomial` where `testinomial_id`='".$testinomial_id."'";
        $STH = $DBH->query($sql);
        if($STH->rowCount() > 0) 
            {
            $return=true;
            } 
        return $return;
         
        }   
		
	public function getAllTestinomial($start,$records_per_page)
       {
       $return=array();
       $DBH = new DatabaseHandler();
       $sql="select * from `tbl_testinomial` where 1 ORDER BY testinomial_id DESC  LIMIT ".$start." ,".$records_per_page."";
       $STH = $DBH->query($sql);
       if($STH->rowCount()>0)
       {
           while($row = $STH->fetch(PDO::FETCH_ASSOC))
           {
               $return[] = $row;
           }
       }
       return $return;
       }
    public function countAllTestinomial()
       {
       $return='';
       $DBH = new DatabaseHandler();
       $sql="select count(*) from `tbl_testinomial` where 1 ";
       $STH = $DBH->query($sql);
       $return=$STH->fetchColumn();
       return $return;
       }	
	
	public function addTestinomial($tdata) 
        {
             
        $return=false;
        $DBH = new DatabaseHandler();
        $sql="insert into `tbl_testinomial` (`name`,`image`,`description`,`status`,`add_date`) value('".addslashes($tdata['name'])."','".$tdata['image']."','".addslashes($tdata['description'])."','".addslashes($tdata['status'])."','".$tdata['add_date']."')";
        $STH = $DBH->query($sql);
        if($STH->rowCount() > 0) 
            {
            $return=true;
            } 
        return $return;
        }
		
	public function editTestinomial($tdata)
        {
            $my_DBH = new DatabaseHandler();
            $DBH = $my_DBH->raw_handle();
            $DBH->beginTransaction();
            $return = TRUE;
            try
                {
            $sql = "update `tbl_testinomial` set `name`='".addslashes($tdata['name'])."',`image`='".addslashes($tdata['image'])."',`description`='".addslashes($tdata['description'])."',`status`='".$tdata['status']."' where `testinomial_id`='".$tdata['id']."'";
            $STH = $DBH->prepare($sql);
                $STH->execute();
                $row_affected = $STH->rowCount();
                if($row_affected == 1)
                    {
                    $return = TRUE;
                    }
                $DBH->commit();
                }
            catch(Exception $e)
                {
                echo $e->getMessage();
                $DBH->rollBack();
                }
            return $return;   
   
   
        }	
		
	public function getEditTestinomialDetailsById($testinomial_id)
        {
        $return='';
        $DBH = new DatabaseHandler();
        $sql= "SELECT * FROM `tbl_testinomial` WHERE `testinomial_id` ='".$testinomial_id."'";
        $STH = $DBH->query($sql);
         if($STH->rowCount() > 0) 
            {
            $row = $STH->fetch(PDO::FETCH_ASSOC);
            $return=$row;
            } 
        return $return;   
        }	
		
	public function getAllFeaturedPropertysFrontEnd($category,$limit)
        {
           $return=array();
           $DBH = new DatabaseHandler();
           $sql="select * from `tbl_property` where `status`=1 and `category`='".$category."' order by `id` DESC limit 0,".$limit."";
           $STH = $DBH->query($sql);
           if($STH->rowCount()>0)
           {
               while($row = $STH->fetch(PDO::FETCH_ASSOC))
               {
                   $return[] = $row;
               }
           }
           return $return;
        }	
		
	public function addAgent($tdata) 
        {
             
        $return=false;
        $DBH = new DatabaseHandler();
        $sql="insert into `tbl_agent` (`name`,`image`,`designation`,`facebook`,`twitter`,`linkdin`,`instagram`,`status`,`add_date`) value('".addslashes($tdata['name'])."','".$tdata['image']."','".addslashes($tdata['designation'])."','".addslashes($tdata['facebook'])."','".addslashes($tdata['twitter'])."','".addslashes($tdata['linkdin'])."','".addslashes($tdata['instagram'])."','".addslashes($tdata['status'])."','".$tdata['add_date']."')";
        $STH = $DBH->query($sql);
        if($STH->rowCount() > 0) 
            {
            $return=true;
            } 
        return $return;
        }
		
	public function editAgent($tdata)
        {
            $my_DBH = new DatabaseHandler();
            $DBH = $my_DBH->raw_handle();
            $DBH->beginTransaction();
            $return = TRUE;
            try
                {
            $sql = "update `tbl_agent` set `name`='".addslashes($tdata['name'])."',`image`='".addslashes($tdata['image'])."',`designation`='".addslashes($tdata['designation'])."',`facebook`='".addslashes($tdata['facebook'])."',`twitter`='".addslashes($tdata['twitter'])."',`linkdin`='".addslashes($tdata['linkdin'])."',`instagram`='".addslashes($tdata['instagram'])."',`status`='".$tdata['status']."' where `agent_id`='".$tdata['id']."'";
            $STH = $DBH->prepare($sql);
                $STH->execute();
                $row_affected = $STH->rowCount();
                if($row_affected == 1)
                    {
                    $return = TRUE;
                    }
                $DBH->commit();
                }
            catch(Exception $e)
                {
                echo $e->getMessage();
                $DBH->rollBack();
                }
            return $return;   
   
   
        }	
		
	
	public function getEditAgentDetailsById($agent_id)
        {
        $return='';
        $DBH = new DatabaseHandler();
        $sql= "SELECT * FROM `tbl_agent` WHERE `agent_id` ='".$agent_id."'";
        $STH = $DBH->query($sql);
         if($STH->rowCount() > 0) 
            {
            $row = $STH->fetch(PDO::FETCH_ASSOC);
            $return=$row;
            } 
        return $return;   
        }			
		
	public function getAllAgent($start,$records_per_page)
       {
       $return=array();
       $DBH = new DatabaseHandler();
       $sql="select * from `tbl_agent` where 1 ORDER BY agent_id DESC  LIMIT ".$start." ,".$records_per_page."";
       $STH = $DBH->query($sql);
       if($STH->rowCount()>0)
       {
           while($row = $STH->fetch(PDO::FETCH_ASSOC))
           {
               $return[] = $row;
           }
       }
       return $return;
       }
    public function countAllAgent()
       {
       $return='';
       $DBH = new DatabaseHandler();
       $sql="select count(*) from `tbl_agent` where 1 ";
       $STH = $DBH->query($sql);
       $return=$STH->fetchColumn();
       return $return;
       }	
	public function getAllTestinomialFrontEnd($limit)
        {
           $return=array();
           $DBH = new DatabaseHandler();
           $sql="select * from `tbl_testinomial` where `status`=1 order by `testinomial_id` DESC limit 0,".$limit."";
           $STH = $DBH->query($sql);
           if($STH->rowCount()>0)
           {
               while($row = $STH->fetch(PDO::FETCH_ASSOC))
               {
                   $return[] = $row;
               }
           }
           return $return;
        }
	
	public function getAllAgentFrontEnd($limit)
        {
           $return=array();
           $DBH = new DatabaseHandler();
           $sql="select * from `tbl_agent` where `status`=1 order by `agent_id` DESC limit 0,".$limit."";
           $STH = $DBH->query($sql);
           if($STH->rowCount()>0)
           {
               while($row = $STH->fetch(PDO::FETCH_ASSOC))
               {
                   $return[] = $row;
               }
           }
           return $return;
        }
	
    public function getAllBlogLimitFrontEnd($limit)
        {
           $return=array();
           $DBH = new DatabaseHandler();
           $sql="select * from `tbl_blog` where `status`=1 order by `blog_id` DESC limit 0,".$limit."";
           $STH = $DBH->query($sql);
           if($STH->rowCount()>0)
           {
               while($row = $STH->fetch(PDO::FETCH_ASSOC))
               {
                   $return[] = $row;
               }
           }
           return $return;
        }	
	public function getAllAreaFrontEnd()
        {
           $return=array();
           $DBH = new DatabaseHandler();
           $sql="select * from `tbl_property` where `area`!='' group by `area` order by `id` DESC ";
           $STH = $DBH->query($sql);
           if($STH->rowCount()>0)
           {
               while($row = $STH->fetch(PDO::FETCH_ASSOC))
               {
                   $return[] = $row;
               }
           }
           return $return;
        }		
	
    public function countAllPropertyByCategory($category)
       {
       $return='';
       $DBH = new DatabaseHandler();
       $sql="select count(*) from `tbl_property`where `status`='1' and `category`='".$category."' ";
       $STH = $DBH->query($sql);
       $return=$STH->fetchColumn();
       return $return;
       }	
	   
	// customer
    public function chkCustomer($contact_no,$password)
    {
        $return=false;
        $DBH=new DatabaseHandler();
        $sql="select * from `tbl_user` where `email`='".$contact_no."' and `is_admin`='0' and `password`='".md5($password)."'";
        $STH=$DBH->query($sql);
        if($STH->rowCount()>0)
        {
            $return=true;
        }
        return $return;
    }	
	
	function doCustomerLogIn($contact_no)
        {
        $return = false;
        $prop_id = $this->getCustomer_id($contact_no);
       
        $schooldetail= $this->getCustomerDetailBy_id($prop_id);
       
        $first_name = $schooldetail['first_name'];
        $email =$schooldetail['email'];
		//$username =$schooldetail['username'];
        $password = $schooldetail['password'];
        $super_admin = $schooldetail['is_admin'];
       
        if($prop_id > 0)
            {
            $return = true;	
            $_SESSION['cprop_id'] = $prop_id;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['cemail'] = $email; 
			//$_SESSION['cusername'] = $username; 
            $_SESSION['cpassword'] = $password; 
             $_SESSION['cis_super_admin'] = $super_admin;
            }	
            return $return;
        }
    public function getCustomer_id($email)
        {
        $return=false;
        $DBH = new DatabaseHandler();
        $sql = "SELECT * FROM `tbl_user` WHERE `email` = '".$email."' ";
        $STH = $DBH->query($sql);
        if($STH->rowCount() > 0) 
            {
                $row = $STH->fetch(PDO::FETCH_ASSOC);
            $return=$row['user_id'];
            } 
        return $return;
	}  
    public function getCustomerDetailBy_id($prop_id)
        {
        $return=false;
        $DBH = new DatabaseHandler();
        $sql = "SELECT * FROM `tbl_user` WHERE `user_id` = '".$prop_id."'";
        $STH = $DBH->query($sql);
        if($STH->rowCount() > 0) 
            {
         $row = $STH->fetch(PDO::FETCH_ASSOC);
            $return=$row;
            } 
        return $return;
	}
	
	public function chkMobileNumber($contact_no)
    {
        $return=false;
        $DBH=new DatabaseHandler();
        $sql="select * from `tbl_admin` where `contact_no`='".$contact_no."'";
        $STH=$DBH->query($sql);
        if($STH->rowCount()>0)
        {
            $return=true;
        }
        return $return;
    } 
	
	public function chkEmail($email)
    {
        $return=false;
        $DBH=new DatabaseHandler();
        $sql="select * from `tbl_admin` where `email`='".$email."'  ";
        $STH=$DBH->query($sql);
        if($STH->rowCount()>0)
        {
            $return=true;
        }
        return $return;
    } 	
	function validate_mobile($mobile)
       {
           return preg_match('/^[0-9]{10}+$/', $mobile);
       } 
	public function addCustomer($tdata) 
        {
             
        $return=false;
        $DBH = new DatabaseHandler();
        $sql="insert into `tbl_user` (`first_name`, `last_name`, `password`,`email`,`is_admin`) value( '" .$tdata['first_name']."', '".$tdata['last_name']."',   '".md5($tdata['password'])."','".$tdata['email']."','".$tdata['is_admin']."')";
        $STH = $DBH->query($sql);
        if($STH->rowCount() > 0) 
            {
            $return=true;
            } 
        return $return;
        } 
		
	public function chkWishlist($id)
    {
        $return=false;
        $DBH=new DatabaseHandler();
        $sql="select * from `tbl_wishlist` where `property_id`='".$id."' and `customer_id`='".$_SESSION['cprop_id']."'";
        $STH=$DBH->query($sql);
        if($STH->rowCount()>0)
        {
            $return=true;
        }
        return $return;
    }	
    
    public function addWishlist($tdata) 
        {
         $add_date = date('Y-m-d');    
        $return=false;
        $DBH = new DatabaseHandler();
        $sql="insert into `tbl_wishlist` (`property_id`,`price`,`customer_id`,`add_date`) value('".$tdata['id']."','".$tdata['price']."','".$_SESSION['cprop_id']."','".$add_date."')";
        $STH = $DBH->query($sql);
        if($STH->rowCount() > 0) 
            {
            $return=true;
            } 
        return $return;
        } 
	 public function countWishlist()
       {
       $return='';
       $DBH = new DatabaseHandler();
       $sql="select count(*) from `tbl_wishlist` where `customer_id`='".$_SESSION['cprop_id']."'";
       $STH = $DBH->query($sql);
       $return=$STH->fetchColumn();
       return $return;
       }  		
	public function getAllWishlistFrontEnd()
        {
           $return=array();
           $DBH = new DatabaseHandler();
           $sql="select * from `tbl_wishlist` where `customer_id`='".$_SESSION['cprop_id']."'";
           $STH = $DBH->query($sql);
           if($STH->rowCount()>0)
           {
               while($row = $STH->fetch(PDO::FETCH_ASSOC))
               {
                   $return[] = $row;
               }
           }
           return $return;
        }   
		
	public function DeleteWishlist($wishlist_id)
        {
        $return=false;
        $DBH = new DatabaseHandler();
        $sql="delete from `tbl_wishlist` where `wishlist_id`='".$wishlist_id."'";
        $STH = $DBH->query($sql);
        if($STH->rowCount() > 0) 
            {
            $return=true;
            } 
        return $return;
         
        }   
	public function addPropertyImage($image,$property_id) 
        {
             
        $return=false;
        $DBH = new DatabaseHandler();
        $sql="insert into `tbl_property_image` (`property_id`,`image`) value('".addslashes($property_id)."','".$image."')";
        $STH = $DBH->query($sql);
        if($STH->rowCount() > 0) 
            {
            $return=true;
            } 
        return $return;
        }		
	public function lastInsertIdFromPropertyTable($image)
        {
        $return=false;
        $DBH = new DatabaseHandler();
        $sql = "SELECT max(`id`) as id FROM `tbl_property` where `image`='".$image."'";
        $STH = $DBH->query($sql);
        if($STH->rowCount() > 0) 
            {
            $row = $STH->fetch(PDO::FETCH_ASSOC);
            $return=$row['id'];
            } 
        return $return;
	}	
	public function getAllPropertyImageByPropertyId($property_id)
        {
           $return=array();
           $DBH = new DatabaseHandler();
           $sql="select * from `tbl_property_image` where `property_id`='".$property_id."' ";
           $STH = $DBH->query($sql);
           if($STH->rowCount()>0)
           {
               while($row = $STH->fetch(PDO::FETCH_ASSOC))
               {
                   $return[] = $row;
               }
           }
           return $return;
        }   
	public function DeleteMoreImage($id)
        {
        $return=false;
        $DBH = new DatabaseHandler();
        $sql="delete from `tbl_property_image` where `image_id`='".$id."'";
        $STH = $DBH->query($sql);
        if($STH->rowCount() > 0) 
            {
            $return=true;
            } 
        return $return;
         
        }	
}