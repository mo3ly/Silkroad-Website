<?php
$error = NULL;
$success = NULL;

$ActivationCode = $_GET['third'];

if($func->is_secure($ActivationCode)){
	
    $qry = "SELECT * FROM $dbs[WEB]..[_Users] WHERE ([ActiveLink] = '$ActivationCode')";
     if ($sql->QueryHasRows($qry) == true) {
	   $Query = $sql->Query($qry);
        $data = $sql->QueryFetchArray($Query);
		
         if($data['Status'] == 0){
            if($data['ActiveLink'] === $ActivationCode){
				
				$password = "unset";
                $email = $data['Email'];
				$username = $data['Username'];
				
				// Insert the values on TB_user
                $sql->Query("INSERT INTO $dbs[ACC]..[TB_User] ([StrUserID], [password], [sec_primary], [sec_content], [Email])  VALUES ('$username', '$password', '3', '3', '$email')");
                $sql->Query("UPDATE $dbs[WEB]..[_Users] SET [Status] = '1' ,[ActiveLink] = 'Actived' WHERE [ActiveLink] = '$ActivationCode' ");
				$sql->Query("INSERT INTO $dbs[ACC]..[SK_Silk] (JID, silk_own, silk_gift, silk_point) VALUES((SELECT JID from  $dbs[ACC]..TB_User where StrUserID = '$username'), '$startSilk', '0', '0')");
				$sql->Query("INSERT INTO $dbs[WEB]..[SK_Points] (JID, WebPoints, VotePoints) VALUES ((SELECT JID from  $dbs[ACC]..TB_User where StrUserID = '$username'), '0', '0')");
				
                $success = $func->Alerts("Your account [ $username ] actived successfully, <br>you can login to set you game password now !","success");
				
				// if auto login is enabled
				If ($AutoLogin == false){
					$_SESSION['LogIn'] = true;
		            $_SESSION['username'] = $username;
					$sql->query("UPDATE $dbs[WEB]..[_Users] LastLogin = '$time' where Username = '$username' ");
					$func->userRedirect('/',false);
				}
				
            }else{$error = $func->Alerts("Please check your activation code again.","danger");}
        }else{$error = $func->Alerts("Your Account is already actived.","exclamation");}
    }else{$error = $func->Alerts("Sorry this activation code is not valid.","danger");}
}else{$error = $func->Alerts("Sorry this code contains forbidden letters.","danger");}
?>
<div class="nk-gap-6"></div>
<center><h3>Account Activation</h3></center>
<div class="nk-gap-3"></div>

<div class="container">

<div class="col-md-12">

    <?php
    if(isset($error)){
        ?>
        <div class="col-md-8 offset-md-2 ">
            <?= $error; ?>
			 <a href = "/" class="nk-btn nk-btn-lg link-effect-4">
                                <span>Home page</span>
                  </a>
        </div>
		
    <?php
    }
    if(isset($success)){
        ?>
        <div class="col-md-8 offset-md-2 ">
            <?= $success; ?>
			<a href = "/" class="nk-btn nk-btn-lg link-effect-4">
                                <span>Home page</span>
                  </a>
        </div>
    <?php
    }
    ?>
	
</div>


</div>
<div class="nk-gap-6"></div>
<div class="nk-gap-2"></div>