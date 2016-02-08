<?php

	function getPosts($bdd,$place){
	
		switch($place){

			case "profile":

				$request = $bdd->prepare('SELECT * FROM posts WHERE author=:author order by pub_date desc;');
				$request->execute(array("author"=>$_SESSION['co_elements']['first'].' '.$_SESSION['co_elements']['name']));
				
				printPosts($request);

				break;

		}

	}

	function printPosts($data){

		$id = 0;

		while($single = $data->fetch()){

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
			</div>';

			$id++;
		}
	}

?>