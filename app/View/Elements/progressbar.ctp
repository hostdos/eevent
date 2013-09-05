<div class="progress">
  <div class="bar bar-bezahlt" style="width: <?php echo $progressbar['bezahlt']['perc'] ?>%;"><?php echo $progressbar['bezahlt']['num'] ?> bezahlt</div>
    <div class="bar bar-angemeldet" style="width: <?php echo $progressbar['angemeldet']['perc'] ?>%;"> <?php echo $progressbar['angemeldet']['num'] ?> angemeldet</div>
  <div class="bar bar-frei" style="width: <?php echo $progressbar['frei']['perc'] ?>%;"><?php echo $progressbar['frei']['num'] ?> frei</div>
</div> 
<div class="teilnehmerlink">
<?php echo $this->Html->link(__('Teilnehmerliste'), array('controller' => 'registrations', 
'action' => 'liste', '#' => 'menu')); ?>
</div>

