<?php
App::uses('AppController', 'Controller');
/**
 * Participants Controller
 *
 * @property Participant $Participant
 * @property SessionComponent $Session
 */
class ParticipantsController extends AppController {

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
		$this->Participant->recursive = 0;
		$this->set('participants', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Participant->exists($id)) {
			throw new NotFoundException(__('Invalid participant'));
		}
		$options = array('conditions' => array('Participant.' . $this->Participant->primaryKey => $id));
		$this->set('participant', $this->Participant->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Participant->create();
			if ($this->Participant->save($this->request->data)) {
				$this->Session->setFlash(__('The participant has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The participant could not be saved. Please, try again.'));
			}
		}
		$users = $this->Participant->User->find('list');
		$parentParticipants = $this->Participant->ParentParticipant->find('list');
		$tournaments = $this->Participant->Tournament->find('list');
		$this->set(compact('users', 'parentParticipants', 'tournaments'));
	}

	public function addSingle() {
		if ($this->request->is('post')) {
			$this->Participant->create();

			$user = $this->Auth->user('User');
			$this->request->data['Participant']['user_id'] = $user['id'];

			if ($this->Participant->save($this->request->data)) {
				$this->Session->setFlash(__('Deine Anmeldung wurde gespeichert'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Deine Anmeldung konnte nicht gespeichert werden'));
			}
		}
		$users = $this->Participant->User->find('list');
		$parentParticipants = $this->Participant->ParentParticipant->find('list');
		$tournaments = $this->Participant->Tournament->find('list');
		$this->set(compact('users', 'parentParticipants', 'tournaments'));
	}

	public function joinTeam($parentid = null) {
		if ($this->request->is('post')) {
			$parent = $this->Participant->findById($parentid);
			$self = $this->Participant->findByUserId('all',array('conditions' => array('parent_id' => $parentid)));
			$parentpw = $parent['Participant']['password'];
			if($this->request->data['Participant']['password'] == $parentpw && empty($self)){
			$this->Participant->create();
			$user = $this->Auth->user('User');
			$this->request->data['Participant']['user_id'] = $user['id'];
			$this->request->data['Participant']['parent_id'] = $parentid;

			if ($this->Participant->save($this->request->data)) {
				$this->Session->setFlash(__('Du dem Team beigetreten'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Du konntest dem Team nicht beitreten'));
			}
		}else{
				$this->Session->setFlash(__('Du konntest dem Team nicht beitreten'));
		}
		}
		$parentParticipants = $this->Participant->ParentParticipant->find('list', array('conditions' => array('type' => 2)));
		$this->set(compact('users', 'parentParticipants', 'tournaments'));
	}
	public function addTeam() {
		if ($this->request->is('post')) {
			$this->Participant->create();
			$this->request->data['Participant']['type'] = 2;
			if ($this->Participant->save($this->request->data)) {
				$this->Session->setFlash(__('Das Team wurde gespeichert'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Das Team konnte nicht gespeichert werden'));
			}
		}
		$users = $this->Participant->User->find('list');
		$parentParticipants = $this->Participant->ParentParticipant->find('list');
		$tournaments = $this->Participant->Tournament->find('list');
		$this->set(compact('users', 'parentParticipants', 'tournaments'));
	}





/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Participant->exists($id)) {
			throw new NotFoundException(__('Invalid participant'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Participant->save($this->request->data)) {
				$this->Session->setFlash(__('The participant has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The participant could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Participant.' . $this->Participant->primaryKey => $id));
			$this->request->data = $this->Participant->find('first', $options);
		}
		$users = $this->Participant->User->find('list');
		$parentParticipants = $this->Participant->ParentParticipant->find('list');
		$tournaments = $this->Participant->Tournament->find('list');
		$this->set(compact('users', 'parentParticipants', 'tournaments'));
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
		$this->Participant->id = $id;
		if (!$this->Participant->exists()) {
			throw new NotFoundException(__('Invalid participant'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Participant->delete()) {
			$this->Session->setFlash(__('Participant deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Participant was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
