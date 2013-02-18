<div class="forums form">
<?php echo $this->Form->create('Forum'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Forum'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('users_id');
		echo $this->Form->input('isdisabled');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Forum.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Forum.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Forums'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Threads'), array('controller' => 'threads', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Threads'), array('controller' => 'threads', 'action' => 'add')); ?> </li>
	</ul>
</div>
