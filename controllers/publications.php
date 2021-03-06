<div class = "row">
	<div class = "col-sm-7 col-xs-12 col-sm-offset-3 col-md-offset-0 profile-container">

		<div class = "container-fluid post-form single">

			<div class = "col-xs-2">
				<div class = "place-t-post active-item" id = "class-post" title="Ecrivez à votre classe.">
					<?php echo $_SESSION['co_elements']['class']; ?>
				</div>
				<div class = "place-t-post" id = "year-post" title="Ecrivez aux camarades de votre année.">
					<?php echo $_SESSION['co_elements']['class'][0]; ?>
				</div>
				<div class = "place-t-post" id = "friends-post" title="Ecrivez à vos amis.">
					<span class = "glyphicon glyphicon-user"></span>
				</div>
				<div class = "place-t-post" id = "school-post" title="Ecrivez à toute l'école.">
					<span class = "glyphicon glyphicon-globe"></span>
				</div>
			</div>
			<div class = "col-xs-10" style="line-height: 0;">
				<textarea id = "write-space" placeholder="Ecrivez à votre classe."></textarea>
				<div class = "bottom-post" style="min-height: 30px;">
					<span id = "img-preview">
					</span>
					<div class = "complement">
						<span class = "glyphicon glyphicon-picture"></span>
					</div>
					<div class = "complement">
						<span id="sticky-button" class = "glyphicon glyphicon-bookmark" style = "position: absolute;bottom: 0px;top: 101px;"></span>
					</div>
					<button class = "btn btn-submit btn-small" id = "pub-send">Envoyer</button>
				</div>
				<form class="box" method="post" accept="image/*" enctype="multipart/form-data">
				  <div class="box-input">
				    <input class="box-file" multiple type="file" name="files[]" id="file" />
				    <label for="file" id = "drag-drop-label"><span class = "box-traditional">Choissez une photo</span><span class="box-dragndrop"> ou droppez-la ici</span>.</label>
				  </div>
				  <div class="box-uploading">Envoi&hellip;</div>
				</form>

			</div>

		</div>

		<div id = "thread">

		</div>
		<h6>0 0 0</h6>
	</div>
</div>
