<?php
create_image();

function create_image()
{
    header('Content-type: image/png');

	// Image
	$Image = imagecreatefrompng('paper.png');

	// Basics (Color and font)
	$color = imagecolorallocate($Image, 255, 255, 255); // white color
	$Orange = imagecolorallocate($Image, 224, 136, 33); // orange color
	$font = '/marcellus-sc.regular.ttf';

	$Server = ''.urldecode($_GET['server']).'';
	imagettftext($Image, 30, 0, 20, 40, $Orange, $font, $Server);

	$Charname = 'Char : '.urldecode($_GET['name']).'';
	imagettftext($Image, 16, 0, 20, 75, $color, $font, $Charname);

	$Guild = 'Guild : '.urldecode($_GET['guild']).'';
	imagettftext($Image, 16, 0, 20, 95, $color, $font, $Guild);

	$Level = 'Level : '.urldecode($_GET['level']).'';
	imagettftext($Image, 16, 0, 20, 115, $color, $font, $Level);
	
	$Race = 'Race : '.urldecode($_GET['race']).'';
	imagettftext($Image, 16, 0, 20, 135, $color, $font, $Race);

	imagepng($Image);

	imagedestroy($Image);	
}
