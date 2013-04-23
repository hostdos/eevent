<div class="tournaments index">
	<h2><?php echo __('Tournaments'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th></th>
	</tr>
	<?php foreach ($tournaments as $tournament): ?>
	<tr>
		<td><?php echo h($tournament['Tournament']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $tournament['Tournament']['id'], '#' => 'menu')); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
