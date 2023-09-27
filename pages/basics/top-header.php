<!--
    START: Top Contacts

    Additional Classes:
        .nk-contacts-top-light
-->
        <div class="nk-contacts-top">
            <div class="container">
                <div class="nk-contacts-left">
                    <div class="nk-navbar">
                        <ul class="nk-nav">
                            <li class="nk-drop-item">
                                <a href="#">Language</a>
                                <ul class="dropdown">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">Arabic</a></li>
                                    <li><a href="#">Turkish</a></li>
                                    <li><a href="#">France</a></li>
                                    <li><a href="#">Germany</a></li>
                                </ul>
                            </li>
							<?php if(!isset($_SESSION['LogIn'])) { ?>
							<li><a href="/register"><b class="fa fa-user"></b> Register</a></li>
							<li><a data-toggle="modal" data-target="#LoginModel" href="#"><b class="fa fa-lock"></b> Login</a></li>
							<?php } else { ?>
								<li class="nk-drop-item">
								<a href="#"><b class="fa fa-user"></b> <?= $_SESSION['username']; ?></a>
								
								<ul class="dropdown">
                                          <li class="nk-drop-item">
										     <a href="#">Balance</a>
									 	     <ul class="dropdown">
                                               <li><a href="#">Silk [ <?= number_format($sql->silk($_SESSION['username'],"1")); ?> ]</a></li>
											   <li><a href="#">Silk Gift [ <?= number_format($sql->silk($_SESSION['username'],"2")); ?> ]</a></li>
											   <li><a href="#">Silk Point [ <?= number_format($sql->silk($_SESSION['username'],"3")); ?> ]</a></li>
											   <li><a href="#">WebPoints [ <?= number_format($sql->UserPoints($_SESSION['username'],"Web")); ?> ]</a></li>
                                             </ul>
									      </li>
										  
										  <li class="nk-drop-item">
										  <a href="#">Panels</a>
										   <ul class="dropdown">
                                               <li><a href="/account/panel">Account Panel</a></li>
											   <li><a href="/chars/manage">Character Panel</a></li>
                                             </ul>
										  </li>
										  
                                    <li><a href="/account/tickets">Tickets</a></li>
                                    <li><a href="/donate">Donate</a></li>
                                    <li><a href="/logout">Logout</a></li>
                                </ul>
								
								</li>
								<?php if($sql->CheckFirstLogin($_SESSION['username']) == true) { ?>
								<li style="color:red"><a href="/account/setpassword"><b class="ion-alert-circled"></b> Please click here to set your game password.</a></li>
								
								<?php 
										}
                 					}	
								?>
							
                        </ul>
                    </div>
                </div>
                <div class="nk-contacts-right">
                    <div class="nk-navbar">
                        <ul class="nk-nav">
                            <li>
                                <a href="<?= $facebook ?>" target="_blank">
                                    <span class="ion-social-facebook"></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= $twitter ?>" target="_blank">
                                    <span class="ion-social-twitter"></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= $youtube ?>">
                                    <span class="ion-social-youtube"></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= $skype ?>">
                                    <span class="ion-social-skype"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Top Contacts -->
		