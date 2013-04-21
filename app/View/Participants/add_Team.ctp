<div class="participants form">
<?php echo $this->Form->create('Participant'); ?>
	<fieldset>
		<legend><?php echo __('Team Erstellen'); ?></legend>
	<?php
		echo $this->Form->input('tournament_id');
		echo $this->Form->input('name');
		echo $this->Form->input('comment');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Team Erstellen')); ?>
</div>
