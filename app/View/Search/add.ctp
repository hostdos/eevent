<div>
    <h3>Neues Inserat erstellen</h3>
    <?php echo $this->Form->create('Search', array('url' => array('controller' => 'search', 'action' => 'view', $game['id']))); ?>
        <div>
            <div class="left width100">
                Spiel:
            </div>
            <?php echo $this->Form->input('gamename', array('label' => false, 'disabled' => 'disabled', 'value' => $game['name'], 'class' => 'background-color')); ?>
        </div>
        <div>
            <div class="left width100">
                Typ:
            </div>
            <?php echo $this->Form->input('typ', array('type' => 'select', 'options' => array( 1 => 'Teamsuche', 0 => 'Spielersuche'), 'label' => false)); ?>
        </div>
        <div>
            <div class="left width100">
                Titel:
            </div>
            <?php echo $this->Form->input('title', array('label' => false, 'class' => 'width600')); ?>
        </div>
        <div>
            <div class="left width100">
                Text:
            </div>
            <?php echo $this->Form->input('text', array('label' => false, 'rows' => 10, 'class' => 'width600')); ?>
        </div>
        <div>
            <div class="left width100">
                &nbsp;
            </div>
            <?php echo $this->Form->submit('Inserat erstellen', array('class' => 'btn height30', 'div' => false)); ?>
            <?php echo $this->Html->link('Abbrechen',array('controller' => 'search', 'action' => 'view', $game['id']),array('escape' => false, 'class' => 'btn')); ?>
        </div>
    <?php echo $this->Form->end(); ?>
</div>