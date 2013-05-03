<div class="registrations view">
<h2><?php  echo __('Registration'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($registration['Registration']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($registration['User']['username'], array('controller' => 'users', 'action' => 'view', $registration['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Registered'); ?></dt>
		<dd>
			<?php echo h($registration['Registration']['registered']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Seat'); ?></dt>
		<dd>
			<?php echo h($registration['Registration']['seat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($registration['Registration']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($registration['Registration']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Registration'), array('action' => 'edit', $registration['Registration']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Registration'), array('action' => 'delete', $registration['Registration']['id']), null, __('Are you sure you want to delete # %s?', $registration['Registration']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Registrations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Registration'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
