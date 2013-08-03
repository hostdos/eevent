<?php
App::uses('AppController', 'Controller');
/**
 * News Controller
 *
 * @property Search $Search
 * @property SessionComponent $Session
 * @property AuthComponent $Auth
 */
class SearchController extends AppController {

    public function beforeFilter(){
        parent::beforeFilter();
        //  Secur ity::hash($password, 'md5', false);
        $this->Auth->allow('view','detail','add','createComment','createAdvert');
    }


/**
 * Components
 *
 * @var array
 */
    public $components = array('Session', 'Newss');

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->layout = 'bootstrap_basic';
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        /*if (!$this->Search->exists($id)) {
            throw new NotFoundException(__('Invalid search'));
        }
        $options = array('conditions' => array('Search.' . $this->Search->primaryKey => $id)); */
        if($id != 1 && $id != 2) {
            $id = 1;
        }
        $this->loadModel('Game');
        if(!empty($this->request->data)) {
            $this->createAdvert($id);
            $this->Session->setFlash(__('Das Inserat wurde erstellt'));
        }
        $game = $this->Game->find('first', array('conditions' => array('game.id' => $id)));
        $adverts = $this->Search->find('all', array('conditions' => array('game_id' => $id)));
        
        $this->set('game', $game['Game']);
        $this->set('adverts', $adverts);
    }
    
    public function detail($id = null) {
        $this->loadModel('Users');
        $this->loadModel('Adcomment');
        if(!empty($this->request->data)) {
            $this->createComment($id);
            $this->Session->setFlash(__('Ihr Kommentar wurde erstellt'));
        }
        $advert = $this->Search->find('first', array('conditions' => array('id' => $id)));
        $user = $this->Users->find('first', array('conditions' => array('id' => $advert['Search']['users_id'])));
        $comments = $this->Adcomment->find('all', array('conditions' => array('advert_id' => $id)));
        $commentUsers = array();
        $i = 0;
        foreach($comments as $comment) {
            $commentUsers[$i]['id'] = $comment['Adcomment']['id'];
            $commentUser = $this->Users->find('first', array('conditions' => array('id' => $comment['Adcomment']['users_id'])));
            $commentUsers[$i]['username'] = $commentUser['Users']['username'];
            $i++;
        }
        $this->set('commentUsers', $commentUsers);
        $this->set('comments', $comments);
        $this->set('advert', $advert);
        $this->set('user', $user);
    }
    
    public function add($gameId = null) {
        if($gameId != 1 || $gameId != 2) {
            $gameId = 1;
        }
        $this->loadModel('Game');
        $game = $this->Game->find('first', array('conditions' => array('game.id' => $gameId)));
        $this->set('game', $game['Game']);
    }
    
    private function createAdvert($id) {
        $user = $this->Auth->user('User');
        $this->Search->set('created', date('Y-m-d h:i:s', time()));
        $this->Search->set('updated', date('Y-m-d h:i:s', time()));
        $this->Search->set('game_id', $id);
        //$this->Search->set('users_id', $user['id']);
        $this->Search->set('users_id', 1);
        $this->Search->set('typ', $this->request->data['Search']['typ']);
        $this->Search->set('title', $this->request->data['Search']['title']);
        $this->Search->set('text', $this->request->data['Search']['text']);
        $this->Search->save();
    }
    
    private function createComment($id) {
        $user = $this->Auth->user('User');
        $this->Adcomment->set('text', $this->request->data['adcomment']['text']);
        $this->Adcomment->set('advert_id', $id);
        //$this->Adcomment->set('users_id', $user['id']);
        $this->Adcomment->set('users_id', 1);
        $this->Adcomment->set('created', date('Y-m-d h:i:s', time()));
        $this->Adcomment->set('updated', date('Y-m-d h:i:s', time()));
        $this->Adcomment->save();
    }
}
