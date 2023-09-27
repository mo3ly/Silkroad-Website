<?php
if (isset($_SESSION['LogIn'])){
	$time = date('Y-m-d H:i:s');
	    
	/** GAME PASSWORD **/
	if($_GET['third'] == "gamepassword"){
		
		$OldPass 	= md5($_POST['oldpass']);
		$SecretWord = $_POST['secretword'];
		$NewPass 	= $_POST['newpass'];
		$NewPass2 	= $_POST['newpass2'];
		
		$Query = $sql->query("SELECT * FROM $dbs[WEB].._Users where Username = '$_SESSION[username]'");
		$Data = $sql->QueryFetchArray($Query);
		$SecretCode = $Data['SecretCode'];
		
		$QueryPassword = $sql->query("SELECT password FROM $dbs[ACC]..TB_User where StrUserID = '$_SESSION[username]'");
		$Row = $sql->QueryFetchArray($QueryPassword);
		$OldPassword = $Row['password'];
		
		if(($func->is_secure($NewPass)) || ($func->is_secure($NewPass2))) {
			if ($OldPassword != "unset"){
				if ($SecretWord == $SecretCode){
					if ($OldPass == $OldPassword){
						if (strlen($NewPass)>=$PasswordMax || strlen($NewPass)<=$PasswordMin){
							$func->AjaxError("New passwords must be between $PasswordMin and $PasswordMax letters!!");
						}else{
							if ($NewPass === $NewPass2){
								
								$LastPass = md5($NewPass);
								$sql->query("UPDATE $dbs[ACC]..TB_User set password = '$LastPass' where StrUserID = '$_SESSION[username]'");
								$func->AjaxSuccess("Your game password changed successfully");
								
								
							}else{$func->AjaxError("New passwords are not matched!");}
						}
					}else{$func->AjaxError("Old password is not correct");}
				} else {$func->AjaxError("Secert word is not correct!");}
			}else{$func->AjaxError("You have to set you game password first!");}
		}else{$func->AjaxError("Password contains forbidden letters!");}
	}
	
	
	/** WEBSITE PASSWORD **/
	if($_GET['third'] == "webpassword"){
		
		$OldWebPass 	= sha1($_POST['oldwebpass']);
		$SecretWord		= $_POST['secretwordweb'];
		$NewWebPass 	= $_POST['newwebpass'];
		$NewWebPass2 	= $_POST['newwebpass2'];
		
		$Query = $sql->query("SELECT * FROM $dbs[WEB].._Users where Username = '$_SESSION[username]'");
		$Data = $sql->QueryFetchArray($Query);
		$SecretCode = $Data['SecretCode'];
		$OldWebPassword = $Data['Password'];
		
		if(($func->is_secure($NewWebPass)) || ($func->is_secure($NewWebPass2))) {
			if ($SecretWord == $SecretCode){
				if ($OldWebPass == $OldWebPassword){
					if (strlen($NewWebPass)>$PasswordMax || strlen($NewWebPass)<$PasswordMin){
						$func->AjaxError("New passwords must be between $PasswordMin and $PasswordMax letters!!");
					}else{
						if ($NewWebPass === $NewWebPass2){
							
							$LastWebPass = sha1($NewWebPass);
							$sql->query("UPDATE $dbs[WEB].._Users set Password = '$LastWebPass' where Username = '$_SESSION[username]'");
							$func->AjaxSuccess("Your web password changed successfully");
							
							
						}else{$func->AjaxError("New passwords are not matched!");}
					}
				}else{$func->AjaxError("Old web password is not correct");}
			} else {$func->AjaxError("Secert word is not correct!");}
		} else {$func->AjaxError("Password contains forbidden letters!");}
	}
	
	/** EMAIL **/
	if($_GET['third'] == "email"){
		
		$OldEmail 	= $_POST['OldEmail'];
		$SecretWord = $_POST['SecretWordEmail'];
		$NewEmail 	= $_POST['NewEmail'];
		$NewEmail2 	= $_POST['NewEmail2'];
		
		$Query = $sql->query("SELECT * FROM $dbs[WEB].._Users where Username = '$_SESSION[username]'");
		$Data = $sql->QueryFetchArray($Query);
		$SecretCode = $Data['SecretCode'];
		$DataEmail = $Data['Email'];
		
		if(($func->is_securemail($NewEmail)) || ($func->is_securemail($NewEmail2))) {
			if ($SecretWord == $SecretCode){
				if ($OldEmail == $DataEmail){
						if ($NewEmail === $NewEmail2){
							if($func->validemail($NewEmail)){
								if(!$sql->QueryHasRows("SELECT * FROM $dbs[WEB].._Users where Email = '$NewEmail' ")){
									if(!$sql->QueryHasRows("SELECT * FROM $dbs[ACC]..TB_User where Email = '$NewEmail' ")){
							
										$sql->query("UPDATE $dbs[ACC]..TB_User set Email = '$NewEmail' where StrUserID = '$_SESSION[username]'");
										$sql->query("UPDATE $dbs[WEB].._Users set Email = '$NewEmail' where Username = '$_SESSION[username]'");
										$func->AjaxSuccess("Your email changed successfully");
										
									}else{$func->AjaxError("This email is already taken!");}
								}else{$func->AjaxError("This email is already taken!");}
							}else{$func->AjaxError("This email is not valid!");}
						}else{$func->AjaxError("New emails are not matched!");}
				}else{$func->AjaxError("Your old email is not correct!");}
			} else {$func->AjaxError("Secert word is not correct!");}
		} else {$func->AjaxError("Email contains forbidden letters!");}
	}
	
	/** SECRET	WORD **/
	if($_GET['third'] == "secret"){
		
		$OldSecret	    = $_POST['OldSecret'];
		$NewSecret 		= $_POST['NewSecret'];
		$NewSecret2 	= $_POST['NewSecret2'];
		
		$Query = $sql->query("SELECT * FROM $dbs[WEB].._Users where Username = '$_SESSION[username]'");
		$Data = $sql->QueryFetchArray($Query);
		$SecretCode = $Data['SecretCode'];
		
		
			if ($OldSecret == $SecretCode){
				if(($func->is_secure($NewSecret)) || ($func->is_secure($NewSecret2))) {
					if (strlen($NewSecret)>=$SecretWordMax || strlen($NewSecret)<=$SecretWordMin){
						$func->AjaxError("New secretword must be between $SecretWordMin and $SecretWordMax letters!!");
					}else{
						if ($NewSecret === $NewSecret2){
							
							$sql->query("UPDATE $dbs[WEB].._Users set SecretCode = '$NewSecret' where Username = '$_SESSION[username]'");
							$func->AjaxSuccess("Your secret word changed successfully");
							
							
						}else{$func->AjaxError("Secretwords are not matched!");}
					}
				}else{$func->AjaxError("Secret words contains forbidden letters.");}
			} else {$func->AjaxError("Old Secert word is not correct!");}
	}
}
?>
