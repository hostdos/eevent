<?php 

echo $this->Form->create(array('action'=>'signup'));
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end('Signup');
?>
