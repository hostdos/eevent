<div id="price">
<span>Gesamtpreis: </span><span id="totalprice">45</span><span>Chf.-</span>
</div>
<div class="preorders form">
<?php echo $this->Form->create('register'); ?>
	<fieldset>
		<legend><?php echo __('Spiessli vorbestellen'); ?></legend>
	<?php
		echo $this->Form->input('preorder.spiesstype', array('type' => 'select', 'options' => array(null => 'Kein Spiessli','PouletSpiess' => 'PouletSpiess','RindSpiess' => 'RindSpiess'), 'label' => ''));
		echo "PouletSpiess = 10 CHf, RindSpiess = 11 CHf";
		echo "</br>";
		echo $this->Form->input('preorder.drinktype', array('type' => 'select', 'options' => array('Ohne' => 'Ohne','Bier' => 'Bier','Mineral' => 'Mineral'), 'label' => ''));
	?>
	</fieldset>
</div>
<div class="preorders form">
	<fieldset>
		<legend><?php echo __('Buffalo Energy-Drinks vorbestellen'); ?></legend>
	<?php
		echo $this->Form->input('preorders.amount', array('type' => 'text', 'label' => 'Menge'));
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
$('#preordersAmount').keyup(function(){
	calculatePrice();
})
$('#preorderSpiesstype').change(function(){
	calculatePrice();
})
$('#preorderDrinktype').change(function(){
	calculatePrice();
})


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
	var drinktype = $('#preorderDrinktype').val();
	if(spiesstype == 'PouletSpiess'){
		var spiess = 10;
	}
	if(spiesstype == 'RindSpiess'){
		var spiess = 11;
	}
	if(spiesstype == ''){
		var spiess = 0;
	}

	if(drinktype == 'Ohne'){
		var drink = 0;
	}
	if(drinktype == 'Bier'){
		var drink = 5;
	}
	if(drinktype == 'Mineral'){
		var drink = 3;
	}
	return spiess + drink;
}

</script>