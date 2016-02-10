<?php

session_start();

if(isset($_SESSION["co_elements"]) && isset($_POST['pid'])){

	require("../config/db.php");

	if($_POST['todo'] == "more"){
		$request = $bdd->prepare('INSERT INTO `heart`(`id`, `pid`, `uid`) VALUES ( NULL, :pid, :uid);');
		$request->execute(array("pid"=>$_POST['pid'], "uid"=>$_SESSION['co_elements']['uid']));
	}
	elseif ($_POST['todo'] == "min"){
		$request = $bdd->prepare('DELETE FROM `heart` WHERE pid=:pid AND uid=:uid');
		$request->execute(array("pid"=>$_POST['pid'], "uid"=>$_SESSION['co_elements']['uid']));
	}
	else{
		die("Are u lost ?");
	}

}
else{
	die("Are u lost ?");
}

?>
