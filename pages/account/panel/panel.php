<?php
if (!isset($_SESSION['LogIn'])){
	$func->userRedirect("/");
}
if($AccountPanelStatus == false){
?>


        <!-- START: ACCOUNT PANEL -->
		<script>
		function LoadStroage(){
				$("#gamestroage").html(" <h3><center>Loading please wait...</center></h3><br><span class='nk-preloader-animation'></span>");
				$("#gamestroage").load("/gamestroage/<?= $sql->JID($_SESSION['username'])?>");
		} //Load Stroage
		
		//ResetForm
		function ResetForm(Name){
					$('#Change'+Name+'Form')[0].reset();
					$( ".nk-form-response-error" ).hide();
					$( ".nk-form-response-success" ).hide();
		}
		</script>

        <div class="nk-gap-4"></div>
       
	    <div class="container">
		 <div class="nk-tabs">  
		 
		 <div class="col-md-3">
		        <ul  style=" -webkit-padding-start: 0px;"   role="tablist">
			     <a href="#WebStroage" role="tab" data-toggle="tab" class="nk-btn nk-btn-block nk-btn-lg link-effect-4">
                                <span>Web-Stroage</span>
                 </a>
				 <div class="nk-gap"></div>
				 
				 <a href="#GameStroage" onclick="LoadStroage();" role="tab" data-toggle="tab" class="nk-btn nk-btn-block nk-btn-lg link-effect-4">
                                <span>Game-Stroage</span>
                 </a>
				 <div class="nk-gap"></div>
				 
                 <a href="#ChangeGamePass" onclick="ResetForm('GamePass');" role="tab" data-toggle="tab" class="nk-btn nk-btn-block nk-btn-lg link-effect-4">
                                <span>Game-Password</span>
                 </a>
				 <div class="nk-gap"></div>
				  
				 <a href="#ChangeWebPass" onclick="ResetForm('WebPass');" role="tab" data-toggle="tab" class="nk-btn nk-btn-block nk-btn-lg link-effect-4">
                                <span>Web-Password</span>
                 </a>
				 <div class="nk-gap"></div>
				 
				 <a href="#ChangeEmailSection" onclick="ResetForm('Email');" role="tab" data-toggle="tab" class="nk-btn nk-btn-block nk-btn-lg link-effect-4">
                                <span>Change-Email</span>
                 </a>
				 <div class="nk-gap"></div>
				
				 <a href="#ChangeSecretSection" onclick="ResetForm('Secret');" role="tab" data-toggle="tab" class="nk-btn nk-btn-block nk-btn-lg link-effect-4">
                                <span>Change-Secret</span>
                 </a>
				 <div class="nk-gap"></div>
				 
				</ul>
		</div>
		
		<div class="col-md-9">
		 <div class="tab-content">
		 
			<!---------------------------
					WEB STROAGE
			----------------------------> 
			<div role="tabpanel" class="tab-pane fade in active" id="WebStroage">
				<? include('/pages/account/panel/stroages/bank.php'); ?>
			</div>
			
			<!---------------------------
					GAME STROAGE
			----------------------------> 
			<div role="tabpanel" class="tab-pane fade in active" id="GameStroage">
				<div id="gamestroage"></div>
			</div>
			
			
			
			<!---------------------------
				CHANGE GAME PASSWORD
			----------------------------> 
			<div role="tabpanel" class="tab-pane fade" id="ChangeGamePass">
			
            <!--Change password form--> 
			<div class="nk-box-2 bg-dark-1">
			<h2 style="color:orange;margin-left:11px">Change Game password!!</h2>
			<div class="nk-gap-1"></div>
			
				<form class="nk-form nk-form-ajax nk-form-style-1" id="ChangeGamePassForm"  action="/account/change/gamepassword" method="POST">

					<div class="col-md-12">
					<div class="nk-form-response-success"></div>
					<div class="nk-form-response-error"></div>
					</div>     
					
					<div class="col-md-6">
					<span>Old password <span style="color:red">*</span></span>
					 <input type="password" class="form-control required" placeholder="Old password" name="oldpass" />
					<div class="nk-gap-2"></div>
					</div>
					
					<div class="col-md-6">
					<span>Secret Word <span style="color:red">*</span></span>
					 <input type="text" class="form-control required" placeholder="Secret word" name="secretword" />
					<div class="nk-gap-2"></div>
					</div>
					
					<div class="col-md-6">
					<span>New password <span style="color:red">*</span></span>
					 <input type="password" class="form-control required" placeholder="New password" name="newpass" />
					<div class="nk-gap-2"></div>
					</div>
					
					<div class="col-md-6">
					<span>Repeat new password <span style="color:red">*</span></span>
					 <input type="password" class="form-control required" placeholder="Repeat new password" name="newpass2" />
					<div class="nk-gap-2"></div>
					</div>


					<div class="col-md-12">
					<button type="submit" class="nk-btn nk-btn-lg link-effect-4">
								<span>Change</span>
					</button>
					</div>

				</form>
			  </div>
			  
			</div>
			
			<!---------------------------
				CHANGE WEB PASSWORD
			----------------------------> 
			<div role="tabpanel" class="tab-pane fade" id="ChangeWebPass">
			
			<!--Change web password form--> 
			<div class="nk-box-2 bg-dark-1">
			<h2 style="color:orange;margin-left:11px">Change web password!!</h2>
			<div class="nk-gap-1"></div>
			
				<form class="nk-form nk-form-ajax nk-form-style-1" id="ChangeWebPassForm" action="/account/change/webpassword" method="POST">

					<div class="col-md-12">
					<div class="nk-form-response-success"></div>
					<div class="nk-form-response-error"></div>
					</div>     
					
					<div class="col-md-6">
					<span>Old password <span style="color:red">*</span></span>
					 <input type="password" class="form-control required" placeholder="Old web password" name="oldwebpass" />
					<div class="nk-gap-2"></div>
					</div>
					
					<div class="col-md-6">
					<span>Secret Word <span style="color:red">*</span></span>
					 <input type="text" class="form-control required" placeholder="Secret word" name="secretwordweb" />
					<div class="nk-gap-2"></div>
					</div>
					
					<div class="col-md-6">
					<span>New password <span style="color:red">*</span></span>
					 <input type="password" class="form-control required"  placeholder="New web password" name="newwebpass" />
					<div class="nk-gap-2"></div>
					</div>
					
					<div class="col-md-6">
					<span>Repeat new password <span style="color:red">*</span></span>
					 <input type="password" class="form-control required" placeholder="Repeat new web password" name="newwebpass2" />
					<div class="nk-gap-2"></div>
					</div>


					<div class="col-md-12">
					<button type="submit" class="nk-btn nk-btn-lg link-effect-4">
								<span>Change</span>
					</button>
					</div>

				</form>
			  </div>
			  
			</div>
			 
			<!---------------------------
					CHANGE EMAIL
			----------------------------> 
			<div role="tabpanel" class="tab-pane fade" id="ChangeEmailSection">
			
			<!--Change email form --> 
			<div class="nk-box-2 bg-dark-1">
			<h2 style="color:orange;margin-left:11px">Change Email!!</h2>
			<div class="nk-gap-1"></div>
				<form class="nk-form nk-form-ajax nk-form-style-1" id="ChangeEmailForm"  action="/account/change/email" method="POST">

					<div class="col-md-12">
					<div class="nk-form-response-success"></div>
					<div class="nk-form-response-error"></div>
					</div>     
					
					<div class="col-md-6">
					<span>Old email <span style="color:red">*</span></span>
					 <input type="email" class="form-control required" placeholder="Old email" name="OldEmail" />
					<div class="nk-gap-2"></div>
					</div>
					
					<div class="col-md-6">
					<span>Secret Word <span style="color:red">*</span></span>
					 <input type="text" class="form-control required" placeholder="Secret word" name="SecretWordEmail" />
					<div class="nk-gap-2"></div>
					</div>
					
					<div class="col-md-6">
					<span>New email <span style="color:red">*</span></span>
					 <input type="email" class="form-control required"  placeholder="New web password" name="NewEmail" />
					<div class="nk-gap-2"></div>
					</div>
					
					<div class="col-md-6">
					<span>Repeat new email <span style="color:red">*</span></span>
					 <input type="email" class="form-control required" placeholder="Repeat new email" name="NewEmail2" />
					<div class="nk-gap-2"></div>
					</div>


					<div class="col-md-12">
					<button type="submit" class="nk-btn nk-btn-lg link-effect-4">
								<span>Change</span>
					</button>
					</div>

				</form>
			  </div>
			  
			</div>
			
			<!---------------------------
				CHANGE SECRET WORD 
			----------------------------> 
			<div role="tabpanel" class="tab-pane fade" id="ChangeSecretSection">
			
			<!--Change email form --> 
			<div class="nk-box-2 bg-dark-1">
			<h2 style="color:orange;margin-left:11px">Change Secret Word!!</h2>
			<div class="nk-gap-1"></div>
			
				<form class="nk-form nk-form-ajax nk-form-style-1" id="ChangeSecretForm" action="/account/change/secret" method="POST">

					<div class="col-md-12">
					<div class="nk-form-response-success"></div>
					<div class="nk-form-response-error"></div>
					</div>     
					
					<div class="col-md-12">
					<span>Old secretword <span style="color:red">*</span></span>
					 <input type="text" class="form-control required" placeholder="Old secretword" name="OldSecret" />
					<div class="nk-gap-2"></div>
					</div>
					
					<div class="col-md-6">
					<span>New SecretWord <span style="color:red">*</span></span>
					 <input type="text" class="form-control required" placeholder="New Secretword" name="NewSecret" />
					<div class="nk-gap-2"></div>
					</div>
					
					<div class="col-md-6">
					<span>Repeat New SecretWord <span style="color:red">*</span></span>
					 <input type="text" class="form-control required"  placeholder="Repeat new secretword" name="NewSecret2" />
					<div class="nk-gap-2"></div>
					</div>


					<div class="col-md-12">
					<button type="submit" class="nk-btn nk-btn-lg link-effect-4">
								<span>Change</span>
					</button>
					</div>

				</form>
			  </div>
			  
			</div>
			
			
			
			
			</div>
		 </div>
		</div>
	</div>
    <div class="nk-gap-2"></div>
    <div class="nk-gap-4"></div>
    <!-- END: ACCOUNT PANEL -->
   
<? } else { ?>

	<div class="nk-gap-6"></div>
	<center><h1><b style="color:red" class="ion-information-circled"></b> Account panel is disabled </h1><br>
	<a href = "/" class="nk-btn nk-btn-lg link-effect-4">
						<span>Home page</span>
	</a>
	<center>
	<div class="nk-gap-6"></div>
	
  <? } ?>