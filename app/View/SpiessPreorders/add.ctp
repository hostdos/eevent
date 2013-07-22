<div class="preorders form">
<?php echo $this->Form->create('Preorder'); ?>
	<fieldset>
		<legend><?php echo __('Spiessli vorbestellen'); ?></legend>
	<?php
		echo $this->Form->input('amount', array('type' => 'text', 'label' => 'Menge'));
		echo $this->Form->input('spiesstype', array('type' => 'select', 'options' => array('PouletSpiess' => 'PouletSpiess','RindSpiess' => 'RindSpiess'), 'label' => ''));
		echo "PouletSpiess = 10 CHf, RindSpiess = 11 CHf";
		echo "</br>";
		echo $this->Form->input('drinktype', array('type' => 'select', 'options' => array('Bier' => 'Bier','Mineral' => 'Mineral','Ohne' => 'Ohne'), 'label' => ''));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
