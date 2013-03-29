
<?php
/* /app/View/Helper/LinkHelper.php */
App::uses('AppHelper', 'View/Helper');

class CommentsHelper extends AppHelper {
public $helpers = array('Html');
		protected $_output;

	public function getComments($newsid){
		$_output = null;
		$this->Users = ClassRegistry::init('Users');
		$this->Comments = ClassRegistry::init('Comments');
		$options = array('conditions' => array('Comments.isdisabled' => 0, 'Comments.news_id' => $newsid));
		$allcomments = $this->Comments->find('all', $options);
		foreach ($allcomments as $cmnt) {
		$usr = $this->Users->findById($cmnt['users_id']);

	$_output .= '<div class="comment">';
	$_output .= '<h5>' .$usr['Users']['username']. '</h4>';
	$_output .= '<p>';
	$_output .= $cmnt['content'];
	$_output .= '</p>';
	/*if($authUser['id'] == $usr['Users']['id']){
		$_output .= $this->Html->link('Editieren', array('controller' => 'comments', 'action' => 'edit',$cmnt['id']));
	}*/
	$_output .= '</div>';
		}
	$_output .= $this->Html->link('Kommentar Schreiben', array('controller' => 'comments', 'action' => 'add',$newsid), array('class' => 'commentaddlink'));
		return $_output;
	}


	public function getAdminComments($newsid){
	$_output = null;
	$this->Users = ClassRegistry::init('Users');
	$this->Comments = ClassRegistry::init('Comments');
	$allcomments = $this->Comments->findAllByNewsId($newsid);
	foreach ($allcomments as $comment => $cmnt) {
	$usr = $this->Users->findById($cmnt['Comments']['users_id']);
	$_output .= '<div class="comment">';
	$_output .= '<h5>' .$usr['Users']['username']. '</h5>';
	$_output .= '<p>';
	$_output .= $cmnt['Comments']['content'];
	$_output .= '</p>';
	$_output .= $this->Html->link('Editieren', array('controller' => 'comments', 'action' => 'edit',$cmnt['Comments']['id'], 'admin' => true));
	$_output .= '</div>';
		}
		$_output .= $this->Html->link('Kommentar Schreiben', array('controller' => 'comments', 'action' => 'add',$newsid), array('class' => 'commentaddlink'));
		return $_output;
	}

}



?>