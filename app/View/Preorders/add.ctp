<div class="preorders form">
<?php echo $this->Form->create('Preorder'); ?>
	<fieldset>
		<legend><?php echo __('Buffalo Energy-Drinks vorbestellen'); ?></legend>
	<?php
		echo $this->Form->input('amount', array('type' => 'text', 'label' => 'Menge'));
		echo "1 Dose = 1 Schweizer Franken";
		echo "</br>";
		echo $this->Form->input('verbindlich', array('type' => 'checkbox', 'label' => 'Ich bestätige hiermit das ich die bestellten</br> energy drinks an der LAN bezahlen und abholen werde.'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
