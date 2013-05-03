<div class="registrations form">
<?php echo $this->Form->create('Registration'); ?>
	<fieldset>
		<legend><?php echo __('Edit Registration'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type' => 'hidden', 'value' => $Registration['user_id']));
		echo $this->Form->input('seat', array('value' => $Registration['seat']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
