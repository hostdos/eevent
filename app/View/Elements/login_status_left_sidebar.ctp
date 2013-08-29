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
         echo '<hr/>';
        if(isset($userRegistr) && $userRegistr != null && !empty($userRegistr) ){
          if($userRegistr[0]['Registrations']['registered'] == 1){
            echo __('Du bist für die EEvent 3.0 Angemeldet!');
            echo '<br/>';
			echo '<hr/>';
         
         }
          if($userRegistr[0]['Registrations']['paid'] == 1){
            echo __('Wir haben noch keine Zahlung von dir erhalten.');
            echo '<br/>';
			echo '<hr/>';
          }elseif($userRegistr[0]['Registrations']['paid'] == 0){
            echo __('Deine Zahlung ist bei uns angekommen!');
            echo '<br/>';
			echo '<hr/>';
          }
        }
		$totalticketprice = 45;
         foreach($preorder as $preord){
           if(isset($preord) && $preord['Preorders']['spiesstype'] != '' && $preord['Preorders']['spiesstype'] != null && $preord['Preorders']['spiesstype'] != 'energy'){
            echo 'Bestelltes Essen: <br/>';
            switch ($preord['Preorders']['spiesstype']) {
              case 'Poulet Spiesse':
              echo 'Poulet Spiess mit Kartoffelsalat';
              $totalticketprice += 14;
                break;
              case 'Rinds entercote':
              echo 'Rinds Entercote mit Kartoffelsalat';
              $totalticketprice += 16;
              break;
              default:
              echo 'Nichts bestellt';
                break;
            }
            echo '<br/>';
			echo '<hr/>';
           }
          if(isset($preorder) && $preord['Preorders']['spiesstype'] == 'energy'){
            echo 'Bestellte Energy Drinks: <br/>';
            echo $preord['Preorders']['amount'];
            $totalticketprice += $preord['Preorders']['amount'];
            echo '<br/>'; 
			echo '<hr/>';
           }
        }
		
			echo __('Dein Ticketpreis: ',true) . $totalticketprice . __('Chf.-',true);
			echo '<hr/>';
			echo '<br />';
		
         echo $this->Html->link('Ausloggen?', array('action'=>'logout','admin' => null));
         echo '</span>';
        } else {
         
          echo $this->Form->create('User', array('action' => 'login'));
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