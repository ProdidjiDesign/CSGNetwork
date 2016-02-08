<?php
ob_start();
session_start();

if(isset($_COOKIE['sessid']) || isset($_SESSION['co_elements'])){

	if(!isset($_SESSION['co_elements'])){
		
		require("./controllers/decode_cookie.php");
		die("<h3 style = 'color:#808080;'>Chargement...</h3>");

	}

}
else{
	header("Location: ./index.php");
}

?>