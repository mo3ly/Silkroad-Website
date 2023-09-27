<?php

    function errorHandler ($message) {
		
        die(json_encode(array(
            'type'     => 'error',
            'response' => $message,
        )));
    }

    function successHandler ($message) {
		
        die(json_encode(array(
            'type'     => 'success',
            'response' => $message,
        )));
    }

    // remove it if your php finally configured
    //errorHandler($func->Alerts("We are testing it man","danger"));
	errorHandler("ok man askdj");

    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']  == 'XMLHttpRequest') {
        
		$name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        
        // Check if name has been entered
        if (!$_POST['name']) {
            errorHandler('Please enter your name.');
        }

        // Check if message has been entered
        if (!$_POST['message']) {
            errorHandler('Please enter your message.');
        }
		
    } else {
        errorHandler('Allowed only XMLHttpRequest.');
    }
?>
