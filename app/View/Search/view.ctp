<div>
    <?php echo $this->Html->link('Inserat erstellen',array('controller' => 'search', 'action' => 'add', $game['id']),array('escape' => false, 'class' => 'right btn')); ?>
    <div>
        <h2><?php echo $game['name'];?></h2>
    </div>
    <div>
        <?php if(!empty($adverts)){ ?>
            <table class="fullWidth hover">
            <?php
			$teams = array();
            $solo = array();
            foreach($adverts as $advert){ 
	            if($advert['Search']['type'] == 1){
	                array_push($teams, $advert['Search']);
	            }elseif($advert['Search']['type'] == 0){
	                array_push($solo, $advert['Search']);
	            }
			}

			if(!empty($teams)):
?>
	        <tr class="searchlists">
	            <th class="searchheader"> <?php echo __('Suche Team'); ?> </th>
  <?php
        foreach($teams as $team){ 
        ?>
                    <td class="padding-top10 padding-bottom10 border-top border-bottom padding-left10">
                        <?php echo $this->Html->link($team['title'],array('controller' => 'search', 											'action' => 'detail', $team['id']),array('escape' => false)); ?>
                    </td>
            <?php } ?>
                </tr>
		<?php	
		endif;
		if(!empty($solo)):
		?> 
                <tr class="searchlists">
                    <th class="searchheader"> <?php echo __('Suche Spieler'); ?> </th>

				<?php
        foreach($solo as $sol){ 
        ?>
                    <td class="padding-top10 padding-bottom10 border-top border-bottom padding-left10">
                        <?php echo $this->Html->link($sol['title'],array('controller' => 'search', 												'action' => 'detail', $sol['id']),array('escape' => false)); ?>
                    </td>
            <?php } ?>
                </tr>
                <?php endif; ?>
            </table>
        <?php } ?>
    </div>
</div>
