<?php
if($sql->CheckFirstLogin($_SESSION['username']) == false) {$func->userRedirect("/",false);}
if($FirstLoginStatus == false){
?>



    <div class="nk-gap-3"></div>
	 <div class="container">
	 <div class="row vertical-gap">
		<div class="nk-box-2 bg-dark-1">
         <div class="col-md-6">
			<div class="nk-gap"></div>
			<h3 style="margin-left: 12px;">SET YOUR INFORMATION</h3>
            <form name="SetPassFirstForm" id="SetPassFirstForm" onsubmit="SetPassFirstAction();return false;" method="POST">
			     
				 <div class="col-md-12">
				 <div  id="SetPassFirstAction" ></div>
				 </div>
                  
                 <!--Website password-->         
                 <div class="col-xs-6">
				 <span>Game Password <span style="color:red">*</span></span>
                     <input type="password" class="form-control required" placeholder="*********" name="password" />
                 <div class="nk-gap"></div>
				 </div>
				 <div class="col-xs-6">
				  <span>Repeat Game Password <span style="color:red">*</span></span>
                      <input type="password" class="form-control required" placeholder="*********" name="password2" />
                  <div class="nk-gap"></div>
				 </div>
				 
				  <!--Secret word-->         
                 <div class="col-xs-6">
				 <span>Secret Word <span style="color:red">*</span></span>
                     <input type="password" class="form-control required" placeholder="*********" name="secret" />
                 <div class="nk-gap"></div>
				 </div>
				 <div class="col-xs-6">
				  <span>Repeat Secret Word <span style="color:red">*</span></span>
                      <input type="password" class="form-control required" placeholder="*********" name="secret2" />
                  <div class="nk-gap"></div>
				 </div>

                 <!--Question and answer system--> 
				
				<?php 
				 // If question and answer enabled
                 If ($MoreSecSystem == false)
	             {
			    ?>
                 <div class="col-xs-6">
				 <span>Question <span style="color:red">*</span></span>
                      <select class="form-control required"  name="question">
					  <option value=""><selected>Select the question, please.</selected></option>
			          <?php
			          foreach($RegisterQuestions as $questions) {
                                echo '<option >'.$questions.'</option>';
						}
			           ?>
		              </select>
					  <div class="nk-gap"></div>
                 </div>
				 
				 <div class="col-xs-6">
				 <span>Answer <span style="color:red">*</span></span>
                      <input type="text" class="form-control required" placeholder="example : Apple" name="answer"  />
					  <div class="nk-gap"></div>
                 </div>
				 
				 <!---->
				 
				 <div class="col-xs-6">
				 <span>Recovery Account <span style="color:red">*</span></span>
                      <input type="text" class="form-control required" placeholder="Recovery Account" name="revacc"  />
					  <div class="nk-gap"></div>
                 </div>
				 <?php } ?>
                   
                
                <div class="col-md-12">
				<button type="submit" class="nk-btn nk-btn-lg nk-btn-block link-effect-4">
                                <span>Submit</span>
				</button>
                </div>
			</form>
		</div>		

		
       <div class="col-md-6 hidden-sm-down">
	            <div class="nk-gap"></div>	
				<h3>YOUR SECURITY!</h3>
				<h6><em style="color:olive">Please, know that your security is our first target.</em>
				
				<div class="nk-gap"></div>				
				<h6>1. Different web & game passwords.<h6>
				   <em style="color:olive">This for more security.</em>
                <br>
				
				<h6>2. Secret Word.<h6>
				   <em style="color:olive">To change your email or passwords with it.</em>
                <br>
				
				<?php 
				// If question and answer enabled
                If ($MoreSecSystem == false)
	            {
			    ?>
				<h6>3. Question & answer.<h6>
				   <em style="color:olive">To restore you account with it.</em>
                <br>
				
				<h6>4. Recovery Account.<h6>
				   <em style="color:olive">To restore you account with other account.</em>
                <br>
				<?php } ?>
                <br>

	  </div>  	    
    </div>
  </div>
</div>
   
<? } else {
	
		echo'<div class="nk-gap-6"></div>
		<center><h1><b style="color:red" class="ion-information-circled"></b> Set game password is disabled </h1><br>
		<a href = "/" class="nk-btn nk-btn-lg link-effect-4">
					<span>Home page</span>
		</a>
		<center>
		<div class="nk-gap-6"></div>';
   }
  ?>
<div class="nk-gap-6"></div>