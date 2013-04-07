
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
		
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>

		<?php
		echo $this->Html->css('sitzplan/siteLayout.css');
		echo $this->Html->css('sitzplan/siteStyle.css');
		echo $this->Html->css('sitzplan/style.css');

		echo $this->Html->script('sitzplan/seatManager.js');

		?>
		
	</head>
	<body>
				<div id="content">
					<h1>Sitzplan</h1>
					<div class="room" id="room">
						<div class="roomLoading" id="roomLoading">
							<?php echo $this->Html->image('sitzplan/logo.png'); ?>
						</div>
					</div>
				</div>
	</body>
		
</html>













