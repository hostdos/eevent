        <div class="sidelogin">
        <?php
        if ($authUser){
         echo '<span>';
         echo 'Eingeloggt als ';
         echo $this->Html->link($authUser['username'], array('controller' => 'users', 'action' => 'view', 
          $authUser['id']));
         echo '</br>';
         echo $this->Html->link('Ausloggen?', array('controller' => 'users','action'=>'logout','admin' => null));
         echo '</span>';
        } else {
         
          echo $this->Form->create('User', array('controller' => 'users','action' => 'login'));
          echo $this->Form->input('username', array('placeholder' => 'username', 'label' => false));
          echo $this->Form->password('password', array('placeholder' => 'passwort')); // No div, no label
          echo $this->Form->submit('login', array('class' => 'btn'));
          echo $this->Form->end();
          echo $this->Html->link('Passwort vergessen?', array('controller' => 'users', 'action' => 'forgotpass'));
          echo $this->Html->link('Registrieren', array('controller' => 'users','action'=>'add','admin'=> null));

        }
        ?>
        </div>