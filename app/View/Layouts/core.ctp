
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Titel -->
  <title>EEvent</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Beschreibung -->
  <meta name="description" content="eevent lan website">
  <meta name="keywords" content="lan switzerland eevent myinsanity">
  <meta name="author" content="Dominique Hostettler">

  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="js/html5shim.js"></script>
  <![endif]-->
  
  <!-- Web Fonts -->

  <!-- css -->
  <!--[if IE 7]>
  <link rel="stylesheet" href="style/font-awesome-ie7.css">
  <![endif]-->		
<?php
/*	<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
*/

echo $this->Html->css('welcome/bootstrap.css');
echo $this->Html->css('welcome/font-awesome.css');
echo $this->Html->css('welcome/style.css');
echo $this->Html->css('welcome/eevent.css');
echo $this->Html->css('welcome/jquery.countdown.css');
echo $this->Html->css('welcome/bootstrap-responsive.css');
//javascripts

echo $this->Html->script('welcome/jquery');
echo $this->Html->script('welcome/bootstrap');
echo $this->Html->script('welcome/jquery.tweet');
echo $this->Html->script('welcome/jquery.lwtCountdown-1.0');

echo $this->fetch('css');
echo $this->fetch('script');

echo '</head>';
echo $this->fetch('content');
echo $this->element('footer');
?>