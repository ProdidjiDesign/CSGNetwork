<?php
ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);

	session_start();

	if(isset($_SESSION["co_elements"]) && isset($_POST['pid']) && isset($_POST['content'])){

  	require("../config/db.php");
    require("../models/publications.php");

    postCom($bdd,htmlspecialchars($_POST['pid']),htmlspecialchars($_POST['content']));

  }
  else{
    die("Are u lost ?");
  }

?>
