  <?php 
  session_start();
include_once('classess/config.php');
include_once('classess/function.php');

$option="";
$admin_obj = new Admin();
$error = false;



if(!$admin_obj->isadminLoggedIn())
{
    header("Location:login.php");
    exit(0);
}
if(isset($_REQUEST['action']) && $_REQUEST['action'] =='deleteblog')
    {
        
    $response=array();
    $id=$_REQUEST['id']!='' ? $_REQUEST['id'] : '';
    if($admin_obj->DeleteBlog($id))
        {
        $response['error']=0;
        }
    echo json_encode(array($response));
    exit(0);    
    }
	
if(isset($_REQUEST['action']) && $_REQUEST['action'] =='bloglist')
    {
//   
    $adjacents = 2;
    $records_per_page =8;
    $page = (int) (isset($_POST['page_id']) ? $_POST['page_id'] : 1);
    $page = ($page == 0 ? 1 : $page);
    $start = ($page-1) * $records_per_page;
    
    $location = $admin_obj->getAllBlog($start,$records_per_page);
  
    $count=$admin_obj->countAllBlog();
    //
    $next = $page + 1;    
    $prev = $page - 1;
    $last_page = ceil($count/$records_per_page);
    $second_last = $last_page - 1;
    $i = (($page * $records_per_page) - ($records_per_page - 1));
    $pagination = "";
	if($last_page > 1)
            {
        $pagination .= "<div class='pagination'>";
        if($page > 1)
            $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($prev).");'>&laquo; Previous&nbsp;&nbsp;</a>";
        else
            $pagination.= "<spn class='disabled'>&laquo; Previous&nbsp;&nbsp;</spn>";   
	if($last_page < 7 + ($adjacents * 2))
            {   
            for ($counter = 1; $counter <= $last_page; $counter++)
                {
                if ($counter == $page)
                    $pagination.= "<spn class='current'>$counter</spn>";
                else
                    $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($counter).");'>$counter</a>";     
                }
            }
        elseif($last_page > 5 + ($adjacents * 2))
            {
            if($page < 1 + ($adjacents * 2))
                {
                for($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                    {
                    if($counter == $page)
                        $pagination.= "<spn class='current'>$counter</spn>";
                    else
                        $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($counter).");'>$counter</a>";     
                    }
                $pagination.= "...";
                $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($second_last).");'> $second_last</a>";
                $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($last_page).");'>$last_page</a>";   
           
                }
           elseif($last_page - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                {
               $pagination.= "<a href='javascript:void(0);' onClick='change_page(1);'>1</a>";
               $pagination.= "<a href='javascript:void(0);' onClick='change_page(2);'>2</a>";
               $pagination.= "...";
               for($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                    {
                   if($counter == $page)
                       $pagination.= "<spn class='current'>$counter</spn>";
                   else
                       $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($counter).");'>$counter</a>";     
                    }
               $pagination.= "..";
               $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($second_last).");'>$second_last</a>";
               $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($last_page).");'>$last_page</a>";   
                }
           else
                {
               $pagination.= "<a href='javascript:void(0);' onClick='change_page(1);'>1</a>";
               $pagination.= "<a href='javascript:void(0);' onClick='change_page(2);'>2</a>";
               $pagination.= "..";
               for($counter = $last_page - (2 + ($adjacents * 2)); $counter <= $last_page; $counter++)
               {
                   if($counter == $page)
                        $pagination.= "<spn class='current'>$counter</spn>";
                   else
                        $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($counter).");'>$counter</a>";     
               }
           }
        }
        if($page < $counter - 1)
            $pagination.= "<a href='javascript:void(0);' onClick='change_page(".($next).");'>Next &raquo;</a>";
        else
            $pagination.= "<spn class='disabled'>Next &raquo;</spn>";
	    $pagination.= "</div>";       
        }
    
      //End pagination

        $option.= '<div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sr.no</th>
                                            <th>Title</th>
                                            <th>Image</th>
											<th>Description</th>
											<th>Comment</th>
											<th>Author Name</th>
											<th>Status</th>
                                            <th>Add Date</th>
                                            <th colspan="2">Action</th>
                                          </tr>
                                    </thead>
                                    <tbody>';
                                if(is_array($location) && count($location) > 0)
                            {
                       
                                     foreach($location as $record)
                                     {  
                                        $status = ($record['status'] != 0 ? 'Active' : 'Inactive');
                                        $option.='<tr>
                                        <td>'.$i.'</td>
                                        <td>'.$record['title'].'</td>
										<td><img src="images/'.$record['image'].'" height="50" width="50"></td>
                                        <td>'.$record['description'].'</td>
										<td>'.$record['comment'].'</td>
										<td>'.$record['author_name'].'</td>
										<td>'.$status.'</td>
                                        <td>'.$record['add_date'].'</td>
                                        <td><a href="edit-blog.php?id='.$record['blog_id'].'&page='.$page.'"><i class="fa fa-pencil"></i></a></td>
                                        <td><a href="" onclick="deleteblog('.$record['blog_id'].','.$page.');return false;"><i class="fa fa-trash"></i></a></td>
                                        
                                        </tr>';
                                        $i++;
                                     }
                                     }
                        else
                            {
                            $option.='<tr><td colspan="8" style="color:red;text-align:center">No record</d></tr>';
                            }
                         $option.='</tbody>
                                </table>
                            </div>';   
                            $option.=$pagination;        
                         echo $option;
                         exit(0);
    }  
 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="shortcut icon" type="image/icon" href="../assets/images/favicon.ico"/>
      
        <?php require_once 'head.php'; ?>
        <!-- dataTables -->
        <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
        <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/pagination.css" rel="stylesheet" type="text/css">
        
    </head>
    <style>    
div.pagination 
    {
     padding: 3px;
     margin: 3px;
     text-align:center;
     font-family:tahoma;
     font-size:12px;
     
    }
 
 div.pagination a 
 {
 padding: 2px 5px 2px 5px;
 margin: 2px;
 border: 1px solid #007799;
 text-decoration: none;
 color: #006699;
 clear: left;
 }
 div.pagination a:hover, div.digg a:active {
 border: 1px solid #006699;
 color: #000;
 }
 div.pagination spn.current {
 padding: 2px 5px 2px 5px;
 margin: 2px;
 border: 1px solid #006699;
 font-weight: bold;
 background-color: #006699;
 color: #FFF;
 }
 div.pagination spn.disabled {
 padding: 2px 5px 2px 5px;
 margin: 2px;
 border: 1px solid #EEE;
 color: #DDD;
 }
 </style> 
    <body hoe-navigation-type="vertical" hoe-nav-placement="left" theme-layout="wide-layout">

        <!--side navigation start-->
        <div id="hoeapp-wrapper" class="hoe-hide-lpanel" hoe-device-type="desktop">
           <?php require_once 'header.php'; ?>
            <div id="hoeapp-container" hoe-color-type="lpanel-bg7" hoe-lpanel-effect="shrink">
                <?php require_once 'side-menu.php'; ?>
                <!--start main content-->
                <section id="main-content">
                    <div class="space-30"></div>
                   <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row mail-header">
                                            <div class="col-md-6">
                                                <h3>BLOG DETAILS</h3>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="pull-right tooltip-show">
                                                   
                                                    <a href="add-blog.php" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title=""><i class="fa fa-plus"></i></a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                       
                                    </div>
                                </div>
                            </div><!--col end-->
                             <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="se-pre-con"></div>
                                     <div id="bloglist"></div>
                                    </div>
                                </div>
                              </div>
							<!--col end-->
                        </div>
                    </div>
                  

                    <?php require_once 'footer.php'; ?>
                </section><!--end main content-->
            </div>
        </div><!--end wrapper-->
        <!--Common plugins-->
        <?php require_once 'script.php'; ?>
         <script src="assets/js/bootstrap-dialog.js"></script>
         <script src="js/bootbox.min.js"></script>
       <script>
$(document).ready(function()
    {
     var page_id='<?php echo isset($_GET['page_id']) && $_GET['page_id']!='' ? $_GET['page_id'] :''?>';
    
     $.ajax({  
        type: "POST",  
        url: 'manage-blog.php',  
        data: 'page_id='+page_id+'&action=bloglist',  
        success: function(result)
            { 
//             alert(result);  
            $('#bloglist').html(result);
            }
       });
       
    });
    
function change_page(page_id)
    {
//    var name=$('#name').val();
    var dataString ='page_id='+page_id+'&action=bloglist';
    $.ajax({
           type: "POST",
           url: 'manage-blog.php', 
           data: dataString,
           cache: false,
           success: function(result)
                {
               $('#bloglist').html(result);
               }
      });
    }
//function searchmarathigre()
//    {
//    var name=$('#name').val();
//    var dataString ='name='+name +'&action=packagelist';
//    $.ajax({
//           type: "POST",
//            url: 'manage-package.php', 
//           data: dataString,
//           cache: false,
//           success: function(result)
//                {
//                //alert(result);    
//               $('#packagelist').html(result);
//               }
//      });      
//} 
function deleteblog(id,page_id)
    {
     bootbox.confirm("Are you sure?", function(result)
        {
        if(result==true)
            {
            $.ajax({  
            type: "POST",  
             url: 'manage-blog.php',
            data:'id='+id+'&action=deleteblog',  
            success: function(resp)
                {
                var JSONObject = JSON.parse(resp);
                var rslt=JSONObject[0]['status'];
                if($.trim(rslt)==1)
                    {
                         change_page(page_id);
                    }
                else
                   {
                        change_page(page_id);
                   }    
                }
               });   
            }    
      
        });    
    }
    
   


    
 </script> 
        <!-- Datatables-->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script>
            $(document).ready(function() {
               // alert('hii');
        $('#datatable').dataTable();
        });
        </script>
    </body>
</html>