<?php


session_start();

if(isset($_SESSION["co_elements"]) && isset($_POST['last']) && isset($_POST['place'])){

	require("../config/db.php");
	require("../models/publications.php");

	switch($_POST['place']){

		case "profile":
			getPosts($bdd, "profile", $_POST['last']);
			break;
		case "newpost":
			getPosts($bdd, "newpost", $_POST['last']);
			break;
		case "thread-page":
			getPosts($bdd, "thread-page", $_POST['last']);
			break;

	}

}
else{
	echo "Are u lost ?";
}


?>
