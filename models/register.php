<?php


	function verifUser($first_name, $name, $bdd){

		$exist = $bdd->prepare('SELECT COUNT(*) AS nbr FROM accounts WHERE first_name=:fn AND name=:n ;');
		$exist->execute(array("fn"=>$first_name, "n"=>$name));
		$data = $exist->fetch();

		if($data['nbr'] != 0){
			return true;
		}
		return false;

	}



	function sendCookie($first, $name, $sessid, $encrypt, $bdd){

			$unique_id = uniqid(rand(),true);

			$changeid = $bdd->prepare('UPDATE accounts SET sessid = "'.$unique_id.'" WHERE sessid = :sessid ;');
			$changeid->execute(array("sessid" => $sessid));

			if($encrypt){
				$cookiedata = password_hash($_SERVER['REMOTE_ADDR'],PASSWORD_BCRYPT,['cost' => 12]).'----'.password_hash($first,PASSWORD_BCRYPT,['cost' => 12]).'----'.password_hash($name,PASSWORD_BCRYPT,['cost' => 12]).'----'.$unique_id ;
			}
			else{
				$cookiedata = password_hash($_SERVER['REMOTE_ADDR'],PASSWORD_BCRYPT,['cost' => 12]).'----'.$first.'----'.$name.'----'.$unique_id ;
			}

			setcookie('sessid', $cookiedata, time()+3600*24*14, "/", null, false, true);

	}



	function registerUser($first, $name, $mail, $sex, $class, $uniqid, $pass, $bdd){


		$new_user = $bdd->prepare('INSERT INTO `accounts`(`id`, `first_name`, `name`, `e_mail`, `sex`, `class`, `img`, `friends`, `level`, `pass`, `sessid`, `ip`) VALUES (NULL, :first, :name, :mail, :sex, :class, "./pictures/default.jpg", "", 1, :pass, :sessid, "'.$_SERVER['REMOTE_ADDR'].'") ;');
		$new_user->execute(array(

			'first' => $first,
			'name' => $name,
			'mail' => $mail,
			'sex' => $sex,
			'sessid' => $uniqid,
			'class' => $class,
			'pass' => $pass

		));

		$new_user -> closeCursor();

		$just_id = $bdd->query('SELECT id FROM accounts WHERE pass = "'.$pass.'";');
		$id = $just_id->fetch();

		$_SESSION["co_elements"] = array(

			'pass' => $pass,
			'uid' => $id,
			'first' => $first,
			'name' => $name,
			'class' => $class,
			'friends' => array(),
			'img' => './pictures/default.jpg',
			'level' => 1

		);

		sendCookie($first, $name, $uniqid, true, $bdd);

		return true;

	}


?>
