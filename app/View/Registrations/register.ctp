<div id="price">
<span>Gesamtpreis:  </span><span id="totalprice">45</span><span>Chf.-</span>
</div>
<div class="preorders form">
<?php echo $this->Form->create('register'); ?>
	<fieldset>
		<legend><?php echo __('Grillfleisch vorbestellen'); ?></legend>
	<?php
		echo $this->Form->input('preorder.spiesstype', array('type' => 'select', 'options' => array(null => 'Kein Essen','Poulet Spiesse' => 'Poulet Spiesse','Rinds entercote' => 'Rinds entercote'), 'label' => ''));
		echo "Poulet Spiesse = 14 CHf, Rinds entercote = 16 CHf";
	?>
	</fieldset>
</div>
<div class="preorders form">
	<fieldset>
		<legend><?php echo __('<a href ="http://www.monsterenergy.com/us/en/products/monster-energy/">Monster</a> Energy-Drinks vorbestellen'); ?></legend>
	<?php
		echo $this->Form->input('preorders.amount', array('type' => 'number', 'label' => 'Menge', 'min' => 0, 'max' => 200));
		echo "1 Dose = 1 Schweizer Franken";
	?>
	</fieldset>
</div>
<div class="users form">
	<fieldset class="pricemoneysliders">
		<legend><?php echo __('Preisgeld Festlegen'); ?></legend>
		<div class="priceinfo">
		<h4>
		<?php echo __('not more than 10 franks'); ?>
		</h4>
		</div>
		<?php
		echo '<div class="control-group">';
		echo $this->Form->input('registrations.price_lol', array('label' => __('LoL'), 'value' => '3'));
		echo '</div>';
		echo '<div class="control-group">';
		echo $this->Form->input('registrations.price_csgo', array('label' => __('CS:GO'), 'value' => '4'));		
		echo '</div>';
		echo '<div class="control-group">';
		echo $this->Form->input('registrations.price_hots', array('label' => __('SC2'), 'value' => '3'));
		echo '</div>';
		?>
		<div class="priceerror" style="display:none;">
			<p>
			<?php echo __('all prices have to equal 10 franks'); ?>
			</p>
		</div>
	</fieldset>
	<fieldset>
			<?php
		echo $this->Form->input('agb', array(
			'label' => 'Um dich anzumelden musst du unsere '. $this->Html->link('AGB',array('controller' => 'pages','action'=>'agb')) .' akzeptieren','type' => 'checkbox', 'required' => 'true'));
		?>
	</fieldset>
<?php 
		echo $this->Form->submit(__('Für die EEvent 3.0 Anmelden!'), array('class' => 'btn btn-large btn-primary', 'id' => 'submitbutton'));
		echo $this->Form->end(); ?>
</div>

<script>
$(document).ready(function() {
	$("#preorderSpiesstype").val('Rinds entercote');
	calculatePrice();
});

$("#preordersAmount").keypress(function(){
    var value = $(this).val();
    value = value.replace(/[^0-9]+/g, '');
    $(this).val(value);
});

$("#preordersAmount").keyup(function(){
    var value = $(this).val();
    value = value.replace(/[^0-9]+/g, '');
    $(this).val(value);
});


$('#registrationsPriceLol').keyup(function(){
	validatePrice();
	});
$('#registrationsPriceCsgo').keyup(function(){
	validatePrice();
	});
$('#registrationsPriceHots').keyup(function(){
	validatePrice();
	});
$('#preordersAmount').keyup(function(){
	calculatePrice();
})
$('#preorderSpiesstype').change(function(){
	calculatePrice();
})


function validatePrice() {
	var lol = parseInt($('#registrationsPriceLol').val());
	var go = parseInt($('#registrationsPriceCsgo').val());
	var sc = parseInt($('#registrationsPriceHots').val());
	var lol = (-1)*lol.toFixed(0);
	var go = (-1)*go.toFixed(0);
	var sc = (-1)*sc.toFixed(0);
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

function calculatePrice() {
	var base = 45;
	var spiess = getSpiessPrice();
	var energy = getEnergyPrice();
	var gesamt = base + spiess + energy;
	console.log(gesamt);
	$('#totalprice').text(gesamt);
}
function getSpiessPrice() {
	return $('#preordersAmount').val() * 1;
}

function getEnergyPrice() {
	var spiesstype = $('#preorderSpiesstype').val();
	if(spiesstype == 'Poulet Spiesse'){
		var spiess = 14;
	}
	if(spiesstype == 'Rinds entercote'){
		var spiess = 16;
	}
	if(spiesstype == ''){
		var spiess = 0;
	}
	return spiess;
}

</script>