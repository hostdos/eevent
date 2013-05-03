<div class="preorders form">
<?php echo $this->Form->create('Preorder'); ?>
	<fieldset>
		<legend><?php echo __('Edit Preorder'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('amount');
		echo $this->Form->input('paid');
		echo $this->Form->input('recieved');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Preorder.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Preorder.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Preorders'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
