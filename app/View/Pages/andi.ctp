
<body>

<!-- Top Area -->
<div class="tops">
   <div class="container">
      <div class="row">
         <div class="span12">
            <!-- Logo -->
             <div class="logo">
               <div class="padd">
                  <div class="logo-pic">
                     <!-- eevent logo -->
                     <?php echo $this->Html->image('welcome/logo.png'); ?> 
                   </div>
                  <div class="logo-text">
                     <!-- Add company name in below line. Replace # with your site url. -->
                     <!-- <h1><a href="#">Company Logo</a></h1> -->
                  </div>   
               </div>   
             </div>
             <div class="csoon">
               <div class="padd">
                  <!-- Coming Soon section. -->
                  <h2>EEvent 3.0</h2>
                  <p>228 Gamer. Mehrzweckhalle Subingen. 3 - 5 Mai. 4 Turniere.</p>
               </div>
             </div>
            <!-- Countdown timer section starts here. To Set date and time, goto JavaScript section below (above "</body>" tag). Under title "Countdown", add your date and time in appropriate fields.-->
             <div class="timer">
               <div class="padd">
                  <div id="countdown_dashboard">
                     <div class="dash days_dash">
                        <div class="bor">
                           <!-- Days -->
                           <span class="dash_title">tage</span>
                           <div class="digit">0</div>
                           <div class="digit">0</div>
                        </div>
                     </div>

                     <div class="dash hours_dash">
                        <div class="bor">
                           <!-- Hours -->
                           <span class="dash_title">stunden</span>
                           <div class="digit">0</div>
                           <div class="digit">0</div>
                        </div>
                     </div>

                     <div class="dash minutes_dash">
                        <div class="bor">
                           <!-- Minutes -->
                           <span class="dash_title">minuten</span>
                           <div class="digit">0</div>
                           <div class="digit">0</div>
                        </div>
                     </div>

                     <div class="dash seconds_dash">
                        <div class="bor">
                           <!-- Seconds -->
                           <span class="dash_title">sekunden</span>
                           <div class="digit">0</div>
                           <div class="digit">0</div>
                        </div>
                     </div>
                  </div>
               </div>
             </div>
         </div>
      </div>
   </div>
</div>   
	
<!-- Bottom section -->
   
<div class="bottoms">
   <div class="container">
      <!-- Subscribe section -->

      <div class="cols">
         <div class="row">
            <div class="span9 offset2">
               <div class="padd">
                  <!-- About section -->
                  <div class="widget"> 
                     <!-- About title -->
                     <h3><span>Eevent 2013</span></h3>
                     <!-- About para -->
                     <p>Der Filmsoft Verein ist stolz, die eevent - LAN 2013 zu präsentieren. </br>
Vom 03. - 05. Mai 2013 erwartet die Crew rund um den eevent, 228 Teilnehmer in Subingen im Kanton Solothurn, wo sie um Preisgeld, sowie diverse andere Überraschungen spielen werden!</br>
Die Voraussetzungen sind einfach nur genial! Wir haben eine super Location, ein sensationelles Internet, ein unumstössliches Netzwerk, tolle Preisgelder, erfahrene LAN-Organisatoren sowie eine riesen Motivation!</br> Diese LAN wird zu einem E-Sport Spektakel, lässt jedoch auch die eher gemütlichen Gamer-Herzen nicht kalt. Ein grosses Chill Out mit Bar und Spielekonsolen werden für die nötige Abwechslung sorgen.</br> Mehr Details zur Anmeldung und zu den Turnierpreisen werden in der nächsten Wochen folgen. </p>
                     <div class="socials">
                        <!-- Social media icons. Replace # with your social profile links. -->
                        <?php 
                              echo $this->Html->link(
          $this->Html->image('welcome/facebook.png', array('alt' => __('Facebook'), 'border' => '0', 'data-original-title' => "Facebook", 'class' => 'tip')),
          'http://www.facebook.com/eeventlan/',
          array('target' => '_blank', 'escape' => false)
        );

                              echo $this->Html->link(
          $this->Html->image('welcome/twitter.png', array('alt' => __('Twitter'), 'border' => '0', 'data-original-title' => "Twitter", 'class' => 'tip')),
          'http://twitter.com/eeventlan/',
          array('target' => '_blank', 'escape' => false)
        );
                        ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>  
      </div>
   </div>
</div>
   
<!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="span12">
         <!-- Copyright section. You can add extra links here. Replace below line with your site url and site name. -->
        <div class="fpadd"><a href="http://www.myinsanity.eu">mYinsanity.eu</a></div>
      </div>
    </div>
  </div>
</footer>		

<!-- JS -->
<script>
/* Tool tip */
$('.tip').tooltip();

/* Countdown */

// Set by specific date/time

// Initiate Countdown

jQuery(document).ready(function() {
	$('#countdown_dashboard').countDown({
		targetDate: {
			'day': 		3,
			'month': 	5,
			'year': 	2013,
			'hour': 	20,
			'min': 		0,
			'sec': 		0
		},
		omitWeeks: true
	});
});

</script>
</body>
</html>