<?php
	//Código escrito por Tony Cárdenas @shishanyu 2016
	//Publicado bajo la GNU GENERAL PUBLIC LICENSE

	if(isset($_REQUEST["hackerid"])){$hackerid = $_REQUEST["hackerid"];}
	if(isset($_REQUEST["task"])){$task = $_REQUEST["task"];}

	//	include_once("functions.php");
	echo "$task<br>";
	if ($task == "register"){
		include_once("templates/register.html");
	} else if ($task == "submitnew"){
		//include_once("phpqrcode/qrlib.php");
		//QRcode::png('PHP QR Code :)', 'data/qr/test.png', 'L', 4, 2);
		if(isset($_REQUEST["g-recaptcha-response"])){$captcha = $_REQUEST["g-recaptcha-response"];}
		$secret = "6Le_lx0TAAAAAFC7ZnD5Lllj9Aqvma_injwWxIl8";
	} else if ($task == "modify"){

	} else if ($task == "submitmodify"){

	} else if ($task == "search"){

	} else if ($task == "json"){

	} else if ($task == "validate"){

	} else if ($task == "shareinfo"){

	} else if($hackerid){

	} else {
		include_once("templates/welcome.html");
	}


?>