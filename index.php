<?php
	//Código escrito por Tony Cárdenas @shishanyu 2016
	//Publicado bajo la GNU GENERAL PUBLIC LICENSE
	$task = false;
	$hackerid = false;
	if(isset($_REQUEST["hackerid"])){$hackerid = $_REQUEST["hackerid"];}
	if(isset($_REQUEST["task"])){$task = $_REQUEST["task"];}

	//	include_once("functions.php");
	if ($task == "register"){
		include_once("templates/register.html");
	} else if ($task == "submitnew"){
		include_once("functions.php");
		include_once("phpqrcode/qrlib.php");
		//QRcode::png('PHP QR Code :)', 'data/qr/test.png', 'L', 4, 2);
		if(isset($_REQUEST["g-recaptcha-response"])){$captcha = $_REQUEST["g-recaptcha-response"];}
		$secret = "6Le_lx0TAAAAAFC7ZnD5Lllj9Aqvma_injwWxIl8";
		$googleAPI = "https://www.google.com/recaptcha/api/siteverify";
		$captcha_json = file_get_contents("$googleAPI?secret=$secret&response=$captcha");
		$captcha_json = json_decode($captcha_json, true);
		//$captcha_json["success"]; $captcha_json["hostname"]; $captcha_json["challenge_ts"];
		header('Content-Type: text/html; charset=utf-8');
		if(!$captcha_json["success"] || $captcha_json["hostname"] != "hackergarage.mx" && $captcha_json["hostname"] != "localhost"){
			if($captcha_json["hostname"] != "localhost"){
				die("Fallo el CAPTCHA o diste actualizar a la p&aacute;gina");
			}
		}
		if(isset($_REQUEST["names"])){$rq_names = $_REQUEST["names"];} else { die("No escribiste nombre");}
		if(isset($_REQUEST["lastname"])){$rq_lastname = $_REQUEST["lastname"];} else { die("No escribiste apellido paterno");}
		if(isset($_REQUEST["lastnamem"])){$rq_lastnamem = $_REQUEST["lastnamem"];} else { die("No escribiste apellido materno");}
		if(isset($_REQUEST["cellphone"])){$rq_cellphone= $_REQUEST["cellphone"];} else { die("No escribiste celular");}
		if(isset($_REQUEST["email"])){$rq_email = $_REQUEST["email"];} else { die("No escribiste correo");}
		if(isset($_REQUEST["password"])){$rq_password = $_REQUEST["password"];} else { die("No escribiste contraseña");}
		validate::name($rq_names);
		validate::name($rq_lastname,"El apellido paterno");
		validate::name($rq_lastnamem,"El apellido materno");
		validate::phone($rq_cellphone);
		validate::email($rq_email);
		validate::password($rq_password);
		$rq_password = password_hash($rq_password,PASSWORD_BCRYPT,["cost" => 13]) ;
		$check = getimagesize($_FILES["picture"]["tmp_name"]);
		$imageFileType = pathinfo(basename($_FILES["picture"]["name"]),PATHINFO_EXTENSION);
	    if($check == false) {
	        die("Subiste un archivo que NO es una imagen");
	    }
	    if ($_FILES["picture"]["size"] > 500000) {
		    die("El archivo no puede ser mayor a 500KB.");
		}
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
		    die("Sólo se permite JPG, JPEG, PNG & GIF.");
		}
		$randomname = md5(uniqid(rand(), true));
		$hackerid_code = strtoupper(substr($randomname, 0,6));
		if (!move_uploaded_file($_FILES["picture"]["tmp_name"], "data/ids/".$hackerid_code.".$imageFileType")) {
	        die ("Hubo un error al subir el archivo");
	    }
	    echo "<img src='data/ids/$hackerid_code.$imageFileType' style='max-width:200px;max-height:200px;'>";
	    $hackerid_code = strtoupper(substr($randomname, 0,6));
	    echo "<style>body{background:#c00;font-family:Arial;color:white;font-size:20px;}a{color: white;text-decoration:none;}</style>";
	    echo "<h1>Hola $rq_names, tu HackerID es: <a href='http://hackergarage.mx/hackerid/?hackerid=$hackerid_code'>$hackerid_code</a></h1>";
	    QRcode::png("$hackerid_code", "data/qr/$hackerid_code"."_num.png", 'h', 5.3, 2);
	    QRcode::png("http://hackergarage.mx/hackerid/?hackerid=$hackerid_code)", "data/qr/$hackerid_code"."_url.png", 'm', 4, 2);
	    QRcode::png("http://hackergarage.mx/hackerid/?hackerid=$hackerid_code&action=json)", "data/qr/$hackerid_code"."_api.png", 'm', 4, 2);
	    QRcode::png("http://hackergarage.mx/hackerid/?hackerid=$hackerid_code&action=validate)", "data/qr/$hackerid_code"."_val.png", 'm', 4, 2);

	    echo "<br><img src='data/qr/$hackerid_code"."_num.png'>";
		$dbobj = new db();
		$result = $dbobj->query("INSERT INTO miembros (hid, email, password, names, lastname, lastnamem, cellphone)
		VALUES ('$hackerid_code','$rq_email','$rq_password','$rq_names','$rq_lastname','$rq_lastnamem','$rq_cellphone')");
		if(!$result){die("Error al insertar en base de datos. No se guardaron los datos del usuario");}

	} else if ($task == "modify"){

	} else if ($task == "submitmodify"){

	} else if ($task == "search"){
		//DESPUES
	} else if ($task == "json"){
		//DESPUES
	} else if ($task == "validate"){

	} else if ($task == "shareinfo"){
		//DESPUES
	} else if($hackerid){

	} else {
		include_once("templates/welcome.html");
	}


?>