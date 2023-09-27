<?php
if($ReVerfiyStatus == false){
?>


       <!-- START: Resend verification code -->
 

        <div class="nk-gap-4"></div>
       
	    <div class="container">
		<div class="col-md-6">
			
              <!--Reset password form-->   
              <form class="nk-form nk-form-ajax nk-form-style-1" name="ResendVerify" id="ResendVerifyForm" onsubmit="ResendVerifyAction();return false;" method="POST">
			     
				 <div class="col-md-12">
				 <div  id="ResendVerify" ></div>
				 </div>
                        
                 <div class="col-md-12">
				 <span>Username <span style="color:red">*</span></span>
                     <input type="text" class="form-control required" 
						title="Username cannot be empty." placeholder="Your user name." name="username" />
                 <div class="nk-gap-2"></div>
				 </div>
				 
				 <div class="col-md-12">
				  <span>Email <span style="color:red">*</span></span>
                      <input type="text" class="form-control required" 
					  title="Your email field cannot be empty." placeholder="Your email." name="email" />
                  <div class="nk-gap"></div>
				 </div>
				 
                <div class="col-md-12">
				<button type="submit" class="nk-btn nk-btn-lg link-effect-4">
                                <span>SEND CODE</span>
                  </button>
                </div>
				
			</form>
			  
			</div>
			
	
    	
		
    <div class="col-md-6 hidden-sm-down hidden-md-down" >
				
				<h3>VERIFICATION CODE!</h3>
				<h6><em style="color:olive">Here you can re send the verification code to your email.</em>
				
				<div class="nk-gap"></div>				
				<h6>1. Make sure that.<h6>
				   <em style="color:olive">Your email and username are correct, because you have the ability to send 2 codes only per email.</em>
                <br>
				
				<h6>2. Still didn't get the code.<h6>
				   <em style="color:olive">If you didn't recieve your verification code. Please, contact with admins to help you.</em>
                <br>
				
	</div>
	
	</div>
    <div class="nk-gap-2"></div>
    <div class="nk-gap-4"></div>
     <!-- END: Forgot -->

   
<? } else {
	echo'<div class="nk-gap-6"></div>
	     <center><h1><b style="color:red" class="ion-information-circled"></b> Re-Send Verification code is disabled </h1><br>
		 <a href = "/" class="nk-btn nk-btn-lg link-effect-4">
                                <span>Home page</span>
         </a>
		 <center>
		 <div class="nk-gap-6"></div>';
   }
  ?>