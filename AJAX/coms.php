<?php

	session_start();

	if(isset($_SESSION["co_elements"]) && isset($_POST['pid'])){

  	require("../config/db.php");
    require("../models/publications.php");

    printComs($bdd,$_POST['pid']);

  }
  else{
    die("Are u lost ?");
  }

  ?>
