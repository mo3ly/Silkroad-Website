<?
if (isset($_SESSION['LogIn'])){
	$Topic = $_GET['sup'];
	
	/***********************
			LOAD ITEM
	***********************/
	if($Topic == "loaditem"){
	$ItemSID = $_GET['third'];
	
	if ($sql->QueryHasRows("SELECT * FROM $dbs[SHARD].._Inventory WHERE ItemID = '$ItemSID' and CharID in (SELECT CharID from $dbs[SHARD].._Char where CharName16 = '$_SESSION[CharName]')")){
		$_SESSION['AlchemyItem'] = $ItemSID;
		if ($_SESSION['AlchemyItem'] != 0){
			$QueryCheck = "SELECT c.CharName16, c.CharID, Status = CASE
							WHEN ((r.CodeName128 like'ITEM_EU_DAGGER_%_%') or (r.CodeName128 like 'ITEM_CH_SPEAR_%_%') or (r.CodeName128 like 'ITEM_EU_%STAFF%_%_%') 
							or (r.CodeName128 like 'ITEM_CH_BOW_%_%') or (r.CodeName128 like 'ITEM_CH_%BLADE_%_%') or (r.CodeName128 like 'ITEM_EU_%SWORD_%_%')
							or (r.CodeName128 like 'ITEM_CH_SWORD_%_%') or (r.CodeName128 like 'ITEM_EU_HARP_%_%') or (r.CodeName128 like 'ITEM_EU_BOW_%_%')
							or (r.CodeName128 like 'ITEM_EU_AXE_%_%')) THEN 'Allow'
							WHEN (r.CodeName128 like 'ITEM_%_%_LIGHT_%_%_%') or (r.CodeName128 like 'ITEM_%_%_HEAVY_%_%_%' ) or (r.CodeName128 like 'ITEM_%_%_CLOTH_%_%_%') THEN 'Allow'
							WHEN (r.CodeName128 like'ITEM_%_SHIELD_%_A%' )  THEN 'Allow'
							WHEN (r.CodeName128 like'ITEM_EU_NECKLACE_%_%') or (r.CodeName128 like'ITEM_EU_%RING_%_%') or
							(r.CodeName128 like'ITEM_CH_NECKLACE_%_%') or (r.CodeName128 like'ITEM_CH_%RING_%_%') 	THEN 'Allow'
							WHEN (r.CodeName128 like'%ITEM_%_AVATAR_%_NASRUN%')THEN 'Allow'
							ELSE 'NotAllow' 
							END
							FROM $dbs[SHARD].._Inventory i 
							JOIN $dbs[SHARD].._Items it on i.ItemID = it.ID64 
							JOIN $dbs[SHARD].._RefObjCommon r on it.RefItemID = r.ID 
							LEFT JOIN $dbs[SHARD].._RefObjItem ri on r.Link = ri.ID 
							JOIN $dbs[SHARD].._Char c on i.CharID = c.CharID
							WHERE ItemID =  '$ItemSID' ";
				$QueryExec = $sql->query($QueryCheck);
				$Data = $sql->QueryFetchArray($QueryExec);
				if ($Data['Status'] == "Allow"){
				?>
					<div class="slot-back" >
						<div id="slot" data-itemInfo="1"   
						style="background-image:url(<?= $sql->ItemIcon($ItemSID);?>);">
							<?= $sql->Is_Sox($ItemSID);?>
							<div id="StartAlchemy"></div>
						</div>
						<div class="itemInfo">
						<? include('/main/iteminfo.php');?>
						</div>
					</div>
					
					<? if (!$_GET['forth']){ ?>
					
						<script>
							Msg('AlchemyResult','<span class="h6">Your item loaded successfully!!</span>');
						</script>
						
					<? } ?>
				<?				
				} else { echo'<div class="slot-back" ></div> 
							<script>
							DisableAlchemy(); 
							Msg(\'AlchemyResult\',\'<span class="h6">Sorry, you cannot use this item!</span>\');
							</script>';
						}
			}
		}
	}
	/******************************	
			LOAD AN ITEM
	******************************/
	if($Topic == "loaditeminv"){
	$ItemSID = $_GET['third'];
	
	if ($sql->QueryHasRows("SELECT * FROM $dbs[SHARD].._Inventory WHERE ItemID = '$ItemSID' and CharID in (SELECT CharID from $dbs[SHARD].._Char where CharName16 = '$_SESSION[CharName]')")){
		$_SESSION['AlchemyItem'] = $ItemSID;
		if ($_SESSION['AlchemyItem'] != 0){
			$QueryCheck = "SELECT c.CharName16, c.CharID,i.Slot, Status = CASE
							WHEN ((r.CodeName128 like'ITEM_EU_DAGGER_%_%') or (r.CodeName128 like 'ITEM_CH_SPEAR_%_%') or (r.CodeName128 like 'ITEM_EU_%STAFF%_%_%') 
							or (r.CodeName128 like 'ITEM_CH_BOW_%_%') or (r.CodeName128 like 'ITEM_CH_%BLADE_%_%') or (r.CodeName128 like 'ITEM_EU_%SWORD_%_%')
							or (r.CodeName128 like 'ITEM_CH_SWORD_%_%') or (r.CodeName128 like 'ITEM_EU_HARP_%_%') or (r.CodeName128 like 'ITEM_EU_BOW_%_%')
							or (r.CodeName128 like 'ITEM_EU_AXE_%_%')) THEN 'Allow'
							WHEN (r.CodeName128 like 'ITEM_%_%_LIGHT_%_%_%') or (r.CodeName128 like 'ITEM_%_%_HEAVY_%_%_%' ) or (r.CodeName128 like 'ITEM_%_%_CLOTH_%_%_%') THEN 'Allow'
							WHEN (r.CodeName128 like'ITEM_%_SHIELD_%_A%' )  THEN 'Allow'
							WHEN (r.CodeName128 like'ITEM_EU_NECKLACE_%_%') or (r.CodeName128 like'ITEM_EU_%RING_%_%') or
							(r.CodeName128 like'ITEM_CH_NECKLACE_%_%') or (r.CodeName128 like'ITEM_CH_%RING_%_%') 	THEN 'Allow'
							WHEN (r.CodeName128 like'%ITEM_%_AVATAR_%_NASRUN%')THEN 'Allow'
							ELSE 'NotAllow' 
							END
							FROM $dbs[SHARD].._Inventory i 
							JOIN $dbs[SHARD].._Items it on i.ItemID = it.ID64 
							JOIN $dbs[SHARD].._RefObjCommon r on it.RefItemID = r.ID 
							LEFT JOIN $dbs[SHARD].._RefObjItem ri on r.Link = ri.ID 
							JOIN $dbs[SHARD].._Char c on i.CharID = c.CharID
							WHERE ItemID =  '$ItemSID' ";
				$QueryExec = $sql->query($QueryCheck);
				$Data = $sql->QueryFetchArray($QueryExec);
				$Slot = $Data['Slot'];
				if ($Data['Status'] == "Allow"){
				?>
				<div id="SlotID<?= $Slot?>" >
					<div class="slot-back">
						<div id="slot" data-itemInfo="1"   
						style="background-image:url(<?= $sql->ItemIcon($ItemSID);?>);" draggable="true" ondragstart="drag(event);LoadItem(<?= $ItemSID;?>)">
							<?= $sql->Is_Sox($ItemSID);?>
						</div>
						<div class="itemInfo">
						<? include('/main/iteminfo.php');?>
						</div>
					</div>
				</div>
				<?				
				} 
			}
		}
	}
	/******************************
		ALLCHEMY PROGRESS
	******************************/
	if($Topic == "alchemyprogress"){
		if (isset($_SESSION['AlchemyItem'])){
			if ($_SESSION['AlchemyItem'] != 0){
				if ($sql->QueryHasRows("SELECT * FROM $dbs[SHARD].._Inventory WHERE ItemID = '$_SESSION[AlchemyItem]' and CharID in (SELECT CharID from $dbs[SHARD].._Char where CharName16 = '$_SESSION[CharName]')")){
					$QueryCheck = "SELECT c.CharName16, c.CharID,i.Slot, Status = CASE
							WHEN ((r.CodeName128 like'ITEM_EU_DAGGER_%_%') or (r.CodeName128 like 'ITEM_CH_SPEAR_%_%') or (r.CodeName128 like 'ITEM_EU_%STAFF%_%_%') 
							or (r.CodeName128 like 'ITEM_CH_BOW_%_%') or (r.CodeName128 like 'ITEM_CH_%BLADE_%_%') or (r.CodeName128 like 'ITEM_EU_%SWORD_%_%')
							or (r.CodeName128 like 'ITEM_CH_SWORD_%_%') or (r.CodeName128 like 'ITEM_EU_HARP_%_%') or (r.CodeName128 like 'ITEM_EU_BOW_%_%')
							or (r.CodeName128 like 'ITEM_EU_AXE_%_%')) THEN 'Weapon'
							WHEN (r.CodeName128 like 'ITEM_%_%_LIGHT_%_%_%') or (r.CodeName128 like 'ITEM_%_%_HEAVY_%_%_%' ) or (r.CodeName128 like 'ITEM_%_%_CLOTH_%_%_%') THEN 'Equip'
							WHEN (r.CodeName128 like'ITEM_%_SHIELD_%_A%' )  THEN 'Shield'
							WHEN (r.CodeName128 like'ITEM_EU_NECKLACE_%_%') or (r.CodeName128 like'ITEM_EU_%RING_%_%') or
							(r.CodeName128 like'ITEM_CH_NECKLACE_%_%') or (r.CodeName128 like'ITEM_CH_%RING_%_%') 	THEN 'Accessory'
							ELSE 'NotAllow' 
							END
							FROM $dbs[SHARD].._Inventory i 
							JOIN $dbs[SHARD].._Items it on i.ItemID = it.ID64 
							JOIN $dbs[SHARD].._RefObjCommon r on it.RefItemID = r.ID 
							LEFT JOIN $dbs[SHARD].._RefObjItem ri on r.Link = ri.ID 
							JOIN $dbs[SHARD].._Char c on i.CharID = c.CharID
							WHERE ItemID =  '$_SESSION[AlchemyItem]' ";
							
					$QueryExec = $sql->query($QueryCheck);
					$Data = $sql->QueryFetchArray($QueryExec);
					$ItemType = $Data['Status'];//Item Type
					$ItemSlot = $Data['Slot'];//Item Type
					//Allowed items array
					$AllowedItems = array('Weapon','Equip','Accessory','Shield');
					
					//Check item allowed or no
					if (in_array($ItemType,$AllowedItems)){
						
						
						$CharID = $sql->CharID($_SESSION['CharName']);
						$QueryElixer = $sql->query("SELECT * FROM $dbs[WEB].._Chars where CharID = '$CharID' ");
						$DataElixer = $sql->QueryFetchArray($QueryElixer);
						$Elixer = $DataElixer[''.$ItemType.'Elixer']; //Elixers
						$ElixerType = ''.$ItemType.'Elixer';
						//Check enough elixers or no
						if ($Elixer > 0){
							
							$sql->query("UPDATE $dbs[WEB].._Chars set $ElixerType = $ElixerType - '1' where CharID = '$CharID' ");
							
							//Item OptLevel
							$Data = $sql->QueryFetchArray($sql->query("SELECT  OptLevel from $dbs[SHARD].._Items where ID64 = '$_SESSION[AlchemyItem]' "));
							$OptLvl = $Data['OptLevel']; //Fetch OptLevel
							if ($OptLvl < $ItemMaxPlus){
								
								//Rate
								if ($OptLvl < 5){
									$AlchemyRate = array('1','1','0','1','0','1','0','0','1','0');
									$RandoKey = $AlchemyRate[rand(0, count($AlchemyRate) - 1)];
									
								} elseif ($OptLvl < 8){
									$AlchemyRate = array('1','0','1','0','1','1','0','1','0','1');
									$RandoKey = $AlchemyRate[rand(0, count($AlchemyRate) - 1)];
									
								} elseif ($OptLvl < 12){
									$AlchemyRate = array('1','0','1','0','1','1','1','1','0','1');
									$RandoKey = $AlchemyRate[rand(0, count($AlchemyRate) - 1)];
									
								} elseif ($OptLvl < 17){
									$AlchemyRate = array('1','1','0','1','1','1','1','1','1','0');
									$RandoKey = $AlchemyRate[array_rand($AlchemyRate)];
									
								} elseif ($OptLvl < 30){
									$AlchemyRate = array('1','1','1','1','1','1','1','1','1','0');
									$RandoKey = $AlchemyRate[array_rand($AlchemyRate)];
								}
								
								//Success
								if ($RandoKey == 0){
									$AlchemyStatus = "Success" ;$Plus = "1";
									$sql->query("UPDATE $dbs[SHARD].._Items Set OptLevel = OptLevel + '$Plus' where ID64 = '$_SESSION[AlchemyItem]'");
								
								//Failed
								}elseif($RandoKey == 1){
									$AlchemyStatus = "Failed";$Plus = "0";
									$sql->query("UPDATE $dbs[SHARD].._Items Set OptLevel = '0' where ID64 = '$_SESSION[AlchemyItem]'");
								}
								
								
								?>
								<script>
									function Result(){
										$('#AlchemyResult').html('<span class="h6">Item is Fusing, Please wait..</span>');
										setTimeout(function(){
											$('#StartAlchemy').fadeOut(300);
											<? if ($AlchemyStatus == "Success"){?>
												$('#AlchemyResult').html('<h6 style="color:olive">Item has been changed to [<?= $OptLvl + $Plus; ?>] because the alchemy of enhancement is a success.</h6>').fadeIn('slow');
											<? } elseif ($AlchemyStatus == "Failed") {?>
												$('#AlchemyResult').html('<h6 style="color:Darkred">The alchemy of enhancement is a failed.</h6>').fadeIn('slow');
											<? } ?>
											
											EnableAlchemyBtn();
											$('#AlchemyItemSlot').load('/alchemyaction/loaditem/<?= $_SESSION['AlchemyItem'];?>/nomsg');
											$('#SlotID<?= $ItemSlot;?>').load('/alchemyaction/loaditeminv/<?= $_SESSION['AlchemyItem'];?>/nomsg');
											AllowInventory();
											document.getElementById("LoadPlus").disabled = false;
											document.getElementById("LoadSwitcher").disabled = false;
										} ,3000);
									} 
									
									Result();
									
									$(function() {
										$("#ElixerLoader").load("/alchemyaction/loadelixer/");
									});
								</script>
							
								<?
						
							} else {echo '<script>DisableAlchemy();AllowInventory();</script><h6>This is the max plus of the item!</h6>';}
					
						} else {echo '<script>DisableAlchemy();AllowInventory();</script><h6>You do not have enough elixers to fuse this item!</h6>';}
						
					} else {echo '<script>DisableAlchemy();AllowInventory();</script><h6>This is item is not allowed!</h6>';}
					
				} else {echo '<script>DisableAlchemy();AllowInventory();Msg(\'#AlchemyResult\',\'<span class="h6"> Please select your item!</span>\');</script><h6>There is a problem occurred!</h6>';}
					
			} else {echo '<script>DisableAlchemy();AllowInventory();Msg(\'#AlchemyResult\',\'<span class="h6"> Please select your item!</span>\');</script><h6>Please select an item to fuse it!</h6>';}
			
		} else { echo'<script>DisableAlchemy();AllowInventory();Msg(\'#AlchemyResult\',\'<span class="h6"> Please select your item!</span>\');</script>There is no item to fuse it!';}
	}
	
	
	/******************************
		SWITCH PROGRESS
	******************************/
	if($Topic == "switchprogress"){
		if (isset($_SESSION['AlchemyItem'])){
			if ($_SESSION['AlchemyItem'] != 0){
				if ($sql->QueryHasRows("SELECT * FROM $dbs[SHARD].._Inventory WHERE ItemID = '$_SESSION[AlchemyItem]' and CharID in (SELECT CharID from $dbs[SHARD].._Char where CharName16 = '$_SESSION[CharName]')")){
					$QueryCheck = "SELECT c.CharName16, c.CharID,r.CodeName128,i.Slot, Status = CASE
							WHEN ((r.CodeName128 like'ITEM_EU_DAGGER_%_%') or (r.CodeName128 like 'ITEM_CH_SPEAR_%_%') or (r.CodeName128 like 'ITEM_EU_%STAFF%_%_%') 
							or (r.CodeName128 like 'ITEM_CH_BOW_%_%') or (r.CodeName128 like 'ITEM_CH_%BLADE_%_%') or (r.CodeName128 like 'ITEM_EU_%SWORD_%_%')
							or (r.CodeName128 like 'ITEM_CH_SWORD_%_%') or (r.CodeName128 like 'ITEM_EU_HARP_%_%') or (r.CodeName128 like 'ITEM_EU_BOW_%_%')
							or (r.CodeName128 like 'ITEM_EU_AXE_%_%')) THEN 'Weapon'
							WHEN (r.CodeName128 like 'ITEM_%_%_LIGHT_%_%_%') or (r.CodeName128 like 'ITEM_%_%_HEAVY_%_%_%' ) or (r.CodeName128 like 'ITEM_%_%_CLOTH_%_%_%') THEN 'Equip'
							WHEN (r.CodeName128 like'ITEM_EU_NECKLACE_%_%') or (r.CodeName128 like'ITEM_EU_%RING_%_%') or
							(r.CodeName128 like'ITEM_CH_NECKLACE_%_%') or (r.CodeName128 like'ITEM_CH_%RING_%_%') 	THEN 'Accessory'
							ELSE 'NotAllow' 
							END
							FROM $dbs[SHARD].._Inventory i 
							JOIN $dbs[SHARD].._Items it on i.ItemID = it.ID64 
							JOIN $dbs[SHARD].._RefObjCommon r on it.RefItemID = r.ID 
							LEFT JOIN $dbs[SHARD].._RefObjItem ri on r.Link = ri.ID 
							JOIN $dbs[SHARD].._Char c on i.CharID = c.CharID
							WHERE ItemID =  '$_SESSION[AlchemyItem]' ";
							
					$QueryExec = $sql->query($QueryCheck);
					$Data = $sql->QueryFetchArray($QueryExec);
					$ItemType = $Data['Status'];//Item Type
					$ItemCode = $Data['CodeName128'];//Item Code
					$Replace = "_".$_GET['third']."_";//Replace to
					$ItemSlot = $Data['Slot'];//Item Slot
					//Allowed items array
					$AllowedItems = array('Weapon','Equip','Accessory');
					
					//Check item allowed or no
					if (in_array($ItemType,$AllowedItems)){
						
						$CharID = $sql->CharID($_SESSION['CharName']);
						$QueryElixer = $sql->query("SELECT * FROM $dbs[WEB].._Chars where CharID = '$CharID' ");
						$DataElixer = $sql->QueryFetchArray($QueryElixer);
						$SwitcherTk = $DataElixer[''.$ItemType.'Switch']; //Elixers
						$TokenType = ''.$ItemType.'Switch';
						//Check enough Tokens or no
						if ($SwitcherTk > 0){
							
							$sql->query("UPDATE $dbs[WEB].._Chars set $TokenType = $TokenType - '1' where CharID = '$CharID' ");
							//$ItemPackage = array("_HARP_","_STAFF_","_BOW_","_DAGGER_","_AXE_","_SPEAR_","_SWORD_","_TSWORD_","_BLADE_","_TBLADE_","_HA_","_LA_","_AA_","_BA_","_FA_","_SA_","_RING_","_NECKLACE_","_EARRING_");
							
							//Explode the codename
							$MainExplode = explode("_",$ItemCode);
							
							//Find code
							if ($ItemType == "Weapon" or $ItemType == "Accessory"){
								$FindCode = "_".$MainExplode[2]."_";
							} elseif ($ItemType == "Equip") {
								$FindCode = "_".$MainExplode[3]."_";
							}
							
							//Item Race
							$Race = $MainExplode[1];
							
							//Item Package
							if ($ItemType == "Weapon"){
								
								if ($Race == "EU"){
									//Europe weapons
									$ItemPackage = array("_HARP_","_TSTAFF_","_STAFF_","_DARKSTAFF_","_TSWORD_","_DAGGER_","_AXE_","_SWORD_");
								} elseif ($Race == "CH"){
									//China Weapons
									$ItemPackage = array("_BLADE_","_SWORD_","_BOW_","_SPEAR_","_TBLADE_");
								}
								
							}  elseif ($ItemType == "Equip") {
								//Equip
								$ItemPackage = array("_CLOTHES_","_LIGHT_","_HEAVY_");
							}  elseif ($ItemType == "Accessory") {
								//Accessory
								$ItemPackage = array("_NECKLACE_","_EARRING_","_RING_");
							}
							
							if (in_array($FindCode,$ItemPackage)){
								$NewCode = str_replace($FindCode,$Replace,$ItemCode);
								
								//ItemCode
								$DataNewCode = $sql->QueryFetchArray($sql->query("SELECT ID FROM $dbs[SHARD].._RefObjCommon where CodeName128 = '$NewCode'"));
								$CodeID = $DataNewCode['ID'];
								
								$sql->query("UPDATE $dbs[SHARD].._Items SET RefItemID = '$CodeID' where ID64 = '$_SESSION[AlchemyItem]' ");
							}
								?>
								<script>
									function SwitchResult(){
										$('#AlchemyResult').html('<span class="h6">Item is switching, Please wait..</span>');
										setTimeout(function(){
											$('#StartAlchemy').fadeOut(300);
											$('#AlchemyResult').html('<h6 style="color:olive">Item has been switched successfully.</h6>').fadeIn('slow');
											EnableAlchemyBtn();
											$('#AlchemyItemSlot').load('/alchemyaction/loaditem/<?= $_SESSION['AlchemyItem'];?>/nomsg');
											$('#SlotID<?= $ItemSlot;?>').load('/alchemyaction/loaditeminv/<?= $_SESSION['AlchemyItem'];?>/');
											AllowInventory();
											document.getElementById("LoadPlus").disabled = false;
											document.getElementById("LoadSwitcher").disabled = false;
										} ,3000);
									} 
									SwitchResult();
									$(function() {
										$("#SwitcherTokens").load("/alchemyaction/loadswitchers/");
									});
								</script>
							
								<?
						
					
						} else {echo '<script>DisableAlchemy();AllowInventory();</script><h6>You do not have any tokens to switch this item!</h6>';}
						
					} else {echo '<script>DisableAlchemy();AllowInventory();</script><h6>This is item is not allowed!</h6>';}
					
				} else {echo '<script>DisableAlchemy();AllowInventory();Msg(\'#AlchemyResult\',\'<span class="h6"> Please select your item!</span>\');</script><h6>There is a problem occurred!</h6>';}
					
			} else {echo '<script>DisableAlchemy();AllowInventory();Msg(\'#AlchemyResult\',\'<span class="h6"> Please select your item!</span>\');</script><h6>Please select an item to switch it!</h6>';}
			
		} else { echo'<script>DisableAlchemy();AllowInventory();Msg(\'#AlchemyResult\',\'<span class="h6"> Please select your item!</span>\');</script>There is no item to switch it!';}
	}
	
	/******************************
		SWITCH SELECT ITEM
	******************************/
	if ($_GET['sup'] == "chooseitem"){
		$QueryCheck = "SELECT c.CharName16, c.CharID,r.CodeName128,i.Slot, Status = CASE
		WHEN ((r.CodeName128 like'ITEM_EU_DAGGER_%_%') or (r.CodeName128 like 'ITEM_CH_SPEAR_%_%') or (r.CodeName128 like 'ITEM_EU_%STAFF%_%_%') 
		or (r.CodeName128 like 'ITEM_CH_BOW_%_%') or (r.CodeName128 like 'ITEM_CH_%BLADE_%_%') or (r.CodeName128 like 'ITEM_EU_%SWORD_%_%')
		or (r.CodeName128 like 'ITEM_CH_SWORD_%_%') or (r.CodeName128 like 'ITEM_EU_HARP_%_%') or (r.CodeName128 like 'ITEM_EU_BOW_%_%')
		or (r.CodeName128 like 'ITEM_EU_AXE_%_%')) THEN 'Weapon'
		WHEN (r.CodeName128 like 'ITEM_%_%_LIGHT_%_%_%') or (r.CodeName128 like 'ITEM_%_%_HEAVY_%_%_%' ) or (r.CodeName128 like 'ITEM_%_%_CLOTH_%_%_%') THEN 'Equip'
		WHEN (r.CodeName128 like'ITEM_EU_NECKLACE_%_%') or (r.CodeName128 like'ITEM_EU_%RING_%_%') or
		(r.CodeName128 like'ITEM_CH_NECKLACE_%_%') or (r.CodeName128 like'ITEM_CH_%RING_%_%') 	THEN 'Accessory'
		ELSE 'NotAllow' 
		END
		FROM $dbs[SHARD].._Inventory i 
		JOIN $dbs[SHARD].._Items it on i.ItemID = it.ID64 
		JOIN $dbs[SHARD].._RefObjCommon r on it.RefItemID = r.ID 
		LEFT JOIN $dbs[SHARD].._RefObjItem ri on r.Link = ri.ID 
		JOIN $dbs[SHARD].._Char c on i.CharID = c.CharID
		WHERE ItemID =  '$_SESSION[AlchemyItem]' ";
							
		$QueryExec = $sql->query($QueryCheck);
		$Data = $sql->QueryFetchArray($QueryExec);
		$ItemType = $Data['Status'];//Item Type
		$ItemCode = $Data['CodeName128'];//Item Code
		
		//Explode the codename
		$MainExplode = explode("_",$ItemCode);
		
		//Item Race
		$Race = $MainExplode[1];
		
		//Item Package
		if ($ItemType == "Weapon"){
			
			if ($Race == "EU"){
				//Europe weapons
				$ItemPackage = array("HARP"=>"Harp","TSTAFF"=>"Two Handed Staff","STAFF"=>"Light Staff","DARKSTAFF"=>"Dark Staff","TSWORD" => "Two Handed Sword","DAGGER"=>"Dagger","AXE"=>"Axe");
			} elseif ($Race == "CH"){
				//China Weapons
				$ItemPackage = array("BLADE"=>"Blade","SWORD"=>"Sword","BOW"=>"Bow","SPEAR"=>"Spear","TBLADE"=>"Glavie");
			}
			
		}  elseif ($ItemType == "Equip") {
			if ($Race == "EU"){
				//Equip Europe
				$ItemPackage = array("CLOTHES"=>"Robe","LIGHT"=>"Light Armor","HEAVY"=>"Heavy Armor");
			} elseif ($Race == "CH"){
				//Equip China
				$ItemPackage = array("CLOTHES"=>"Geremant","LIGHT"=>"Protector","HEAVY"=>"Armor");
			}
		}  elseif ($ItemType == "Accessory") {
			//Accessory
			$ItemPackage = array("NECKLACE"=>"Necklace","EARRING"=>"Earring","RING"=>"Ring");
		} else {
			$ItemPackage = array("PLEASE SELECT ITEM");
		}
		
		foreach ($ItemPackage as $Item => $ItemName){
			echo'<option value="'.$Item.'">'.$ItemName.'</option>';
		} 
	}
	/*********************************
				LOAD ELIXERS
	*********************************/
	if ($_GET['sup'] == "loadelixer"){
		
		$CharID = $sql->CharID($_SESSION['CharName']);
		$QueryExec = $sql->query("SELECT * FROM $dbs[WEB].._Chars where CharID = '$CharID' ");
		$Data = $sql->QueryFetchArray($QueryExec);
		//Elixers
		$WeaponElixer = $Data['WeaponElixer'];
		$EquipElixer = $Data['EquipElixer'];
		$ShieldElixer = $Data['ShieldElixer'];
		$AccessoryElixer = $Data['AccessoryElixer'];
		?>
		<div class="col-xs-2"></div>
						
							<div class="col-xs-2">
								<div class="slot-back" title="[ <?= $ShieldElixer;?> ] Magic Shield elixer(s)">
									<div id="slot"  style="background-image:url(assets/images/item/alchemy/elixer-shield.png);">
										<span class="info"><?= $ShieldElixer;?></span>
									</div>
								</div>
							</div>
							<div class="col-xs-2">
								<div class="slot-back" title="[ <?= $AccessoryElixer;?> ] Magic Accessory elixer(s)">
									<div id="slot"  style="background-image:url(assets/images/item/alchemy/elixer-accessory.png);">
										<span class="info"><?= $AccessoryElixer;?></span>
									</div>
								</div>
							</div>
							<div class="col-xs-2">
								<div class="slot-back" title="[ <?= $EquipElixer;?> ] Magic Protector elixer(s)">
									<div id="slot"  style="background-image:url(assets/images/item/alchemy/elixer-protector.png);">
										<span class="info"><?= $EquipElixer;?></span>
									</div>
								</div>
							</div>
							<div class="col-xs-2">
								<div class="slot-back" title="[ <?= $WeaponElixer;?> ] Magic Weapon elixer(s)">
									<div id="slot"  style="background-image:url(assets/images/item/alchemy/elixer-weapon.png);">
										<span class="info"><?= $WeaponElixer;?></span>
									</div>
								</div>
							</div>
						
		<div class="col-xs-2"></div>
		<?	
	}
	/**************************
			LOAD SWITCHERS
	**************************/
	if ($_GET['sup'] == "loadswitchers"){
		
		$CharID = $sql->CharID($_SESSION['CharName']);
		$QueryExec = $sql->query("SELECT * FROM $dbs[WEB].._Chars where CharID = '$CharID' ");
		$Data = $sql->QueryFetchArray($QueryExec);
		//Switchers
		$WeaponSwitcher = $Data['WeaponSwitch'];
		$EquipSwitcher = $Data['EquipSwitch'];
		$AccessorySwitcher = $Data['AccessorySwitch'];
		?>
		<div class="col-xs-3"></div>
					
									<div class="col-xs-2">
										<div class="slot-back" title="[ <?= $WeaponSwitcher?> ] Weapon Switcher token(s)">
											<div id="slot"  style="background-image:url(assets/images/item/alchemy/switcher-weapon.png);">
												<span class="info"><?= $WeaponSwitcher?></span>
											</div>
										</div>
									</div>
									<div class="col-xs-2">
										<div class="slot-back" title="[ <?= $AccessorySwitcher?> ] Accessory Switcher token(s)">
											<div id="slot"  style="background-image:url(assets/images/item/alchemy/switcher-accessory.png);">
												<span class="info"><?= $AccessorySwitcher?></span>
											</div>
										</div>
									</div>
									<div class="col-xs-2">
										<div class="slot-back" title="[ <?= $EquipSwitcher?> ] Protector Switcher token(s)">
											<div id="slot"  style="background-image:url(assets/images/item/alchemy/switcher-equip.png);">
												<span class="info"><?= $EquipSwitcher?></span>
											</div>
										</div>
									</div>
								
			<div class="col-xs-3"></div>
		<?	
	}
}
?>