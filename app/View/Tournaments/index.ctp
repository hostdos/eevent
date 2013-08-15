<div class="tournaments index">
	<h2><?php echo __('Tournaments'); ?></h2>
	<ul class="tournamentlist">
	<?php foreach ($tournaments as $tournament): ?>
		<li>
				<?php 
				echo $this->Html->link( $this->Html->image($tournament['Tournament']['image'], array('fullBase' => true, 'class' => 'tournamentlogo'))
				, array('action' => 'view', $tournament['Tournament']['id'], '#' => 'menu')); ?>
		</li>
	<?php endforeach; ?>
	</ul>
</br>
<a href="http://eevent.ch/images/zeitplan_erneuert.pdf">Turnier Zeitplan</a>
