<?php
session_start();
create_image();

function create_image()
{
	
    $rand = md5(rand(0, 9999999));
    $value = substr($rand, 10, 8);

    $width = 160;
    $height = 50;

    // Set the content-type
	header('Content-Type: image/png');

	// Create the image
	$image = imagecreatetruecolor($width, $height);

    $black = imagecolorallocate($image, 255, 255, 255);
    $white = imagecolorallocate($image, 14, 14, 14);
	
    imagefill($image, 0, 0, $white);

    // The text to draw
	$text = $value;
	
	// Replace path by your own font path
	$font = '/marcellus.ttf';

	// Add the text
	imagettftext($image, 20, 0, 25, 35, $black, $font, $text);

	// Using imagepng() results in clearer text compared with imagejpeg()
	imagepng($image);
	imagedestroy($image);

    $_SESSION['captcha_key'] = $value;
	
	
}
