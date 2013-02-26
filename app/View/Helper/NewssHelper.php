<?php
/* /app/View/Helper/LinkHelper.php */
App::uses('AppHelper', 'Controller/Helper');

class NewssHelper extends AppHelper {
public $helpers = array('Html');
		protected $_output;


	public function getNewsBig($count){
		$this->loadModel('News');
		$this->loadModel('Comments');

		$options = 'conditions' => array('fields' => array('News.id', 'News.title', 'News.content', 'News.users_id'), 'limit' => $count);
		var_dump($this->News->find('all', 'conditions' => array('fields' => array('News.id', 'News.title', 'News.content', 'News.users_id'), 'limit' => $count));
		foreach ($News as $nws) {
	$_output .= '<div class="news view">';
	$_output .= '<h2>' .__('News'). '</h2>';
	$_output .= '<dl>';
	$_output .= '<dt>' .__('Title'). '</dt>';
	$_output .= '<dd>';
	$_output .= $nws['title'];
	$_output .= '</dd>';
	$_output .= '<dt>' .__('Content'). '</dt>';
	$_output .= '<dd>';
	$_output .= $nws['content'];
	$_output .= '</dd>';
	$_output .= '<dt>' .__('Users'). '</dt>';
	$_output .= '<dd>';
	$_output .= $this->Html->link($nws['users_id'], array('controller' => 'users', 'action' => 'view', $nws['users_id']));
	$_output .= '</dd>';
	$_output .= '</dl>';
	$_output .= '</div>';
		}
	return $_output;
	}


    public function getNewsFull($newsid) {
        // Logic to create specially formatted link goes here...
    }
}



?>