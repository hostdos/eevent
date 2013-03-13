<?php
/* /app/View/Helper/LinkHelper.php */
App::uses('Component', 'Controller');
class NewssComponent extends Component  {
	public $helpers = array('Html');	

	public function getNewsBig($count){
	$_output = null;
		$this->News = ClassRegistry::init('News');
		$this->Users = ClassRegistry::init('Users');
		$this->Comments = ClassRegistry::init('Comments');
		$options = array( 'fields' => array('News.id', 'News.title', 'News.content', 'News.users_id'),
		 'limit' => ($count) , 'conditions' => array('News.isdisabled' => 0) );
		$News = $this->News->find('all', $options);
		foreach ($News as $nws) {
		$user = $this->Users->findById($nws['News']['users_id']);
	$_output .= '<article class="news">';
	$_output .= '<header>';
	$_output .= '<h1>' .$nws['News']['title']. '</h1>';
	$_output .= '</header>';
	$_output .= '<p>';
	$_output .= $nws['News']['content'];
	$_output .= '</p>';
	$_output .= '<dd>';
	$_output .=  
	$this->	Html->link($user['username'], array('controller' => 'users', 'action' => 'view'
		,'id' => $user['id']));
	$_output .= '</dd>';
	$_output .= '</dl>';
	$_output .= '</article>';
		}
	return $_output;
	}


    public function getNewsFull($newsid) {
        // Logic to create specially formatted link goes here...
    }
}



?>