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

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
  ?>
</head>

<body>



        <div class="container">
  <?php //echo $this->element('eevent_banner_small'); ?>

    <div class="row">

        <?php echo $this->element('main_nav'); ?>

      <?php echo $this->Session->flash(); ?>
       <div class="span2">
        <?php echo $this->element('left_sidebar'); ?>
        </div>

        <div class="span8">
                <div class="shadowblock"> </div>

      <?php echo $this->fetch('content'); ?>
                <div class="shadowblock"> </div>

      </div>
        <div class="span2">
        </div>
      <?php //echo $this->element('breadcrumb'); ?>
    </div>

</body>
</html>
