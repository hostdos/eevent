
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
		$allcomments = $this->Comments->findByNewsId($newsid);
		foreach ($allcomments as $cmnt) {
		$usr = $this->Users->findById($cmnt['users_id']);

			$_output .= '<div class="comment">';
	$_output .= '<h5>' .$usr['Users']['username']. '</h4>';
	$_output .= '<p>';
	$_output .= $cmnt['content'];
	$_output .= '</p>';
	$_output .= '</div>';
		}
		return $_output;
	}
}



?>