<? 
//Switch pages
if ($_GET['sup']){
	$Num = $_GET['sup'];
} else {
	$Num =1;
}
?>

<!--Buttons-->
<div id="LoadInv">
<div style="background:rgba(0, 0, 0, 0.60);padding:10px;border:1px solid rgb(74, 71, 71)">
<center>
<div class="nk-gap" style="height: 10px;"></div>
<a onclick="Inventory(1);" style="cursor:pointer" class="h6 link-effect-4">
			<span>Page 1</span>
</a>
&nbsp;&nbsp;&nbsp;
<a onclick="Inventory(2);" style="cursor:pointer" class="h6 link-effect-4">
			<span>Page 2</span>
</a>
&nbsp;&nbsp;&nbsp;
<a onclick="Inventory(3);" style="cursor:pointer" class="h6 link-effect-4">
			<span>Page 3</span>
</a>
<div class="nk-gap"></div>
</center>

<div id="LoadingInv"></div>
<div class="divider"></div>
	<center>
	<!--Pages section-->
		<div class="nk-gap"></div>
			<div class="row equal-height">
					
					<?php
					$charID = $sql->CharID($_SESSION['CharName']);//Char ID
					//Switch Quires
					if($Num == 1){
							$queryItems = $sql->query("SELECT * FROM $dbs[SHARD].._Inventory WHERE CharID = '$charID' and Slot between 13 and 44");
					}
					if($Num == 2){
							$queryItems = $sql->query("SELECT * FROM $dbs[SHARD].._Inventory WHERE CharID = '$charID' and Slot between 45 and 76");
					}
					if($Num == 3){
							$queryItems = $sql->query("SELECT * FROM $dbs[SHARD].._Inventory WHERE CharID = '$charID' and Slot between 77 and 108");
					}
					
					while ($query = $sql->QueryFetchArray($queryItems)){
					$Slota = $query['Slot'];
					$ItemSID = $query['ItemID'];
					
					?>
					
					<!--Start loop for slots-->
					<div class="col-xs-3 pull-left">
					
					<div id="SlotID<?= $Slota?>" >
						<div class="slot-back" >
							<div id="slot" data-itemInfo="1" 
							style="background-image:url(<?= $sql->ItemIcon($ItemSID);?>);" draggable="true" ondragstart="drag(event);LoadItem(<?= $ItemSID;?>)">
								<?= $sql->Is_Sox($ItemSID);?>
								<span class="info"><?= $sql->Item_Amount($ItemSID);?></span>
							</div>
						<!-- Item Stats -->
						<div class="itemInfo">
							<? include('/main/iteminfo.php');?>
						</div>
						
						</div>
					</div>
					
					<div class="nk-gap"></div>
					</div>
					
					<?php }  ?>
					
			</div>
		</center>
	</div>
</div>