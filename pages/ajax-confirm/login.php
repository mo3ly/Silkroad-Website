<?php
if (!isset($_SESSION['LogIn'])){
	
    $result = array();
	$username = $_POST['username'];
	$password = $_POST['password'];
	$captcha  = $_POST['captcha'];
	$ip =	    $_SERVER["REMOTE_ADDR"];
	$time =     date('Y-m-d H:i:s');
	
	
	// If login is disabled
	if ($LoginStatus == true)
	{
		$result['msg'] = $func->Alerts("Sorry, Login is disabled.","danger");
		$result['state'] = "error";
		echo json_encode($result);
		exit;
	}
	
	// If username or password are empty
	if(empty($username) && empty($password))
	{
		$result['msg'] = $func->Alerts("Username or Password cannot be Empty","danger");
		$result['state'] = "error";
		echo json_encode($result);
		exit; 
	}
	
	// Check security
	if ((!$func->is_secure($username)) || (!$func->is_secure($username)))
	{
		$result['msg'] = $func->Alerts("Username or password is not correct.","danger");
		$result['state'] = "error";
		echo json_encode($result);
		exit;
	}
	
	//Check If Char is blocked
	$QueryBlock = $sql->Query("SELECT AbleLogin From $dbs[WEB].._Users where Username = '$username'");
	$Data = $sql->QueryFetchArray($QueryBlock);
	$BlockStatus = $Data['AbleLogin'];
	if ($BlockStatus != 0){
		$result['msg'] = $func->Alerts("Your account is blocked!!","danger");
		$result['state'] = "error";
		echo json_encode($result);
		exit;
	}
	
	//Check Active or no
	if($sql->QueryHasRows("select * from $dbs[WEB].._Users where Username='$username' and Status = '0' "))
	{
		$result['msg'] =  $func->Alerts("OPPs!! Your account still not actived with the verification code.<br>If you still didn't recieve your any verification code to your email.
		                                <br>Please, click here to send a new verification code.<br>
										<a href=\"/account/verify\" class=\"nk-btn nk-btn-lg link-effect-4 ready\"<span>Click Me</span></a>","exclamation");
		$result['state'] = "error";
		echo json_encode($result);
		exit;
	}
	
	//Check Failed Login times 
	$LoginFail = count($sql->query("select * from $dbs[WEB]..LoginStatics where IP = '$ip' ")->fetchAll());

	//Show captcha after failed login times
	$CaptchaClasses="
	<span>Captcha <span style='color:red'>*</span></span>
	<input type='text' class='form-control required' id='captcha' title='Captcha is required' placeholder='Captcha' /><br>
	
	<img style='border:1px solid #404040'  src='/pages/others/captcha.php' /><span> Captcha Code </span>
	<div class='nk-gap'></div>";
	
	/** Time format **/
	$q = $sql->query("select TOP 1 * from $dbs[WEB]..LoginStatics  where IP = :ip order by Time desc",array('ip'=>$ip));
	$qr = $q->fetchAll();
	
	$OldTime = count($qr) > 0 ? $func->RemainingTime($qr[0]['Time']) > $FailLoginTime ? 0 : 1 : 0;
	$RemainTime = count($qr) > 0 ?  $func->RemainingTime($qr[0]['Time']) : $FailLoginTime+1 ;
	$Remain_Time = $FailLoginTime - $RemainTime;
		
	/** Show Captcha code after x failed logins **/
	if(($captcha != $_SESSION['captcha_key']) && (($LoginFail == 3) or ($LoginFail == 4)) && $OldTime == 1){
		
		$result['msg'] =  $func->Alerts("Please enter correct Captcha code.","danger");
		$result['capt'] = $CaptchaClasses;
		$result['state'] = "captcha";
		echo json_encode($result);
	    exit;
	} 
	
	/** check failed logins **/
	if($LoginFail >= $FailedLogins){
		
		If ($OldTime == 1) {
			
			$result['msg'] =  $func->Alerts("Sorry, you tried more than <br>$FailedLogins times with wrong account details, <br>Please, wait for $Remain_Time minutes to login again.","danger");
			$result['state'] = "error";
			echo json_encode($result);
			exit;
		
		} else {
			// When the time finish  delete rows from Statics table
			$sql->query("delete from $dbs[WEB]..LoginStatics where IP = '$ip' ");
			$result['msg'] =  $func->Alerts("Please, Could you try again?","danger");
			$result['state'] = "error";
			echo json_encode($result);
			exit;
		}
	}
	
	
	
	
	
	$AccountCheck = count($sql->query("select * from $dbs[WEB].._Users where Username=:User and Password=:Pass",array(':User'=>$username,':Pass'=>sha1($password)))->fetchAll());
	$TB_userCheck = count($sql->query("select * from $dbs[ACC]..TB_user where StrUSerID=:User",array(':User'=>$username))->fetchAll());
	
	// Wrong information
	if(($AccountCheck <= 0) ){
		
		if($LoginFail != 0) {
			$details = "Username or password is not correct ($LoginFail / $FailedLogins)."; 
		} else {
			$details = "Username or password is not correct.";
		}
		
		$result['msg'] =  $func->Alerts("$details","danger");
		$result['state'] = "error";
		$sql->query("INSERT INTO $dbs[WEB]..[LoginStatics] VALUES ('$time','$ip','1')");
		
		echo json_encode($result);
		exit;
	} else if($AccountCheck == 1 && ($TB_userCheck == 1)){

		// Correct information
		$_SESSION['LogIn'] = true;
		$_SESSION['username'] = $username;
		$result['msg'] = $func->Alerts("Welcome, [$_SESSION[username]] loggedin successfully..","success");
		$result['state'] = "success";
		$sql->query("UPDATE $dbs[WEB]..[_Users] LastLogin = '$time' where Username = '$username' ");
		$sql->query("delete from $dbs[WEB]..LoginStatics where IP = '$ip' ");
		
		/** Insert Chars **/
		$Chars = array();
		$counter = 0;
		
		$QryExec = $sql->query("SELECT TOP 4 * FROM $dbs[SHARD].._Char CharTable, $dbs[SHARD].._User UsersTable WHERE CharTable.CharID = UsersTable.CharID AND UsersTable.UserJID=(select JID from $dbs[ACC]..TB_User where StrUserID='$username')");
		while($Data = $sql->QueryFetchArray($QryExec))	
		{		
			$counter++;
			$Chars[$counter]['charid'] = $Data['CharID'];
		}
		foreach($Chars as $Action)
		{
			if (!$sql->QueryHasRows("SELECT * FROM $dbs[WEB].._Chars where CharID = '$Action[charid]' ")){
				$sql->query("INSERT INTO $dbs[WEB].._Chars values ('$Action[charid]','0','0','0','0','0','0','0','0')");
			}
		}
		
		echo json_encode($result);
		exit;
	
	} else {
	
		// Unknown error
		$result['msg'] =  $func->Alerts("Something Went Wrong...","danger");
		$result['state'] = "error";
		echo json_encode($result);
		exit;
	
	}
	
}
?>
