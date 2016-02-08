<!DOCTYPE html>

<html>

	<head>
		<?php 
			$animate = false;
			require(dirname(__FILE__)."/head.php");
		?>
		<style>



		</style>
	</head>

	<body>

		<div class = "container-fluid">

			<div class = "row" style = "margin-top:20vh;">

				<div class = "col-md-4 col-md-offset-4 col-xs-8 col-xs-offset-2">

					<img src = "./pictures/logo.png" class = "logo" style = "float:initial;"/>

				</div>

			</div>
			<div class = "row" style = "margin-top:10vh;">
				
				<span class="cssload-loader2"><span class="cssload-loader-inner2"></span></span>

			</div>

		</div>

	<?php 
		$mobile = true;
		require(dirname(__FILE__)."/scripts.php"); 
	?>
	<script type = "text/javascript">

	$(document).ready(function(){

		$.ajax({

			method	: "GET",
			url		: "./AJAX/decode_cookie.php",
			dataType: "html",
			success: function(data){

					location.reload(true);

			},
			error: function(){

					location.reload(true);

			}

		});

	});

	</script>
	</body>

</html>