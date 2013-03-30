<?php
App::uses('AppController', 'Controller');
/**
 * Registrations Controller
 *
 * @property Registration $Registration
 */
class RegistrationsController extends AppController {

public $components = array('Auth');



	public function beforeFilter(){
		parent::beforeFilter();
		
	}



	public function register() {
	$user = $this->Auth->user('User');

	//check if register entry exists, if yes then set it to 1
	//$options = array('conditions' => 'registrations.user_id' => $user['id'])
	$registr = $this->Registration->findByUserId($user['id']);
	if(empty ($registr)) {
		$this->Registration->create();
		$regist['user_id'] = $user['id'];
		$regist['registered'] = 1;


		if($this->Registration->save($regist)){
			$this->Session->setFlash(__('You are now registered'));
			$this->redirect(array('controller' => 'news', 'action' => 'index'));
		}else{
			$this->Session->setFlash(__('The registration could not be saved. Please, try again.'));
		}
	}else{
	//if not exists then create and put 1
		$regist['id'] = $registr['Registration']['id'];
		$regist['registered'] = 1;

		if($this->Registration->save($regist)){
			$this->Session->setFlash(__('You are now registered'));
			$this->redirect(array('controller' => 'news', 'action' => 'index'));
		}else{
			$this->Session->setFlash(__('The registration could not be saved. Please, try again.'));
		}




	}
}


	public function unregister() {
		$user = $this->Auth->user('User');

	$registr = $this->Registration->findByUserId($user['id']);
	if(empty ($registr)) {
		$this->Registration->create();
		$regist['user_id'] = $user['id'];
		$regist['registered'] = 0;


		if($this->Registration->save($regist)){
			$this->Session->setFlash(__('You are now unregistered'));
			$this->redirect(array('controller' => 'news', 'action' => 'index'));
		}else{
			$this->Session->setFlash(__('The registration could not be saved. Please, try again.'));
		}
	}else{
	//if not exists then create and put 0
		$regist['id'] = $registr['Registration']['id'];
		$regist['registered'] = 0;

		if($this->Registration->save($regist)){
			$this->Session->setFlash(__('You are now unregistered'));
			$this->redirect(array('controller' => 'news', 'action' => 'index'));
		}else{
			$this->Session->setFlash(__('The registration could not be saved. Please, try again.'));
		}
	}
}


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Registration->recursive = 0;
		$this->set('registrations', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Registration->exists($id)) {
			throw new NotFoundException(__('Invalid registration'));
		}
		$options = array('conditions' => array('Registration.' . $this->Registration->primaryKey => $id));
		$this->set('registration', $this->Registration->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Registration->create();
			if ($this->Registration->save($this->request->data)) {
				$this->Session->setFlash(__('The registration has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registration could not be saved. Please, try again.'));
			}
		}
		$users = $this->Registration->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Registration->exists($id)) {
			throw new NotFoundException(__('Invalid registration'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Registration->save($this->request->data)) {
				$this->Session->setFlash(__('The registration has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The registration could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Registration.' . $this->Registration->primaryKey => $id));
			$this->request->data = $this->Registration->find('first', $options);
		}
		$users = $this->Registration->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Registration->id = $id;
		if (!$this->Registration->exists()) {
			throw new NotFoundException(__('Invalid registration'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Registration->delete()) {
			$this->Session->setFlash(__('Registration deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Registration was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
