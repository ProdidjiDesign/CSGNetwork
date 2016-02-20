<?php

	function getPosts($bdd,$place,$last){

		switch($place){

			case "profile":

				$request = $bdd->prepare('SELECT * FROM posts WHERE author=:author order by pub_date desc limit '.intval($last).', '.intval($last+15).' ;');
				$request->execute(array("author"=>$_SESSION['co_elements']['first'].' '.$_SESSION['co_elements']['name']));

				printPosts($bdd,$request,intval($last));
				break;

			case "newpost":

				$request = $bdd->prepare('SELECT * FROM posts WHERE author=:author order by pub_date desc limit 1 ;');
				$request->execute(array("author"=>$_SESSION['co_elements']['first'].' '.$_SESSION['co_elements']['name']));

				printPosts($bdd,$request,0);
				break;

			case "thread-page":

				$request = $bdd->prepare('SELECT * FROM posts WHERE
					sticky=1 AND
					(dest LIKE :fcase
					OR dest LIKE :scase
					OR dest LIKE :tcase
					OR dest LIKE :fcase
					OR author = :author
					OR dest = :class
					OR dest = "school"
					OR dest = :year)
					order by pub_date desc limit 15 ;');

					$request->execute(array(
					"author"=>$_SESSION['co_elements']['first'].' '.$_SESSION['co_elements']['name'],
					"fcase"=>'%'.$_SESSION['co_elements']['first'].' '.$_SESSION['co_elements']['name'].'%',
					"scase"=>'%'.$_SESSION['co_elements']['first'].' '.$_SESSION['co_elements']['name'],
					"tcase"=>$_SESSION['co_elements']['first'].' '.$_SESSION['co_elements']['name'].'%',
					"tcase"=>$_SESSION['co_elements']['first'].' '.$_SESSION['co_elements']['name'],
					"class"=>$_SESSION['co_elements']['class'],
					"year"=>$_SESSION['co_elements']['class'][0]
				));

				printPosts($bdd,$request,0);


				$request = $bdd->prepare('SELECT * FROM posts WHERE
					sticky!=1 AND
					(dest LIKE :fcase
					OR dest LIKE :scase
					OR dest LIKE :tcase
					OR dest LIKE :fcase
					OR author = :author
					OR dest = :class
					OR dest = "school"
					OR dest = :year)
					order by pub_date desc limit 15 ;');

				$request->execute(array(
					"author"=>$_SESSION['co_elements']['first'].' '.$_SESSION['co_elements']['name'],
					"fcase"=>'%'.$_SESSION['co_elements']['first'].' '.$_SESSION['co_elements']['name'].'%',
					"scase"=>'%'.$_SESSION['co_elements']['first'].' '.$_SESSION['co_elements']['name'],
					"tcase"=>$_SESSION['co_elements']['first'].' '.$_SESSION['co_elements']['name'].'%',
					"tcase"=>$_SESSION['co_elements']['first'].' '.$_SESSION['co_elements']['name'],
					"class"=>$_SESSION['co_elements']['class'],
					"year"=>$_SESSION['co_elements']['class'][0]
				));

				printPosts($bdd,$request,0);
				break;


		}

	}

	function printPosts($bdd,$data,$id){

		while($single = $data->fetch()){

			$icon = "glyphicon-heart";
			$iconcoms = "glyphicon-pencil";
			$number = 0;

			$request = $bdd->prepare('SELECT * FROM heart WHERE pid=:post_id ;');
			$request->execute(array("post_id"=>$single['id']));

			while($hearts = $request->fetch()){

				if($hearts['uid'] == $_SESSION['co_elements']['uid']){
					$icon = "icon-heart-broken under-pub-active";
				}
				$numberh++;
			}
			$request->closeCursor();

			$request = $bdd->prepare('SELECT * FROM comments WHERE pid=:post_id ;');
			$request->execute(array("post_id"=>$single['id']));

			while($coms = $request->fetch()){

				if($coms['uid'] == $_SESSION['co_elements']['uid']){
					$iconcoms = "glyphicon-pencil under-pub-active-com";
				}
				$numberc++;
			}

			$request->closeCursor();

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
						<span class = "glyphicon '.$icon.' under-pub-content"></span><span class = "under-pub-content">'.$numberh.'</span>
					</div>
					<div class = "col-sm-2 col-xs-6 under-pub">
						<span class = "glyphicon '.$iconcoms.' under-pub-content"></span><span class = "under-pub-content">'.$numberc.'</span>
					</div>
				</div>
			</div>';

			$id++;
		}
	}

?>
