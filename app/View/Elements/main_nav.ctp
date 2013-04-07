    <ul class="nav nav-tabs">
<?php $menupoints = array('News' => array('controller' => 'news', 'action' => 'index', 'admin' => null), 'Event' => array( 'controller' => 'event', 'action' => 'index', 'admin' => null ), 'Sponsoren' => array('controller' => 'team', 'action' => 'index', 'admin' => null ),'Sitzplan' => array('controller' => 'pages', 'action' => 'sitzplan', 'admin' => null ));?>

<?php 
 $num = 0;
 $menubar = array_keys($menupoints);
foreach ($menupoints as $point) {
  if((in_array($point['controller'], explode('/', $this->request->here))) == true) {
  echo '<li class="main_nav_bar active">';
}else{
  echo '<li class="main_nav_bar">';
} 
  echo $this->Html->link($menubar[$num],$point);  
  echo '<div>
        </div>
        </a>
      </li>';
      $num ++;
}

 ?>
    </ul>
