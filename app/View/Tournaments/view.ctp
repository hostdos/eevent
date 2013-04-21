<div class="tournaments view">
<h2><?php  echo __('Tournament'); ?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($tournament['Tournament']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Teamgrösse'); ?></dt>
		<dd>
			<?php echo h($tournament['Tournament']['maxsize']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<?php 
if($tournament['Tournament']['maxsize'] == NULL || $tournament['Tournament']['maxsize'] == 1){ ?>
<div class="actions">
		<?php echo $this->Html->link(__('an Turnier Teilnehmen'), array('controller' => 'participants', 'action' => 'addSingle')); ?>
</div>
<?php }else{
			echo $this->Html->link(__('einem Team Beitreten'), array('controller' => 'participants', 'action' => 'joinTeam', $tournament['Tournament']['id']));
			echo '</br>';
			echo $this->Html->link(__('Team Erstellen'), array('controller' => 'participants', 'action' => 'addTeam', $tournament['Tournament']['id']));
} ?>
<div class="related">
	<h3><?php echo __('Related Participants'); ?></h3>
	<?php if (!empty($tournament['Participant'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Tournament Id'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($tournament['Participant'] as $participant): ?>
		<tr>
			<td><?php echo $participant['id']; ?></td>
			<td><?php echo $participant['user_id']; ?></td>
			<td><?php echo $participant['parent_id']; ?></td>
			<td><?php echo $participant['tournament_id']; ?></td>
			<td><?php echo $participant['type']; ?></td>
			<td><?php echo $participant['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'participants', 'action' => 'view', $participant['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
<?php if($tournament['Participant']){ ?>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Participant'), array('controller' => 'participants', 'action' => 'joinTeam', $participant['tournament_id'])); ?> </li>
		</ul>
	</div>
	<?php } ?>
</div>
