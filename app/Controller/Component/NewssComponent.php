<?php
/* /app/View/Helper/LinkHelper.php */
App::uses('Component', 'Controller');
class NewssComponent extends Component  {
public $helpers = array('Html');

	public function getNewsBig($count){

		$this->News = ClassRegistry::init('News');
		$this->Comments = ClassRegistry::init('Comments');
	$_output = 'test';

		$options = array( 'fields' => array('News.id', 'News.title', 'News.content', 'News.users_id'), 'limit' => ($count));
		$News = $this->News->find('all', $options);
		foreach ($News as $nws) {
	$_output .= '<div class="news view">';
	$_output .= '<h2>' .__('News'). '</h2>';
	$_output .= '<dl>';
	$_output .= '<dt>' .__('Title'). '</dt>';
	$_output .= '<dd>';
	$_output .= $nws['News']['title'];
	$_output .= '</dd>';
	$_output .= '<dt>' .__('Content'). '</dt>';
	$_output .= '<dd>';
	$_output .= $nws['News']['content'];
	$_output .= '</dd>';
	$_output .= '<dt>' .__('Users'). '</dt>';
	$_output .= '<dd>';
	//$_output .= $this->Html->link($nws['News']['users_id'], array('controller' => 'users', 'action' => 'view', $nws['News']['users_id']));
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