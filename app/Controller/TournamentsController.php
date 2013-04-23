<?php
App::uses('AppController', 'Controller');
/**
 * Tournaments Controller
 *
 * @property Tournament $Tournament
 * @property SessionComponent $Session
 */
class TournamentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Tournament->recursive = 0;
		$this->set('tournaments', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tournament->exists($id)) {
			throw new NotFoundException(__('Invalid tournament'));
		}
		$options = array('conditions' => array('Tournament.' . $this->Tournament->primaryKey => $id));
		$tournament = $this->Tournament->find('first', $options);
		$this->loadModel('Participants');
		$type = 0;
		if($tournament['Tournament']['maxsize'] == 5){
			$type = 2;
		}
		$this->loadModel('Users');
		$this->set('teilnehmer', $this->Participants->find('all', array('conditions' => array('type' => $type, 'tournament_id' => $id))));
		$this->set('tournament', $this->Tournament->find('first', $options));
		$this->set('users', $this->Users->find('list', array('fields' => array('id','username'))));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Tournament->create();
			if ($this->Tournament->save($this->request->data)) {
				$this->Session->setFlash(__('The tournament has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tournament could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Tournament->exists($id)) {
			throw new NotFoundException(__('Invalid tournament'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Tournament->save($this->request->data)) {
				$this->Session->setFlash(__('The tournament has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tournament could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Tournament.' . $this->Tournament->primaryKey => $id));
			$this->request->data = $this->Tournament->find('first', $options);
		}
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
		$this->Tournament->id = $id;
		if (!$this->Tournament->exists()) {
			throw new NotFoundException(__('Invalid tournament'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tournament->delete()) {
			$this->Session->setFlash(__('Tournament deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tournament was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
