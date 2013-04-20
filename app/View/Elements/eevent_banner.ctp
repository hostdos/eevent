       <div class="hero-unit awesome flat headerawesome">
      <div>
                <div class="bannerdiv">

                <?php echo $this->Html->image('welcome/logo.png', array('class'=>'bannerimg')); ?>
        </div>

        <h1 style="text-align: center;">
          EEvent 2.0 ist am stylen
        </h1>
      </div>
      <div>
        <p style="text-align: center;">
          Die EEvent 2.0 startet bald! mit 228 Sitzplätzen und guter Laune wird
          das super.&nbsp;
        </p>
      </div>
<div class="progress">
  <div class="bar bar-bezahlt" style="width: <?php echo $progressbar['bezahlt']['perc'] ?>%;"><?php echo $progressbar['bezahlt']['num'] ?> bezahlt</div>
    <div class="bar bar-angemeldet" style="width: <?php echo $progressbar['angemeldet']['perc'] ?>%;"> <?php echo $progressbar['angemeldet']['num'] ?> angemeldet</div>
  <div class="bar bar-frei" style="width: <?php echo $progressbar['frei']['perc'] ?>%;"><?php echo $progressbar['frei']['num'] ?> frei</div>
</div> 
<div class="teilnehmerlink">
<?php echo $this->Html->link(__('Teilnehmerliste'), array('controller' => 'registrations', 
'action' => 'liste', '#' => 'menu')); ?>
</div>
      <?php echo $this->Html->link('Jetzt für den EEvent anmelden!', 
      array('controller' => 'registrations','action'=>'register','admin' => null), array('class' => 'btn btn-primary btn-large middlebutton')); ?>
     </div>
