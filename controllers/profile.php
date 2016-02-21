<!DOCTYPE html>

<html>

	<head>
		<?php
			$animate = false;
			require(dirname(__FILE__)."/head.php");
		?>
	</head>

	<body class = "maincontainer" id="profile">
	<?php require(dirname(__FILE__)."/navbar.php");?>
		<div class = "container-fluid" style = "min-height:90vh;">
			<div class = "row" style="margin-top:10vh;">
				<div class = "col-sm-2 col-sm-offset-1 col-xs-4">
					<div class = "container-fluid">
						<div class = "row">
							<div class = "col-sm-12" style = "padding:0px;">
								<div class="img-rounded profile-img" style="background-image:url('<?php echo $_SESSION['co_elements']['img']; ?>');background-size:cover;background-position:center;width:100%;height:auto;padding:50%;"></div>
							</div>
						</div>
						<div class = "row">
							<div class = "col-sm-12">
								<table class = "table portable-nav" style = "margin-top:5vh;">
									<tbody>
										<tr>
											<td id = "home"><span class = "glyphicon glyphicon-home"></span> <span class = "txt">Mon profil</span></td>
										</tr>
										<tr>
											<td id = "settings"><span class = "glyphicon glyphicon-cog"></span> <span class = "txt">Paramètres</span></td>
										</tr>
										<tr>
											<td id = "pictures"><span class = "glyphicon glyphicon-camera"></span> <span class = "txt">Photos</span></td>
										</tr>
										<tr>
											<td id = "documents"><span class = "glyphicon glyphicon-folder-open"></span> <span class = "txt">Fichiers</span></td>
										</tr>
										<tr>
											<td id = "class"><span class = "glyphicon glyphicon-education" style="font-size: 1.3em;"></span> <span class = "txt"><?php echo $_SESSION['co_elements']['class']; ?></span></td>
										</tr>
										<tr>
											<td id = "friends"><span class = "glyphicon glyphicon-user" style="font-size: 1.3em;"></span> <span class = "txt">Amis</span></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-9">
					<div class="container-fluid" id = "R2_d2">
					<div class = "row">
						<div class="col-sm-6">
							<h1 style = "text-align:left;"><?php echo $_SESSION['co_elements']['first'].' '.$_SESSION['co_elements']['name']; ?></h1>
						</div>
						<div class = "col-sm-6">
							<!-- MAX 7 -->
							<?php

								if($_SESSION['co_elements']['level'] == 1){

									echo "<img class = 'badge-item' title='élève' src = './pictures/eleve.png' />";

								}
							?>
						</div>
					</div>
					<hr />
					<?php
						require('./controllers/publications.php');
					?>
					</div>
				</div>
			</div>
		</div>
		<div class = "overlay"></div>
		<div class = "lightbox">
			<div class = "comments-container">
				<div class="container-fluid">
					<div class="row"  style = "display: flex;align-items: center;">
						<div class = "col-xs-4 col-md-2">
							<div style = "background-image:url('./pictures/default.jpg');" class = "pub-img">
							</div>
						</div>
						<div class = "col-xs-8">
							<h6>Loic Grumiaux</h6>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12" style="padding:2px 10px 10px;">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae ipsum a mauris fringilla cursus id sed nisi. Phasellus malesuada metus eget posuere tempor.
						</div>
					</div>
					<hr class="left-hr"></hr>
				</div>

				<div class="container-fluid">
					<div class="row"  style = "display: flex;align-items: center;">
						<div class = "col-xs-4 col-md-2">
							<div style = "background-image:url('./pictures/default.jpg');" class = "pub-img">
							</div>
						</div>
						<div class = "col-xs-8">
							<h6>Loic Grumiaux</h6>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12" style="padding:2px 10px 10px;">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae ipsum a mauris fringilla cursus id sed nisi. Phasellus malesuada metus eget posuere tempor.
						</div>
					</div>
					<hr class="left-hr"></hr>
				</div>
				<div class="container-fluid">
					<div class="row"  style = "display: flex;align-items: center;">
						<div class = "col-xs-4 col-md-2">
							<div style = "background-image:url('./pictures/default.jpg');" class = "pub-img">
							</div>
						</div>
						<div class = "col-xs-8">
							<h6>Loic Grumiaux</h6>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12" style="padding:2px 10px 10px;">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae ipsum a mauris fringilla cursus id sed nisi. Phasellus malesuada metus eget posuere tempor.
						</div>
					</div>
					<hr class="left-hr"></hr>
				</div>
				<div class="container-fluid">
					<div class="row"  style = "display: flex;align-items: center;">
						<div class = "col-xs-4 col-md-2">
							<div style = "background-image:url('./pictures/default.jpg');" class = "pub-img">
							</div>
						</div>
						<div class = "col-xs-8">
							<h6>Loic Grumiaux</h6>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12" style="padding:2px 10px 10px;">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae ipsum a mauris fringilla cursus id sed nisi. Phasellus malesuada metus eget posuere tempor.
						</div>
					</div>
					<hr class="left-hr"></hr>
				</div>

			</div>
			<div class = "container-fluid">
				<div class="row">
					<div class="col-xs-12">
						<textarea class = "write-space-bis"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-md-offset-4 col-xs-6 col-xs-offset-3">
						<button class="btn btn-submit">Envoyer</button>
					</div>
				</div>
			</div>
			<div id = "lightbox-close" class="glyphicon glyphicon-remove"></div>
		</div>
	<?php
		$mobile = true;
		require(dirname(__FILE__)."/scripts.php");
		echo "<script type = 'text/javascript'> detectActive(0); </script>";
	?>
	<script async src="//cdn.embedly.com/widgets/platform.js" charset="UTF-8"></script>
	<script type = "text/javascript" src="./js/publications.js"></script>
	<script type = "text/javascript" src="./js/profile.js"></script>
	</body>

</html>
