<!DOCTYPE html>

<html>

	<head>
		<?php
			$animate = true;
			require(dirname(__FILE__)."/controllers/head.php");
		?>
	</head>

	<body style = "background-image:url('./pictures/crowd.png');">
		<div class = "container-fluid">
			<div class = "row">
				<div class = "col-md-3">
					<img src = "./pictures/CsgNet.png" class = "logo" />
				</div>
				<div class = "col-md-5 col-md-offset-4">

					<form class = "form-inline login-form" id = "login-form">

						<div class = "form-group">
							<input class = "form-control" id = "login-user" type = "text" placeholder = "Utilisateur"></input>
						</div>
						<div class = "form-group">
							<input class = "form-control" id = "login-pass" type = "password" placeholder = "Mot de passe"></input>
						</div>
						<div class = "form-group">
							<button type = "submit" class = "btn btn-default" id = "login-btn">Log in</button>
						</div>

					</form>

				</div>

			</div><hr class = "basic-hr"/>
		</div>

		<div class = "container-fluid home-form">

			<div class = "row">
			<h2 class = "title">Inscription</h2>
				<form class = "form-vertical" id = "register-form">
					<div class = "col-md-3 col-md-offset-3">
						<div class = "form-group">
							<label for = "prenom" class = "left-label">Prénom :</label>
							<input class = "form-control required" type = "text" id = "firstname" placeholder = "Prénom"></input>
						</div>
						<div class = "form-group">
							<label for = "nom" class = "left-label">Nom :</label>
							<input class = "form-control required" type = "text" id = "name" placeholder = "Nom"></input>
						</div>
						<div class = "form-group">
							<label for = "email" class = "left-label">E-mail :</label>
							<input class = "form-control required" type = "email" id = "email" placeholder = "Courrier électronique"></input>
						</div>
						<div class = "form-group">
							<label class = "left-label">Sexe : </label>
							<label class="radio-inline">
  								<input type="radio" id="girl" name="sex" value = "girl" checked="checked"> Fille
							</label>
							<label class="radio-inline">
  								<input type="radio" id="boy" name="sex" value = "boy"> Garçon
							</label>
						</div>
					</div>
					<div class = "col-md-3">
						<div class = "form-group">
							<label for = "year" class = "left-label" style = "width:100%;text-align:left;">Classe :</label>
							<div class = "class-input">
							<select class="form-control" id = "year" name = "year">
  								<option>1</option>
  								<option>2</option>
  								<option>3</option>
  								<option>4</option>
  								<option>5</option>
  								<option>6</option>
							</select>
								<input type = "text" id = "class-id" class = "form-control required" name = "class-id" placeholder="A"></input>
							</div>
						</div>
						<div class = "form-group">
							<label for="pass1" class = "left-label">Mot de passe : </label>
							<input type = "password" id = "pass1" class = "form-control required" placeholder="Mot de passe"></input>
						</div>
						<div class = "form-group">
							<label for="pass2" class = "left-label">Confirmation : </label>
							<input type = "password" id = "pass2" class = "form-control required" placeholder="Retapez votre mot de passe"></input>
						</div>

						<button type = "submit" class = "btn btn-submit" id = "register-btn">S'inscrire</button>
					</div>
				</form>
			</div>

		</div>
		<div class="cssload-loader-inner">
			<div class="cssload-cssload-loader-line-wrap-wrap">
				<div class="cssload-loader-line-wrap"></div>
			</div>
			<div class="cssload-cssload-loader-line-wrap-wrap">
				<div class="cssload-loader-line-wrap"></div>
			</div>
			<div class="cssload-cssload-loader-line-wrap-wrap">
				<div class="cssload-loader-line-wrap"></div>
			</div>
			<div class="cssload-cssload-loader-line-wrap-wrap">
				<div class="cssload-loader-line-wrap"></div>
			</div>
			<div class="cssload-cssload-loader-line-wrap-wrap">
				<div class="cssload-loader-line-wrap"></div>
			</div>
		</div>

	<?php

		$mobile = false;
		require(dirname(__FILE__)."/controllers/scripts.php");
	?>
	<script type = "text/javascript" src = "./js/login.js"></script>
	</body>

</html>
