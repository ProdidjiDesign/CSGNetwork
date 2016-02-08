<?php 
	define('PATH', 'http://'.$_SERVER['HTTP_HOST'].'/CSGNetwork/');

	if($animate){

		echo '<link href="'.PATH.'css/animate.css" rel="stylesheet"/>';

	}
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset = "utf-8"></meta>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
<link href="<?php echo PATH."css/main.css"; ?>" rel="stylesheet"/>