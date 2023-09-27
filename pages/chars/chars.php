<?php

$charID = (int)$_GET['third'];

    if(!empty($charID)){
	   
    $qryPlayer = $sql->query("SELECT * FROM $dbs[SHARD]..[_Char] WHERE [CharID] = '$charID'");
    $CheckAvaliable = count($sql->query("SELECT * FROM $dbs[SHARD]..[_Char] WHERE [CharID] = '$charID' ")->fetchAll()); 
	
	if (!$CheckAvaliable == 0){
		
        $Data = $sql->QueryFetchArray($qryPlayer);
        $CharName16 = $Data["CharName16"];
	    $CharTitle = $CharName16;
        $RefObjID = $Data["RefObjID"];
		$CharType = $Data["RefObjID"];
        $CurLevel = $Data["CurLevel"];
		$TitleID = $Data["HwanLevel"];
        $Gold = $Data['RemainGold'];
		
        $Health = $Data["HP"];
        $Mana = $Data["MP"];
		$Str = $Data["Strength"];
		$Int = $Data["Intellect"];
		
		$HwanCount = $Data["RemainHwanCount"];

        $LatestRegion = $Data["LatestRegion"];
        $PosX = $Data["PosX"];
        $PosY = $Data["PosY"];
        $PosZ = $Data["PosZ"];
		
		//Job aliance
		if($Data['NickName16'] == NULL || $Data['NickName16'] == " ") {
		   $NickName = $Data['NickName16'] = "None";
		} else {
			$NickName = $Data['NickName16'];
		}
			
		$originalDate = $Data['LastLogout'];
		$LastLogOut = date('d-M  H:i', strtotime($originalDate));

		
		$level = $CurLevel + 1;
		$exp_check = $sql->query("SELECT Exp_C from $dbs[SHARD].._RefLevel where Lvl = '$level'");
		$p_exp = $sql->QueryFetchArray($exp_check);
		
		#--- Next level progress ---#
		if($level > $ServerCap) {
			$next_level = "00";
		} else {
			$next_level_x = $Data['ExpOffset'] / $p_exp['Exp_C'] * 100;
			$next_level = 100 - $next_level_x;
		}

        $CharImage = "/assets/images/chars/" . $RefObjID . ".gif";

	} else {
		$func->userRedirect("/error",false);
	}
	
    } else {
		$func->userRedirect("/error",false);
	}
	?>

  <div class="nk-gap-3"></div>
	<div class="container">
	 <div class="nk-tabs">  
		 
		
		<div class="col-md-9">
		 <div class="tab-content">
			<!--Char info section-->
            <div role="tabpanel" class="tab-pane fade in active" id="informations">
			<?include('/pages/chars/char-info.php');?>
			</div>
		
			<!--Items section-->
			<div role="tabpanel" class="tab-pane fade" id="characteritem">
			<div id="LoadMainInv"></div>
			</div>
					
			
			<? if(isset($_SESSION['username'])){
			   if ($sql->CharInUser($_SESSION['username'],$CharName16)){ 
			?>
			<!--Inventory section-->
			<div role="tabpanel" class="tab-pane fade" id="Inventory">
			<div id="LoadInv"></div>
			</div>
				
			<? } } ?>
			
			<!--CHARACTER LOGS-->
		    <div role="tabpanel" class="tab-pane fade" id="charlogs">
		    <?include('/pages/chars/char-logs.php');?>
	        </div>	
			
			</div>
		   </div>
		  
		  <!--Buttons-->
			<script>
				function LoadInv(){
					 $("div#LoadInv").html(" <h3><center>Loading please wait...</center></h3><br><span class='nk-preloader-animation'></span>");
					 $("#LoadInv").load("/charinv/<?= $charID?>");
		    	} //Load inventory
				
				function LoadMainInv(){
						$("div#LoadMainInv").html(" <h3><center>Loading please wait...</center></h3><br><span class='nk-preloader-animation'></span>");
						$("#LoadMainInv").load("/charavataritem/<?= $charID?>");
				} //Load Char main avatar inventory
			</script>
		    <div class="col-md-3">
		        <ul  style=" -webkit-padding-start: 0px;" role="tablist">
				<div class="hidden-lg-up hidden-md-up">
				<div class="nk-gap-2"></div>
				</div>
				<a href="#informations" role="tab" data-toggle="tab" class="nk-btn nk-btn-lg link-effect-4 nk-btn-block">
                                <span>Char-Info</span>
                 </a>
				 <div class="nk-gap"></div>
				 
                 <a href="#characteritem" onclick="LoadMainInv();" role="tab" data-toggle="tab" class="nk-btn nk-btn-lg link-effect-4 nk-btn-block">
                                <span>Inventory</span>
                 </a>
				 <div class="nk-gap"></div>
				 
				<? if(isset($_SESSION['username'])){
				   if ($sql->CharInUser($_SESSION['username'],$CharName16)){ 
				?>
				 <a href="#Inventory" onclick="LoadInv();" role="tab" data-toggle="tab" class="nk-btn nk-btn-lg link-effect-4 nk-btn-color-main-1 nk-btn-block">
                                <span>Main-Inventory</span>
                 </a>
				 <div class="nk-gap-1"></div>
				   <? } } ?>
				 
				 <a href="#charlogs" role="tab" data-toggle="tab" class="nk-btn nk-btn-lg link-effect-4 nk-btn-block">
                                <span>Char-Logs</span>
                 </a>
				 
				 <div class="nk-gap"></div>
				 
				</ul>
		</div>
		
		</div>
	
	</div>
	<div class="nk-gap-6"></div>
	<div class="nk-gap-2"></div>
	