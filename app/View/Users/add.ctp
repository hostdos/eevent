  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script>
  $(function() {
    var availableTags =
    <?php foreach ($clanlist as $clan){
           $data[] = $clan;
    }
        echo json_encode($data); ?>
    
    $( "#clan" ).autocomplete({
      source: availableTags
    });
  });
  </script>

<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset class="first">
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username', array('placeholder' => 'Username'));
		
		echo $this->Form->input('password', array('label' => 'Passwort','placeholder' => 'Passwort', 'type' => 'password'));
		echo $this->Form->input('email', array('placeholder' => 'Email','type' => 'email','label'=>'E-Mail'));
		echo $this->Form->input('gender', array('label' => __('Geschlecht'),'type' => 'select',
					'options' => array( '1' => __('Mann'), '0' => __('Frau'))));
		echo $this->Form->input('prename', array('placeholder' => 'Vorname','label'=> 'Vorname'));
		echo $this->Form->input('surname', array('placeholder' => 'Nachname','	label'=> 'Nachname'));
	?>
	</fieldset>
	<fieldset class="second">
	<?php
		echo $this->Form->input('birthdate', array('type' => 'text',
   			 'label' => __('birthdate'),
   			 'placeholder' => date('d.m.Y')));
   		
		echo $this->Form->input('place',array('label' => __('Wohnort'), 'type' => 'text', 'placeholder' => 'bärn'));
		echo $this->Form->input('zip', array('label' => __('PLZ'), 'placeholder' => '3005'));
		echo $this->Form->input('street', array('label' => __('Adresse'), 'placeholder' => 'Bundesplatz 3'));
		echo $this->Form->input('phone', array('label' => __('Tel.'), 'placeholder' => '031 322 87 90'));
		echo $this->Form->input('clan', array('label' => 'Clan', 'placeholder' => 'Clan', 'id' => 'clan', 'placeholder' => 'Broken-Arrow'));
		echo $this->Form->input('website', array('label' => 'Website', 'placeholder' => 'Website', 'placeholder' => 'www.retardmagnetgaming.ch.vu'));
	?>
	</fieldset>
	<fieldset class="pricemoneysliders">
		<div class="priceinfo">
		<h4>
		<?php echo __('not more than 10 franks'); ?>
		</h4>
		</div>
		<?php
		echo '<div class="control-group">';
		echo $this->Form->input('price_lol', array('label' => __('LoL'), 'value' => '3'));
		echo '</div>';
		echo '<div class="control-group">';
		echo $this->Form->input('price_csgo', array('label' => __('CS:GO'), 'value' => '4'));		
		echo '</div>';
		echo '<div class="control-group">';
		echo $this->Form->input('price_hots', array('label' => __('SC2'), 'value' => '3'));
		echo '</div>';
		?>
		<div class="priceerror" style="display:none;">
			<p>
			<?php echo __('all prices have to equal 10 franks'); ?>
			</p>
		</div>
	</fieldset>

<?php 
		echo $this->Form->submit(__('Registrieren'), array('class' => 'btn btn-large btn-primary', 'id' => 'submitbutton'));
		echo $this->Form->end(); ?>
</div>
<script>

$('#UserPriceLol').keyup(function(){
	validatePrice();
	});
$('#UserPriceCsgo').keyup(function(){
	validatePrice();
	});
$('#UserPriceHots').keyup(function(){
	validatePrice();
	});



function validatePrice() {
	var lol = parseInt($('#UserPriceLol').val());
	var go = parseInt($('#UserPriceCsgo').val());
	var sc = parseInt($('#UserPriceHots').val());
	var total = lol + go + sc;

	if(total == 10){
		$('.priceerror').hide();
		$('#submitbutton').removeAttr("disabled");
		return true;
	}else{
		$('.priceerror').show();
		$('#submitbutton').attr('disabled','disabled');
		console.log($('#submitbutton'));
		return total;
	}
}




</script>
