<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('AppController', 'Controller');
/**
 * Registrations Controller
 *
 * @property Registration $Registration
 */
class RegistrationsController extends AppController {

public $components = array('Auth','Email');



	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('liste');
	}



	public function register() {
		$user = $this->Auth->user('User');
		$this->loadModel('User');
		$usermail = $this->User->findById($user['id']);
		$usermail = $usermail['User']['email'];

	//check if register entry exists, if yes then set it to 1
	//$options = array('conditions' => 'registrations.user_id' => $user['id'])
	$registr = $this->Registration->findByUserId($user['id']);
	if(empty ($registr)) {
		$this->Registration->create();
		$regist['user_id'] = $user['id'];
		$regist['registered'] = 1;


		if($this->Registration->save($regist)){
			$Email = new CakeEmail();
			$Email->from(array('info@eevent.ch' => 'Eevent info'));
			$Email->to(array( $usermail => $user['username']));
			$Email->subject(__('Registrierung für EEvent 2.0'));

			$emailstring = "Hallo ". $user['username'] .",
Deine Anmeldung für die eevent LAN-Party 2.0 war erfolgreich!
Damit du einen Sitzplatz auswählen kannst und du definitiv einen Platz hast, musst du nun nur noch den Unkostenbeitrag von CHF 45.00 auf folgendes Konto überweisen.

Zahlungsdetails:
Filmsoft Verein
Weingartstrasse 11
3014 Bern
CH41 0630 0016 9466 1000 6
Valiant Bank
3001 Bern

Betreff: Nickname, eevent 2.0

Bei Zahlungen für mehrere Personen einfach alle Nicknamen angeben.

Vielen Dank. Wir freuen uns sehr, dich vom 03-05 Mai in Subingen begrüssen zu dürfen.

Liebe Grüsse
Dein Eevent Team
";


			$Email->send($emailstring);

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

			$Email = new CakeEmail();
			$Email->from(array('info@eevent.ch' => 'Eevent info'));
			$Email->to(array( $usermail => $user['username']));
			$Email->subject(__('Anmeldung für EEvent 2.0'));

		$emailstring = "Hallo ". $user['username'] .",
Deine Anmeldung für die eevent LAN-Party 2.0 war erfolgreich!
Damit du einen Sitzplatz auswählen kannst und du definitiv einen Platz hast, musst du nun nur noch den Unkostenbeitrag von CHF 45.00 auf folgendes Konto überweisen.

Zahlungsdetails:
Filmsoft Verein
Weingartstrasse 11
3014 Bern
CH41 0630 0016 9466 1000 6
Valiant Bank
3001 Bern

Betreff: Nickname, eevent 2.0

Bei Zahlungen für mehrere Personen einfach alle Nicknamen angeben.

Vielen Dank. Wir freuen uns sehr, dich vom 03-05 Mai in Subingen begrüssen zu dürfen.

Liebe Grüsse
Dein Eevent Team
";
			$Email->send($emailstring);

			$this->Session->setFlash(__('You are now registered'));
			$this->redirect(array('controller' => 'news', 'action' => 'index'));



		}else{
			$this->Session->setFlash(__('The registration could not be saved. Please, try again.'));
		}




	}
}


	public function unregister() {
		$user = $this->Auth->user('User');
		$this->loadModel('User');
		$usermail = $this->User->findById($user['id']);
		$usermail = $usermail['User']['email'];

	$registr = $this->Registration->findByUserId($user['id']);
	if(empty ($registr)) {
		$this->Registration->create();
		$regist['user_id'] = $user['id'];
		$regist['registered'] = 0;


		if($this->Registration->save($regist)){
			$Email = new CakeEmail();
			$Email->from(array('info@eevent.ch' => 'Eevent info'));
			$Email->to(array( $usermail => $user['username']));
			$Email->subject(__('Abmeldung für EEvent 2.0'));
			$Email->send(__('Du hast dich von der EEvent 2.0 Abgemeldet, schade :('));
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
			$Email = new CakeEmail();
			$Email->from(array('info@eevent.ch' => 'Eevent info'));
			$Email->to(array( $usermail => $user['username']));
			$Email->subject(__('Abmeldung für EEvent 2.0'));
			$Email->send(__('Du hast dich von der EEvent 2.0 Abgemeldet, schade :('));

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

	public function liste() {
		$this->loadModel('Registrations');
		$this->loadModel('Users');
		$this->loadModel('UserRegistrations');
		$this->UserRegistrations->bindModel(array('belongsTo' => array('Users')));
		$angemeldet = $this->Registrations->find('list', array(
        'conditions' => array('Registrations.registered' => 1),
        'fields' => 'Registrations.user_id',
        'recursive' => 1
        ));

        $users = $this->Users->find('list', array(
        	'conditions' => array('Users.id' => $angemeldet),
        	'fields' => 'Users.username'
        	));

        $this->set('users', $users);
      //  var_dump($test);
        var_dump($users);
/*        foreach ($angemeldet as $a) {
        	$user = $this->Users->findById($a['user_id']);
        	var_dump($a);
        }
*/

	}

}
