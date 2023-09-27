
    <!--
        START: Navbar

        Additional Classes:
            .nk-navbar-sticky
            .nk-navbar-transparent
            .nk-navbar-autohide
            .nk-navbar-light
    -->
        <nav class="nk-navbar nk-navbar-top nk-navbar-sticky nk-navbar-transparent nk-navbar-autohide">
            <div class="container">
                <div class="nk-nav-table">

                    <a href="/" style="text-decoration: none;" class="nk-nav-logo">
                        <span style="font-size:25px;"><?= $ServerName ?></span>
                    </a>


                    <ul class="nk-nav nk-nav-right hidden-md-down" data-nav-mobile="#nk-nav-mobile">
                        <li class="active  ">
                            <a href="/">
                Home</a>
                        </li>
                        <li class="  ">
                            <a href="/ranking">
                Ranking</a>
				        </li>
                        <li class=" nk-mega-item nk-drop-item">
                            <a href="#">
                Server Info</a>
                            <div class="dropdown">
                                <div class="bg-image"></div>
                                <ul>


                                    <li>
                                      <ul>
								<li class="col-md-4">
									<a href="/statics">
										<img src="assets/images/avatar-1-sm.jpg" alt="">
										<div class="caption">
											<span  style="color:yellow">Statics</span>
											<h4>Server Statics</h4>
											<p>Our server real statics.</p>
										</div>
									</a>
								</li>

								<li class="col-md-4">
									<a href="#">
										<img src="assets/images/avatar-2-sm.jpg" alt="">
										<div class="caption">
											<span style="color:#9c2503">Rules</span>
											<h4>Our Game Rules</h4>
											<p>Please, read it carefully.</p>
										</div>
									</a>
								</li>
								<li class="col-md-4">
									<a href="#">
										<img src="assets/images/avatar-3-sm.jpg" alt="">
										<div class="caption">
											<span  style="color:olive">Guides</span>
											<h4>Our Game Guides</h4>
											<p>We'll get you started.</p>
										</div>
									</a>
								</li>
                                
								</ul>
                                    

                                    </li>


                                </ul>
                            </div>
                        </li>
						
				<? if(isset($_SESSION['LogIn'])){?>
                        <li class="  nk-drop-item">
                            <a href="store.html">
                Shop</a>
                            <ul class="dropdown">
                                <li class="  ">
                                    <a href="/stall">
                Online Stall</a>
                                </li>
                                <li class="  ">
                                    <a href="/shop">
                Online Store</a>
                                </li>
								<li class="  ">
                                    <a href="/donate">
                Purchase </a>
                                </li>
                            </ul>
                        </li>
				<? } ?>
                        <li class="  ">
                            <a href="/forum">
                Forum</a>
                        </li>
                    </ul>

                    <ul class="nk-nav nk-nav-right nk-nav-icons">

                        <li class="single-icon hidden-lg-up">
                            <a href="#" class="no-link-effect" data-nav-toggle="#nk-nav-mobile">
                                <span class="nk-icon-burger">
                                    <span class="nk-t-1"></span>
                                    <span class="nk-t-2"></span>
                                    <span class="nk-t-3"></span>
                                </span>
                            </a>
                        </li>



                        <li class="single-icon">
                            <a href="#" class="nk-search-toggle no-link-effect">
                                <span class="nk-icon-search"></span>
                            </a>
                        </li>
						 

                        <?php if(isset($_SESSION['LogIn'])){?>
                        <li class="single-icon">
                            <a href="#" class="nk-cart-toggle no-link-effect" onclick="NewNotitification();">
                                <span class="nk-icon-toggle">
									<span class="nk-icon-toggle-front" >
                                        <span class="ion-chatbubble"></span>
                                        <div id="Notification"></div>
                                    </span>
                                    <span class="nk-icon-toggle-back" onmouseover="ReadNotitification();">
                                        <span class="nk-icon-close"></span>
                                    </span>
                                </span>
                            </a>
                        </li>
						
						
						<li class="single-icon">
                            <a href="#" class="no-link-effect" data-nav-toggle="#nk-side">
                                <span class="nk-icon-burger">
                                    <span class="nk-t-1"></span>
                                    <span class="nk-t-2"></span>
                                    <span class="nk-t-3"></span>
                                </span>
                            </a>
                        </li>
						
						<?php } ?>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- END: Navbar -->

    </header>

	<!--
    START: Navbar Mobile

    Additional Classes:
        .nk-navbar-left-side
        .nk-navbar-right-side
        .nk-navbar-lg
        .nk-navbar-overlay-content
        .nk-navbar-light
      -->
    <div id="nk-nav-mobile" class="nk-navbar nk-navbar-side nk-navbar-left-side nk-navbar-overlay-content hidden-lg-up">
        <div class="nano">
            <div class="nano-content">
                <a href="/" class="nk-nav-logo">
                    <span style="text-decoration:none;font-size:25px"><?= $ServerName; ?></span>
                </a>
                <div class="nk-navbar-mobile-content">
                    <ul class="nk-nav">
                        <!-- Here will be inserted menu from [data-mobile-menu="#nk-nav-mobile"] -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Navbar Mobile -->
	
	<!-- START: Admin Navbar -->
	
	<? include("/pages/basics/admin-nav.php")?>
	
	<!-- END: Admin Navbar -->