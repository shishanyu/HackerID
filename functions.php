<?php
	//Código escrito por Tony Cárdenas @shishanyu 2016
	//Publicado bajo la GNU GENERAL PUBLIC LICENSE

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

	class validate {
		public static function phone ($string){
			if(strlen($string) != 10){
				die("Deben ser 10 números exactos en el teléfono");
				return false;
			} else if (filter_var($string, FILTER_VALIDATE_INT) === false){
				die ("Contiene caracteres que no son números");
				return false;
			}
			return $string;
		}
		public static function email ($string){
			if (filter_var($string, FILTER_VALIDATE_EMAIL) === false){
				die ("El correo no es válido");
				return false;
			}
			return $string;
		}
		public static function name ($string){
			$string = utf8_decode($string);
			if (filter_var($string, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[^A-Za-z\s\p{L}]/")))){
				die ("El nombre contiene caracteres no válidos");
				return false;
			}
			return $string;
		}
		public static function addressnumber ($string){
			if (filter_var($string, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[^0-9A-Za-z]/")))){
				die ("Sólo se aceptan letras simples y números");
				return false;
			}
			return $string;
		}
		public static function text ($string){
			$original = $string;
			$string = filter_var($string, FILTER_SANITIZE_MAGIC_QUOTES);
			if($original != $string){
				die ("Esta cadena de texto contiene caracteres no válidos por ejemplo: &#39; &quot; &#92; ");
				return false;
			}
			return $string;
		}
	}

	class db {
		private $user = "usuariodeprueba";
		private $pass = "hASD4l-=¿madCU8";
		private $database = "hackerid";
		private $host = "localhost";
		private $dbcon = NULL;

		public function finish (){
			if($this->dbcon != NULL){
				$con = $this->dbcon;
				$con->close();
				$this->dbcon = NULL;
			}
			return false;
		}

		public function start (){
			$this->finish();
			$this->dbcon = new mysqli($this->host, $this->user, $this->pass, $this->database);
			$con = $this->dbcon;
			$con->set_charset("utf8");
			if($con->connect_errno) {
				printf("Falló la conexión: %s\n", $con->connect_error);
				return false;
			}
			return true;
		}
		public function query($query){
			if($this->dbcon == NULL){
				$this->start();
			}

			$con = $this->dbcon;
			$result = $con->query($query);
			return $result;
		}
		public function lastID(){
			if($this->dbcon == NULL){
				return false;
			}
			$con = $this->dbcon;
			$result = $con->insert_id;
			return $result;
		}
	}
?>