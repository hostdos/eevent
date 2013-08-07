<?php 	echo $this->Html->css('smoothness/jquery-ui-1.10.2.custom.min');
		echo $this->Html->script('jquery-ui-1.10.2.custom.min');
?>
    <script>
  $(function() {
    var availableTags =
    <?php foreach ($clanlist as $clan){
           $data[] = $clan;
    }
        echo json_encode($data); ?>
    
    $( "#clan" ).autocomplete({
      source: availableTags
    });
  });
  </script>

<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset class="first">
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username', array('placeholder' => 'Username'));
		
		echo $this->Form->input('password', array('label' => 'Passwort','placeholder' => 'Passwort', 'type' => 'password'));
		echo $this->Form->input('email', array('placeholder' => 'Email','type' => 'email','label'=>'E-Mail'));
		echo $this->Form->input('gender', array('label' => __('Geschlecht'),'type' => 'select',
					'options' => array( '1' => __('Mann'), '0' => __('Frau'))));
		echo $this->Form->input('prename', array('placeholder' => 'Vorname','label'=> 'Vorname'));
		echo $this->Form->input('surname', array('placeholder' => 'Nachname','	label'=> 'Nachname'));
	?>
	</fieldset>
	<fieldset class="second">
	<?php
		echo $this->Form->input('birthdate', array('type' => 'text',
   			 'label' => __('birthdate'),
   			 'placeholder' => date('d.m.Y')));
   		
		echo $this->Form->input('place',array('label' => __('Wohnort'), 'type' => 'text', 'placeholder' => 'bärn'));
		echo $this->Form->input('zip', array('label' => __('PLZ'), 'placeholder' => '3005'));
		echo $this->Form->input('street', array('label' => __('Adresse'), 'placeholder' => 'Bundesplatz 3'));
		echo $this->Form->input('phone', array('label' => __('Tel.'), 'placeholder' => '031 322 87 90'));
		echo $this->Form->input('clan', array('label' => 'Clan', 'placeholder' => 'Clan', 'id' => 'clan', 'placeholder' => 'Broken-Arrow'));
		echo $this->Form->input('website', array('label' => 'Website', 'placeholder' => 'Website', 'placeholder' => 'www.retardmagnetgaming.ch.vu'));
	?>
	</fieldset>
	<fieldset class="pricemoneysliders">
		<div class="span4">
          <div id="slider_lol" class="ui-slider lol-slider">
          </div>
		</div>
<script>
    // jQuery UI Sliders
    var $slider1 = $("#slider_lol");
    if ($slider1.length) {
      $slider1.slider({
        min: 1,
        max: 10,
        value: 2,
        orientation: "horizontal",
        range: "min"
      }).addSliderSegments($slider1.slider("option").max);
    }
</script>
		<div class="span4">
          <div id="slider_csgo" class="ui-slider csgo-slider">
          </div>
		</div>
<script>
    var $slider2 = $("#slider_csgo");
    if ($slider2.length) {
      $slider2.slider({
        min: 1,
        max: 10,
        value: 2,
        orientation: "horizontal",
        range: "min"
      }).addSliderSegments($slider2.slider("option").max);
    }
</script>
		<div class="span4">
          <div id="slider_hots" class="ui-slider hots-slider">
          </div>
		</div>
<script>    
var $slider3 = $("#slider_hots");
    if ($slider3.length) {
      $slider3.slider({
        min: 1,
        max: 10,
        value: 2,
        orientation: "horizontal",
        range: "min"
      }).addSliderSegments($slider3.slider("option").max);
    }

</script>

	</fieldset>

<?php 
		echo $this->Form->submit(__('Registrieren'), array('class' => 'btn btn-large btn-primary'));
		echo $this->Form->end(); ?>
</div>
<script>
     
   function addSliderSegments (amount) {
    return this.each(function () {
      var segmentGap = 100 / (amount - 1) + "%"
        , segment = "<div class='ui-slider-segment' style='margin-left: " + segmentGap + ";'></div>";
      $(this).prepend(segment.repeat(amount - 2));
    });
  };




</script>

<!-- 
<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('email');
		echo $this->Form->input('prename');
		echo $this->Form->input('surname');
		echo $this->Form->input('birthdate');
		echo $this->Form->input('clan');
		echo $this->Form->input('website');
		echo $this->Form->input('status');
		echo $this->Form->input('isdisabled');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
	</ul>
</div>
 -->