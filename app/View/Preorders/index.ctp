<div class="preorders index">
	<h2><?php echo __('Vorbestellungen'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<?php	if(!empty($preorders)) { ?>
	<tr>
			<th><?php echo $this->Paginator->sort('user_id', 'Benutzer     '); ?></th>
			<th><?php echo $this->Paginator->sort('amount', 'Menge'); ?></th>
	</tr>
	<?php 
	foreach ($preorders as $preorder): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($preorder['User']['username'], array('controller' => 'users', 'action' => 'view', $preorder['User']['id'])); ?>
		</td>
		<td><?php echo h($preorder['Preorder']['amount']); ?>&nbsp;</td>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $preorder['Preorder']['id']), null, __('Are you sure you want to delete # %s?', $preorder['Preorder']['id'])); ?>
	</tr>
<?php 
	endforeach; 
	} else {
		echo "Du hast noch keine Vorbestellungen";
	}
?>
	</table>
</br>
	<h2>Energy-Drink Vorbestellung</h2>
	<p>
	Schon von der Erenya bekannt, haben wir uns entschlossen euch die Möglichkeit zu geben Energy-Drinks</br> schon vor der LAN zu bestellen.
	Diese Aktion ist natürlich nur wegen unserem Sponsor Drink-Energy möglich,</br> welcher uns auch die Energy-Drinks zur verfügung stellen.</br>
	Deshalb können wir euch die energy drinks für <u><b>1CHf Pro Dose</b></u> verkaufen.</br>
	Welcher Energy-Drink verkaufen wir euch? keinen anderen als der:
</p>
	<a href="http://drinkenergy.ch/buffalo-classic-energy-drink-250ml-dose.html"><h3>Buffalo Classic Energy Drink</h3></a>
<p>
	Buffalo Classic Energy Drink - kein Taurin. Die Energy wird durch Guaranaextrakte sowie Koffein geliefert,</br> ausserdem enthält der Buffalo Energy Drink Extrakte aus rund 20 hochalpinen Schweizer Kräutern. Energie pur.</br> Das Geschmackswunder, wenn man diesen Geschmack beschreiben müsste, kommt man zum Entschluss,</br> dass es die verbesserte Red-Bull Variante ist.

</p>

<p>
	Überzeugt? Dann bestell dir deine Buffalo Energy drinks direkt an die LAN, eiskalt und für dich vorbereitet.
</br>
	<u><?php echo $this->Html->link(__('Neue Vorbestellung'), array('controller' => 'preorders' , 'action' => 'add')); ?></u>

</div>