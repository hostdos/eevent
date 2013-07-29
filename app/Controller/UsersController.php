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
		$usr = $this->Auth->user('User');
		if ($usr['id'] == $id) {
			$this->set('isowner', true);
		}else{
			$this->set('isowner', false);
		}

		$this->loadModel('Registrations');
		$registration = $this->Registrations->findByUserId($id);
		$this->set('isregistered', $registration['Registrations']['registered']);

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
	 $clanoptions = array(
                    'fields'=>array('User.clan'),
                    'group' => '`User`.`clan`',
                );
	$clanlist = $this->User->find('list',$clanoptions);
	$this->set('clanlist', $clanlist);
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
			$datestring = $this->request->data['User']['birthdate']['year'] . '/' .$this->request->data['User']['birthdate']['month'] . '/' . $this->request->data['User']['birthdate']['day'];
         	$datestring = date('Y-m-d', strtotime($datestring));
			$this->request->data['User']['birthdate'] = CakeTime::format('Y-m-d H:i:s',$datestring);			
			if ($this->User->save($this->request->data)) {



				$emailstring = 
				'Hallo ' . $this->request->data["User"]["prename"] .' '. $this->request->data["User"]["surname"] .',
				Vielen Dank für Ihre Registrierung auf eevent.ch. Damit ist die Anmeldung für die eevent LAN-Party jedoch noch nicht ganz abgeschlossen.</br>
				Um definitiv angemeldet zu sein, klicke bitte auf der http://www.eevent.ch auf die Schaltfläche “Jetzt für den eevent anmelden”</br>
				oder klicke auf folgenden Link:</br>
				<a href="www.eevent.ch/registrations/register" link </a></br>
				Vielen Dank für deine Teilnahme, wir freuen uns, dich vom 03-05 Mai in Subingen begrüssen zu dürfen.</br>
</br>
</br>
				Liebe Grüsse</br>
				Dein eevent Team</br>
				';
				$Email = new CakeEmail();
				$Email->emailFormat('both');
				$Email->from(array('info@eevent.ch' => 'Eevent info'));
				$Email->to(array( $this->request->data['User']['email'] => $this->request->data['User']['username']));
				$Email->subject(__('Registrierung auf Eevent.ch'));
				$Email->send($emailstring);

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
		$usr = $this->Auth->user('User');
		var_dump($usr['id']);
		var_dump($id);
		if ($usr['id'] === $id){

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
		} else {
			$this->Session->setFlash(__('You are not allowed to edit this User.'));
			$this->redirect(array('controller' => 'news', 'action' => 'index'));
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

	public function emails() {
	//	$this->loadModel('Registrations');
	//	$paidlist = $this->Registrations->find('list',array('fields' => array('registrations.user_id'), 'conditions' => array('registrations.paid !=' => 0)));
	//	array_flip($paidlist);
	//	echo "testsss";
	//	$paidkeys = array_keys($paidlist);
	//	echo "test";
		$userlist = $this->User->query("SELECT users.email FROM users JOIN registrations ON users.id = registrations.user_id WHERE paid=0");
		var_dump($userlist);
		//$userlist = $this->User->find('all', array('fields' => array('email')));
		$this->set('userlist', $userlist);
	}


	public function admin_index() {
/*
	if($authUser == null || $authUser['status'] != 1){
		$this->Session->setFlash(__('fuck off'));
		$this->redirect(array('controller' => 'registrations', 'action' => 'sitzplan'));
	}
*/

		$this->User->recursive = 0;
		$this->paginate = array('limit' => 300,'order' => array('username' => 'asc'));
		$this->set('users', $this->paginate());
		$this->loadModel('Registrations');
		$registrations = $this->Registrations->find('all', array( 'fields' => array(
		'Registrations.id','Registrations.user_id','Registrations.registered','Registrations.paid','Registrations.checkin')));
		//print_r($registrations);
		
		$registrationslist = array();
		foreach($registrations as $regs){
			$registrationslist[$regs['Registrations']['user_id']] = $regs['Registrations'];
		}
		$this->set('registrations', $registrationslist);
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

	public function admin_setpaid() {
		$this->loadModel('Registrations');
		
		$allreg = $this->Registrations->find('list',array(
		'fields' => 'user_id',
		'conditions' => array('paid' => '1')));
		

		$users = $this->User->find('list', array(
		'fields' => array('username','prename','surname'),
		'conditions' => array('id' => $allreg)));

		$this->set('userlist',$users);
		
		if(isset($this->data()) && $this->request->is('post')){
			$userreg = $this->Registrations->findByUserId($userid);
			
			
			
		}

	}