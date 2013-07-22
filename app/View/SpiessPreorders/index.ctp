<div class="preorders index">
	<h2><?php echo __('Vorbestellungen'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<?php	if(!empty($preorders)) { ?>
	<tr>
			<th><?php echo $this->Paginator->sort('user_id', 'Benutzer     '); ?></th>
			<th><?php echo $this->Paginator->sort('amount', 'Menge'); ?></th>
			<th><?php echo $this->Paginator->sort('spiesstype', 'Spiess'); ?></th>
			<th><?php echo $this->Paginator->sort('drinktype', 'Getränk'); ?></th>
	</tr>
	<?php 
	foreach ($preorders as $preorder): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($preorder['User']['username'], array('controller' => 'users', 'action' => 'view', $preorder['User']['id'])); ?>
		</td>
		<td><?php echo h($preorder['Preorder']['amount']); ?>&nbsp;</td>
		<td><?php echo h($preorder['Preorder']['spiesstype']); ?>&nbsp;</td>
		<td><?php echo h($preorder['Preorder']['drinktype']); ?>&nbsp;</td>

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
	<h2>Spiessli Vorbestellung</h2>
	<p>
	Super feini Spiessli!.</br>
	Zu den Spiessli gibt es noch Teigwaren mit Tomatensosse.
</p>
<img src="http://media1.deindeal.ch/upload/120_restaurant_arcade_flambispiess4.jpg" alt="Produktbild representiert nicht das gekaufte produkt" title="Produktbild representiert nicht das gekaufte produkt" height="400px">
</br>
	<u><?php echo $this->Html->link(__('Neue Spiessli Bestellung'), array('controller' => 'SpiessPreorders' , 'action' => 'add')); ?></u>

</div>