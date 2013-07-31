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
      <?php echo $this->Html->link('Jetzt für den EEvent anmelden!', 
      array('controller' => 'registrations','action'=>'register','admin' => null), array('class' => 'btn btn-primary btn-large middlebutton')); ?>
     </div>
