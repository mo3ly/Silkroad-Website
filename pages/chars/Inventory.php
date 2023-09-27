<? 
$charID = (int)$_GET['sup'];
$CharName16 = $sql->CharName($charID);
if ($sql->CharInUser($_SESSION['username'],$CharName16)){ 
?>
<div class="nk-box-1 bg-dark-1">
			 
							
		<center>
		<div class="nk-testimonial-name h2">Inventory</div>
		<div class="nk-gap"></div>
		<img src="/assets/images/chars/hero.png" style="opacity:0.1;margin-bottom:-1050px;margin-left:120px">
		<!--<img src="/assets/images/monkey.png" data-mouse-parallax-z="3" style="width:60%;opacity:0.5;margin-bottom:-310px;margin-right:100px">-->
					
		<!--Gold-->
		<h3><b class="fa fa-star"></b> Gold: <?= number_format($Gold);?></h3>
		<div class="nk-gap-2"></div>
			
		<div class="nk-tabs">  
		<!--Buttons-->
		<ul  style=" -webkit-padding-start: 0px;" role="tablist">
		<div class="hidden-lg-up hidden-md-up">
		<div class="nk-gap-2"></div>
		</div>
		<a href="#page1" role="tab" data-toggle="tab" class="nk-btn nk-btn-lg link-effect-4">
						<span>Page 1</span>
		 </a>
		 
		 <a href="#page2" role="tab" data-toggle="tab" class="nk-btn nk-btn-lg link-effect-4">
						<span>Page 2</span>
		 </a>
		 
		 <a href="#page3" role="tab" data-toggle="tab" class="nk-btn nk-btn-lg link-effect-4">
						<span>Page 3</span>
		 </a>
		 
		</ul>
		<div class="nk-gap-2"></div>
		<div class="col-md-12">
		 <div class="tab-content">

			
		    <?php 
			for($i=1;$i<4;$i++){
			if($i == 1){$Fade = "fade in active";} else {$Fade="";}
			
			?>
			<!--Pages section-->
            <div role="tabpanel" class="tab-pane <?= $Fade;?>" id="page<?= $i;?>">
			
							<div class="row equal-height">
							
							<?php
							
							if($i == 1){
									$queryItems = $sql->query("SELECT * FROM $dbs[SHARD].._Inventory WHERE CharID = '$charID' and Slot between 13 and 44");
							}
							if($i == 2){
									$queryItems = $sql->query("SELECT * FROM $dbs[SHARD].._Inventory WHERE CharID = '$charID' and Slot between 45 and 76");
							}
							if($i == 3){
									$queryItems = $sql->query("SELECT * FROM $dbs[SHARD].._Inventory WHERE CharID = '$charID' and Slot between 77 and 108");
							}
							
							while ($query = $sql->QueryFetchArray($queryItems)){
							$Slota = $query['Slot'];
							$ItemSID = $query['ItemID'];
							
							?>
							
							<!--Start loop for slots-->
							<div class="col-xs-3 pull-left">
							
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
		</div>				
  </center>						
</div>
<?
	} else {
		$func->userRedirect("/");
	}	
?>