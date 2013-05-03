<?php
App::uses('AppController', 'Controller');
/**
 * Preorders Controller
 *
 * @property Preorder $Preorder
 */
class PreordersController extends AppController {


	public $components = array('Session');


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Preorder->recursive = 0;
		$userp = $this->Auth->user('User');
		$this->paginate = array('conditions' => array('Preorder.user_id' => $userp['id']));
		$this->set('preorders', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Preorder->exists($id)) {
			throw new NotFoundException(__('Invalid preorder'));
		}
		$options = array('conditions' => array('Preorder.' . $this->Preorder->primaryKey => $id));
		$this->set('preorder', $this->Preorder->find('first', $options));
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
			$this->Session->setFlash(__('Leider hast du noch nicht einbezahlt, deshalb kannst du keine Energy-Drinks vorbestellen.'));
			$this->redirect(array('controller' => 'preorders', 'action' => 'index'));

		}

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Preorder->create();
			$userp = $this->Auth->user('User');

			$this->request->data['Preorder']['user_id'] = $userp['id'];
			$this->checkPaid();
			if($this->request->data['Preorder']['amount'] > 0 && $this->request->data['Preorder']['verbindlich'] == 1){
				if ($this->Preorder->save($this->request->data)) {
					$this->Session->setFlash(__('Deine Vorbestellung wurde gespeichert'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Deine Vorbestellung konnte nicht gespeichert werden.'));
				}
			}else{
					$this->Session->setFlash(__('Deine Vorbestellung konnte nicht gespeichert werden.'));
			}
		}
		$users = $this->Preorder->User->find('list');
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
		if (!$this->Preorder->exists($id)) {
			throw new NotFoundException(__('Invalid preorder'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Preorder->save($this->request->data)) {
				$this->Session->setFlash(__('The preorder has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The preorder could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Preorder.' . $this->Preorder->primaryKey => $id));
			$this->request->data = $this->Preorder->find('first', $options);
		}
		$users = $this->Preorder->User->find('list');
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
		$this->Preorder->id = $id;
		if (!$this->Preorder->exists()) {
			throw new NotFoundException(__('Invalid preorder'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Preorder->delete()) {
			$this->Session->setFlash(__('Preorder deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Preorder was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
