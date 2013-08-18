        <div class="sidelogin">
        <?php
        if ($authUser){
         echo '<span>';
         echo 'Eingeloggt als ';
         echo $authUser['username'];
         echo '<br/>';
         echo $this->Html->link(__('Profil Editieren'), array('controller' => 'users', 'action' => 'view', 
          $authUser['id']));
         echo '</br>';
        if(isset($userRegistr)){
          if($userRegistr[0]['Registrations']['registered'] == 1){
            echo __('Du bist für die EEvent 3.0 Angemeldet!');
            echo '<br/>';
          }
          if($userRegistr[0]['Registrations']['paid'] == 1){
            echo __('Wir haben noch keine Zahlung von dir erhalten.');
            echo '<br/>';
          }elseif($userRegistr[0]['Registrations']['paid'] == 0){
            echo __('Deine Zahlung ist bei uns angekommen!');
            echo '<br/>';
          }
        }

         foreach($preorder as $preord){
           if(isset($preord) && $preord['Preorders']['spiesstype'] != '' || $preord['Preorders']['spiesstype'] != null){
            echo 'Bestelltes Essen: <br/>';
            switch ($preord['Preorders']['spiesstype']) {
              case 'PouletSpiess':
              echo 'Poulet Spiess mit Kartoffelsalat';
                break;
              case 'RindSpiess':
              echo 'Rinds Entercote mit Kartoffelsalat';
                break;
              default:
              echo 'Nichts bestellt';
                break;
            }
            echo '<br/>';
           }
          if(isset($preorder) && $preord['Preorders']['spiesstype'] == 'energy' || $preord['Preorders']['spiesstype'] != null){
            echo 'Bestellte Energy Drinks: <br/>';
            echo $preord['Preorders']['amount'];
            echo '<br/>';
           }
        }

         echo $this->Html->link('Ausloggen?', array('controller' => 'users','action'=>'logout','admin' => null));
         echo '</span>';
        } else {
         
          echo $this->Form->create('User', array('controller' => 'users','action' => 'login'));
          echo $this->Form->input('username', array('placeholder' => 'username', 'label' => false));
          echo $this->Form->password('password', array('placeholder' => 'passwort')); // No div, no label
          echo $this->Form->submit('login', array('class' => 'btn'));
          echo $this->Form->end();
          echo $this->Html->link('Registrieren', array('controller' => 'users','action'=>'add','admin'=> null));
          echo '<br />';
          echo $this->Html->link('Passwort vergessen?', array('controller' => 'users', 'action' => 'forgotpass'));
        }
        ?>
        </div>