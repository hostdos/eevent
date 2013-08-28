<footer>
  <div class="container">
    <div class="row">
      <div class="span12">
         <!-- Copyright section. You can add extra links here. Replace below line with your site url and site name. -->
        <div class="fpadd">
                              <?php echo $this->Html->link(
          $this->Html->image('welcome/facebook.png', array('alt' => __('Facebook'), 'data-original-title' => "Facebook", 'class' => 'tip')),
          'http://www.facebook.com/eeventlan/',
          array('target' => '_blank', 'escape' => false)
        );

                              echo $this->Html->link(
          $this->Html->image('welcome/twitter.png', array('alt' => __('Twitter'), 'data-original-title' => "Twitter", 'class' => 'tip')),
          'http://twitter.com/eeventlan/',
          array('target' => '_blank', 'escape' => false)
        );
                        ?>

        	<a href="http://www.myinsanity.eu">mYinsanity.eu</a><span> © 2013</span></div>
                             <div class="socials">
                        <!-- Social media icons. Replace # with your social profile links. -->
       </div>
      </div>
    </div>
  </div>
</footer>		
