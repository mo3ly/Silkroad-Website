<?php

    /* SQL connect settings */
    $host = "HOSTNAME\SQL";       //SQL Host name
    $user = "sa";                           //SQL server username
	$password = "123456789";                //SQL Server password
    $dbs = array(
	'ACC'=>"SRO_VT_ACCOUNT",
	'SHARD'=>"SRO_VT_SHARD",
	'LOG'=>"SRO_VT_SHARDLOG",
	'WEB'=>"EPIC_WEBSITE");                 //Databases


	/* Basic Website Settings */
	$ServerName = "EXORIA";                 // Your server name
	$ServerDomain = "localhost.com";        // your Domain
	
	//Game Server Settings
	$ShardID = "64";        //Defalut "64"
	$IP = "127.1.0.1";               //Your server IP
	$Port = "15779";             //Your Game server Port
	$ServerCap = "110";      //Your server cap
	$Gm_Number = "1";    //The tb_user sec_primary number
	
	/****************************************************************
	                     BETA PHASE HERE
	****************************************************************/
	
	$OpenBeta = false;                 //(True = Open , False = Close)
	$BetaEndDate = "2017-1-26 14:30"; // the end date for beta
	
	/***************************************************************/
	
	//Rates
	$Races = "CH/EU";       // CH / EU 
	$SoloExp = "10";        // Your server Solo Exp rate! Please, put only numbers
	$PartyExp = "15";       // Your server Party Exp rate! Please, put only numbers
	$ItemRate = "8";        // Your server Item drop rate! Please, put only numbers
	$GoldRate = "5";        // Your server Gold drop rate! Please, put only numbers
	$AlchemyRate = "1";     // Your server Alchemy  rate! Please, put only numbers
	$PCLimit = "1";         // Your server Solo Exp rate! Please, put only numbers
	
	//Links
	$facebook = "https://www.facebook.com";
	$twitter = "https://www.twitter.com";
	$youtube = "https://www.youtube.com";
	$skype = "https://www.skype.com";
	

    /* Enable / Disabled Section */
    $RegisterStatus = false;    // Register ( true = Disabled ; false = Enable )
    $LoginStatus =    false;    // Login    ( true = Disabled ; false = Enable )
	$FirstLoginStatus = false;  // First login information to set your game password ( true = Disabled ; false = Enable )
	$AccountPanelStatus = false; // account panel  ( true = Disabled ; false = Enable )
	$CharsPanelStatus = false; // chars panel  ( true = Disabled ; false = Enable )
	$ReVerfiyStatus = false;     // Resend verification code ( true = Disabled ; false = Enable )
	$ForgotStatus = false;      // Allow users to see forgot page ( true = Disabled ; false = Enable )
	$MoreSecSystem =    false;  // Question system and recovery account system for more security  ( true = Disabled ; false = Enable )
	$AutoLogin =    false;      	// It will loin the user automaticlly after activation progress    ( true = Disabled ; false = Enable )
	$ActiveWithEmail =    true; //Login    ( true = Disabled ; false = Enable )

	$FailedLogins = "5";     //After x times the user ip will blocked for x time.
	$FailLoginTime = "2";    //Time in minutes for blocked user
	
	/*******************
	    SPIN WHEEL 
	*******************/
	$spinEvery = 8; // allowed to spin every 8 hours
	$rewards = array(10,20,30,40,50,60,70,80,90,100); // rewards in silk 
	$silkType = 1; // 1 = silk_own, 2 = silk_gift, 3 = silk_point
	$winMessage = "You Have Won xxx Silks"; // don't remove xxx because we will need it later and it may cause problems.
	/*******************
	    STALL SECTION
	*******************/
	$StallMax = "100000";
	$HotItemPrice = "10";
	
	/* For the Register */
	$startSilk = "0";
	
	$UsernameMin = "6";
	$UsernameMax = "10";
	
    $PasswordMin = "6";
    $PasswordMax = "10";
	
	$GamePasswordMin = "6";
    $GamePasswordMax = "10";
	
    $SecretWordMin = "6";
    $SecretWordMax = "10";
	
	$AnswerMin = "6";
    $AnswerMax = "10";
	
	/* Alchemy */
	$ItemMaxPlus = "20";
	
	/*Pagination limit per page */
	$row_per_page = "10";
	
	/** Ticket system **/
	$TicketCategories = array("Silk","In Game","Report Bug","Charge Silk");
	
	//Questions
	$RegisterQuestions = array("What is your name", "What is you car modeel");
    
	//slider image
	$SliderImages = array(
	"assets/images/gallery-1.jpg",
	"assets/images/gallery-2.jpg",
	"assets/images/gallery-3.jpg",
	"assets/images/gallery-4.jpg",
	"assets/images/gallery-5.jpg",
	"assets/images/image-1.jpg");
	//countries
	$countries = array("Egypt", "Venezuela", "Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo", "Cook Islands", "Costa Rica", "Cote dIvoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea", "Kuwait", "Kyrgyzstan", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");



