<div class="forums view">
<h2><?php  echo __('Forum'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($forum['Forum']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($forum['Forum']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($forum['Forum']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Users'); ?></dt>
		<dd>
			<?php echo $this->Html->link($forum['Users']['id'], array('controller' => 'users', 'action' => 'view', $forum['Users']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Isdisabled'); ?></dt>
		<dd>
			<?php echo h($forum['Forum']['isdisabled']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($forum['Forum']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($forum['Forum']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Forum'), array('action' => 'edit', $forum['Forum']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Forum'), array('action' => 'delete', $forum['Forum']['id']), null, __('Are you sure you want to delete # %s?', $forum['Forum']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Forums'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Threads'), array('controller' => 'threads', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Threads'), array('controller' => 'threads', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Threads'); ?></h3>
	<?php if (!empty($forum['Threads'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Users Id'); ?></th>
		<th><?php echo __('Forums Id'); ?></th>
		<th><?php echo __('Isdisabled'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($forum['Threads'] as $threads): ?>
		<tr>
			<td><?php echo $threads['id']; ?></td>
			<td><?php echo $threads['title']; ?></td>
			<td><?php echo $threads['type']; ?></td>
			<td><?php echo $threads['users_id']; ?></td>
			<td><?php echo $threads['forums_id']; ?></td>
			<td><?php echo $threads['isdisabled']; ?></td>
			<td><?php echo $threads['created']; ?></td>
			<td><?php echo $threads['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'threads', 'action' => 'view', $threads['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'threads', 'action' => 'edit', $threads['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'threads', 'action' => 'delete', $threads['id']), null, __('Are you sure you want to delete # %s?', $threads['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Threads'), array('controller' => 'threads', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
