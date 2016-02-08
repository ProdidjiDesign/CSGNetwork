<?php
	
	error_reporting(E_ALL);
	ini_set("display_errors", 1);


	
	session_start();


	if(isset($_COOKIE['sessid']) || isset($_SESSION['co_elements'])){

		if(!isset($_SESSION['co_elements'])){

			require("./controllers/decode_cookie.php");

		}
		else{
			require(dirname(__FILE__)."/thread.php");
		}
	}
	else{
		require(dirname(__FILE__)."/welcome.php");
	}
	

?>