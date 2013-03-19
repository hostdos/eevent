<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username', array('placeholder' => 'username'));
		echo $this->Form->password('password', array('placeholder' => 'passwort', 'type' => 'password'));
		echo $this->Form->input('email', array('type' => 'email'));
		echo $this->Form->input('prename');
		echo $this->Form->input('surname');
		echo $this->Form->input('birthdate', array('type' => 'date'));
		echo $this->Form->input('clan');
		echo $this->Form->input('website');
		echo $this->Form->input('status', array('type' => 'hidden', 'value' => '0'));
		echo $this->Form->input('isdisabled', array('type' => 'hidden', 'value' => '0'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>