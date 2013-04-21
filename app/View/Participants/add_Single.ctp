<div class="participants form">
<?php echo $this->Form->create('Participant'); ?>
	<fieldset>
		<legend><?php echo __('Turnier beitreten'); ?></legend>
	<?php
		echo $this->Form->input('tournament_id');
		echo $this->Form->input('comment');

	?>
	</fieldset>
<?php echo $this->Form->end(__('Teilnehmen')); ?>
</div>