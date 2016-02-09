<?php

		session_start();
		ob_start();

		include('../config/db.php');
		include('../models/register.php');
		include('../models/decode_cookie.php');

		$datarray = explode('----',$_COOKIE['sessid']);

		if(!verifExistUser($datarray[3], $bdd)){ 
			setcookie('sessid', NULL, time(), "/", null, false, true);
			exit('error1');
		}

		$base = verifData($datarray[3], $datarray[0], $datarray[1], $datarray[2], $bdd);

		print_r($base);

		if($base){

			if($base['level'] == 0){

				echo "suspended";

			}
			else{

				sendCookie($base['first_name'], $base['name'], $base['sessid'], true, $bdd);

				$_SESSION['id'] = uniqid(rand(),true);

				$_SESSION['co_elements'] = array(

					'uid' => $base['id'],
					'pass' => $base['pass'],
					'first' => $base['first_name'],
					'name' => $base['name'],
					'class' => $base['class'],
					'img' => $base['img'],
					'level' => $base['level'],
					'friends' => explode('/',$base['friends']) 

				);

			}

		}
		else{

			setcookie('sessid', NULL, time(), "/", null, false, true);

		}


?>