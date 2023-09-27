<?
	$UserJID = (int)$_GET['sup'];
	if ($UserJID != ($sql->JID($_SESSION['username']))){
		$func->Notification("You cannot open this stroage!","10");
		$func->userRedirect("/");
	} else {
	//Stroage Gold
	if($sql->QueryHasRows("SELECT Gold FROM $dbs[SHARD].._AccountJID where JID = '$UserJID'")){
		$GoldQury = $sql->query("SELECT Gold FROM $dbs[SHARD].._AccountJID where JID = '$UserJID'");
		$Datas = $sql->QueryFetchArray($GoldQury);
		$GoldStroage = $Datas['Gold'];
	} else {
		$GoldStroage = "0";
	}
?>
<div class="nk-box-1 bg-dark-1">					
		<center>
		<div class="nk-testimonial-name h2" style="color:orange">Game Stroage</div>
		<div class="nk-gap"></div>
		<img src="/assets/images/chars/hero.png" style="opacity:0.1;margin-bottom:-1050px;margin-left:120px">
		<!--<img src="/assets/images/monkey.png" data-mouse-parallax-z="3" style="width:60%;opacity:0.5;margin-bottom:-310px;margin-right:100px">-->
					
		<!--Gold-->
		<h3><b class="fa fa-star"></b> Gold: <?= number_format($GoldStroage);?></h3>
		<div class="nk-gap-2"></div>
			
		<div class="nk-tabs">  
		<div class="col-md-12">
		 <div class="tab-content">

			
		    <?php 
			for($i=1;$i<6;$i++){
			if($i == 1){$Fade = "fade in active";} else {$Fade="";}
			
			?>
			<!--Pages section-->
            <div role="tabpanel" class="tab-pane <?= $Fade;?>" id="stroage<?= $i;?>">
			
							<div class="row equal-height">
							
							<?php
							if($i == 1){
								$queryItems = $sql->query("SELECT * FROM $dbs[SHARD].._Chest WHERE UserJID = '$UserJID' and Slot between 0 and 29");
							}
							if($i == 2){
								$queryItems = $sql->query("SELECT * FROM $dbs[SHARD].._Chest WHERE UserJID = '$UserJID' and Slot between 30 and 59");
							}
							if($i == 3){
								$queryItems = $sql->query("SELECT * FROM $dbs[SHARD].._Chest WHERE UserJID = '$UserJID' and Slot between 60 and 89");
							}
							if($i == 4){
								$queryItems = $sql->query("SELECT * FROM $dbs[SHARD].._Chest WHERE UserJID = '$UserJID' and Slot between 90 and 119");
							}
							if($i == 5){
								$queryItems = $sql->query("SELECT * FROM $dbs[SHARD].._Chest WHERE UserJID = '$UserJID' and Slot between 120 and 149");
							}
							while ($query = $sql->QueryFetchArray($queryItems)){
							$Slota = $query['Slot'];
							$ItemSID = $query['ItemID'];
							
							?>
							
							<!--Start loop for slots-->
							<div class="col-xs-2 pull-left">
							
							<div class="slot-back" >
							<div id="slot" data-itemInfo="1"   
							style="background-image:url(<?= $sql->ItemIcon($ItemSID);?>);">
							    <?= $sql->Is_Sox($ItemSID);?>
								<span class="info"><?= $sql->Item_Amount($ItemSID);?></span>
							</div>
							<div class="itemInfo">
							<? include('/main/iteminfo.php');?>
							</div>
							
							</div>
							
							<div class="nk-gap"></div>
							</div>
							
						    <?php }  ?>
							
							</div>
                </div>
			  <?}?>
			</div>
		   </div>
		<!--Buttons-->
		<ul  style=" -webkit-padding-start: 0px;"  role="tablist">
		<div class="hidden-lg-up hidden-md-up">
		<div class="nk-gap-2"></div>
		</div>
		<a href="#stroage1" role="tab" data-toggle="tab" class="nk-btn nk-btn-lg link-effect-4">
						<span>Page 1</span>
		 </a>
		 
		 <a href="#stroage2" role="tab" data-toggle="tab" class="nk-btn nk-btn-lg link-effect-4">
						<span>Page 2</span>
		 </a>
		 
		 <a href="#stroage3" role="tab" data-toggle="tab" class="nk-btn nk-btn-lg link-effect-4">
						<span>Page 3</span>
		 </a>
		 <a href="#stroage4" role="tab" data-toggle="tab" class="nk-btn nk-btn-lg link-effect-4">
						<span>Page 4</span>
		 </a>
		 
		 <a href="#stroage5" role="tab" data-toggle="tab" class="nk-btn nk-btn-lg link-effect-4">
						<span>Page 5</span>
		 </a>
		 
		</ul>
		<div class="nk-gap-2"></div>
		</div>				
  </center>						
</div>
	<? } ?>