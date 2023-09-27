<?php
ini_set('errors_reporting','1');

$mail="taqy_2011@yahoo.com";
$username="moddy12";
$activeline="moddy12584bde91cbc2f";
$mailBody = "Welcome " . strtolower($username) . ",<br/><br/>

                                                            Thank you for choosing " . $ServerName . " Online,<br/>
                                                            We wish you lots of fun at our server for any troubles feel free to contact the GM Staff.<br/>
                                                            Please, click the link below to activate your account.<br/><br/>

                                                            <a href='http://" . $ServerDomain . "/account/activation/" . $activelink . "'>Activate me !</a><br/><br/>

                                                            If the link does not work, please copy this:<br/>
                                                            http://" . $ServerDomain . "/account/activation/" . $activelink . "<br/><br/>

                                                            Thanks, your " . $ServerName . " Team";
				//Mailer function
		       if($func->sendEmail($mailBody,$mail,$username,"Thank You For Registering!"))
			   {
				   echo'<h1 style="color:olive">Mail sent successfully, this mailer is working fine.<h1>';
			   } else {
				   echo'<h1 style="color:red">There is an error.</h1>';
			   }
			  
?>