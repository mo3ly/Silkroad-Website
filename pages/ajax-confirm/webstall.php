<?php
if(isset($_SESSION['LogIn'])){
	
	/******************************
		SET CHARACTER FOR STALL
	******************************/
	if ($_GET['sup'] == "setchar"){
		$Charname = $_POST['Charname'];
		
		if (!$sql->CharInUser($_SESSION['username'],$Charname)){
			
			$func->Notification("You don't own this character!","danger");
			
		}else{
			
			$func->Notification("[$Charname] is your stall character!","success");
			$_SESSION['CharName'] = $Charname;
			$func->Reload();
			
		}

	}
	 
	/***********************************
		BUY AN ITEM FROM STALL
	***********************************/
	if ($_GET['sup'] == "BuyItem"){
			$ItemSID = (int)$_GET['third'];
			$Image = $sql->ItemIcon($ItemSID);
			$Sox = $sql->Is_Sox($ItemSID);
			$Str = 
			 '<script>function BuyBtn(ItemID){$("#BuyMsg").load("/webstall/BuyLast/"+ItemID);}</script>
			 <div id="BuyMsg"></div>
			 <div class="slot-back" >
			 <div id="slot" data-itemInfo="1"  style="background-image:url('.$Image.')" >
			 '.$Sox.'
			 </div>
			 </div><br>
			 <span class="h10" style="color:orange">Are you sure you want to buy this <br>item with your character ['.$_SESSION['CharName'].']!?</span><br>
			 <button onclick="BuyBtn('.$ItemSID.');" class="nk-btn link-effect-4">Buy</button>
			 <button onclick="close1();" class="nk-btn link-effect-4">No</button>';
			 $func->Notification($Str,"100");
	}
 
 
 
	/*************************************
		 LAST PURCHASE PROCESS
	*************************************/
	if ($_GET['sup'] == "BuyLast"){
		
	$ItemSID = (int)$_GET['third'];// ItemID
	$Image = $sql->ItemIcon($ItemSID);//Item image
	$Sox = $sql->Is_Sox($ItemSID); // check sox or no
	
	if($sql->QueryHasRows("SELECT * FROM $dbs[WEB].._WebStall where ItemID = '$ItemSID' and CharName != '$_SESSION[CharName]' ")){
	/**Check free space or no **/
	if ($sql->InvCheck ($_SESSION['CharName'])){
	/**Check char is online or offline**/
	if($sql->CharStatus($_SESSION['CharName']) == "Offline"){
		
		 //Get the item data
		 $Qry = $sql->query("SELECT * FROM $dbs[WEB].._WebStall where ItemID = '$ItemSID'");
		 $Data = $sql->QueryFetchArray($Qry);
		 
		 /** Get the price type **/
		 if ($Data['SilkPrice'] == 0){
			$Price = $Data['GoldPrice'];
			$Method = "Gold";
		 } else {
			 $Price = $Data['SilkPrice'];
			 $Method = "Silk";
		 }
		 
		 
		/** Switch price methods **/
		if ($Method == "Gold"){
			
			/** Check enough gold **/
			if ($sql->CharGold($_SESSION['CharName']) > $Price){
				
				/** Notification **/
				$Str = '
					<h6>['.$_SESSION['CharName'].'] Has bought your item from stall for '.number_format($Price).'Gold,<br>
					You can collect the gold from you web stroage <a href="/accout/panel">here</a></h6>
						<div class="slot-back" >
							<div id="slot" data-itemInfo="1"  style="background-image:url('.$Image.')" >
								'.$Sox.'
							</div>
						</div>
					</br>';

				$sql->query("UPDATE $dbs[SHARD].._Char set RemainGold = RemainGold - '$Price' where CharName16 = '$_SESSION[CharName]'");// Take gold

				$StrUserID = $sql->TB_USER($sql->CharID($Data['CharName']),"StrUserID");
				$sql->query("UPDATE $dbs[WEB].._Users set WebBank = WebBank + $Price where Username = '$StrUserID'");
				$sql->query("INSERT INTO $dbs[WEB].._Notifications values ('$Str','Game System','$StrUserID','Un Seen','Un Send',GETDATE())");

				$InventroySlot = $sql->FreeSlot($_SESSION['CharName']);
				$sql->query("UPDATE $dbs[SHARD].._Inventory set ItemID = '$ItemSID' where CharID 
				in (SELECT CHARID FROM SRO_VT_SHARD.._CHAR where charname16 = '$_SESSION[CharName]') and Slot = '$InventroySlot'");

				$sql->query("DELETE FROM $dbs[WEB].._WebStall where ItemID = '$ItemSID'");// Delete the item for stall
				echo $func->Alerts("Your have bought the item successfully!","success");// Successfully bought
				$func->Reload();
		 
		 
			} else { echo $func->Alerts("Sorry, you don't have enough gold to buy this item.","danger");}
		
		/** Purchase silk method **/
		} elseif ($Method == "Silk"){
			
			if ($sql->Silk($_SESSION['username'],1) > $Price){
				/** Notification **/
				$Str = '
					<h6>['.$_SESSION['CharName'].'] Has bought your item from stall for '.number_format($Price).' Silks,<br>
					Your silk added your account.
						<div class="slot-back" >
							<div id="slot" data-itemInfo="1"  style="background-image:url('.$Image.')" >
								'.$Sox.'
							</div>
						</div>
					</br>';
					
				$sql->query("UPDATE $dbs[ACC]..Sk_Silk set silk_own = silk_own - '$Price' where JID in (SELECT JID FROM $dbs[ACC]..TB_user where StrUserID = '$_SESSION[username]') ");// Take silk

				$StrUserID = $sql->TB_USER($sql->CharID($Data['CharName']),"StrUserID");
				$sql->query("UPDATE $dbs[ACC]..Sk_Silk set silk_own = silk_own + $Price  where JID in (SELECT JID FROM $dbs[ACC]..TB_user where StrUserID = '$StrUserID')");
				
				$sql->query("INSERT INTO $dbs[WEB].._Notifications values ('$Str','Game System','$StrUserID','Un Seen','Un Send',GETDATE())");// Send the notification

				$InventroySlot = $sql->FreeSlot($_SESSION['CharName']);
				$sql->query("UPDATE $dbs[SHARD].._Inventory set ItemID = '$ItemSID' where CharID 
				in (SELECT CHARID FROM SRO_VT_SHARD.._CHAR where charname16 = '$_SESSION[CharName]') and Slot = '$InventroySlot'");

				$sql->query("DELETE FROM $dbs[WEB].._WebStall where ItemID = '$ItemSID'");// Delete the item for stall
				echo $func->Alerts("Your have bought the item successfully!","success");// Successfully bought
				$func->Reload();
			
			}else { echo $func->Alerts("Sorry, you don't have enough silk to buy this item.","danger");}
			
		}
	
	} else { echo $func->Alerts("Sorry, your character should be offline.","danger");}
	// If there is no enought space
	} else { echo $func->Alerts("Sorry, you don't have enough space in your inventorty.","danger");}
	//If something went wrong
	} else { echo $func->Alerts("Sorry somthing went wrong please, try again.","danger");}
	 
	}
  
	/******************************
	        ADD ITEM TO STALL
	******************************/
	
	if ($_GET['sup'] == "AddItem"){
			
		$ItemSID = $_GET['third'];
		$Image = $sql->ItemIcon($ItemSID);
		$Sox = $sql->Is_Sox($ItemSID);
		$Script = "<script>
		function AddItemStall()
		{

		$.ajax({
			url: '/webstall/AddItemLast',
			type: 'post',
			data: jQuery('#AddItemStall').serialize(),
			success: function (data) {
				 $('div#AddItem').html(data);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert(JSON.stringify(jqXHR));
			}		
		});
		}
		</script>";
		$Str = ''.$Script.'
		<span class="h10" style="color:orange">Add this to Stall!!</span>
		<div id="AddItem"></div>
		<br><div class="slot-back" >
		<div id="slot" data-itemInfo="1"  style="background-image:url('.$Image.')" >
		'.$Sox.'</div></div>
		
		<form id="AddItemStall" onsubmit="AddItemStall();return false;" method="POST">
		<input type="hidden" name="ItemID" value="'.$ItemSID.'">
			<select placeholder="Gold Price" name="Type" class="form-control">
			<option value="Gold">Gold</option>
			<option value="Silk">Silk</option>
			</select>
		<input type="text" placeholder="Price" name="Price" class="form-control"><br>
		<button type="submit" class="nk-btn link-effect-4">Add</button>
		</form>';
		if ($ItemSID != 0){
		$func->Notification($Str,100);
		}
	}
  
	/**********************************
		ADD ITEM TO STALL FORM
	**********************************/
	if ($_GET['sup'] == "AddItemLast"){
		$ItemID = $_POST['ItemID'];
		$Price = $_POST['Price'];
		$Type = $_POST['Type'];
		$Owner = $_SESSION['CharName'];
		
		/** Check char is online or offline **/
		if($sql->CharStatus($_SESSION['CharName']) == "Offline"){
		
		/** check the price **/
		if($Price <= 0 || !is_numeric($Price) || $Price > $StallMax){
			echo $func->Alerts("Your price cannot be less than 1 or more than $StallMax Gold or Silk.","danger");
		} else {
		 
		/** Price types **/
		if ($Type == "Gold"){$SilkPrice = "0";	$GoldPrice = $Price;}	else	{$SilkPrice = $Price; $GoldPrice = "0";}

		/** Check char is online or offline **/
		if($sql->CharStatus($Owner) == "Online"){
			echo $func->Alerts("Sorry, your character should be offline.","danger");
		}else{
		/** Check item on the stall or no **/
		if ($sql->QueryHasRows("SELECT * FROM $dbs[WEB].._WebStall where ItemID = '$ItemID' ")){
			echo $func->Alerts("Sorry, this item is already on the stall.","danger");
		}else{
		/** Sql Checks **/
		$CheckItem = $sql->query("
		SELECT c.CharName16, c.CharID, ItemType = CASE
		WHEN ((r.CodeName128 like'%DAGGER%') or (r.CodeName128 like '%SPEAR%') or (r.CodeName128 like '%STAFF%') 
		or (r.CodeName128 like '%BOW%') or (r.CodeName128 like '%BLADE%') or (r.CodeName128 like '%SWORD%') 
		or (r.CodeName128 like '%AXE%')) THEN 'Weapon'
		WHEN (r.CodeName128 like '%LIGHT%') or (r.CodeName128 like '%HEAVY%' ) or (r.CodeName128 like '%CLOTH%') THEN 'Set'
		WHEN (r.CodeName128 like'%SHIELD%' )  THEN 'Shield'
		WHEN (r.CodeName128 like'%NECKLACE%') or (r.CodeName128 like'%RING%')THEN 'Accessory'
		ELSE 'Other' 
		END
		FROM $dbs[SHARD].._Inventory i 
		JOIN $dbs[SHARD].._Items it on i.ItemID = it.ID64 
		JOIN $dbs[SHARD].._RefObjCommon r on it.RefItemID = r.ID 
		LEFT JOIN $dbs[SHARD].._RefObjItem ri on r.Link = ri.ID 
		JOIN $dbs[SHARD].._Char c on i.CharID = c.CharID
		WHERE ItemID =  '$ItemID' and ItemID <> 0");
		$Data = $sql->QueryFetchArray($CheckItem);
		$Sort = $Data['ItemType']; // ItemSort
		$CharName = $Data['CharName16'];
		$CharID = $Data['CharID'];

		if ($CharName == $Owner){
		 
		//Add item to stall
		if($sql->query("INSERT INTO $dbs[WEB].._WebStall values ('$Owner','$Sort','$ItemID','$GoldPrice','$SilkPrice','0',GETDATE())")){
		$sql->query("UPDATE $dbs[SHARD].._Inventory set ItemID = 0 where ItemID = '$ItemID' and CharID = '$CharID'");
		echo $func->Alerts('Your item added successfully to the stall.',"success");
		$func->Reload();

		//If an error happen
		} else {echo $func->Alerts("Something went wrong please, try again!","danger"); }

		// If the user don't own the item
		} else {echo $func->Alerts("Sorry you don't own this item!","danger");}
		} 
		}
		}
		// If the character is online
		} else {echo $func->Alerts("Sorry your character must be offline!","danger");}
	}
	
	/**********************************
		DELETE AN ITEM FROM STALL
	**********************************/
	if ($_GET['sup'] == "DeleteItem"){
		$ItemID = $_GET['third']; // ItemID
		
		if($sql->QueryHasRows("SELECT * FROM $dbs[WEB].._WebStall where ItemID = '$ItemID' and CharName = '$_SESSION[CharName]' ")){
			
		if ($sql->InvCheck ($_SESSION['CharName'])){
			
		if	($sql->CharStatus($Owner) == "Offline"){

			$InventroySlot = $sql->FreeSlot($_SESSION['CharName']);
			$sql->query("UPDATE $dbs[SHARD].._Inventory set ItemID = '$ItemID' where CharID in (SELECT CHARID FROM SRO_VT_SHARD.._CHAR where charname16 = '$_SESSION[CharName]')
			and Slot = '$InventroySlot'");
			$sql->query("DELETE FROM $dbs[WEB].._WebStall where ItemID = '$ItemID'");
			echo $func->Notification("<h6 style='color:olive'>Your item deleted successfully!</h6>","10");
			$func->Reload();
			
		// Case char is online
		} else { echo $func->Notification("Sorry, your character should be offline.","10"); } 
		// No enought space
		} else { echo $func->Notification("Sorry, you don't have enough space in your inventorty.","10"); } 
		//If something went wrong
		} else { echo $func->Notification("Sorry somthing went wrong please, try again.","10"); }
	}
	
	
	/*********************************
		ADD AN ITEM TO HOT SECTION
	*********************************/
	if ($_GET['sup'] == "HotItem"){
		$ItemID = $_GET['third'];

		if($sql->QueryHasRows("SELECT * FROM $dbs[WEB].._WebStall where ItemID = '$ItemID' and CharName = '$_SESSION[CharName]' ")){
			
		if($sql->Silk($_SESSION['username'],"silk_own") >= $HotItemPrice){
			
		//if($sql->QueryHasRows("SELECT * FROM $dbs[WEB].._WebStall where ItemID = '$ItemID' and CharName = '$_SESSION[CharName]' and HotItem = '0'")){
			
			$JID = $sql->JID($_SESSION['username']);
			$sql->query("UPDATE $dbs[ACC]..Sk_Silk Set silk_own = silk_own - '$HotItemPrice' where JID = '$JID'");
			$sql->query("UPDATE $dbs[WEB].._WebStall Set HotItem = '1', Date = GETDATE() where ItemID = '$ItemID'");
			echo $func->Notification("<h6 style='color:olive'>Your item become in hot section successfully!</h6>","10");

			$func->Reload();
		//If item on hot class
		//} else {echo $func->Notification("Your item is already in hot section you want to make it again!","10");}
		
		//If the user don't have enough silk
		} else {echo $func->Notification("Sorry you don't have enought silk!","10");}
		
		//If something went wrong
		} else { echo $func->Notification("Sorry somthing went wrong please, try again.","10"); }
	}
 

}
?>
