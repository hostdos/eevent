<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {


public $components = array('Auth','Session');
public $helpers = array('Html');



	public function beforeFilter(){
		parent::beforeFilter();
		App::uses('CakeTime', 'Utility');
		//	Secur ity::hash($password, 'md5', false);
		$this->Auth->allow('login','logout','add');
		//Configure::write('Config.language', $this->Session->read('Config.language'));
		//$this->Auth->authenticate = array(
		// AuthComponent::ALL => array(
		// 'scope' => array('is_disabled' => 0)
		// )
	}


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}




	public function login() {


		if($this->request->is('post')){
		
			
			$logindata = $this->data;
				$userid = $this->User->find('first', array(
				'conditions' => array(
				'User.username' => $logindata['User']['username'],
				'User.password' => Security::hash(($logindata['User']['password']), 'md5',false)
				)
			));
			if(isset($userid['User']['id'])){
				var_dump($logindata);
			$logindata['User']['id'] = $userid['User']['id'];
			$logindata['User']['status'] = $userid['User']['status'];

			}else{
				$this->Session->setFlash(__('Falscher Name oder Passwort'));
			}
			
		if(isset($userid['User']) && $this->Auth->login($logindata)) {
  				$this->Session->setFlash(__('Login erfolgreich!'));
				$this->redirect($this->Auth->redirect());
		} else {
			$this->Session->setFlash(__('Falscher Name oder Passwort'));
		}
	}
		
}




public function oldlogin() {
    if ($this->request->is('post')) {

    	//Security::setHash('md5');
    	//Security::hash('md5', false);

        if ($this->Auth->login()) {
            $this->redirect($this->Auth->redirect());
        } else {
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }
}


	public function logout() {
		
		$this->Session->SetFlash(__('Sie sind Ausgeloggt!'));
		$this->redirect($this->Auth->Logout());
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}




	public function beforeSave() { 
        $this->data['User']['password'] = md5($this->data['User'] 
		['password']);
    return true; 
}  

	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			$this->request->data['User']['status'] = 0;
			$this->request->data['User']['isdisabled'] = 0;
			$this->request->data['User']['password'] = Security::hash($this->request->data['User']['password'], 'md5',false);
			$this->request->data['User']['birthdate'] = CakeTime::format('Y-m-d H:i:s',$this->request->data['User']['birthdate']);			
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				var_dump($this->request->data);
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$user = $this->data['User'];
			if($user['password1'] == $user['password2'] && $user['password1'] != null && $user['password1'] != ''
			&& $user['password2'] != null && $user['password2'] != ''){
				$this->request->data['User']['password'] = Security::hash($user['password1'], 'md5',false);
			}

			if ($this->User->save($this->request->data['User'])) {
				$this->Session->setFlash(__('The user has been saved'));
				//$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
