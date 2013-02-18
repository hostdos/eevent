<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
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
	//       echo $this->Html->css('custom');
   echo $this->Html->script('jquery-1.9.1.min');
    echo $this->Html->script('bootstrap.min');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
  ?>
</head>
<body>

<?php echo $this->element('eevent_banner'); ?>

    <ul class="nav nav-tabs">
      <li class="active">
        <a href="#">
          <div style="text-align: center;">
            News
          </div>
        </a>
      </li>
      <li class="">
        <a href="#">
          <div style="text-align: center;">
            Event
          </div>
        </a>
      </li>
      <li class="">
        <a href="#">
          <div style="text-align: center;">
            Team
          </div>
        </a>
      </li>
      <li class="">
        <a href="#">
          <div style="text-align: center;">
            Forum
          </div>
        </a>
      </li>
    </ul>



  <div class="container">
      <div class="row-fluid">
        <div class="span3">
          <div>
            <h2>
              Heading
            </h2>
            <p>
              Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus
              ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo
              sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed
              odio dui.
            </p>
          </div>
          <a class="btn" href="#">
            View details »
          </a>
        </div>



        <div class="span6">
          <div class="hero-unit pinnedcontent">
            <div>
              <h1 style="text-align: center;">
                EEvent&nbsp;2.0
              </h1>
              <p>
                This is a template for a simple marketing or informational website. It
                includes a large callout called the hero unit and three supporting pieces
                of content. Use it as a starting point to create something more unique.
              </p>
            </div>
          </div>

          
		<?php echo $this->fetch('content'); ?>

        </div>



        <div class="span3">
          <div>
            <h2>
              Heading
            </h2>
            <p>
              Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus
              ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo
              sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed
              odio dui.
            </p>
          </div>
          <a class="btn" href="#">
            View details »
          </a>
        </div>



      </div>



      <hr>



      <div>
        mYinsanity.eu
      </div>



      <ul class="breadcrumb">
        <li class="">
          <a href="#">
            Playlists
          </a>
        </li>
        <span class="divider">
          /
        </span>
        <li class="">
          <a href="#">
            Office
          </a>
        </li>
        <span class="divider">
          /
        </span>
        <li class="">
          <a href="#">
            Rick Astley
          </a>
        </li>
      </ul>



    </div>












</body>
</html>


<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <title>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style>
      body { padding-top: 60px; /* 60px to make the container go all the way
      to the bottom of the topbar */ }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
      </script>
    <![endif]-->
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <style>
    </style>
  </head>
  <body>

    <div

  </body>
</html>
