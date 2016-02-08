<?php

function verifExistUser($uniqid, $bdd){

		$count = $bdd -> prepare("SELECT COUNT(*) AS exist FROM accounts WHERE sessid = :uniqid ;");
		$count -> execute(array("uniqid" => $uniqid));
		$exist = $count -> fetch();

		echo $exist['exist'];

		if($exist['exist'] == 0){return false;}

		return true;

}

function verifData($uniqid, $ip, $first, $name, $bdd){

		$request = $bdd -> prepare("SELECT * FROM accounts WHERE sessid = :uniqid ;");
		$request -> execute(array("uniqid" => $uniqid));
		$base = $request -> fetch();

		$bool = password_verify($base['ip'], $ip)&&password_verify($base['first_name'], $first)&&password_verify($base['name'], $name);

		if($bool){
			return $base;
		}
		else{
			return false;
		}
}

?>