<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array('Auth','Session'); 


	public function beforefilter(){
		$this->layout = 'bootstrap_basic';
		CakeSession::write('Config.language', 'deu');
		Configure::write('Config.language','de');
		$this->set('authUser', $this->Auth->user('User'));
		$user = $this->Auth->user('User');
		$this->loadModel('Registrations');
		$userRegistr = $this->Registration->findByUserId($user['id'],array(
		'conditions' => array('Registrations.registered' => 1)));
		$this->set('userRegistr',$userRegistr);
		$all = 228;
		$angemeldet = $this->Registrations->find('count', array(
        'conditions' => array('Registrations.registered' => 1)));
   		$bezahlt = $this->Registrations->find('count', array(
        'conditions' => array('Registrations.registered' => 1, 'Registrations.paid' => 1)));
        $angemeldet = $angemeldet - $bezahlt;
		$progressbar['angemeldet']['num'] = $angemeldet;
		$progressbar['angemeldet']['perc'] = $this->percentage($angemeldet);
		$progressbar['bezahlt']['num'] = $bezahlt;
		$progressbar['bezahlt']['perc'] = $this->percentage($bezahlt);
		$tempnum = $all - ($bezahlt + $angemeldet);
		$progressbar['frei']['num'] = $tempnum;
		$progressbar['frei']['perc'] = 100 - ($progressbar['bezahlt']['perc'] + $progressbar['angemeldet']['perc']);
		$this->set('progressbar', $progressbar);

/*
		$progressbar['frei']['num'] = $tempnum;
		$progressbar['frei']['perc'] = $this->percentage($tempnum);
*/
		//now calculate pricemoneh
		$pricemoney = array();
		$pricemoney['lol'] = 
		$this->Registrations->find('all', array('conditions' => array('Registrations.registered' => 1), 'fields' => 'SUM(price_lol)'));
		$pricemoney['cs'] = 
		$this->Registrations->find('all', array('conditions' => array('Registrations.registered' => 1), 'fields' => 'SUM(price_go)'));
		$pricemoney['sc'] = 
		$this->Registrations->find('all', array('conditions' => array('Registrations.registered' => 1), 'fields' => 'SUM(price_sc)'));
		$pricemoney['lol'] = substr($pricemoney['lol'][0][0]['SUM(price_lol)'], 0, -3);		
		$pricemoney['cs'] = substr($pricemoney['cs'][0][0]['SUM(price_go)'], 0, -3);
		$pricemoney['sc'] = substr($pricemoney['sc'][0][0]['SUM(price_sc)'], 0, -3);
		$this->set('pricemoney', $pricemoney);

		$this->allowAccess(); 
			}


	private function allowAccess() {

   if (in_array($this->name, array('News','Event','Team','Pages','Tournaments','Participants','Search'))) {
     $this->Auth->allow(array('index','display','view','add','edit', 'forgotpass','liste','full'));
   }
 }
 	private function percentage($num = null){
 		$count1 = $num / 228;
		$count2 = $count1 * 100;
		$count = number_format($count2, 0);
		return $count;
 	}
	 	private function percentage_floor($num = null){
 		$count1 = $num / 228;
		$count2 = $count1 * 100;
		$count = floor($count2);
		return $count;
 	}


}
