<?php
App::uses('AppController', 'Controller');
/**
 * News Controller
 *
 * @property News $News
 * @property SessionComponent $Session
 * @property AuthComponent $Auth
 */
class EventController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $helpers = array('News');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->layout = 'bootstrap_basic';
		
	}
}
