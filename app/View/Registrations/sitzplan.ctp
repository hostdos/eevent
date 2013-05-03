
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
		<script>
			<?php
			if(!empty($userreg) && $userreg['Registrations']['paid'] == 1){
				echo "var login = 1";
			}else{
				echo "var login = 0";
			}
			?>
		
			var occupiedSeats = 
			<?php
			echo json_encode($seats);
			?>
		</script>
	</head>
	<body>
				<div id="content">
					<h1>Sitzplan</h1>
					<?php
					if(!empty($userreg) && $userreg['Registrations']['paid'] == 1 && 
					$userreg['Registrations']['seat'] != Null){
					
					echo __('you reserved seat');
					echo ": ";
					echo $userreg['Registrations']['seat'];
					echo " ";
					echo $this->Html->link(__('delete reservation?', true), array('controller' => 'registrations','action' => 'removereservation'));
					
						
					}elseif(!empty($userreg) && $userreg['Registrations']['paid'] == 0){
						echo __('you can reserve a seat as soon as we recieve your payment');
						echo " ";
					echo $this->Html->link(__('payment info', true), array('controller' => 'event','action' => 'index'));

					}elseif(empty($userreg)){
							
					}
					
					
					?>
					<div class="room" id="room">
						<div class="roomLoading" id="roomLoading">
							<?php echo $this->Html->image('sitzplan/logo.png'); ?>
						</div>
					</div>
				</div>
	</body>
		
</html>













