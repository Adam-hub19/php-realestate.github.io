<?php 
session_start();
include_once('admin/classess/config.php');
include_once('admin/classess/function.php');
$admin= new ADMIN(); 
$error = false;
$err_msg = '';
$page_id = 1;

$option ='';

$recentproperty = $admin->getAllRecentPropertysFrontEnd(20);
$recentpropertyfooter = $admin->getAllRecentPropertysFrontEnd(3);

if(isset($_REQUEST['action']) && $_REQUEST['action'] =='bloglist')
    {
//   
    $adjacents = 2;
    $records_per_page =16;
    $page = (int) (isset($_POST['page_id']) ? $_POST['page_id'] : 1);
    $page = ($page == 0 ? 1 : $page);
    $start = ($page-1) * $records_per_page;
    
    $blog = $admin->getAllBlogFrontEnd($start,$records_per_page);
  
    $count=$admin->countAllBlogFrontEnd();
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
$option.='<div class="row">';
                    if(is_array($blog) && count($blog) > 0)
                            {
                       
                                foreach($blog as $record)
                                    {  
                                       
                                        $option.='<div class="col-lg-6 col-md-6 col-sm-6">
                                                     <div class="blog-1">
                                                        <img src="admin/images/'.$record['image'].'" style="height:350px" alt="blog" class="img-fluid">
                                                           <div class="detail">
                                                                <div class="date-box">
                                                                    <h5>'.date('d', strtotime($record['add_date'])).'</h5>
                                                                    <h5>'.date('M',strtotime($record['add_date'])).'</h5>
                                                                 </div>
                                                                    <h3>
                                                                        <a href="blog-detail.php?id='.base64_encode($record['blog_id']).'">'.substr($record['title'], 0, 30).'</a>
                                                                    </h3>
                                                                 <div class="post-meta">
                                                                    <span><a href="#"><i class="fa fa-user"></i>'.$record['author_name'].'</a></span>
                                                                    <span><a href="#"><i class="fa fa-commenting-o"></i>'.$record['comment'].' Comment</a></span>
                                                                 </div>
                                                                  <p>'.substr($record['description'], 0, 50).'</p>
                                                           </div>
                                                      </div>
                                                    </div>';
                                        $i++;
                                     }
                                     }
                        else
                            {
                            $option.='<div class="col-lg-6 col-md-6 col-sm-6"></div>';
                            }
                         $option.='</div>';
                            $option.=$pagination;        
                         echo $option;
                         exit(0);
    }  


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
            <h1>Blog</h1>
            <ul class="breadcrumbs">
                <li><a href="index.php">Home</a></li>
					<li class="active">Blog</li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub banner end -->

<!-- Blog section start -->
<div class="blog-section content-area-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
			<div id="bloglist"></div>
                
				
				<!--<div class="row">									
                    <div class="col-lg-12">
                        <div class="pagination-box hidden-mb-45 text-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#"><span aria-hidden="true">«</span></a></li>
                                    <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><span aria-hidden="true">»</span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>-->
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="sidebar mbl">
                   
                    <!-- Categories start -->
                    <div class="widget categories">
                        <h5 class="sidebar-title">Categories</h5>
                        <ul>
                            <li><a href="property.php?category=1">Features<span>(<?php echo $admin->countAllPropertyByCategory(1);?>)</span></a></li>
                            <li><a href="property.php?category=2">Apartments<span>(<?php echo $admin->countAllPropertyByCategory(2);?>)</span></a></li>
                            <li><a href="property.php?category=3">Houses<span>(<?php echo $admin->countAllPropertyByCategory(3);?>)</span></a></li>
                            <li><a href="property.php?category=4">Family Houses<span>(<?php echo $admin->countAllPropertyByCategory(4);?>)</span></a></li>
                            <li><a href="property.php?category=5">Offices<span>(<?php echo $admin->countAllPropertyByCategory(5);?>)</span></a></li>
                            <li><a href="property.php?category=6">Villas<span>(<?php echo $admin->countAllPropertyByCategory(6);?>)</span></a></li>
                            <li><a href="property.php?category=7">Other<span>(<?php echo $admin->countAllPropertyByCategory(7);?>)</span></a></li>
                        </ul>
                    </div>

                    <!-- Recent posts start -->
                    <div class="widget recent-posts">
                        <h5 class="sidebar-title">Recent Properties</h5>
						<?php foreach($recentproperty as $rec) {?>
                        <div class="media mb-4">
                            <a href="property-detail.php?id=<?php echo base64_encode($rec['id'])?>">
                                <img src="admin/images/<?php echo $rec['image'];?>" alt="sub-property">
                            </a>
                            <div class="media-body align-self-center">
                                <h5>
                                    <a href="property-detail.php?id=<?php echo base64_encode(rec)?>"><?php echo $rec['name'];?></a>
                                </h5>
                                <p><?php echo date('d M',strtotime($rec['name']));?></p>
                                <p> <strong>£ <?php echo $rec['price'];?></strong></p>
                            </div>
                        </div>
						<?php }?>
                        
                    </div>

                    <!-- Tags start -->
					
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog section end -->

<!-- Footer start -->
<?php require_once 'footer.php'; ?>
  <script>
$(document).ready(function()
    {
     var page_id='<?php echo isset($_GET['page_id']) && $_GET['page_id']!='' ? $_GET['page_id'] :''?>';
    
     $.ajax({  
        type: "POST",  
        url: 'blog.php',  
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
           url: 'blog.php', 
           data: dataString,
           cache: false,
           success: function(result)
                {
               $('#bloglist').html(result);
               }
      });
    }
</script>
</body>
</html>