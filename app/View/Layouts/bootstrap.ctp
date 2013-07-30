<?php
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');


?>
<!DOCTYPE html>
<html lang="en">
  


<head>
    <meta charset="utf-8">
    <title>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="dominique hostettler @ myinsanity.eu">


  
  <?php echo $this->Html->charset(); ?>
  <title>
    <?php echo $cakeDescription ?>:
    <?php echo $title_for_layout; ?>
  </title>
  <?php
    echo $this->Html->meta('icon');

    //echo $this->Html->css('cake.generic');
  //      echo $this->Html->css('bootstrap-responsive');
    
    echo $this->Html->css('bootstrap');
    echo $this->Html->css('custom');
    echo $this->Html->script('jquery-1.9.1.min');
    echo $this->Html->script('bootstrap.min');

    echo $scripts_for_layout;
    echo $this->Js->writeBuffer(array('cache' => TRUE));
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
  ?>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-39987210-1', 'eevent.ch');
  ga('send', 'pageview');

</script>
</head>

<body>

  <?php echo $this->element('eevent_banner'); ?>

<div class="navbar">
          <div class="navbar-inner">
              <div class="container">
                  <div class="nav-collapse">
        <?php echo $this->element('main_nav'); ?>

                  </div><!-- /.nav-collapse -->
              </div>
          </div><!-- /navbar-inner -->
      </div>


        <div class="container">

		<div class="row">
			<?php echo $this->Session->flash(); ?>
       <div class="span2">
        <?php echo $this->element('login_status_left_sidebar'); ?>
        <?php echo $this->element('sponsors'); ?>

        </div>
        <div class="span8">
          <div class="shadowblock"></div>
          <?php echo $this->element('eevent_info'); ?>
          <?php echo $this->fetch('content'); ?>
          <div class="shadowblock"> </div>
      </div>
      <div class="span2">
        </div>


      <?php //echo $this->element('breadcrumb'); ?>
    </div>
  <?php echo $this->element('footer'); ?>

</body>
</html>
