<div class="users view">
<h2><?php  echo __('User'); ?></h2>
	<dl>
			<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<?php if ($isowner == true) :?>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		<dt><?php echo __('Prename'); ?></dt>
		<dd>
			<?php echo h($user['User']['prename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Surname'); ?></dt>
		<dd>
			<?php echo h($user['User']['surname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Birthdate'); ?></dt>
		<dd>
			<?php echo h($user['User']['birthdate']); ?>
			&nbsp;
		</dd>
		<?php if(!empty($user['User']['clan'])){ ?>
		<dt><?php echo __('Clan'); ?></dt>
		<dd>
			<?php echo h($user['User']['clan']); ?>
			&nbsp;
		</dd>
		<?php } ?>
		<?php if(!empty($user['User']['website'])){ ?>
		<dt><?php echo __('Website'); ?></dt>
		<dd>
			<?php echo h($user['User']['website']); ?>
			&nbsp;
		</dd>
		<?php } ?>
	</dl>
</div>
<?php if ($isowner == true) :?>
<div class="actions">
	<ul>
		<li>
		<?php echo $this->Html->link('Zahlungsdetails',array('controller' => 'event', 'action' => 'index', '#' => 'zahlungsdetails')); ?>
		</li>
		<li><?php
		if($isregistered == 1){
			echo __('You are registered') . " " . $this->Html->link(__('Unregister?'), array('controller' => 'registrations', 'action' => 'unregister'));
		}else{
			echo __('You are not registered') . " " . $this->Html->link(__('Register?'), array('controller' => 'registrations', 'action' => 'register'));
		}

		?></li>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
	</ul>
</div>
<?php endif; ?>