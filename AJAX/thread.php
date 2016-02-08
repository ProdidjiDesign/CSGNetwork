<?php

	error_reporting(E_ALL);
	ini_set("display_errors", 1);


session_start();

if(isset($_SESSION["co_elements"]) && isset($_POST['last']) && isset($_POST['place'])){

	require("../config/db.php");
	require("../models/print_pub.php");

	switch($_POST['place']){

		case "profile":

			getPosts($bdd, "profile");

			break;


	}

}
else{
	echo "Are u lost ?";
	print_r($_POST);
}


?>