<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property SessionComponent $Session
 * @property AuthComponent $Auth
 */
class UsersController extends AppController {
public $helpers = array('Html', 'Js');

public $components = array('Session', 'Auth', 'Newss');

// Login Functionality
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('event');
		$this->layout = 'bootstrap';

		
      }
    function login() {
    if ($this->request->is('post')) {
        if ($this->Auth->login($this->data)) {
            return $this->redirect($this->Auth->redirectUrl());
            // Prior to 2.3 use `return $this->redirect($this->Auth->redirect());`
        } else {
            $this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');
        }
    }
}   


	public function event(){
		
		$this->layout = 'bootstrap';
		$dat = $this->Newss->getNewsBig(2);
		var_dump($dat);
	}    

public  function logout()
    {
        $this->Session->setFlash('You are logged out!');
        $this->redirect($this->Auth->logout());
    }
 
    public  function signup() 
    {
 
        if (!empty($this->data)) {
              $this->User->create();
              if ($this->User->save($this->data)) {
              $this->Session->setFlash('User saved!');
              $this->redirect(array('action'=>'login'));
            } 
       else {
               $this->Session->setFlash('User not saved! There were some errors. Please rectify them and retry.');
             }

            }
       
          }





/**
 * Components
 *
 * @var array
 */


/*	public $components = array('RequestHandler','Session', 'Auth' => array(
        'loginAction' => array(
            'controller' => 'users',
            'action' => 'login',
        ),
        'authError' => 'Did you really think you are allowed to see that?',
        'authenticate' => array(
            'Form' => array(
                'fields' => array('username' => 'username','password' => 'password')
            )
        )
    ));
*/

// Pass settings in $components array
/*public $components = array(
    'Auth' => array(
        'loginAction' => array(
            'controller' => 'users',
            'action' => 'login',
            'plugin' => 'users'
        ),
        'authError' => 'Did you really think you are allowed to see that?',
        'authenticate' => array(
            'Form' => array(
                'fields' => array('username' => 'email')
            )
        )
    )
);*/



/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
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
