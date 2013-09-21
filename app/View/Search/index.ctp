<div class="text-center">
    <h3>Wähle ein Spiel aus</h3>
    <h4>Spielersuche oder Teamsuche</h4>
</div>
<div class ="search_index">
    <div class="left text-center width400">
        <?php echo  $this->Html->link($this->Html->image('lol.png'),array('controller' => 'search', 'action' => 'view', '1'),array('escape' => false)); ?>
    </div>
    <div class="right text-center width400">
        <?php echo  $this->Html->link($this->Html->image('csgo.png'),array('controller' => 'search', 'action' => 'view', '2'),array('escape' => false)); ?>
    </div>
</div>
