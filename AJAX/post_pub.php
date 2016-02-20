<?php
	session_start();

	if(isset($_SESSION["co_elements"]) && isset($_POST['dest'])){

		require("../config/db.php");
		require("../models/post_pub.php");

		$images_returned = uploadFiles();
		$image1 = $images_returned[0];
		$images_returned[0] = "";
		$images = $image1.'<div class="clearfix mosaicflow-container">'.implode($images_returned).'</div>';
		$status = 1;

		switch($_POST['dest']){
			case 'class-post':
				$dest = $_SESSION['co_elements']['class'];
				break;
			case 'year-post':
				$dest = $_SESSION['co_elements']['class'][1];
				break;
			case 'school-post':
				echo 'waiting';
				$status = 0;
				$dest = 'school';
				break;
			case 'friends-post':
				print_r($_SESSION);
				$dest = implode('/',$_SESSION['co_elements']['friends']);
				break;
			default:
				$dest = implode('/',$_SESSION['co_elements']['friends']);
				break;
		}

		$content = str_replace(array("<a"), "|a", $_POST['content']);
		$content = str_replace(array(">"), "||", $content);
		$content = str_replace(array("</a"), "a|", $content);
		$content = htmlspecialchars($content).' '.$images;
		$content = str_replace(array("|a"), "<a", $content);
		$content = str_replace(array("a|"), "</a", $content);
		$content = str_replace(array("||"), ">", $content);
		$content = str_replace(array("&quot;"), "'", $content);
		$content = str_replace(array("&lt;p"), "<p", $content);
		$content = str_replace(array("&lt;/p"), "</p", $content);

		insertPost(nl2br($content), $dest, $status,  $bdd);
	}
	else{
		die("Are u lost ?");
	}

?>
