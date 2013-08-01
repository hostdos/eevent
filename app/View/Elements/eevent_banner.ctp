<div class="hero-unit awesome flat headerawesome">
  <div>
    <div class="bannerdiv">
      <?php echo $this->Html->image('welcome/logo.png', array('class'=>'bannerimg')); ?>
    </div>
  </div>
  <?php echo $this->Html->link('Jetzt für den EEvent anmelden!', 
  array('controller' => 'registrations','action'=>'register','admin' => null), array('class' => 'btn btn-primary btn-large middlebutton')); ?>
</div>
