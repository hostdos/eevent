<div class="participants view">
<h2><?php  echo $participant['Participant']['name']; ?></h2>
	<dl>
		<dt><?php echo __('Ersteller'); ?></dt>
		<dd>
			<?php echo $this->Html->link($participant['User']['username'], array('controller' => 'users', 'action' => 'view', $participant['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Turnier'); ?></dt>
		<dd>
			<?php echo $this->Html->link($participant['Tournament']['name'], array('controller' => 'tournaments', 'action' => 'view', $participant['Tournament']['id'])); ?>
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
	</dl>
</div>

<?php 	
if($participant['Participant']['type'] != NULL || $participant['Participant']['type'] != 1 ): ?>
<div class="related">
	<h3><?php echo __('Mitglieder'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	

	<?php if(!empty($participant['ChildParticipant'])){?>

	<?php

		foreach ($participant['ChildParticipant'] as $childParticipant): ?>
		<tr>
			<td><?php echo $Users[$childParticipant['user_id']]; ?></td>
		</tr>
	<?php endforeach; 
	}else{
		echo __('Das Team hat noch keine Mitglieder');
	}
	?>
	</table>


	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Team Beitreten'), array('controller' => 'participants', 'action' => 'joinTeam', $tournamentid, $participant['Participant']['id']));?> </li>
		</ul>
	</div>
<?php endif; ?>
</div>
