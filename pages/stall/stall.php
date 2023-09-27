<?
if(!isset($_SESSION['LogIn'])){$func->userRedirect("/");}
if(!isset($_SESSION['CharName'])){
	include('/pages/stall/select-char.php');
}else{
?>
<div class="nk-gap-3"></div>    
	<div class="container">
	<? include('/pages/stall/hot-items.php');?>
		<div class="nk-tabs">  
			<div class="col-md-9">
				<div class="tab-content">
					
					
					<!--End Stall-->
					<div role="tabpanel" class="tab-pane fade in active" id="stallmain">
					<div id="LoadMain"></div>
					</div>
					<!--End Stall-->
					
					<!--Start Additem-->
					<div role="tabpanel" class="tab-pane fade" id="additem">
					<div id="LoadStallChar"></div>
					</div>
					<!--End Additem-->
					
					<!--Start Delete Item-->
					<div role="tabpanel" class="tab-pane fade" id="DeleteItem">
					<div id="LoadDeleteItem"></div>
					</div>
					<!--End Update Delete Item-->
					
					<!--Start Update Stall Char-->
					<div role="tabpanel" class="tab-pane fade" id="updatechara">
					<? include('/pages/stall/upd-stall-char.php');?>
					</div>
					<!--End Update Stall Char-->
					
                </div>
				</div>
				
				<!-- END: Start SideBar -->
				<div class="col-md-3">
                    <!--Buttons-->
		        <ul  style=" -webkit-padding-start: 0px;" role="tablist">
				<div class="hidden-lg-up hidden-md-up">
				<div class="nk-gap-2"></div>
				</div>
				<a href="#stallmain" role="tab" data-toggle="tab" onclick="Stall();" class="nk-btn nk-btn-block nk-btn-lg link-effect-4">
                                <span>Main Stall</span>
                 </a>
				 <div class="nk-gap"></div>
				 
                 <a href="#additem" role="tab" data-toggle="tab" onclick="AddItema();" class="nk-btn nk-btn-block nk-btn-lg link-effect-4">
                                <span>Add an Item</span>
                 </a>
				 <div class="nk-gap"></div>
				 <a  href="#DeleteItem" role="tab" data-toggle="tab" onclick="DeleteItema();"  class="nk-btn nk-btn-block nk-btn-lg link-effect-4">
                                <span>Manage Items</span>
                 </a>
				 <div class="nk-gap"></div>
				 <a  href="#updatechara" role="tab" data-toggle="tab" class="nk-btn nk-btn-block nk-btn-lg link-effect-4">
                                <span>Set Character</span>
                 </a>
				 <div class="nk-gap"></div>
				</ul>
                </div>
				<!-- END: Sidebar -->
				<script>
				$(function() {
					$("div#LoadMain").html(" <h3><center>Loading please wait...</center></h3><br><span class='nk-preloader-animation'></span>");
					$("#LoadMain").load("/mainstall/all/");
				 });
				function Stall(){
					$("div#LoadMain").html(" <h3><center>Loading please wait...</center></h3><br><span class='nk-preloader-animation'></span>");
					$("#LoadMain").load("/mainstall/all/");
				} //Load main stall
				function DeleteItema(){
					$("div#LoadDeleteItem").html(" <h3><center>Loading please wait...</center></h3><br><span class='nk-preloader-animation'></span>");
					$("#LoadDeleteItem").load("/stalldelete/");
				}
				function AddItema(){
					$("div#LoadStallChar").html(" <h3><center>Loading please wait...</center></h3><br><span class='nk-preloader-animation'></span>");
					$('#LoadStallChar').load('/stallchar/');
				}
			    </script>
				
            
			</div>
			</div>
			<?php }?>
            <div class="nk-gap-4"></div>
            <div class="nk-gap-3"></div>
			
        