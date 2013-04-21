<div class="participants form">
<?php echo $this->Form->create('Participant'); ?>
	<fieldset>
		<legend><?php echo __('Add Participant'); ?></legend>
	<?php
		echo $this->Form->input('parentParticipants');
		echo $this->Form->input('password');

	?>
	</fieldset>
<?php echo $this->Form->end(__('Teilnehmen')); ?>
</div>