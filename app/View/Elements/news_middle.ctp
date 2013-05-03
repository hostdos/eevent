<?php 		$this->set('news', $this->paginate());
?>
<div class="news view">
<h2><?php  echo __('News'); ?></h2>
	<dl>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($news['News']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($news['News']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Users'); ?></dt>
		<dd>
			<?php echo $this->Html->link($news['Users']['id'], array('controller' => 'users', 'action' => 'view', $news['Users']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Comments'); ?></h3>
	<?php if (!empty($news['Comment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('News Id'); ?></th>
		<th><?php echo __('Content'); ?></th>
		<th><?php echo __('Users Id'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($news['Comment'] as $comment): ?>
		<tr>
			<td><?php echo $comment['news_id']; ?></td>
			<td><?php echo $comment['content']; ?></td>
			<td><?php echo $comment['users_id']; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
