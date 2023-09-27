<?
if ($sql->Admin($_SESSION['username'],$Gm_Number)){
	
	/** Add item **/
	if ($_GET['sup'] == "add"){
		$ItemCode = $_POST['ItemCode'];
		$ItemName = $_POST['ItemName'];
		$Price	  = $_POST['Price'];
		$ItemSort = $_POST['Sort'];
		$Gender = $_POST['Gender'];
		$Description = $_POST['Description'];
		$MaxPlus = $_POST['MaxPlus'];
		$ItemUQCode = uniqid();
		$time = date('Y-m-d H:i:s');
		
		
		if (!empty ($ItemCode) && ($ItemName) && ($Price) && ($ItemSort) && ($Description) && ($Gender)){
			if (strlen($Description) <= 150){
				if ($sql->QueryHasRows("SELECT * FROM $dbs[SHARD].._RefObjCommon where CodeName128 = '$ItemCode' ")){
					if ($sql->query("INSERT INTO $dbs[WEB].._WebShop values ('$ItemUQCode','$ItemSort','$Gender','$ItemCode','$ItemName','$MaxPlus','$Price','$Description','$time')")){
						$func->AjaxSuccess("Item added successfully to the <a href='/shop'>SHOP</a>!!");
					}
				} else {$func->AjaxError("Item Code is not found!");}
			} else {$func->AjaxError("Description is too long it must be shorter than 150 letters.");}
		} else {$func->AjaxError("All fields are required");}
	}
	
	/** DELETE ITEM FROM SHOP **/
	if($_GET['sup'] == "delete"){
		$ItemID = (int)$_GET['third'];
		$sql->query("delete from $dbs[WEB].._WebShop where ID = '$ItemID'");
		$sql->query("delete from $dbs[WEB].._WebShopCart where ItemShopID = '$ItemID'");
		$func->Notification("Item deleted successfully reloading..","10");
		$func->Reload();
	}
}
?>