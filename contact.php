<?php 
session_start();
include_once('admin/classess/config.php');
include_once('admin/classess/function.php');
$admin= new ADMIN(); 
$error = false;
$err_msg = '';
$page_id = 1;

$option ='';

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
<!--
<img class="d-block w-100" src="slider_image/slider1 - Copy.jpg" alt="banner">-->
<img class="" src="slider_image/slider1 - Copy.jpg" alt="banner" width="100%" height="auto" >    
<div class="container">
        <div class="breadcrumb-area">
            <h1>Contact Us</h1>
            <ul class="breadcrumbs">
                <li><a href="index.html">Home</a></li>
                <li class="active">Contact Us</li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub banner end -->

<!-- Contact 1 start -->
<div class="contact-1 content-area-7">
    <div class="container">
        <div class="main-title">
            <h1>Contact Us</h1>
          
        </div>

        <div class="row">
            <div class="col-lg-7 col-md-7 col-md-7">
        <div id="form-messages" class="form-group alert-success"> </div>

            </div>

        </div>

        <div class="row">
            <div class="col-lg-7 col-md-7 col-md-7">
                <form action="contactFormProcess.php" method="POST"   id="contact-form">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group name">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Name" required="required">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group email">
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="required">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group subject">
                                <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" required="required" value="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group number">
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="Number" required="required">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group message">
                                <textarea class="form-control" id="message" name="message" placeholder="Write message" required="required"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="send-btn">
                                <button type="submit" name = "submit" id="submit" class="btn btn-color btn-md btn-message">Send Message</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class=" offset-lg-1 col-lg-4 offset-md-0 col-md-5">
                <div class="contact-info">
                    <h3>Contact Info</h3>
                    <div class="media">
                        <i class="fa fa-map-marker"></i>
                        <div class="media-body">
                            <h5 class="mt-0">Office Address</h5>
                            <p>xxxxxxxx</p>
                        </div>
                    </div>
                    <div class="media">
                        <i class="fa fa-phone"></i>
                        <div class="media-body">
                            <h5 class="mt-0">Phone Number</h5>
                            <p>Office<a href="tel:0477-0477-8556-552">: XXXX XXXX XXX</a> </p>
                            <p>Mobile<a href="tel:+0477-85x6-552">: xxxxxxxxxxx</a> </p>
                        </div>
                    </div>
                    <div class="media mrg-btn-0">
                        <i class="fa fa-envelope"></i>
                        <div class="media-body">
                            <h5 class="mt-0">Email Address</h5>
                            <p><a href="#">info@adamsrealestate.com</a></p> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact 1 end -->




<!-- Google map start -->
<div class="section">
    <div class="map">
        <div id="contactMap" class="contact-map"></div>
    </div>
</div>
<!-- Google map end -->

<!-- Footer start -->
<?php require_once 'footer.php'; ?>


<script>
    
$(function () {

  

    // Get the form.
    var form = $('#contact-form');

    // Get the messages div.
    var formMessages = $('#form-messages');




    $(form).submit(function (event) {



            // Stop the browser from submitting the form.
                event.preventDefault();

            // Serialize the form data.
               var formData = $(form).serialize();
     
               //var url = "contactFormProcess.php";

            // POST values in the background the the script URL
            $.ajax({
                type: "POST",
                url: $(form).attr('action'),
                data: formData 
            })

            .done(function(response) {
                        // Make sure that the formMessages div has the 'success' class.
                        $(formMessages).removeClass('alert-danger');
                        $(formMessages).addClass('alert-success');

                        // Set the message text.
                        $(formMessages).text(response);

                        // Clear the form.
                        $('#name').val('');


                        $('#email').val('');
                        $('#message').val('');
                        $('#subject').val('');
                        $('#phone').val('');
                    })

            .fail(function(data) {
                        // Make sure that the formMessages div has the 'error' class.
                        $(formMessages).removeClass('alert-success');
                        $(formMessages).addClass('alert-danger');

                        // Set the message text.
                        if (data.responseText !== '') {
                            $(formMessages).text(data.responseText);
                        } else {
                            $(formMessages).text('Oops! An error occured and your message could not be sent.');
                        }
                    });

            
            
        
    })
});


</script>
</body>
</html>