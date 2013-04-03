


<?php 	echo $this->Html->css('smoothness/jquery-ui-1.10.2.custom.min');
		echo $this->Html->script('jquery-ui-1.10.2.custom.min');
?>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
  });
  </script>

<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username', array('placeholder' => 'Username','label'=>null));
		echo $this->Form->password('password', array('placeholder' => 'Passwort', 'type' => 'password'));
		echo $this->Form->input('email', array('placeholder' => 'Email','type' => 'email','label'=>''));
		echo $this->Form->input('prename', array('placeholder' => 'Vorname','label'=> ''));
		echo $this->Form->input('surname', array('placeholder' => 'Nachname','label'=> ''));
		echo $this->Form->input('birthdate', array('type' => 'date',
		'minYear' => date('Y') - 70,
    	'maxYear' => date('Y') - 0,
    	  'selected' => array(
   			 'day' => '15',
   			 'month' => '06',
   			 'year' => '1994',
   			 'label' => _('birthdate'),
)));
		echo $this->Form->input('clan', array('label' => '', 'placeholder' => 'Clan'));
		echo $this->Form->input('website', array('label' => '', 'placeholder' => 'Website'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Registrieren')); ?>
</div>


<!-- 












<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('email');
		echo $this->Form->input('prename');
		echo $this->Form->input('surname');
		echo $this->Form->input('birthdate');
		echo $this->Form->input('clan');
		echo $this->Form->input('website');
		echo $this->Form->input('status');
		echo $this->Form->input('isdisabled');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
	</ul>
</div>
 -->