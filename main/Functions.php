<?php

 Class BasicFunctions {
	 
	function validemail($email) {
		
		return filter_var($email,FILTER_VALIDATE_EMAIL);
       
    }
	 
	 /*Time function*/
	function time_ago($datetime, $full = false) {
	
    $now = new DateTime;
    $ago = new DateTime($datetime);
	
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
	
	
	
	/* Mailer function*/
	function sendEmail($body,$to,$username,$subject)
	{  

	require_once 'mailer/PHPMailerAutoload.php';
	//Create a new PHPMailer instance
	$mail = new PHPMailer;
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();

	//Set the hostname of the mail server
	$mail->Host = "smtp.gmail.com";
	// use
	// $mail->Host = gethostbyname('smtp.gmail.com');
	// if your network does not support SMTP over IPv6

	//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
	$mail->Port = 25;

	//Set the encryption system to use - ssl (deprecated) or tls
	$mail->SMTPSecure = 'ssl';
	$mail->SMTPDebug = 4;
	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;

	//Username to use for SMTP authentication - use full email address for gmail
	$mail->Username = "blabla@gmail.com";

	//Password to use for SMTP authentication
	$mail->Password = "password";

	//Set who the message is to be sent from
	$mail->setFrom('blabla@gmail.com', 'Game Support');

	//Set an alternative reply-to address
	$mail->addReplyTo('blabla@gmail.com', 'no-Reply');

	//Set who the message is to be sent to
	$mail->addAddress($to, $username);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->IsHTML(true);
	//send the message, check for errors
	if(!$mail->Send()) {
						 echo "Error sending: " . $mail->ErrorInfo;
				  } else {
						return true;
				 }
	}
	
	
	/* Security functions */
	function is_secure($string)
    {
		/*$pattern = "/[^a-zA-Z0-9]/";
        if(preg_match($pattern,$string)==true)
			return false;
        else*/
            return true;
    }


    /* @usedSession $_SESSION['loggedIn'] */
    function userRedirect($url, $permanent = false)
    {
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
    }

	/* Text Trim function*/
	function text_trim($text, $maxLength, $trimIndicator)
    {
		$maxLength = $maxLength+3;
        if(strlen($text) > $maxLength) {

            $shownLength = $maxLength - strlen($trimIndicator);

            if ($shownLength < 1) {

                throw new \InvalidArgumentException('Second argument for ' . __METHOD__ . '() is too small.');
            }

            preg_match('/^(.{0,' . ($shownLength - 1) . '}\w\b)/su', $text, $matches);                               

            return (isset($matches[1]) ? $matches[1] : substr($text, 0, $shownLength)) . $trimIndicator ;
        }

        return $text;
    }
	 
	
	/*Server Status function*/
	function ServerStatus($IP,$Port)
	{
		$errno = 0;
		$errstr = 0;
		$GwStatus = @fsockopen($IP, $Port, $errno, $errstr, 0.3);
		
		if ($GwStatus){
			$serverStatus = '<span style="color:olive">Online</span>';
		} else {
		    $ServerStatus = '<span style="color:#b31111">Offline</span>';
		}
		return $ServerStatus;	
	}
	
	/*Alerts Function*/
	Function Alerts($string,$type)
	{
		if ($type=="success"){
			$class="success";
			$icon="checkmark";
		} else if ($type=="danger"){
			$class="danger";
			$icon = "alert";
		} else if ($type=="exclamation"){
			$class="main-1";
			$icon="information";
		}
		
		
		return "<div class=\"nk-info-box bg-$class\"><div class=\"nk-info-box-icon\"><i class='ion-$icon-circled'></i></div>
		        <div class=\"nk-info-box-close nk-info-box-close-btn\"><i class=\"ion-android-close\"></i></div> $string </div>";
	}
	
	/*Time remainig function*/
	function RemainingTime($OldTime)
    {
		$now = new DateTime(date('Y-m-d H:i:s'));
		$date_b = new DateTime($OldTime);
		
		$diff = $now->diff($date_b);
		
		return $diff->format('%i');
    }
	 
	/* Reload*/
	public function Reload()
	{
	 echo'   <script>
	         window.setTimeout(function() {
			 window.location.reload();
			 }, 2000);
			 </script>';
	}
	 
	/* Check if file exists or no*/
	Function Files($filename) {
		 if (file_exists(".".$filename."")) {
			 
		 return true;
		 
		 } else {
			 
		 return false;

		 }
	}

	
	
	Public Function Notification($String,$delay)
	{
		$Delays = ($delay * 1000);
		echo"<div class='nk-cookie-alert' style='display: block; opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0); border: 2px solid white;'>
        <span class='nk-cookie-alert-close'> <span onclick='close1();' class='nk-icon-close'></span> </span>
        ".$String."
		<div class='divider'></div>
        <span onclick='close1();' class='nk-cookie-alert-confirm nk-btn link-effect-4 nk-btn-bg-white nk-btn-color-dark-1 pull-right'>Press here to hide me</span>
        </div>
        <script>
        $(document).ready(function() {
        $('.nk-cookie-alert').slideDown('slow');
        window.setTimeout(close1,".$Delays.");
        });
        function close1() {
        $('.nk-cookie-alert').fadeOut(500);
        }
        </script>";
	}
	
	
	/***** Ajax Function *****/
	function AjaxError ($message) {
	$Message = $this->Alerts($message,'danger');
	
	die(json_encode(array(
	'type'     => 'error',
	'response' => $Message,
	)));
	}

	function AjaxSuccess ($message) {
	$Message = $this->Alerts($message,'success');
	
		die(json_encode(array(
		'type'     => 'success',
		'response' => $Message,
		)));
	}
	
	function SelectChar(){
		echo'set char';
	}
	 
 }
 ?>