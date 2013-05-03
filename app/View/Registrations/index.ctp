<div class="registrations index">
	<h2><?php echo __('Registrations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('registered'); ?></th>
			<th><?php echo $this->Paginator->sort('seat'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($registrations as $registration): ?>
	<tr>
		<td><?php echo h($registration['Registration']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($registration['User']['username'], array('controller' => 'users', 'action' => 'view', $registration['User']['id'])); ?>
		</td>
		<td><?php echo h($registration['Registration']['registered']); ?>&nbsp;</td>
		<td><?php echo h($registration['Registration']['seat']); ?>&nbsp;</td>
		<td><?php echo h($registration['Registration']['created']); ?>&nbsp;</td>
		<td><?php echo h($registration['Registration']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $registration['Registration']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $registration['Registration']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $registration['Registration']['id']), null, __('Are you sure you want to delete # %s?', $registration['Registration']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Registration'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
