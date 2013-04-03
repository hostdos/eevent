
<?php
echo $this->Form->create('User', array('controller' => 'users','action' => 'login'));
echo $this->Form->input('username', array('placeholder' => 'username'));
echo $this->Form->password('password', array('placeholder' => 'passwort')); // No div, no label
echo $this->Form->submit('login');
echo $this->Form->end();

echo $this->Html->link('Passwort vergessen?', array('controller' => 'users', 'action' => 'forgotpass'));
?>