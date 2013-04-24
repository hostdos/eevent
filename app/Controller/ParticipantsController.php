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

	private function checkSingle($tournamentid){
		$userp = $this->Auth->user('User');
		$userp = $this->Participant->find('count', array('conditions' => array('participant.user_id' => $userp['id'], 'participant.tournament_id' =>  $tournamentid, 'participant.parent_id' => NULL)));
		if($userp > 1){
			$this->Session->setFlash(__('Du hast dich für das Turnier schon angemeldet!.'));
			$this->redirect(array('controller' => 'tournaments', 'action' => 'index'));
		}
	}

	private function checkTeam($tournamentid){
		$userp = $this->Auth->user('User');
		$userp = $this->Participant->find('count', array('conditions' => array('participants.user_id' => $userp['id'], 'tournament_id' =>  $tournamentid, 'parent_id !=' => NULL)));
		
		if($userp > 1){
			$this->Session->setFlash(__('Du hast dich für das Turnier schon in einem andern Team angemeldet!.'));
			$this->redirect(array('controller' => 'tournaments', 'action' => 'index'));
		}

	}




	private function checkPaid($id = null){
		$userreg = null;
		$this->loadModel('Registrations');
				if($id == null){
			$userreg = $this->Auth->user('User');
			$userreg = $this->Registrations->findByUserId($userreg['id']);
		}else{
		$userreg = $this->Registrations->findById($id);
		}
		if($userreg['Registrations']['paid'] != 1){
			$this->Session->setFlash(__('Leider hast du noch nicht einbezahlt, deshalb kannst du dich nicht für ein Turnier anmelden.'));
			$this->redirect(array('controller' => 'tournaments', 'action' => 'index'));

		}

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
		$this->loadModel('Users');
		$this->set('Users', $this->Users->find('list', array('fields' => array('id','username'))));
		$self = $this->Participant->findById($id);
		$this->set('tournamentid', $self['Participant']['tournament_id']);
		$ChildParticipants = $this->Participant->findAllByParentId($id);
		$this->set('ChildParticipants', $ChildParticipants);
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
				$this->loadModel('Users');
		$this->loadModel('ParentParticipant');
		$this->loadModel('Tournament');

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
			$this->checkPaid();
			$this->checkSingle($this->request->data['Participant']['tournament_id']);
			if ($this->Participant->save($this->request->data)) {
				$this->Session->setFlash(__('Deine Anmeldung wurde gespeichert'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Deine Anmeldung konnte nicht gespeichert werden'));
			}
		}
		$this->loadModel('Users');
		$this->loadModel('ParentParticipant');
		$this->loadModel('Tournament');

		$users = $this->Participant->User->find('list');
		$tournaments = $this->Participant->Tournament->find('list', array('conditions' => array('maxsize' => NULL)));
		$this->set(compact('users', 'tournaments'));
	}

	public function joinTeam($parentid = null, $teamid = null) {
		if ($this->request->is('post')) {
			$parent = $this->Participant->findById($this->request->data['Participant']['parentParticipants']);
			//$options = array('conditions' => array('parent_id' => $parentid));
			//$self = $this->Participant->findAllByUserId( $parentid , array('conditions' => array('parent_id' => $parentid)));
			$parentpw = $parent['Participant']['password'];
			if($this->request->data['Participant']['password'] == $parentpw){
			$this->Participant->create();
			$user = $this->Auth->user('User');
			$this->request->data['Participant']['user_id'] = $user['id'];
			$this->request->data['Participant']['parent_id'] = $teamid;
			$this->checkPaid();
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
		$parentParticipants = $this->Participant->ParentParticipant->find('list', array('conditions' => array('type' => 2, 'tournament_id' => $parentid)));
		$this->set(compact('users', 'parentParticipants', 'tournaments'));
		$this->set('teamid',$teamid);
	}
	public function addTeam() {
		if ($this->request->is('post')) {
			$this->Participant->create();
			$this->request->data['Participant']['type'] = 2;
			$this->checkPaid();
			if ($this->Participant->save($this->request->data)) {
				$this->Session->setFlash(__('Das Team wurde gespeichert'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Das Team konnte nicht gespeichert werden'));
			}
		}
		$this->loadModel('Users');
		$this->loadModel('ParentParticipant');
		$this->loadModel('Tournament');

		$users = $this->Participant->User->find('list');
		$parentParticipants = $this->Participant->ParentParticipant->find('list');
		$tournaments = $this->Participant->Tournament->find('list', array('conditions' => array('maxsize' => '5')));
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
				$this->loadModel('Users');
		$this->loadModel('ParentParticipant');
		$this->loadModel('Tournament');

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
