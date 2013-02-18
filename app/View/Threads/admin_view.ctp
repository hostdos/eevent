<div class="threads view">
<h2><?php  echo __('Thread'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($thread['Thread']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($thread['Thread']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($thread['Thread']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Users'); ?></dt>
		<dd>
			<?php echo $this->Html->link($thread['Users']['id'], array('controller' => 'users', 'action' => 'view', $thread['Users']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Forums'); ?></dt>
		<dd>
			<?php echo $this->Html->link($thread['Forums']['name'], array('controller' => 'forums', 'action' => 'view', $thread['Forums']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Isdisabled'); ?></dt>
		<dd>
			<?php echo h($thread['Thread']['isdisabled']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($thread['Thread']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($thread['Thread']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Thread'), array('action' => 'edit', $thread['Thread']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Thread'), array('action' => 'delete', $thread['Thread']['id']), null, __('Are you sure you want to delete # %s?', $thread['Thread']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Threads'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Thread'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forums'), array('controller' => 'forums', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forums'), array('controller' => 'forums', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Posts'), array('controller' => 'posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Posts'); ?></h3>
	<?php if (!empty($thread['Posts'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Content'); ?></th>
		<th><?php echo __('Users Id'); ?></th>
		<th><?php echo __('Threads Id'); ?></th>
		<th><?php echo __('Isdisabled'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($thread['Posts'] as $posts): ?>
		<tr>
			<td><?php echo $posts['id']; ?></td>
			<td><?php echo $posts['content']; ?></td>
			<td><?php echo $posts['users_id']; ?></td>
			<td><?php echo $posts['threads_id']; ?></td>
			<td><?php echo $posts['isdisabled']; ?></td>
			<td><?php echo $posts['created']; ?></td>
			<td><?php echo $posts['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'posts', 'action' => 'view', $posts['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'posts', 'action' => 'edit', $posts['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'posts', 'action' => 'delete', $posts['id']), null, __('Are you sure you want to delete # %s?', $posts['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Posts'), array('controller' => 'posts', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
