<?php

	
    $password = 		$_POST['password'];
    $password_repeat = 	$_POST['password2'];
    $Secret =		    $_POST['secret'];
	$Secret_Rep =		$_POST['secret2'];
	$Question =		    $_POST['question'];
	$Answer =		    $_POST['answer'];
	$RecoveryAcc =	    $_POST['revacc'];
    
	$ip = 			    $_SERVER["REMOTE_ADDR"];
	$time = date('Y-m-d H:i:s');
    
	if(!empty ($password) && ($password_repeat) && ($Secret) && ($Secret_Rep) ) {

			
                if((!$func->is_secure($password)) || (!$func->is_secure($password_repeat))) {$message[] = "Password contains forbidden letters.";}
				
				    if((!$func->is_secure($Secret)) || (!$func->is_secure($Secret_Rep))) {$message[] = "Secret words contains forbidden letters.";}
						  
                            if($password !== $password_repeat) {$message[] = "Game Passwords don't match.";}
							
							  if($Secret !== $Secret_Rep) {$message[] = "Secret words don't match.";}
							
                                    if (strlen($password)>$GamePasswordMax || strlen($password)<$GamePasswordMin)
									{$message[] = "Game Password must be between $GamePasswordMin and $GamePasswordMax letters!";}
								
							           if (strlen($Secret)>($SecretWordMax) || strlen($Secret)<($SecretWordMin))
								           {$message[] = "Secret must be between $SecretWordMin and $SecretWordMax letters!";}
                                           
   
   }else{$message[] = "All fields are required.";}
 
    // If question and answer enabled
    If ($MoreSecSystem == false)
	{
		
	If (!empty ($RecoveryAcc) && ($Question) && ($Answer)) {
    if(!$func->is_secure($Answer)) {$message[] = "Answer contains forbidden letters.";}
	
	if(!$func->is_secure($RecoveryAcc)) {$message[] = "Recovery account contains forbidden letters.";}
	
	if (!in_array($Question, $RegisterQuestions)) {$message[] = "This question is not included!";}
	
	$CheckRecovery = count($sql->query("select * from $dbs[ACC]..TB_user where StrUSerID=:User",array(':User'=>$RecoveryAcc))->fetchAll());
	If ($CheckRecovery != 1) {$message[] = "This recovery account is not avaliable!";}
	
	if (strlen($Answer)>($AnswerMax) || strlen($Answer)<($AnswerMin))
	 {$message[] = "Answer must be between $AnswerMin and $AnswerMax letters!";}
 
	}else {$message[] = "Please, fill answer box, Recovery account and select the question.";}
    
	} else {
		$Answer = "None";
		$Question = "None";
		$RecoveryAcc = "None";
	}
	 
	 
	// Show the messages
    if(isset($message[0])) {
	   echo" <div class=\"nk-info-box bg-danger\"><div class=\"nk-info-box-icon\"><i class='ion-information-circled'></i></div>";
		for($i = 0; $i < count($message); $i++)	
		{			
			echo " ".$message[$i]."<br>";
		}
		echo"</div>";
		
	    } 
		
	else if (!isset($message[0])) 
	{
		    
			/* Update users table*/
			$Password_last = md5($password);
			$sql->Query("UPDATE $dbs[ACC]..TB_user set Password = '$Password_last' where StrUserID = '$_SESSION[username]' ");
            $sql->Query("UPDATE $dbs[WEB].._Users set SecretCode = '$Secret' , Question = '$Question' , Answer = '$Answer', RecoveryACC = '$RecoveryAcc' where Username = '$_SESSION[username]' ");
            $messageSucc = "Your game password updated successfully, <br>You can login now.";
			$func->Reload();
		    echo" <div class=\"nk-info-box bg-success\"><div class=\"nk-info-box-icon\"><i class='ion-checkmark-circled'></i></div> $messageSucc</div>";
	}


?>