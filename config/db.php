<?php 

try{
    	$bdd = new PDO('mysql:host=localhost;dbname=csg;charset=utf8','root','');
    }
catch(Exception $e)
	{
    	echo "<div style = 'text-align:center;'>Nous vous prions de nous excuser car cette section est actuellement indisponible pour des raisons techniques...
    	<br>";
	}
	
?>
