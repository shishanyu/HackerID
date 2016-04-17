<?php
	$hackerid = $_REQUEST["hackerid"];

	if(!isset($hackerid)){
		include_once("welcome.php");
		die();
	}

	include_once("functions.php");

?>