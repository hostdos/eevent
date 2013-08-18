<div>
    <?php echo $this->Html->link('Inserat erstellen',array('controller' => 'search', 'action' => 'add', $game['id']),array('escape' => false, 'class' => 'right btn')); ?>
    <div>
        <h2><?php echo $game['name'];?></h2>
    </div>
    <div>
        <?php if(!empty($adverts)){ ?>
            <table class="fullWidth hover">
            <?php foreach($adverts as $advert){ 
            $teams = array();
            $solo = array();
            if($advert['Search']['type'] == 0){
                array_push($teams, $advert);
            }elseif($advert['Search']['type'] == 1){
                array_push($solo, $advert);
            }
        }
        foreach($teams as $team){ ?>
                <tr class="searchlists">
                    <th class="searchheader"> <?php echo __('Suche Team'); ?> </th>
                    <td class="padding-top10 padding-bottom10 border-top border-bottom padding-left10">
                        <?php echo $this->Html->link($advert['Search']['title'],array('controller' => 'search', 'action' => 'detail', $advert['Search']['id']),array('escape' => false)); ?>
                    </td>
                </tr>
            <?php }
        foreach($solo as $sol){ ?>
                <tr>
                    <th class="searchheader"> <?php echo __('Suche Spieler'); ?> </th>
                    <td class="padding-top10 padding-bottom10 border-top border-bottom padding-left10">
                        <?php echo $this->Html->link($advert['Search']['title'],array('controller' => 'search', 'action' => 'detail', $advert['Search']['id']),array('escape' => false)); ?>
                    </td>
                </tr>
            <?php } ?>
            </table>
        <?php } ?>
    </div>
</div>
