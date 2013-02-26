<?php
/* /app/View/Helper/LinkHelper.php */
App::uses('AppHelper', 'View/Helper');

class ForumHelper extends AppHelper {


	public function last_sidebar($int = 2){
		$this->loadModel('Forum');
		$this->loadModel('Post');

		$forum = $this->Forum->find('all', array('limit' = $int));

		foreach ($forum as $mega64um) {
			
		$title = $forum['name'];
		$description = $forum['description'].0;

		}
		$title = $forum['name'];
		$description = $forum['description'];







		}


    public function makeEdit($title, $url) {
        // Logic to create specially formatted link goes here...
    }
}



?>