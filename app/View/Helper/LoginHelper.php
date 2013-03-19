<?php

/* /app/View/Helper/LinkHelper.php */
App::uses('AppHelper', 'View/Helper');

class LoginHelper extends AppHelper {

	public $helpers = array('Html','Form');

	public function getLoginTab(){
		$_output .= $this->Form->create('User', array('action' => 'login'));
		$_output .= $this->Form->input('username', array('placeholder' => 'username'));
		$_output .= $this->Form->password('password', array('placeholder' => 'passwort')); // No div, no label
		$_output .= $this->Form->submit('login');
		$_output .= $this->Form->end();
		return $_output;
	}


	

}


?>