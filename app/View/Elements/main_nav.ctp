<div class="navbar subnav">
          <div class="navbar-inner">
              <div class="container">
                  <div class="nav-collapse">
					<a id="menu" href="#menu"></a>
					<ul class="nav nav-tabs">
					<?php $menupoints = array(
					'News' => array('controller' => 'news', 'action' => 'index', 'admin' => null, '#' => 'menu'),
					 'Event' => array( 'controller' => 'event', 'action' => 'index', 'admin' => null , '#' => 'menu'),
					  'Sponsoren' => array('controller' => 'team', 'action' => 'index', 'admin' => null , '#' => 'menu'),
					  'Sitzplan' => array('controller' => 'registrations', 'action' => 'sitzplan', 'admin' => null , '#' => 'menu'),
					  'Suche' => array('controller' => 'Search', 'action' => 'index', 'admin' => null , '#' => 'menu'),
					  'FAQ' => array('controller' => 'pages', 'action' => 'faq', 'admin' => null , '#' => 'menu'),
					  //'Turniere' => array('controller' => 'tournaments', 'action' => 'index', 'admin' => null , '#' => 'menu'),
					);
					if($authUser != null && $authUser['status'] == 1){
					$menupoints1 = array(
					'checkin' => array('controller' => 'users', 'action' => 'index', 'admin' => true , '#' => 'menu'),
					'liste spiessli' => array('controller' => 'SpiessPreorders', 'action' => 'index', 'admin' => true , '#' => 'menu'),
					);
					$menupoints = array_merge($menupoints,$menupoints1);
					
					}
					 $num = 0;
					 $menubar = array_keys($menupoints);
					foreach ($menupoints as $point) {
					    //  if((in_array($point['controller'], explode('/', $this->request->here))) == true) {
					   //   echo '<li class="main_nav_bar active">';
					   // }else{
					  echo '<li class="main_nav_bar">';
					//} 
					  echo $this->Html->link($menubar[$num],$point);  
					      echo '</li>';
					      $num ++;
					}
					
					 ?>
					 </ul>
                  </div><!-- /.nav-collapse -->
              </div>
          </div><!-- /navbar-inner -->
          <div class="progress">
  <div class="bar bar-bezahlt" style="width: <?php echo $progressbar['bezahlt']['perc'] ?>%;"><?php echo $progressbar['bezahlt']['num'] ?> bezahlt</div>
    <div class="bar bar-angemeldet" style="width: <?php echo $progressbar['angemeldet']['perc'] ?>%;"> <?php echo $progressbar['angemeldet']['num'] ?> angemeldet</div>
  <div class="bar bar-frei" style="width: <?php echo $progressbar['frei']['perc'] ?>%;"><?php echo $progressbar['frei']['num'] ?> frei</div>
</div> 
<!--
<div class="teilnehmerlink">
<?php echo $this->Html->link(__('Teilnehmerliste'), array('controller' => 'registrations', 
'action' => 'liste', '#' => 'menu')); ?>
</div>
-->

      </div>
					
					<script>
					$(document).scroll(function(){
					    var elem = $('.navbar');
					    if (!elem.attr('data-top')) {
					        if (elem.hasClass('navbar-fixed-top'))
					            return;
					         var offset = elem.offset()
					        elem.attr('data-top', offset.top);
					    }
					    if (elem.attr('data-top') - elem.outerHeight() <= $(this).scrollTop() - $(elem).outerHeight()){
					        elem.addClass('navbar-fixed-top');
					        $('body').addClass('navbar-fixed-top-active');
					        }
					    else{
					        elem.removeClass('navbar-fixed-top');
					        $('body').removeClass('navbar-fixed-top-active');
					        }
					});
					</script>
