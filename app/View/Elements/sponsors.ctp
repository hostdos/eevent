        <div class="sidesponsors">
        <h4>Sponsoren</h4>
        <h5>Gold Sponsor</h5>

        <?php 
        echo  $this->Html->link(
              $this->Html->image('bison.png'),
          'http://www.bison-group.ch',
          array('target' => '_blank', 'escape' => false)); ?>
        <h5>Silber Sponsor</h5>
        <?php  
          echo  $this->Html->link(
                $this->Html->image('drink.png'),
          'http://www.drinkenergy.ch',
          array('target' => '_blank', 'escape' => false)); ?>
        </div>