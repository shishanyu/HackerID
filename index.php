<?php
	//Código escrito por Tony Cárdenas @shishanyu 2016
	//Publicado bajo la GNU GENERAL PUBLIC LICENSE

	$hackerid = isset($_REQUEST["hackerid"]);
	$task = isset($_REQUEST["task"]);

	if(!$hackerid){
		include_once("welcome.html");
		die();
	}

	include_once("functions.php");



?>