<?php
if(isset($_SESSION['LogIn'])){$func->userRedirect("/",false);}
if($RegisterStatus == false){
?>

<script>
var m_strUpperCase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
var m_strLowerCase = "abcdefghijklmnopqrstuvwxyz";
var m_strNumber = "0123456789";
var m_strCharacters = "#@!$&*";


function checkPassword(strPassword)
{
    // Reset combination count
    var nScore = 0;

    // Password length
    // -- Less than 4 characters
    if (strPassword.length < 5)
    {
        nScore += 5;
    }
    // -- 5 to 7 characters
    else if (strPassword.length > 4 && strPassword.length < 8)
    {
        nScore += 10;
    }
    // -- 8 or more
    else if (strPassword.length > 7)
    {
        nScore += 25;
    }

    // Letters
    var nUpperCount = countContain(strPassword, m_strUpperCase);
    var nLowerCount = countContain(strPassword, m_strLowerCase);
    var nLowerUpperCount = nUpperCount + nLowerCount;
    // -- Letters are all lower case
    if (nUpperCount == 0 && nLowerCount != 0) 
    { 
        nScore += 10; 
    }
    // -- Letters are upper case and lower case
    else if (nUpperCount != 0 && nLowerCount != 0) 
    { 
        nScore += 20; 
    }

    // Numbers
    var nNumberCount = countContain(strPassword, m_strNumber);
    // -- 1 number
    if (nNumberCount == 1)
    {
        nScore += 10;
    }
    // -- 3 or more numbers
    if (nNumberCount >= 3)
    {
        nScore += 20;
    }

    // Characters
    var nCharacterCount = countContain(strPassword, m_strCharacters);
    // -- 1 character
    if (nCharacterCount == 1)
    {
        nScore += 10;
    }   
    // -- More than 1 character
    if (nCharacterCount > 1)
    {
        nScore += 25;
    }

    // Bonus
    // -- Letters and numbers
    if (nNumberCount != 0 && nLowerUpperCount != 0)
    {
        nScore += 2;
    }
    // -- Letters, numbers, and characters
    if (nNumberCount != 0 && nLowerUpperCount != 0 && nCharacterCount != 0)
    {
        nScore += 3;
    }
    // -- Mixed case letters, numbers, and characters
    if (nNumberCount != 0 && nUpperCount != 0 && nLowerCount != 0 && nCharacterCount != 0)
    {
        nScore += 5;
    }


    return nScore;
}

// Runs password through check and then updates GUI 


function runPassword(strPassword, strFieldID)
{
    // Check password
    var nScore = checkPassword(strPassword);


     // Get controls
        var ctlText = document.getElementById(strFieldID + "_text");
        if (!ctlText)
            return;

    // Color and text
    // -- Very Secure
    if (nScore >= 90)
    {
        var strText = "( Very Secure &#128526; )";
        var strColor = "#0ca908";
    }
    // -- Secure
    else if (nScore >= 80)
    {
        var strText = "( Secure &#128515; )";
        vstrColor = "#7ff67c";
    }
    // -- Very Strong
    else if (nScore >= 70)
    {
        var strText = "( Very Strong &#128522; )";
        var strColor = "#008000";
    }
    // -- Strong
    else if (nScore >= 60)
    {
        var strText = "( Strong &#128558; )";
        var strColor = "#006000";
    }
    // -- Average
    else if (nScore >= 40)
    {
        var strText = "( Average &#128553; )";
        var strColor = "#e3cb00";
    }
    // -- Weak
    else if (nScore >= 20)
    {
        var strText = "( Weak &#128566; )";
        var strColor = "#Fe3d1a";
    }
    // -- Very Weak
    else
    {
        var strText = "( Very Weak &#128545; )";
        var strColor = "#e71a1a";
    }

    if(strPassword.length <= 1)
    {
		ctlText.style.backgroundColor  = "";
		ctlText.innerHTML =  "";
    }
else
    {
   // ctlText.style.foreColor  = strColor;
    ctlText.innerHTML =  strText;
}
}

// Checks a string for a list of characters
function countContain(strPassword, strCheck)
{ 
    // Declare variables
    var nCount = 0;

    for (i = 0; i < strPassword.length; i++) 
    {
        if (strCheck.indexOf(strPassword.charAt(i)) > -1) 
        { 
                nCount++;
        } 
    } 

    return nCount; 
} 




/************************/


function Validation(Name,Type){ 

	if (Type == 'success'){
		$("input[name*='"+Name+"']").addClass("nk-success").removeClass("nk-error");
	} else if (Type == 'error') {
		$("input[name*='"+Name+"']").addClass("nk-error").removeClass("nk-success");
	} else {
		$("input[name*='"+Name+"']").addClass("nk-error");
	}
}

function RegisterAction()
{
	
	$("div#RegisterAction").html(" <div class='nk-preloader-animation'></div>");
	
	$.ajax({
		url: '/regconfirm/confirm',
		type: 'post',
	    data: jQuery('#registerForm').serialize(),
		success: function (data) {
		    $('div#RegisterAction').html(data);
		},		
	});
}

function RegisterValidation()
{
	
	$.ajax({
		url: '/regconfirm/validation',
		type: 'post',
	    data: jQuery('#registerForm').serialize(),
		success: function (data) {
		    $('div#RegisterValidation').html(data);
		},
	});
}
</script>
<style>
.nk-success{
	color: #27791f !important;
    border-color: #27791f !important;
}
</style>
<div class="nk-gap-3"></div>
	<div class="container">
	  <div class="nk-box-2 bg-dark-1">
		<div class="row vertical-gap">
		<div class="col-md-6">
				
				
				<h3>Register!</h3>
				<div class="nk-gap"></div>	
				<form name="RegForm" id="registerForm" onsubmit="RegisterAction();return false;" method="POST">
					
					<!-- RESULTS -->
					<div class="row">
						<div class="col-xs-12">
							<div  id="RegisterAction" ></div>
							<div  id="RegisterValidation" ></div>
						</div>
					</div> 
					
					<!-- USERNAME -->   
					<div class="row">
						<div class="col-xs-12">
							<span>Username <span style="color:red">*</span></span>
								<input type="text" onkeyup="RegisterValidation()" class="form-control" placeholder="Username" name="username" autocomplete="off" />
							<div class="nk-gap"></div>
						</div>
					</div>
					
				    <!-- WEBSITE PASSWORD -->
					<div class="row">
						<div class="col-sm-6">
							<span>Password <span id="password_text"></span> <span style="color:red" >*</span></span>
								<input onkeyup="RegisterValidation()" type="password" class="form-control" placeholder="*********" name="password" />
							<div class="nk-gap"></div>
						</div>
						
						<div class="col-sm-6">
							<span>Repeat Password <span style="color:red">*</span></span>
								<input onkeyup="RegisterValidation()" type="password" class="form-control" placeholder="*********" name="password2" />
							<div class="nk-gap"></div>
						</div>
					</div>
				
					<!-- EMAIL --> 
					<div class="row">
						<div class="col-sm-6">
						  <span>Email <span style="color:red">*</span></span>
							  <input onkeyup="RegisterValidation()" type="text" class="form-control"  placeholder="example@mail.com" name="mail"  autocomplete="off" />
						  <div class="nk-gap"></div>
						</div>
					 
						<div class="col-sm-6">
						 <span>Email Repeat <span style="color:red">*</span></span>
							  <input onkeyup="RegisterValidation()" type="text" class="form-control" placeholder="example@mail.com" name="mail2"  autocomplete="off" />
						  <div class="nk-gap"></div>
						</div>
					</div>
					
				    <!-- CAPTCHA -->
					<div class="row">
						<div class="col-sm-6">
							<span>Captcha <span style="color:red">*</span></span>
								<input onkeyup="RegisterValidation()" type="text" id="CaptchaBox" class="form-control" placeholder="Captcha" name="captcha" autocomplete="off" />
							<div class="nk-gap"></div>
						</div>
				 
						<div class="col-sm-6">
							 <span style="cursor:pointer" onclick="Captcha();">Reload Code <b class="fa fa-refresh refreshIconCaptcha"></b></span>
								<img style="border:1px solid #404040;border-radius: 0;" id='CaptchaImage' src='/pages/others/captcha.php' />
							 <div class="nk-gap"></div>
						</div>
					</div>
					 
					<!-- RULES -->
					<div class="row">
						<div class="col-sm-12">
								<label class="create-account custom-control custom-checkbox" >
									<input class="input-checkbox custom-control-input" type="checkbox" name="rules" value="rules">
									<span class="custom-control-indicator"></span>
									<span>I have read the <a href="/rules" target="_blank">rules</a>, and I agree to them.</span>
								</label><br>
								<div class="nk-gap"></div>
						</div>
					</div> 
					
					<!-- SUBMIT -->
					<div class="row">
						<div class="col-sm-12">
							<button type="submit" class="nk-btn nk-btn-lg link-effect-4">
										<span>Register</span>
							</button>
						</div>
					</div>
					
					<!-- HAVE AN ACCOUNT -->
					<div class="nk-gap-2"></div>
					<div class="row">
						<div class="col-sm-12">
							<div>Already Signed Up? Click <a class="text-red" data-toggle="modal" data-target="#LoginModel" href="#">Sign In</a> to login your account.</div>
						</div>
					</div>
					
				</form>
			</div>		

			<!-- TITLES -->
			<div class="col-md-6 hidden-sm-down">
					<h3>Register Page!</h3>
					<div class="nk-gap"></div>				
					<h6>1. Our Game Rules.<h6>
					   <em style="color:olive">by register you have to accept all rules.</em>
					<br>
					
					<h6>2. Our Game Rules.<h6>
					   <em style="color:olive">by registering here you have to accept all rules.</em>
					<br>
					
					<h6>3. Our Game Rules.<h6>
					   <em style="color:olive">by registering here you have to accept all rules.</em>
					<br>
					
					<h6>4. Our Game Rules.<h6>
					   <em style="color:olive">by registering here you have to accept all rules.</em>
					<br>
					
					<h6>5. Our Game Rules.<h6>
					   <em style="color:olive">by registering here you have to accept all rules.</em>
					<br>
					
					<h6>6. Our Game Rules.<h6>
					   <em style="color:olive">by registering here you have to accept all rules.</em>
					<br>
					
					<h6>7. Our Game Rules.<h6>
					   <em style="color:olive">by registering here you have to accept all rules.</em>
					<br>
					
					<h6>8. Our Game Rules.<h6>
					   <em style="color:olive">by registering here you have to accept all rules.</em>
					<br>
			</div>    
    
		</div>
	</div>
</div>
   
<? } else { ?>

	<!-- REGISTER DISABLES -->
	<div class="nk-gap-6"></div>
	<center><h1><b style="color:red" class="ion-information-circled"></b> Register is disabled </h1><br>
	<a href = "/" class="nk-btn nk-btn-lg link-effect-4">
						<span>Home page</span>
	</a>
	<center>
	<div class="nk-gap-6"></div>
	
<?	}	?>
  
<div class="nk-gap-6"></div>