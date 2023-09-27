<?php
//Check if user is online or no
if (!isset($_SESSION['LogIn'])){
	$func->userRedirect("/");
}

//Characters panel is enabled
if($CharsPanelStatus == false){

//Selected char
if (!isset($_SESSION['CharName'])){
	include("/pages/chars/panel/select-character.php");
} else {
?>


	<!-- START: CHARS PANEL -->
	<div class="nk-box bg-dark-1">
	<div class="nk-gap-4"></div>
	<div class="container">
		
	</div>
    <div class="nk-gap-2"></div>
    <div class="nk-gap-4"></div>
	</div>
    <!-- END: CHARS PANEL -->
   
<?
	}
	} else { 
?>

	<div class="nk-gap-6"></div>
	<center><h1><b style="color:red" class="ion-information-circled"></b> Charatcers panel is disabled </h1><br>
	<a href = "/" class="nk-btn nk-btn-lg link-effect-4">
						<span>Home page</span>
	</a>
	<center>
	<div class="nk-gap-6"></div>
	
  <? } ?>