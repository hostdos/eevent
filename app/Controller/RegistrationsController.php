<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('AppController', 'Controller');
/**
 * Registrations Controller
 *
 * @property Registration $Registration
 */
class RegistrationsController extends AppController {

public $helpers = array('Js');
public $components = array('Auth','Email','RequestHandler');

	var $uses = array('Preorder','Registration');

	public function beforeFilter(){
		parent::beforeFilter();

		$this->Auth->allow('liste', 'sitzplan','pdfgener');
				$this->layout = 'bootstrap_basic';

	}

	public function editPriceMoney(){
		//edit the pricemoney stuff that the User set while registering
		
		
		
		
	}

	public function register() {
		$user = $this->Auth->user('User');
		$this->loadModel('User');
		$usermail = $this->User->findById($user['id']);
		$usermail = $usermail['User']['email'];
	//check if register entry exists, if yes then set it to 1
	//$options = array('conditions' => 'registrations.user_id' => $user['id'])
	$isregistered = $this->Registration->find('all',array(
	'conditions' => array(
	'user_id' => $user['id'],
	'registered' => 1)));
	$registr = $this->Registration->findByUserId($user['id']);
		$hassaved = 0;
	if(!empty($registr) && !empty($isregistered)){
		$this->Session->setFlash(__('You are already registered'));
		$this->redirect(array('controller' => 'news', 'action' => 'index'));
	}
	if($this->request->is('post')){
		if(empty ($registr)) {
			$this->Registration->create();
			$regist['user_id'] = $user['id'];
			$regist['registered'] = 1;
			$regist['price_lol'] = $this->data['registrations']['price_lol'];
			$regist['price_go'] = $this->data['registrations']['price_csgo'];
			$regist['price_sc'] = $this->data['registrations']['price_hots'];

			if($this->Registration->save($regist)){
				$hassaved = 1;

				$Email = new CakeEmail();
				$Email->from(array('info@eevent.ch' => 'Eevent info'));
				$Email->to(array( $usermail => $user['username']));
				$Email->subject(__('Registrierung für EEvent 3.0'));

				$emailstring = "Hallo ". $user['username'] .",
				Deine Anmeldung für die eevent LAN-Party 3.0 war erfolgreich!
				Damit du einen Sitzplatz auswählen kannst und du definitiv einen Platz hast, musst du nun nur noch den Unkostenbeitrag von CHF 45.00 auf folgendes Konto überweisen.

				Zahlungsdetails:
				Filmsoft Verein
				Weingartstrasse 11
				3014 Bern
				CH41 0630 0016 9466 1000 6
				Valiant Bank
				3001 Bern

				Betreff: Nickname, eevent 3.0

				Bei Zahlungen für mehrere Personen einfach alle Nicknamen angeben.

				Vielen Dank. Wir freuen uns sehr, dich vom 08-10 November in Subingen begrüssen zu dürfen.

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
		//if exists then set to 1
			$regist['id'] = $registr['Registration']['id'];
			$regist['price_lol'] = $this->data['registrations']['price_lol'];
			$regist['price_go'] = $this->data['registrations']['price_csgo'];
			$regist['price_sc'] = $this->data['registrations']['price_hots'];
			$regist['registered'] = 1;

			if($this->Registration->save($regist)){
				$hassaved = 1;
				$this->Session->setFlash(__('You are now registered'));



			}else{
				$this->Session->setFlash(__('The registration could not be saved. Please, try again.'));
			}

		}
		if($hassaved == 1){
			if(!empty($registr)){
				$this->Preorder->deleteAll(array('user_id' => $user['id']));
			}

			//save spiesspreorder
			$spreorder['user_id'] = $user['id'];
			$spreorder['amount'] = 1;
			$spreorder['spiesstype'] = $this->data['preorder']['spiesstype'];
			$this->Preorder->create();
			if($this->Preorder->save($spreorder)){
			}else{
				$hassaved = 0;
			}

			$preorder['user_id'] = $user['id'];
			$preorder['amount'] = $this->data['preorders']['amount'];
			$preorder['spiesstype'] = 'energy';
			$this->Preorder->create();
			if($this->Preorder->save($preorder)){
			}else{
				$hassaved = 0;
			}
			$this->redirect(array('controller' => 'news', 'action' => 'index'));
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
			$Email->subject(__('Abmeldung für EEvent 3.0'));
			$Email->send(__('Du hast dich von der EEvent 3.0 Abgemeldet, schade :('));
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
			$Email->subject(__('Abmeldung für EEvent 3.0'));
			$Email->send(__('Du hast dich von der EEvent 3.0 Abgemeldet, schade :('));

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
		$this->layout = 'bootstrap_basic';
		$this->loadModel('Registrations');
		$this->loadModel('Users');
		$this->loadModel('UserRegistrations');
		$this->UserRegistrations->bindModel(array('belongsTo' => array('Users')));
		$angemeldet = $this->Registrations->find('list', array(
        'conditions' => array('Registrations.registered' => 1, 'Registrations.paid' => 0),
        'fields' => 'Registrations.user_id',
        'order' => 'Registrations.created',
        'recursive' => 1
        ));
        
   		$paid = $this->Registrations->find('list', array(
        'conditions' => array('Registrations.registered' => 1, 'Registrations.paid' => 1),
        'fields' => 'Registrations.user_id',
        'order' => 'Registrations.created',
        'recursive' => 1
        ));


        

        $usersangemeldet = $this->Users->find('list', array(
        	'conditions' => array('Users.id' => $angemeldet),
        	'fields' => 'Users.username'
        	));

        $userspaid = $this->Users->find('list', array(
        	'conditions' => array('Users.id' => $paid),
        	'fields' => 'Users.username'
        	));

        $this->set('usersa', $usersangemeldet);
        $this->set('usersp', $userspaid);
      //  var_dump($test);
/*        foreach ($angemeldet as $a) {
        	$user = $this->Users->findById($a['user_id']);
        	var_dump($a);
        }
*/

	}
	
	public function sitzplan() {


		$this->layout = 'content_only';

		$this->loadModel('Users');
		if($this->Auth->loggedin()){
		$user = $this->Auth->user('User');
		$userreg = $this->Registrations->findByUserId($user['id']);
		$this->set('userreg', $userreg);
		}
		$userreservations = $this->Registrations->find('all',array(
		'conditions' => array('Registrations.seat !=' => 'NULL'),
		'fields' => array('Registrations.user_id','Registrations.seat')));
		$seatarray = array();
		foreach($userreservations as $reg){
		$seat['seatId'] = $reg['Registrations']['seat'];
		
		$thisuser = $this->Users->findById($reg['Registrations']['user_id'], array(
		'fields' => 'Users.id', 'Users.username', 'Users.clan'));
		$seat['username'] = $thisuser['Users']['username'];
		$seat['clan'] = $thisuser['Users']['clan'];
		array_push($seatarray, $seat);
		}
		$this->set('seats', $seatarray);
	}


	public function reserveSeat($seatid = null) {
	if($seatid != null && $this->Auth->loggedin() ){
		$user = $this->Auth->user('User');
		$reg = $this->Registrations->findByUserId($user['id']);
		
		$newseatreg['id'] = $reg['Registrations']['id'];
		$newseatreg['seat'] = $seatid;
		if($this->Registrations->save($newseatreg)){
		$this->Session->setFlash(__('seat reserved'));
		$this->redirect(array('controller' => 'registrations', 'action' => 'sitzplan'));
			}else{
		$this->Session->setFlash(__('could not reserve seat'));
		$this->redirect(array('controller' => 'registrations', 'action' => 'sitzplan'));
		
			}
		}else{
		$this->Session->setFlash(__('fuck off'));
		$this->redirect(array('controller' => 'registrations', 'action' => 'sitzplan'));
		}
	}
	
	public function removereservation() {
		if($this->Auth->loggedin() ){
		$user = $this->Auth->user('User');
		$reg = $this->Registrations->findByUserId($user['id']);
		
		$newseatreg['id'] = $reg['Registrations']['id'];
		$newseatreg['seat'] = Null;
		if($this->Registrations->save($newseatreg)){
		$this->Session->setFlash(__('seat reservation deleted'));
		$this->redirect(array('controller' => 'registrations', 'action' => 'sitzplan'));
			}else{
		$this->Session->setFlash(__('could not delete seat reservation'));
		$this->redirect(array('controller' => 'registrations', 'action' => 'sitzplan'));
		}
		}else{
		$this->Session->setFlash(__('fuck off'));
		$this->redirect(array('controller' => 'registrations', 'action' => 'sitzplan'));

		}
	}
	public function admin_pay($userid){
		$reg = $this->Registrations->findByUserId($userid);		
		$newseatreg['id'] = $reg['Registrations']['id'];
		$newseatreg['user_id'] = $userid;
		$newseatreg['registered'] = 1;
		$newseatreg['paid'] = 1;
		if($this->Registrations->save($newseatreg)){
		$this->Session->setFlash(__('user bezahlt'));
		$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
			}else{
		$this->Session->setFlash(__('user konnte nicht bezahlt werden'));
		$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
		}

		
		
		$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
	}
		
	public function admin_checkin($userid){
		$reg = $this->Registrations->findByUserId($userid);		
		$this->set('Registration', $reg['Registrations']);
		if (isset($this->request->data['Registration'])) {
		$newseatreg['id'] = $reg['Registrations']['id'];
		$newseatreg['checkin'] = 1;
		$newseatreg['registered'] = 1;
		$newseatreg['paid'] = 1;
		$newseatreg['seat'] = $this->request->data['Registration']['seat'];

		if($this->Registrations->save($newseatreg)){
		$this->Session->setFlash(__('user eingecheckt'));
		$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
			}else{
		$this->Session->setFlash(__('user konnte nicht eingecheckt werden'));
		$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
		}

		
		
		//$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
	}
	}
	
	public function pdfgener(){
		App::uses('class.einzahlungsschein', 'einzahlungsschein');
		$amount= "150.20";
		$ref="5000001195";
		
		//Create a new pdf to create your invoice, already using FPDF
		//(if you don't understand this part you should have a look at the FPDF documentation)
		$pdf = new FPDF('P','mm','A4');
		$pdf->AddPage();
		$pdf->SetAutoPageBreak(0,0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(50, 4, "Zahlung für die EEvent 3.0 User: dos");
		
		//now simply include your Einzahlungsschein, sending your pdf instance to the Einzahlungsschein class
		$ezs = new Einzahlungsschein(196, 0, $pdf);
		$ezs->setBankData("Berner Kantonalbank AG", "3001 Bern", "01-200000-7");
		$ezs->setRecipientData("My Company Ltd.", "Exampleway 61", "3001 Bern", "123456");
		$ezs->setPayerData("Heinz Müller", "Beispielweg 23", "3072 Musterlingen");
		$ezs->setPaymentData($amount, $ref);
		$ezs->createEinzahlungsschein(false, true);
		
		$pdf->output();
	}

}
