<div class="participants index">
	<h2><?php echo __('Participants'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('tournament_id'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th><?php echo $this->Paginator->sort('password'); ?></th>
			<th><?php echo $this->Paginator->sort('isdisabled'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($participants as $participant): ?>
	<tr>
		<td><?php echo h($participant['Participant']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($participant['User']['username'], array('controller' => 'users', 'action' => 'view', $participant['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($participant['ParentParticipant']['name'], array('controller' => 'participants', 'action' => 'view', $participant['ParentParticipant']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($participant['Tournament']['name'], array('controller' => 'tournaments', 'action' => 'view', $participant['Tournament']['id'])); ?>
		</td>
		<td><?php echo h($participant['Participant']['type']); ?>&nbsp;</td>
		<td><?php echo h($participant['Participant']['name']); ?>&nbsp;</td>
		<td><?php echo h($participant['Participant']['comment']); ?>&nbsp;</td>
		<td><?php echo h($participant['Participant']['password']); ?>&nbsp;</td>
		<td><?php echo h($participant['Participant']['isdisabled']); ?>&nbsp;</td>
		<td><?php echo h($participant['Participant']['created']); ?>&nbsp;</td>
		<td><?php echo h($participant['Participant']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $participant['Participant']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $participant['Participant']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $participant['Participant']['id']), null, __('Are you sure you want to delete # %s?', $participant['Participant']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Participant'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Participants'), array('controller' => 'participants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Participant'), array('controller' => 'participants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tournaments'), array('controller' => 'tournaments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tournament'), array('controller' => 'tournaments', 'action' => 'add')); ?> </li>
	</ul>
</div>
