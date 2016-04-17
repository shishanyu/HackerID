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
		$googleAPI = "https://www.google.com/recaptcha/api/siteverify";
		$captcha_json = file_get_contents("$googleAPI?secret=$secret&response=$captcha");
		$captcha_json = json_decode($captcha_json, true);
		//$captcha_json["success"]; $captcha_json["hostname"]; $captcha_json["challenge_ts"];
		if(!$captcha_json["success"] || $captcha_json["hostname"] != "hackergarage.mx"){
			//die("Fallo el CAPTCHA o diste actualizar a la p&aacute;gina");
		}

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