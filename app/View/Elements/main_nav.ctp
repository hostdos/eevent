    <ul class="nav nav-tabs">
      <a id="menu" href="#menu"></a>
<?php $menupoints = array(
'News' => array('controller' => 'news', 'action' => 'index', 'admin' => null, '#' => 'menu'),
 'Event' => array( 'controller' => 'event', 'action' => 'index', 'admin' => null , '#' => 'menu'),
  'Sponsoren' => array('controller' => 'team', 'action' => 'index', 'admin' => null , '#' => 'menu'),
  'Sitzplan' => array('controller' => 'registrations', 'action' => 'sitzplan', 'admin' => null , '#' => 'menu'),
  'FAQ' => array('controller' => 'pages', 'action' => 'faq', 'admin' => null , '#' => 'menu'));?>

<?php 
 $num = 0;
 $menubar = array_keys($menupoints);
foreach ($menupoints as $point) {
    //  if((in_array($point['controller'], explode('/', $this->request->here))) == true) {
   //   echo '<li class="main_nav_bar active">';
   // }else{
  echo '<li class="main_nav_bar">';
//} 
  echo $this->Html->link($menubar[$num],$point);  
  echo '<div>
        </div>
        </a>
      </li>';
      $num ++;
}

 ?>
    </ul>
