<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {


public $components = array('Auth','Session','Email');
public $helpers = array('Html');



	public function beforeFilter(){
		parent::beforeFilter();
		App::uses('CakeTime', 'Utility');
		//	Secur ity::hash($password, 'md5', false);
		$this->Auth->allow('login','logout','add','forgotpass');
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
			$logindata['User']['id'] = $userid['User']['id'];
			$logindata['User']['status'] = $userid['User']['status'];

			}else{
				$this->Session->setFlash(__('Falscher Name oder Passwort'));
			}
			
		if(isset($userid['User']) && $this->Auth->login($logindata)) {
  				$this->Session->setFlash(__('Login erfolgreich!'));
				$this->redirect(array('controller' => 'news', 'action' => 'index'));
		} else {
			$this->Session->setFlash(__('Falscher Name oder Passwort'));
		}
	}
		
}

public function forgotpass(){

    if ($this->request->is('post') && $this->data['User']) {

    	//Security::hash('md5', false);
        
    	$conditions = array('conditions' => array('User.username' => $this->data['User']['username']));


        $usr = $this->User->find('first', $conditions);

        if (!empty($usr)) {

		  //Initialize the random password
		  $password = '';

		  //Initialize a random desired length
		  $desired_length = rand(8, 12);

		  for($length = 0; $length < $desired_length; $length++) {
		    //Append a random ASCII character (including symbols)
		    $password .= chr(rand(32, 126));
		  }

        	$Email = new CakeEmail();
			$Email->from(array('info@eevent.ch' => 'Eevent info'));
			$Email->to(array( $usr['User']['email'] => $usr['User']['username']));
			$Email->subject(__('Passwort reset'));
			$Email->send(__('Dein neues Passwort: ') . $password );

			//set pw and id in user thing
			$user['id'] = $usr['User']['id'];
			$user['password'] = Security::hash($password, 'md5', false);
			//save new pw in db	
			if($this->User->save($user)){
            $this->redirect(array('controller' => 'news', 'action' => 'index'));
			}

        } else {
            $this->Session->setFlash(__('Invalid username or password, try again'));
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
			$condoptions = array('conditions' => array(
				'OR' => array(
				array('User.username' => $this->request->data['User']['username']),
				array('User.email' => $this->request->data['User']['email']),
				)));
			$userexist = $this->User->find('first', $condoptions);
			if(empty($userexist)){
			$this->User->create();
			$this->request->data['User']['status'] = 0;
			$this->request->data['User']['isdisabled'] = 0;
			$this->request->data['User']['password'] = Security::hash($this->request->data['User']['password'], 'md5',false);
			$datestring = $this->request->data['User']['birthdate']['year'] . '-' .$this->request->data['User']['birthdate']['month'] . '-' . $this->request->data['User']['birthdate']['day'];
         	$datestring = DateTime::createFromFormat('Y-m-d', $datestring);
			$this->request->data['User']['birthdate'] = CakeTime::format('Y-m-d H:i:s',$datestring);			
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
			} else {
				$this->Session->setFlash(__('The user already exists. Please, try again.'));

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
