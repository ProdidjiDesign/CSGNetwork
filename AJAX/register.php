<?php

	session_start();
	ob_start();

	include('../config/db.php');
	include('../models/register.php');

	if(count($_POST) == 7){


		$first = htmlentities($_POST['firstname']);
		$name = htmlentities($_POST['name']);
		$mail = htmlentities($_POST['email']);
		$sex = htmlentities($_POST['sex']);
		$class = htmlentities($_POST['class-id']);
		$pass = htmlentities($_POST['pass1']);

		if(verifUser($first, $name, $bdd)){

			exit('existing_user');

		}

		$hashpass = password_hash($pass,PASSWORD_BCRYPT,['cost' => 10]) ;
		$uniqid = uniqid(rand(), true);

		if(registerUser($first, $name, $mail, $sex, $class, $uniqid, $hashpass, $bdd)){

			exit('ok');

		}
	}





?>