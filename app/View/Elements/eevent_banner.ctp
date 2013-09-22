
<div class="row-fluid headerawesome">
<h1 class="bannerheader">
Die EEvent 3.0 wartet mit spannenden Turnieren und Super Catering auf die Besucher!
</h1>
<div class="container">
    <div class="bannerdiv span3">
      <?php echo $this->Html->image('welcome/logo.png', array('class'=>'bannerimg')); ?>
    </div>
    
	<div class="bannertitle span3">
	<h4>
	200 Gamer, 7 Turniere
	</h4>
  <?php 
  if(empty($userRegistr)){
	  echo $this->Html->link('Jetzt für die EEvent anmelden!', 
	  array('controller' => 'registrations','action'=>'register','admin' => null), array('class' => 'btn btn-primary btn-large middlebutton')); 
  	}else{
	  echo $this->Html->link('Viel spass an der EEvent!', 
	  array(), array('class' => 'btn btn-primary btn-large middlebutton')); 
  	}
  ?>
	<div class="teilnehmerlink">
<?php echo $this->Html->link(__('Teilnehmerliste'), array('controller' => 'registrations', 
'action' => 'liste', '#' => 'menu')); ?>
</div>

	</div>
	<div class="kickdesc span2">
		<p>
			Entscheide selbst welches Spiel deine 10CHF Preisgeld bekommt!
		<p>
	</div>
	
		<div class="kickprogress span4">
			<div class="kickbar" id="lol">
				<?php echo $this->Html->image('lol.png', array('class'=>'kickimg')); ?>
		      <div class="esportsmoney">
	  		      <h3>
				      <?php echo $pricemoney['lol'] . 'CHf' ?>
				  </h3>
		      </div>
			</div>
			<div class="kickbar" id="csgo">
				<?php echo $this->Html->image('csgo.png', array('class'=>'kickimg')); ?>
		      <div class="esportsmoney">
	  		      <h3>
				      <?php echo $pricemoney['cs'] . 'CHf' ?>
			      </h3>
		      </div>
			</div>
			<div class="kickbar" id="hots">
				<?php echo $this->Html->image('hots.png', array('class'=>'kickimg')); ?>
		      <div class="esportsmoney">
	  		      <h3>
				      <?php echo $pricemoney['sc'] . 'CHf' ?>
			      </h3>
		      </div>
			</div>
		</div>
	</div>
</div>