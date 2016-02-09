<?php

	function getPosts($bdd,$place){
	
		switch($place){

			case "profile":

				$request = $bdd->prepare('SELECT * FROM posts WHERE author=:author order by pub_date desc;');
				$request->execute(array("author"=>$_SESSION['co_elements']['first'].' '.$_SESSION['co_elements']['name']));
				
				printPosts($bdd,$request);

				break;

		}

	}

	function printPosts($bdd,$data){

		$id = 0;

		while($single = $data->fetch()){

			$icon = "glyphicon-heart";
			$number = 0;

			$request = $bdd->prepare('SELECT * FROM heart WHERE pid=:post_id ;');
			$request->execute(array("post_id"=>$single['id']));

			while($hearts = $request->fetch()){

				if($hearts['uid'] == $_SESSION['co_elements']['uid']){
					$icon = "icon-heart-broken under-pub-active";
				}
				$number++;
			}

			list($year, $month, $daytime) = explode("-",$single['pub_date']);
			list($day, $time) = explode(" ",$daytime);


			echo '	
			<div class = "container-fluid" id = "pub-'.$id.'">
				<div class = "row pub-header">
					<div class = "pub-info col-xs-3">
						'.$single['author'].'
					</div>
					<div class = "col-xs-4 col-xs-offset-1 col-md-2 col-md-offset-2">
						<div style = "background-image:url(\'./pictures/default.jpg\');" class = "pub-img">
						</div>
					</div> 
					<div class = "pub-info col-xs-3 col-xs-offset-1 col-md-offset-2">
						'.$day.'/'.$month.'/'.$year.'
					</div>
				</div>
				<hr></hr>
				<div class = "pub-content item">
					'.$single['content'].'
				</div>
				<div class = "row">
					<div class = "col-sm-2 col-xs-6 under-pub" id = "'.$single['id'].'">
						<span class = "glyphicon '.$icon.' under-pub-content"></span><span class = "under-pub-content">'.$number.'</span>
					</div>
					<div class = "col-sm-2 col-xs-6 under-pub">
						<span class = "glyphicon glyphicon-pencil under-pub-content"></span><span class = "under-pub-content">4687</span>
					</div>
				</div>
			</div>';

			$id++;
		}
	}

?>