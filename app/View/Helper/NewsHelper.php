
<?php
/* /app/View/Helper/LinkHelper.php */
App::uses('AppHelper', 'View/Helper');

class NewsHelper extends AppHelper {
public $helpers = array('Html');
		protected $_output;



	public function getNewsSingle($id){
	$_output = null;
		$this->News = ClassRegistry::init('News');
		$this->Users = ClassRegistry::init('Users');
		$this->Comments = ClassRegistry::init('Comments');

		$nws = $this->News->findById($id);
		$user = $this->Users->findById($nws['News']['users_id']);
		//$comment = $this->Comments->findById($nws['News']['id']);
		$conditions = array('Comments.news_id' => $nws['News']['users_id']);
	$_output .= '<article class="fullnews news">';
	$_output .= '<header>';
	$_output .= '<h1>' .$this->Html->link($nws['News']['title'], array('controller' => 'news',
		'action'=>'view',$nws['News']['id'])). '</h1>';
			$_output .= '<div class="author">';
	$_output .= 'geschrieben von: ';
	//$_output .=  $this->Html->link($user['Users']['username'], array('controller' => 'users', 'action' => 'view'
//		,$user['Users']['id']));
	$_output .= $user['Users']['username'];
	$_output .= '</div>';

	$_output .= '</header>';
	$_output .= '<div class="newscontent">';
	$_output .= '<p>';
	$_output .= $nws['News']['content'];
	$_output .= '</p>';
	$_output .= '</div>';
	$_output .= '<footer>';
	$_output .= '</footer>';
	$_output .= '</article>';
	return $_output;
	}
		public function getAdminNewsSingle($id){
	$_output = null;
		$this->News = ClassRegistry::init('News');
		$this->Users = ClassRegistry::init('Users');
		$this->Comments = ClassRegistry::init('Comments');

		$nws = $this->News->findById($id);
		$user = $this->Users->findById($nws['News']['users_id']);
		//$comment = $this->Comments->findById($nws['News']['id']);
		$conditions = array('Comments.news_id' => $nws['News']['users_id']);
	$_output .= '<article class="fullnews news">';
	$_output .= '<header>';
	$_output .= '<h1>' .$this->Html->link($nws['News']['title'], array('controller' => 'news',
		'action'=>'view',$nws['News']['id'])). '</h1>';
			$_output .= '<div class="author">';
	$_output .= 'geschrieben von: ';
//	$_output .=  $this->Html->link($user['Users']['username'], array('controller' => 'users', 'action' => 'view'
//		,$user['Users']['id']));
	$_output .= $user['Users']['username'];
	$_output .= '</div>';

	$_output .= '</header>';
		$_output .= '<div class="newscontent">';

	//$_output .= '<p>';
	$_output .= $nws['News']['content'];
	//$_output .= '</p>';
		$_output .= '</div>';

	$_output .= '<footer>';
	$_output .= '</footer>';
	$_output .= $this->Html->link('Editieren', array('controller' => 'news', 'action' => 'edit',$nws['News']['id'], 'admin' => true));
	$_output .= '</article>';
	return $_output;
	}

	public function getNewsBig($count){
		$_output = null;
		$this->News = ClassRegistry::init('News');
		$this->Users = ClassRegistry::init('Users');
		$this->Comments = ClassRegistry::init('Comments');

		$options = array( 'fields' => array('News.id', 'News.title', 'News.content', 'News.users_id'),
		 'limit' => ($count) , 'conditions' => array('News.isdisabled' => 0),'order' => array('News.id DESC') );
		$News = $this->News->find('all', $options);
		foreach ($News as $nws) {

		$user = $this->Users->findById($nws['News']['users_id']);
		//$comment = $this->Comments->findById($nws['News']['id']);
		$conditions = array('Comments.news_id' => $nws['News']['id']);
		if($this->Comments->hasAny($conditions)){
		$commentnum = $this->Comments->find('count', $conditions);
		} else { $commentnum = 0;}
	$_output .= '<article class="news">';
	$_output .= '<header>';
	$_output .= '<h1>' .$this->Html->link($nws['News']['title'], array('controller' => 'news',
		'action'=>'view',$nws['News']['id'])). '</h1>';
	$_output .= '</header>';
	$_output .= '<p>';
	$_output .= $nws['News']['content'];
	$_output .= '</p>';

	$_output .= '<footer>';
	$_output .= '<div class="author">';
	$_output .= 'geschrieben von: ';
	//$_output .=  $this->Html->link($user['Users']['username'], array('controller' => 'users', 'action' => 'view'
//		,$user['Users']['id']));
			$_output .= $user['Users']['username'];

	$_output .= '</div>';
	if($commentnum == 1){$_output .= $this->Html->link( $commentnum .' '. __('Kommentar'), array('controller' => 'news', 'action' => 'view'
		,$nws['News']['id']), array('class' => 'news-comments')); }else{$_output .= $this->Html->link( $commentnum .' '. __('Kommentare'), array('controller' => 'news', 'action' => 'view'
		,$nws['News']['id']), array('class' => 'news-comments')); }
	$_output .= '</footer>';
	$_output .= '</article>';
		}

	$_output .= $this->Html->link('Archiv', array('controller' => 'news', 'action' => 'full'));
	return $_output;
	}

	public function getAdminNewsBig($count){
		$_output = null;
		$this->News = ClassRegistry::init('News');
		$this->Users = ClassRegistry::init('Users');
		$this->Comments = ClassRegistry::init('Comments');

		$options = array( 'fields' => array('News.id', 'News.title', 'News.content', 'News.users_id'),
		 'limit' => ($count) , 'conditions' => array('News.isdisabled' => 0),'order' => array('News.id DESC') );
		$News = $this->News->find('all', $options);
		foreach ($News as $nws) {

		$user = $this->Users->findById($nws['News']['users_id']);
		//$comment = $this->Comments->findById($nws['News']['id']);
		$conditions = array('Comments.news_id' => $nws['News']['id']);
		if($this->Comments->hasAny($conditions)){
		$commentnum = $this->Comments->find('count', $conditions);
		} else { $commentnum = 0;}
	$_output .= '<article class="news">';
	$_output .= '<header>';
	$_output .= '<h1>' .$this->Html->link($nws['News']['title'], array('controller' => 'news',
		'action'=>'view',$nws['News']['id'])). '</h1>';
	$_output .= '</header>';
	$_output .= '<p>';
	$_output .= $nws['News']['content'];
	$_output .= '</p>';
	$_output .= '<footer>';
	$_output .= '<div class="author">';
	$_output .= 'geschrieben von: ';
	$_output .=  $this->Html->link($user['Users']['username'], array('controller' => 'users', 'action' => 'view'
		,$user['Users']['id']));
	$_output .= '</div>';
	$_output .= $this->Html->link('Editieren', array('controller' => 'news', 'action' => 'edit',$nws['News']['id'], 'admin' => true));
	if($commentnum == 1){$_output .= $this->Html->link( $commentnum .' '. __('Kommentar'), array('controller' => 'news', 'action' => 'view'
		,$nws['News']['id']), array('class' => 'news-comments')); }else{$_output .= $this->Html->link( $commentnum .' '. __('Kommentare'), array('controller' => 'news', 'action' => 'view'
		,$nws['News']['id']), array('class' => 'news-comments')); }
	$_output .= '</footer>';
	$_output .= '</article>';
		}

	$_output .= $this->Html->link('News Schreiben', array('controller' => 'news', 'action' => 'add', 'admin' => true));	
	$_output .= $this->Html->link('Archiv', array('controller' => 'news', 'action' => 'full'));
	return $_output;

	}







    public function getNewsFull($newsid) {
        // Logic to create specially formatted link goes here...
    }
}



?>