<div class="preorders view">
<h2><?php  echo __('Vorbestellungen'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($preorder['Preorder']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($preorder['User']['username'], array('controller' => 'users', 'action' => 'view', $preorder['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($preorder['Preorder']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paid'); ?></dt>
		<dd>
			<?php echo h($preorder['Preorder']['paid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Recieved'); ?></dt>
		<dd>
			<?php echo h($preorder['Preorder']['recieved']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($preorder['Preorder']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($preorder['Preorder']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
