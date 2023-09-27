<?php
if(isset($_SESSION['LogIn'])){
	if(isset($_SESSION['CharName'])){
		/**Check char is online or offline**/
		if($sql->CharStatus($_SESSION['CharName']) == "Offline"){
			
			$func->Notification("Your gold added to your game stroage successfully!! ",10);
			$JID = $sql->JID($_SESSION['username']);
			$sql->query("UPDATE $dbs[SHARD].._AccountJID set gold = '100000000' where JID = '$JID'");
			$sql->query("UPDATE $dbs[WEB].._Users set WebBank = '0' where Username = '$_SESSION[username]'");
			$func->Reload();
			
		} else {
			$func->Notification("Sorry your account should be offline to collect gold",10);
		}
	} else {
		$func->Notification("You have to select any of your characters!!",10);
	}
 }
 
?>
