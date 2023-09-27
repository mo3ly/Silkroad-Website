<?
//log in session
if (isset($_SESSION['LogIn'])){
	
	//If charname is not found
	if(isset($_SESSION['CharName'])){
		//Basics
		$Time = date('Y-m-d H:i:s');//Time
		$IP   = $_SERVER['REMOTE_ADDR'];//IP
		$Action = $_GET['sup'];
		
		/****************************
				PURCHASE MODAL
		****************************/
		if ($Action == "buy"){
			$ItemID = (int)$_GET['third'];
			$QueryItem = "SELECT * FROM $dbs[WEB].._WebShop where ID = '$ItemID'";
			if ($sql->QueryHasRows($QueryItem)){
				$QueryExec = $sql->query($QueryItem);
				$Data = $sql->QueryFetchArray($QueryExec);
				$Buy = '<span style="color:orange" class="h6">Are you sure you <br> want to buy this item?</span><br>
						<div id="BuyResult"></div>
						<div class="slot-back">
							<div id="slot" data-iteminfo="1" style="background-image:url('.$sql->ItemIcon($Data['ItemCode'],true).')">
								'.$sql->Is_Sox($Data['ItemCode'],true).'
							</div>
						</div>
						<div class="nk-gap"></div>
						<form id="ShopBuyForm" onsubmit="Submetor(\'/shopaction/lastbuy\',\'BuyResult\',\'ShopBuyForm\'); return false;" method="POST">
							<input type="number" class="form-control" name="amount" placeholder="Quantity" /><br>
							<input type="hidden" name="ItemID" value="'.$Data['ID'].'" />
							<button class="nk-btn nk-btn-md nk-btn-color-main-1 nk-btn-block link-effect-4" type="submit"><span>Yes</span></button>
						</form>
							<button class="nk-btn nk-btn-md nk-btn-block link-effect-4" onclick="close1();"><span>No</span></button>';
				$func->Notification($Buy,"150");
			} else {
				$func->Notification("There is an error happened!","10");
			}
		}
		
		/******************************
				PURCHASE CONFIRM
		******************************/
		if ($Action == "lastbuy"){
			$ItemID = (int)$_POST['ItemID'];
			$Quantity = (int)$_POST['amount'];
			//Amount
			if (empty($Quantity) || ($Quantity < 0)){ 
				$Amount =  $Amount = 1;
			} else {
				$Amount = $Quantity;
			}
			
			$QueryItem = "SELECT * FROM $dbs[WEB].._WebShop where ID = '$ItemID'";//Item Query
			//Check item
			if ($sql->QueryHasRows($QueryItem)){
				$QueryExec = $sql->query($QueryItem);
				$Data = $sql->QueryFetchArray($QueryExec);
				
				$TotalPrice = ($Data['Price'] * $Amount);//Total amount
				$Price = $Data['Price'];//Price for each item
				$CodeName = $Data['ItemCode']; //Item Code
				$Plus = $Data['MaxPlus']; //Item plus
				$UserPoints = $sql->UserPoints($_SESSION['username'],"Web");//Web points
				
				/**Check char is online or offline**/
				if($sql->CharStatus($_SESSION['CharName']) == "Offline"){
					/**	Check web points **/
					if ($UserPoints > $TotalPrice){
						//Check free space or no
						if ($sql->InvCheck ($_SESSION['CharName'])){
							
							//Loop purchase progress
							for ($x = 1; $x <= $Amount; $x++){
								//Check free space or no
								if ($sql->InvCheck ($_SESSION['CharName'])){
									
									$InventroySlot = $sql->FreeSlot($_SESSION['CharName']);
										
										if($sql->query("exec $dbs[SHARD].._ADD_ITEM_EXTERN '$_SESSION[CharName]','$CodeName','1','0'")){
											//Update Web points
											$sql->query("UPDATE $dbs[WEB]..SK_Points set WebPoints = WebPoints - '$Price' where JID in (SELECT JID FROM $dbs[ACC]..TB_User WHERE StrUserID = '$_SESSION[username]')");
											//Log
											$sql->query("INSERT INTO $dbs[WEB].._WebShopLogs VALUES ('$_SESSION[CharName]','$Price','$Plus','$Data[ID]','$CodeName','$IP','$Time')");
										}
								
								// If there is no enought space
								} else { 
									echo $func->Alerts("You have bought $x items(s) for ".$Price * $x." WebPoints, there isn't enought space on your inventory to continue.","danger");
									$func->Reload();//Reload the page
									break;
								}
								
								//Success message
								if (($x == $Amount) && ($sql->InvCheck ($_SESSION['CharName']))){
									echo $func->Alerts("You have bought $Amount item(s) successfully, for $TotalPrice WebPoints, Your currect balance ".($UserPoints - $TotalPrice)." WebPoint(s).","success");
									$func->Reload();//Reload the page
								}
								
							}
							
						// If there is no enought space
						} else { echo $func->Alerts("You don't have enought space to buy this item!","danger");}
					//Check Web points
					} else { echo $func->Alerts("Sorry you have only $UserPoints WebPoint(s), you still need ".($TotalPrice - $UserPoints)." WebPoint(s)!","danger");}
				//If the character is online
				} else { echo $func->Alerts("Sorry somthing went wrong please, try again.","danger");}
			//If something went wrong
			} else { $func->Notification("There is an error happened!","10");}
		}
		
		
		/***************************************
					ADD AN ITEM TO CART
		***************************************/
		if ($Action == "cartadd"){
			$ItemID = (int)$_GET['third'];
			$QueryItem = "SELECT * FROM $dbs[WEB].._WebShop where ID = '$ItemID'";
			if ($sql->QueryHasRows($QueryItem)){
				$QueryExec = $sql->query($QueryItem);
				$Data = $sql->QueryFetchArray($QueryExec);
				$Cart = '<span style="color:orange" class="h6">Add Item to the cart!!</span><br>
						<div id="CartResult"></div>
						<div class="slot-back">
							<div id="slot" data-iteminfo="1" style="background-image:url('.$sql->ItemIcon($Data['ItemCode'],true).')">
								'.$sql->Is_Sox($Data['ItemCode'],true).'
							</div>
						</div>
						<div class="nk-gap"></div>
						<form id="AddCartForm" onsubmit="Submetor(\'/shopaction/cartlast\',\'CartResult\',\'AddCartForm\'); return false;" method="POST">
							<input type="number" class="form-control" name="amount" placeholder="Quantity" /><br>
							<input type="hidden" name="ItemID" value="'.$Data['ID'].'" />
							<button class="nk-btn nk-btn-md nk-btn-color-main-1 nk-btn-block link-effect-4" type="submit"><span><b class="fa fa-cart-plus"></b> Add</span></button>
						</form>';
				$func->Notification($Cart,"150");
			} else {
				$func->Notification("There is an error happened!","10");
			}
		}
		
		
		/**************************************
				ADD ITEM TO CART PROGRESS
		**************************************/
		if ($Action == "cartlast"){
			$ItemID = (int)$_POST['ItemID'];
			$Quantity = (int)$_POST['amount'];
			//Amount
			if (empty($Quantity) || ($Quantity < 0)){ 
				$Amount =  $Amount = 1;
			} else {
				$Amount = $Quantity;
			}
			
			$QueryItem = "SELECT * FROM $dbs[WEB].._WebShop where ID = '$ItemID'";//Item Query
			//Check item
			if ($sql->QueryHasRows($QueryItem)){
				$QueryExec = $sql->query($QueryItem);
				$Data = $sql->QueryFetchArray($QueryExec);
				$TotalPrice = $Amount * $Data['Price'];
				if(!$sql->QueryHasRows("SELECT * FROM $dbs[WEB].._WebShopCart where ItemShopID = '$ItemID' and CharName = '$_SESSION[CharName]' ")){
					
					if ($sql->query("INSERT INTO $dbs[WEB].._WebShopCart VALUES ('$_SESSION[CharName]','$ItemID','$Amount','$TotalPrice','$Time')")){
						echo $func->Alerts("Your item added to cart successfully!","success");
						echo "<script>  $('#ShopCart').modal('show'); close1(); Submetor('/shopaction/loadcart','LoadCart','none','true');</script>" ;
					}
					
					
				} else { echo $func->Alerts("This item already on your cart!!","danger");}
				
			//If somting went wrong!!
			} else { $func->Notification("There is an error happened!","10"); }
		}	
		
		
		/**************************************
				DELETE AN ITEM FROM CART
		**************************************/
		if ($Action == "deletecart"){
			$ItemID = (int)$_GET['third'];
			
				if($sql->QueryHasRows("SELECT * FROM $dbs[WEB].._WebShopCart where ItemShopID = '$ItemID' and CharName = '$_SESSION[CharName]' ")){
					
						$sql->query(" DELETE FROM $dbs[WEB].._WebShopCart WHERE ItemShopID = '$ItemID' and CharName = '$_SESSION[CharName]' ");
						echo "<script> Submetor('/shopaction/loadcart','LoadCart','none'); </script>";
					  
				} else {$func->Notification("There is an error, please try again!!","10");}
				
		}	
	
	
		/**************************************
				COUNT CART ITEMS
		**************************************/
		if ($Action == "countcart"){
			$Qary = $sql->query("SELECT SUM (Quantity) as TotalItems FROM $dbs[WEB].._WebShopCart where CharName = '$_SESSION[CharName]'");
			$Data = $sql->QueryFetchArray($Qary);
			$Number = $Data['TotalItems'];
			if ($Number != 0){
				echo'<span class="nk-badge">'.$Number.'</span>';
			} else {
				echo'';
			}
		}
		
		/*************************************
					LOAD THE CART
		*************************************/
		if ($Action == "loadcart"){
			$LogQuery = "SELECT  
						_WebShopCart.CharName,
						_WebShopCart.Quantity,
						_WebShop.ItemName,
						_WebShop.ItemCode,
						_WebShopCart.TotalPrice,
						_WebShopCart.ItemShopID 
						FROM 
						EPIC_WEBSITE.._WebShopCart
						INNER JOIN EPIC_WEBSITE.._WebShop ON _WebShopCart.ItemShopID = _WebShop.ID
						where CharName = '$_SESSION[CharName]'";
			$query = $sql->Query($LogQuery);
			
			$Logs = 1;
			
			if($sql->QueryHasRows($LogQuery)){
			?>
			
			<div style="height: 270px;overflow-y: auto;">
				<div class="table-responsive">
					<table class="table">
							<thead>
							<tr>
								<th><h5>& </h5></th>
								<th><h5>Item</h5></th>
								<th><h5>Name</h5></th>
								<th><h5>Price</h5></th>
								<th><h5>Quantity</h5></th>
								<th><h5></h5></th>
							</tr>
							</thead>
						<tbody>
				
						
						<?php
						while ($Data = $sql->QueryFetchArray($query)) {
						?>
							 
							<tr>
								
								<td><h6><?= $Logs; ?></td>
								<td>
									<div class="slot-back" style="margin-top:-10px">
									<div id="slot" data-iteminfo="1" style="background-image:url(<?= $sql->ItemIcon($Data['ItemCode'],true);?>)">
										<?= $sql->Is_Sox($Data['ItemCode'],true);?>
									</div>
								</div>
								</td>
								
								<td><h6><?= $Data['ItemName']; ?></h6></td>
								<td><h6><?= number_format($Data['TotalPrice']); ?> WP(s)</h6></td>
								<td><h6><?= $Data['Quantity']; ?> Unit(s)</td>
								<td><h6><b onclick="Submetor('/shopaction/deletecart/<?= $Data['ItemShopID'];?>','DeleteCartResult','none')" class="pointer ion-trash-b"></b></h6></td>
								
						  </tr>
						<?php
						  $Logs++;
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
			<?php
				$QueryQuantity = $sql->query("SELECT SUM (_WebShopCart.TotalPrice) as Total FROM $dbs[WEB].._WebShopCart where CharName = '$_SESSION[CharName]'");
				$Row = $sql->QueryFetchArray($QueryQuantity);
				$Total = $Row['Total'];
			?>
			<div class="divider"></div>
			<h5>Total : <?= number_format($Total);?> WebPoint(s)</h5> <button class="nk-btn nk-btn-md link-effect-4" onclick="Submetor(<?= $Data['ID'];?>);"><span>Check out</span></button>
			<?
			} else {
				echo'<center><div class="nk-gap-1"></div><h3>Your cart is empty.</h3><div class="nk-gap-1"></div></center>';
			}
	}
	?>
		
	<?
		//If there is no Character
	} else { $func->Notification("You have to select one of your characters!","10");} 
}
?>