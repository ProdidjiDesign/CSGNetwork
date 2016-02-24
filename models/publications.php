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
			$numberh = 0;
			$numberc = 0;

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
					$iconcoms = "glyphicon-pencil under-pub-active";
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
					<div class = "col-xs-4 col-xs-offset-1 col-sm-2 col-sm-offset-2">
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

	function uploadFiles(){

	            $images = array();
	            if(isset($_FILES['photos'])){
	                for($a = 0; $a<count($_FILES['photos']['name']); $a++){
	                    $target = '../uploads/';
	                    $extensions = array('jpg','gif','png','jpeg');
	                    $ext  = pathinfo($_FILES['photos']['name'][$a], PATHINFO_EXTENSION);

	                        if (in_array(strtolower($ext),$extensions)){
	                            if(isset($_FILES['photos']['error'][$a]) && UPLOAD_ERR_OK === $_FILES['photos']['error'][$a]){
	                                $img_name = md5(uniqid()) .'.'. $ext;
	                                switch (strtolower($ext)) {
	                                    case 'jpg':
	                                        $img = imagecreatefromjpeg($_FILES['photos']['tmp_name'][$a]);
	                                        break;
	                                    case 'jpeg':
	                                        $img = imagecreatefromjpeg($_FILES['photos']['tmp_name'][$a]);
	                                        break;
	                                    case 'png':
	                                        $img = imagecreatefrompng($_FILES['photos']['tmp_name'][$a]);
	                                        break;
	                                    case 'gif':
	                                        $img = imagecreatefromgif($_FILES['photos']['tmp_name'][$a]);
	                                    break;
	                                    default:
	                                        $img = imagecreatefromjpeg($_FILES['photos']['tmp_name'][$a]);
	                                    }

	                                $width = imagesx($img);
	                                $height = imagesy($img);

	                                $new_width = 900;
	                                $new_height = floor($height * ( 900 / $width ));

	                                $tmp_img = imagecreatetruecolor($new_width, $new_height);

	                                imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	                                $pathToImage = $target.$img_name;


	                                switch (strtolower($ext)) {
	                                    case 'jpg':
	                                        imagejpeg($tmp_img, $pathToImage);
	                                        break;
	                                    case 'jpeg':
	                                        imagejpeg($tmp_img, $pathToImage);
	                                        break;
	                                    case 'png':
	                                        imagepng($tmp_img, $pathToImage);
	                                        break;
	                                    case 'gif':
	                                        imagegif($tmp_img, $pathToImage);
	                                    break;
	                                    default:
	                                        imagejpeg($tmp_img, $pathToImage);
	                                    }
	                                    $result = $pathToImage;
	                                if($result && $a>0){
	                                    $images[$a] = " <div class='mosaicflow_item'><img src = '".substr($pathToImage,1)."' /></div>";
	                                }
	                                else{
	                                    $images[$a] = "<img src = '".substr($pathToImage,1)."' />";
	                                }
	                            }
	                        }
	                }
	                return $images;
	            }
	            else{
	                return false;
	            }
	}

	function insertPost($content, $dest, $level,  $bdd){


	        $new_post = $bdd->prepare('INSERT INTO `posts`(`id`, `author`, `pub_date`, `content`, `level`, `dest`, `sticky`) VALUES (NULL, :author, NOW(), :content, :level, :dest, "");');
	        $new_post->execute(array(

	            'author' => $_SESSION['co_elements']['first']." ".$_SESSION['co_elements']['name'],
	            'content' => $content,
	            'level' => $level,
	            'dest' => $dest

	        ));

	        $new_post -> closeCursor();

	        return true;

	    }

	function printComs($bdd, $pid){

		$request = $bdd->prepare("SELECT * FROM comments WHERE pid=:pid ORDER BY id DESC;");
		$request->execute(array("pid"=>$pid));

		$comsnbr = $bdd->prepare("SELECT COUNT(*) AS nbrcoms FROM comments WHERE pid=:pid ;");
		$comsnbr->execute(array("pid"=>$pid));
		$nbr = $comsnbr->fetch();

		$user = $bdd->prepare("SELECT img,name,first_name FROM accounts WHERE id=:uid;");

		echo '<div class = "comments-container">';

		if($nbr['nbrcoms']==0){
			echo "<p style='color:gray;font-family:Sniglet;font-size:12px;'>Aucun commentaire</h6>";
		}
		else{
			while($data = $request->fetch()){

				$user->execute(array("uid"=>$data['uid']));
				$userdata = $user->fetch();

				echo '<div class="container-fluid">
					<div class="row"  style = "display: flex;align-items: center; text-align:left;">
						<div class = "col-xs-4 col-md-2">
							<div style = "background-image:url(\''.$userdata['img'].'\');" class = "pub-img">
							</div>
						</div>
						<div class = "col-xs-8">
							<h6>'.$userdata['first_name'].' '.$userdata['name'].'</h6>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12" style="padding:0px 10px 10px 20%;">
							'.$data['content'].'
						</div>
						</div>
						<hr class="left-hr"></hr>
						</div>';

			}
		}

		echo '</div>
		<div class = "container-fluid comments-form">
			<div class="row">
				<div class="col-xs-12">
					<textarea class = "write-space-bis" id = "write-space-coms"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-md-offset-4 col-xs-6 col-xs-offset-3">
					<button class="btn btn-submit" id="comment-submit" data-post-id = "'.$pid.'">Envoyer</button>
				</div>
			</div>
		</div>';

	}

	function postCom($bdd, $pid, $content){

		$insert_req = $bdd->prepare("INSERT INTO `comments`(`id`, `uid`, `pid`, `content`) VALUES (NULL,:uid,:pid,:content)");
		$insert_req->execute(array("uid"=>$_SESSION["co_elements"]["uid"], "pid"=>$pid, "content"=>$content));

		echo '<div class="container-fluid last-comment">
			<div class="row"  style = "display: flex;align-items: center; text-align:left;">
				<div class = "col-xs-4 col-md-2">
					<div style = "background-image:url(\''.$_SESSION['co_elements']['img'].'\');" class = "pub-img">
					</div>
				</div>
				<div class = "col-xs-8">
					<h6>'.$_SESSION['co_elements']['first'].' '.$_SESSION['co_elements']['name'].'</h6>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12" style="padding:0px 10px 10px 20%;">
					'.$content.'
				</div>
				</div>
				<hr class="left-hr"></hr>
				</div>';


	}
?>
