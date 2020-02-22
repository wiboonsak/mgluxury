<?php

	//session_start();
	if($this->session->userdata('gfm_captcha') != ''){
		$capt_string = 'ERROR!';
        }else{
		$capt_string = $this->session->userdata('gfm_captcha');
        }	
	$rand_char = strtoupper(substr(str_shuffle('abcdefghjkmnpqrstuvwxyz'), 0, 4));
	$capt_string = rand(1, 7) . rand(1, 7) . $rand_char;
         $capchas = array(
                 'gfm_captcha'     => $capt_string
                 );

           $this->session->set_userdata($capchas);
	//$_SESSION['gfm_captcha'] = $capt_string;
	header('Cache-control: no-cache');
	//Set the font 
	$font  = 'fonts/zxxnoise.otf';
	// Set the image settings
	$image = imagecreatetruecolor(118, 15); 
	$black = imagecolorallocate($image, 0, 0, 0);
	$color = imagecolorallocate($image, 140,148,155);
	$white = imagecolorallocate($image, 245,245,245);
	imagefilledrectangle($image,0,0,399,99,$white);
	// Draw the image
	imagettftext($image, 15, 0, 15, 15, $color, $font, $capt_string);
	// Output image
	header('Content-type: image/png');
	imagepng($image);
	imagedestroy($image);

?>