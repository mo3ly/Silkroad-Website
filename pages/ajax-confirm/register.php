<?php
if (!isset($_SESSION['LogIn'])){
	
	//Register confirm
	if ($_GET['sup'] == "confirm"){
		
		$username =		    $_POST['username'];
		$password = 		$_POST['password'];
		$password2 = 		$_POST['password2'];
		$mail =		        $_POST['mail'];
		$mail2 =			$_POST['mail2'];
		$rules =		    isset($_POST['rules']) ? true : false;
		$ip = 			    $_SERVER["REMOTE_ADDR"];
		$time = date('Y-m-d H:i:s');
		
		if(!empty ($username) && ($password) && ($password2) && ($mail) && ($mail2)) {
			
				//Captcha
				if($_POST['captcha'] != $_SESSION['captcha_key']){
					$message[] = "Captcha code is wrong.";	 
				} 
		  
				//Rules
				if(!$rules){
					$message[] = "You have to accept rules.";
				} //check accepted or no
				
				//Username
				if(!$func->is_secure($username)) {
					$message[] = "Username contains forbidden letters.";
				} //security function
				
				if (strlen($username)>($UsernameMax) || strlen($username)<($UsernameMin)){
				  $message[] = "Username must be between $UsernameMin and $UsernameMax letters!";	
				} 
				
				if (($sql->QueryHasRows("SELECT StrUserID FROM $dbs[ACC]..[TB_User] WHERE [StrUserID] = '$username'")) || ($sql->QueryHasRows("SELECT Username FROM $dbs[WEB]..[_Users] WHERE [Username] = '$username'")) ){
					$message[] = "This username is already taken."; 
				}
													
				//Password
				if((!$func->is_secure($password)) || (!$func->is_secure($password2))) {
					$message[] = "Password contains forbidden letters."; "<script> Validation('password','error')</script>";
				}
				
				if($password !== $password2) {
					$message[] = "Passwords don't match."; 
				}
							
				if (strlen($password)>$PasswordMax || strlen($password)<$PasswordMin || (strlen($password2)>$PasswordMax || strlen($password2)<$PasswordMin)){
					$message[] = "Password must be between $PasswordMin and $PasswordMax letters!"; 
				}
				
				if(($func->validemail($mail) == false) || ($func->validemail($mail2)) == false) {
					$message[] = "This email is not valid.";
				}
				 
				if($mail !== $mail2) {
					$message[] = "Emails don't match."; 
				}
												 
				if(($sql->QueryHasRows("SELECT Email FROM $dbs[ACC]..[TB_User] WHERE [Email] = '$mail'")) || ($sql->QueryHasRows("SELECT Email FROM $dbs[WEB]..[_Users] WHERE [Email] = '$mail'")))
				{
					$message[] = "This email is already taken.";
				} // Check Email
													
													
	   
		}else{$message[] = "All fields are required.";}
		 
		 
		if(isset($message[0])) {
			
			echo" <div class=\"nk-info-box bg-danger\"><div class=\"nk-info-box-icon\"><i class='ion-information-circled'></i></div>";
			
			//loop messages
			for($i = 0; $i < count($message); $i++)	
			{			
				echo " - ".$message[$i]."<br>";
			}
			
			echo"</div>";
			

		} else if (!isset($message[0])){
			   
				/* Insert Row on web users table*/
				$activelink = uniqid($username);
				$SecurePass = sha1($password);
				$sql->Query("INSERT INTO $dbs[WEB]..[_Users] ([Username], [Password],[SecretCode] , [Question], [Answer], [RecoveryACC], [Email], [RegisterIP], [Status], [ActiveLink],[MainChar],[NickName],[Image],[BlockTimes],[AbleLogin], [LastLogin], [RegisterDate]) VALUES ('$username','$SecurePass','None','None','None','None','$mail','$ip','0','$activelink','noChar','No NickName','/assets/images/avatar-2-sm.jpg','0','0','$time','$time')");
			   
				// If active with email is enabled or disabled
				If ($ActiveWithEmail == false){
				   $messageSucc = "Your account created successfully, <br>Please active it with your email.";
				   $func->Reload();
				   
				   //Mailer message
				   $mailBody = "Welcome " . strtolower($username) . ",<br/><br/>

																Thank you for choosing " . $ServerName . " Online,<br/>
																We wish you lots of fun at our server for any troubles feel free to contact the GM Staff.<br/>
																Please, click the link below to activate your account.<br/><br/>

																<a href='http://" . $ServerDomain . "/account/activation/" . $activelink . "'>Activate me !</a><br/><br/>

																If the link does not work, please copy this:<br/>
																http://" . $ServerDomain . "/account/activation/" . $activelink . "<br/><br/>

																Thanks, your " . $ServerName . " Team";
					//Mailer function
				   $func->sendEmail($mailBody,$mail,$username,"Thank You For Registering!");
				   
				} else {
					$messageSucc = "Your account created successfully, it will be active now.";
					
					echo'<script>
					window.setTimeout(function() {
					window.location="/account/activation/'.$activelink.'";
					}, 2000);
					</script>';
				}
				
				echo" <div class=\"nk-info-box bg-success\"><div class=\"nk-info-box-icon\"><i class='ion-checkmark-circled'></i></div> $messageSucc</div>";
		
		}
	}
	
	/*******************************
			VALIDATION FORM
	*******************************/
	if ($_GET['sup'] == "validation"){
		
			$username =		    $_POST['username'];
			$password = 		$_POST['password'];
			$password2 = 		$_POST['password2'];
			$mail =		        $_POST['mail'];
			$mail2 =			$_POST['mail2'];
			$rules =		    isset($_POST['rules']) ? true : false;
			$ip = 			    $_SERVER["REMOTE_ADDR"];
		
			//Captcha
			if (!empty($_POST['captcha'])){
				if($_POST['captcha'] != $_SESSION['captcha_key']){
					echo "<script> Validation('captcha','error')</script>";
				} else { 
					echo "<script> Validation('captcha','success')</script>";
				}
			}
			
			//Rules
			if(!$rules){
				echo "<script> Validation('rule','error')</script>";
			} else {
				echo "<script> Validation('rule','success')</script>";
			}
			
			//Username
			if (!empty($username)){
				if((!$func->is_secure($username)) || (strlen($username)>($UsernameMax) || strlen($username)<($UsernameMin)) || (($sql->QueryHasRows("SELECT StrUserID FROM $dbs[ACC]..[TB_User] WHERE [StrUserID] = '$username'")) || ($sql->QueryHasRows("SELECT Username FROM $dbs[WEB]..[_Users] WHERE [Username] = '$username'"))) ) {
					echo "<script> Validation('username','error')</script>";
				} else { 
					echo "<script> Validation('username','success')</script>";
				}
			}//End username
			
			//Password
			if (!empty(($password) || ($password2))){
				if(((!$func->is_secure($password)) || (!$func->is_secure($password2))) || ($password !== $password2) || (strlen($password)>$PasswordMax || strlen($password)<$PasswordMin || (strlen($password2)>$PasswordMax || strlen($password2)<$PasswordMin))) {
					echo "<script> Validation('password','error');runPassword('".$password."', 'password')</script>";
					echo "<script> Validation('password2','error');runPassword('".$password."', 'password');</script>";
				} else {
					echo "<script> Validation('password','success');runPassword('".$password."', 'password')</script>";
					echo "<script> Validation('password2','success');runPassword('".$password."', 'password')</script>";
				}
			}//End Password
								
			//Email
			if (!empty (($mail) || ($mail2))){
				if (($func->validemail($mail) == false) || ($func->validemail($mail2) == false) || ($mail !== $mail2) || (($sql->QueryHasRows("SELECT Email FROM $dbs[ACC]..[TB_User] WHERE [Email] = '$mail'")) || ($sql->QueryHasRows("SELECT Email FROM $dbs[WEB]..[_Users] WHERE [Email] = '$mail'"))) ) {
					echo "<script> Validation('mail','error')</script>";
					echo "<script> Validation('mail2','error');</script>";
					
				} else { 
					echo "<script> Validation('mail','success')</script>";
					echo "<script> Validation('mail2','success')</script>";
				}
			}// End email
		
	}
	
}	
?>