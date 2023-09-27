<?php
if($ForgotStatus == false){
?>


       <!-- START: Forgot Page -->
 

        <div class="nk-gap-4"></div>
       
	    <div class="container">
		 <div class="nk-tabs">  
		 
		 <div class="col-md-3">
		        <ul  role="tablist">
				
                 <a href="#passwithemail" role="tab" data-toggle="tab" class="nk-btn nk-btn-lg link-effect-4">
                                <span>Reset - Passwords</span>
                 </a>
				 <div class="nk-gap"></div>
				  
				 <a href="#passwordwithaccount" role="tab" data-toggle="tab" class="nk-btn nk-btn-lg link-effect-4">
                                <span>Recover-Password</span>
                 </a>
				 <div class="nk-gap"></div>
				 
				 <a href="#recoveruser" role="tab" data-toggle="tab" class="nk-btn nk-btn-lg link-effect-4">
                                <span>Recover-Username</span>
                 </a>
				 <div class="nk-gap"></div>
				
				 <a href="#recoverscret" role="tab" data-toggle="tab" class="nk-btn nk-btn-lg link-effect-4">
                                <span>Reset Secret-word</span>
                 </a>
				 <div class="nk-gap"></div>
				 
				</ul>
		</div>
		<div class="col-md-6">
		 <div class="tab-content">
		
			<div role="tabpanel" class="tab-pane fade in active" id="passwithemail">
			
              <!--Reset password form-->   
              <form class="nk-form nk-form-ajax nk-form-style-1" name="ResetPass" id="ResetPass" onsubmit="ResetPassAction();return false;" method="POST">
			     
				 <div class="col-md-12">
				 <div  id="ResetPass" ></div>
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
                                <span>Reset</span>
                  </button>
                </div>
				
			</form>
			  
			</div>
			<div role="tabpanel" class="tab-pane fade" id="passwordwithaccount">
			  password with account
			</div>
			 
			<div role="tabpanel" class="tab-pane fade" id="recoveruser">
			    Recover user
			</div>
			
			<div role="tabpanel" class="tab-pane fade" id="recoverscret">
               Recover secret
			</div>
			</div>
		 </div>
		</div>
			
	
    	
		
    <div class="col-md-3 hidden-sm-down hidden-md-down" >
				
				<h3>FORGOT PAGE!</h3>
				<h6><em style="color:olive">Here you can restore your lost information.</em>
				
				<div class="nk-gap"></div>				
				<h6>1. Reset your web password.<h6>
				   <em style="color:olive">You can reset your web password.</em>
                <br>
				
				<h6>2. Secret Word.<h6>
				   <em style="color:olive">To change your email or passwords with it.</em>
                <br>
				
				<h6>3. Question & answer.<h6>
				   <em style="color:olive">To restore you account with it.</em>
                <br>
				
				<h6>4. Recovery Account.<h6>
				   <em style="color:olive">To restore you account with other account.</em>
                <br>
				
	</div>
	
	</div>
    <div class="nk-gap-2"></div>
    <div class="nk-gap-4"></div>
     <!-- END: Forgot -->

   
<? } else {
	echo'<div class="nk-gap-6"></div>
	     <center><h1><b style="color:red" class="ion-information-circled"></b> Forgot page is disabled </h1><br>
		 <a href = "/" class="nk-btn nk-btn-lg link-effect-4">
                                <span>Home page</span>
         </a>
		 <center>
		 <div class="nk-gap-6"></div>';
   }
  ?>