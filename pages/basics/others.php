<!--
    START: Share Buttons
        .nk-share-buttons-left
-->
	<!--
    <div class="nk-share-buttons nk-share-buttons-left">
        <ul>
            <li>
                <span class="nk-share-icon" data-share="facebook">
                    <span class="icon fa fa-facebook"></span>
                </span>
                <span class="nk-share-name">Facebook</span>
            </li>
            <li>
                <span class="nk-share-icon" data-share="twitter">
                    <span class="icon fa fa-twitter"></span>
                </span>
                <span class="nk-share-name">Twitter</span>
            </li>
            <li>
                <span class="nk-share-icon" data-share="google-plus">
                    <span class="icon fa fa-google-plus"></span>
                </span>
                <span class="nk-share-name">Google Plus</span>
            </li>
            
        <li>
            <span class="nk-share-icon" data-share="pinterest">
                <span class="icon fa fa-pinterest"></span>
            </span>
            <span class="nk-share-name">Pinterest</span>
        </li>
        <li>
            <span class="nk-share-icon"  data-share="linkedin">
                <span class="icon fa fa-linkedin"></span>
            </span>
            <span class="nk-share-name">LinkedIn</span>
        </li>
        <li>
            <span class="nk-share-icon" data-share="vk">
                <span class="icon fa fa-vk"></span>
            </span>
            <span class="nk-share-name">Vkontakte</span>
        </li>
        
        </ul>
    </div>
	-->

    <!--
    START: Side Buttons
        .nk-side-buttons-visible
    -->
    <div class="nk-side-buttons nk-side-buttons-visible">
        <ul>
            <li>
                <a href="/contact" class="nk-btn nk-btn-lg link-effect-4">Contact Us!!</a>
            </li>
            <!--<li>
                <span class="nk-btn nk-btn-lg nk-btn-icon nk-bg-audio-toggle">
                    <span class="icon">
                        <span class="ion-android-volume-up nk-bg-audio-pause-icon"></span>
                        <span class="ion-android-volume-off nk-bg-audio-play-icon"></span>
                    </span>
                </span>
            </li>-->
            <li class="nk-scroll-top">
                <span class="nk-btn nk-btn-lg nk-btn-icon">
                    <span class="icon ion-ios-arrow-up"></span>
                </span>
            </li>
        </ul>
    </div>
    <!-- END: Side Buttons -->

    <!--
    START: Search

    Additional Classes:
        .nk-search-light
-->
    <div class="nk-search">
        <div class="container">
		  <div class="nk-gap-2"></div>
            <form id="SearchForm" onsubmit="SearchAction();return false;" method="POST">
			
			        <div class="col-md-4">
				    <select class="form-control" name="type">
					<option value="char" name="char">Character</option>
					<option value="guild" name="guild">Guild</option>
					</select>
					</div>
					<div class="hidden-lg-up hidden-md-up">
		            <div class="nk-gap-2"></div>
	                </div>
					<div class="col-md-8">
                    <input type="text" class="form-control" onkeyup="SearchAction();" name="search" id="search" placeholder="Search..." >
					<input type="submit" style="display:none" /></div>
					
				<div class="nk-gap-5"></div>
				
				<div class="col-md-12">
				<div id="searchbox">
				<h4><b class="fa fa-search"></b> Your search results will be listed here.<h4>
				</div>
				</div>
            </form>
        </div>
    </div>
    <!-- END: Search -->
	
    <!--
    START: Notifications
    -->
    <?php 
		if (isset($_SESSION['LogIn'])){
			include("/pages/notifications/notifications.php");
		}
	?>
    <!-- END: Shopping Cart -->


	<? if (!isset($_SESSION['LogIn'])){ ?>
	<!-- START: Login Modal -->
    <div id="LoginModel" class="modal nk-modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="ion-android-close"></span>
                    </button>
                    <h4 class="modal-title nk-title" id="myModalLabel">Login</h4>
                </div>
                <div class="modal-body">
				
				    <form class="nk-form nk-form-style-1" onsubmit="LoginAction();return false;" id="loginForm" method="POST">
					
					<div id="loginNotification" ></div>
					
					<span>Username <span style="color:red">*</span></span>
					<div class="input-append input-group">
					<input type="text" class="form-control required" id="user" placeholder="here, please."/>
					<span tabindex="100" class="add-on input-group-addon"><i class="fa fa-user"></i></span>
					</div>
					
					<div class="nk-gap-2"></div>
					
					<span>Password <span style="color:red">*</span></span>
					<input type="password" data-toggle="password" class="form-control required" id="pass" placeholder="***********"/><br>
					
					
					<div id="captchaShow">
					</div>
					
					<span>You don't have an account? Please register <a href="/register">here</a>!</span><br>
					<span>If you forgot your username or password, click <a href="/account/forgot">here</a> to reset it.</span>
					</div>
					
                    <div class="modal-footer">
                    <button type="button" class="nk-btn" data-dismiss="modal">Close</button>
                    <button type="submit" id="login" class="nk-btn nk-btn-color-main-1">Login</button>
                    </div>

                    </form>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- END: Modal -->
	<? } ?> 