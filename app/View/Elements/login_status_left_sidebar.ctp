        <div class="sidelogin">
        <?php
        if ($authUser){
         echo '<span>';
         echo 'Eingeloggt als ';
         echo $this->Html->link($authUser['username'], array('controller' => 'users', 'action' => 'edit', 
          $authUser['id']));
         echo '</br>';
         echo $this->Html->link('Ausloggen?', array('controller' => 'users','action'=>'logout','admin' => null));
         echo '</span>';
        } else {
          echo '<span>';
          echo 'Nicht eingeloggt, '; 
          echo $this->Html->link('Einloggen', array('controller' => 'users','action'=>'login','admin'=> null));
          echo '</br>';
          echo $this->Html->link('Registrieren', array('controller' => 'users','action'=>'add','admin'=> null));
          echo '</span>';
        }
        ?>
        </div>