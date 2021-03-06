<?php
App::uses('AppController', 'Controller');
/**
 * News Controller
 *
 * @property News $News
 */


class NewsController extends AppController {


	public $helpers = array('News','Comments');
	public $components = array('Auth');


	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('news','full');
	}


	public function index() {
		$this->set('amount', 4);
		$this->layout = 'bootstrap_basic';
	}

	public function view($id = null)	{
				if (!$this->News->exists($id)) {
			throw new NotFoundException(__('Invalid news'));
		}
		$this->set('id',$id);
		$this->set('newsid',$id);
		
	}

	public function full() {
	//	$this->layout = 
		$this->set('amount', 999999999);
		$this->render('index');
	}





/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->News->recursive = 0;
		$this->set('news', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->News->exists($id)) {
			throw new NotFoundException(__('Invalid news'));
		}
		$options = array('conditions' => array('News.' . $this->News->primaryKey => $id));
		$this->set('news', $this->News->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			//$this->loadModel('Comments');
			$this->News->create();
var_dump($this->request->data);
			if ($this->News->save($this->request->data)) {
			//	$this->Comments->create();
			//	$commentvars['id'] = $this->News->getLastInsertId();
				$this->Session->setFlash(__('The news has been saved'));
				$this->redirect(array('action' => 'index','controller' => 'news' ,'admin' => null));
			} else {
				$this->Session->setFlash(__('The news could not be saved. Please, try again.'));
			}
		}
		$users = $this->News->Users->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->News->exists($id)) {
			throw new NotFoundException(__('Invalid news'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->News->save($this->request->data)) {
				$this->Session->setFlash(__('The news has been saved'));
				$this->redirect(array('action' => 'index' ,'admin' => null));
			} else {
				$this->Session->setFlash(__('The news could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('News.' . $this->News->primaryKey => $id));
			$this->request->data = $this->News->find('first', $options);
		}
		$users = $this->News->Users->find('list');
		$this->set(compact('users'));
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
		$this->News->id = $id;
		if (!$this->News->exists()) {
			throw new NotFoundException(__('Invalid news'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->News->delete()) {
			$this->Session->setFlash(__('News deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('News was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
