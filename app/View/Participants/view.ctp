<div class="participants view">
<h2><?php  echo __('Participant'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($participant['Participant']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($participant['User']['username'], array('controller' => 'users', 'action' => 'view', $participant['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Participant'); ?></dt>
		<dd>
			<?php echo $this->Html->link($participant['ParentParticipant']['name'], array('controller' => 'participants', 'action' => 'view', $participant['ParentParticipant']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tournament'); ?></dt>
		<dd>
			<?php echo $this->Html->link($participant['Tournament']['name'], array('controller' => 'tournaments', 'action' => 'view', $participant['Tournament']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($participant['Participant']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($participant['Participant']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($participant['Participant']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($participant['Participant']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Isdisabled'); ?></dt>
		<dd>
			<?php echo h($participant['Participant']['isdisabled']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($participant['Participant']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($participant['Participant']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Participant'), array('action' => 'edit', $participant['Participant']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Participant'), array('action' => 'delete', $participant['Participant']['id']), null, __('Are you sure you want to delete # %s?', $participant['Participant']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Participants'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Participant'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Participants'), array('controller' => 'participants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Participant'), array('controller' => 'participants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tournaments'), array('controller' => 'tournaments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tournament'), array('controller' => 'tournaments', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Participants'); ?></h3>
	<?php if (!empty($participant['ChildParticipant'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Tournament Id'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Isdisabled'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($participant['ChildParticipant'] as $childParticipant): ?>
		<tr>
			<td><?php echo $childParticipant['id']; ?></td>
			<td><?php echo $childParticipant['user_id']; ?></td>
			<td><?php echo $childParticipant['parent_id']; ?></td>
			<td><?php echo $childParticipant['tournament_id']; ?></td>
			<td><?php echo $childParticipant['type']; ?></td>
			<td><?php echo $childParticipant['name']; ?></td>
			<td><?php echo $childParticipant['comment']; ?></td>
			<td><?php echo $childParticipant['password']; ?></td>
			<td><?php echo $childParticipant['isdisabled']; ?></td>
			<td><?php echo $childParticipant['created']; ?></td>
			<td><?php echo $childParticipant['updated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'participants', 'action' => 'view', $childParticipant['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'participants', 'action' => 'edit', $childParticipant['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'participants', 'action' => 'delete', $childParticipant['id']), null, __('Are you sure you want to delete # %s?', $childParticipant['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Participant'), array('controller' => 'participants', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
