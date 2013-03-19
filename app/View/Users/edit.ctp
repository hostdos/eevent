<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('Passwort',array('placeholder' => 'neues passwort', 'name' => "User[password1]", 'value' => ''));
		echo $this->Form->input('', array('placeholder' => 'passwort wiederholen', 'name' => "User[password2]", 'value' => ''));
		echo $this->Form->input('prename', array('label' => 'Vorname'));
		echo $this->Form->input('surname', array('label' => 'Nachname'));
		echo $this->Form->input('clan');
		echo $this->Form->input('website');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
