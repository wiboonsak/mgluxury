<?php

	//session_start();
	if(strtoupper($_GET['captcha']) == $this->session->userdata('gfm_captcha')) {
		echo 'true';
	} else {
		echo 'false';
	}
	
?>