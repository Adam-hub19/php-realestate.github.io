

<header class="main-header sticky-header" id="main-header-2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light rounded">
                    <a class="navbar-brand logo navbar-brand d-flex w-50 mr-auto" href="index.php">
                       <!-- <img src="assets/img/logos/black-logo.png" alt="logo">-->
					   <h4 style="color:white;">Tyona</h4>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fa fa-bars"></span>
                    </button>
                    <div class="navbar-collapse collapse w-100" id="navbar">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="index.php" >
                                    Home
                                </a>
                                
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="property.php" >
                                    Properties
                                </a>
                                
                            </li>
							<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="about.php" >
                                    About Us
                                </a>
                                
                            </li>
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="blog.php"  >
                                    Blog
                                </a>
                               </li>
                            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="contact.php" >
                                    Contact Us
                                </a>
                                
                            </li>
                            <!--<li class="nav-item dropdown">
                                <a href="#full-page-search" class="nav-link">
                                    <i class="fa fa-search"></i>
                                </a>
                            </li>-->
                            <li class="nav-item dropdown">
							<?php if(isset($_SESSION['cprop_id'])) {?>
							    <a class="nav-link dropdown-toggle" href="wishlist.php" >
                                   <span href="wishlist.php" class="fa fa-heart"><span id="wishlist_header_count"><?php echo $admin->countWishlist();?></span></span>
								 </a>	
									<?php } else {?>
								<a class="nav-link dropdown-toggle" href="login.php" >	
									<span href="login.php" class="fa fa-heart"></span>
								 </a>		
									<?php } ?>
                                 
                                
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
