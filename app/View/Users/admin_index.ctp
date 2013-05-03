<div class="users index">
	<h2><?php echo __('Users'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('prename'); ?></th>
			<th><?php echo $this->Paginator->sort('surname'); ?></th>
			<th><?php echo $this->Paginator->sort('birthdate'); ?></th>
			<th><?php echo $this->Paginator->sort('clan'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
			<th><?php echo 'angemeldet'; ?></th>
			<th><?php echo 'bezahlt'; ?></th>
			<th><?php echo 'eingecheckt'; ?></th>

	</tr>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['prename']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['surname']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['birthdate']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['clan']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Bezahlen'), array('action' => 'admin_pay','controller' => 'registrations', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Einchecken'), array('action' => 'admin_checkin','controller' => 'registrations', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
		</td>
<?php 		if(isset($registrations[$user['User']['id']])): ?>
		<td><?php echo h($registrations[$user['User']['id']]['registered']);?>&nbsp;</td>
		<td><?php echo h($registrations[$user['User']['id']]['paid']);?>&nbsp;</td>
		<td><?php echo h($registrations[$user['User']['id']]['checkin']);?>&nbsp;</td>
		 <?php endif; ?>
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
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
	</ul>
</div>
