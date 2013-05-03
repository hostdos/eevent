<?php
echo $this->Form->create('User', array('action' => 'forgotpass'));
echo $this->Form->input('username', array('placeholder' => 'username', 'allowEmpty' => true));
echo $this->Form->input('mail', array('placeholder' => 'mail', 'type' => 'email', 'allowEmpty' => true)); // No div, no label
echo $this->Form->submit('Passwort Zurücksetzen');
echo $this->Form->end();
?>