<html>

	<head>
		<?php
			$animate = false;
			require(dirname(__FILE__)."/head.php");
		?>
	</head>

	<body class = "maincontainer" id = "thread-page">
	<?php require(dirname(__FILE__)."/navbar.php");?>
		<div class = "container-fluid" style = "min-height:90vh;">
			<div class = "row">
        <div class = "col-md-9 col-md-offset-3">
          <div class = "container-fluid">
					<?php
						require('./controllers/publications.php');
					?>
        </div>
				</div>
			</div>
		</div>

	<?php
		$mobile = true;
		require(dirname(__FILE__)."/scripts.php");
		echo "<script type = 'text/javascript'> detectActive(1); </script>";
	?>
	<script async src="//cdn.embedly.com/widgets/platform.js" charset="UTF-8"></script>
	<script type = "text/javascript" src="./js/publications.js"></script>
	</body>

</html>
