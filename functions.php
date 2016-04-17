<?php
	class clean {
	public static function phone (&$string){
		$string = preg_replace('/[^0-9]+/', '', $string);
		return $string;
	}
	public static function email (&$string){
		$string = filter_var($string, FILTER_SANITIZE_EMAIL);
		return $string;
	}
	public static function name (&$string){
		//$string = preg_replace('/[\n\r\\\\"\']+/', '', $string);
		$string = utf8_decode($string);
		$string = preg_replace('/[^A-Za-z\s\p{L}\.]+/', '', $string);
		$string = filter_var($string, FILTER_SANITIZE_STRING);
		return $string;
	}
	public static function number (&$string){
		$string = filter_var($string, FILTER_SANITIZE_NUMBER_INT);
		return $string;
	}
	public static function addressnumber (&$string){
		$string = preg_replace('/[^0-9A-Za-z]+/', '', $string);
		return $string;
	}
	public static function text (&$string){
		$string = filter_var($string, FILTER_SANITIZE_MAGIC_QUOTES);
		return $string;
	}
}
?>