<script type="text/javascript">
    function comment() {
        if(document.getElementById('addcomment').style.display == 'none') {
            document.getElementById('addcomment').style.display = 'block';
            document.getElementById('commentbutton').style.display = 'none';
        } else {
            document.getElementById('addcomment').style.display = 'none';
            document.getElementById('commentbutton').style.display = 'block';
        }
    }
</script>
<div>
    <h3><?php echo $advert['Search']['title']; ?></h3>
    <table class="fullWidth margin-bottom10">
        <tr>
            <td class="column1">
                <div class="min-height150 margin-top10">
                    <b><?php echo $user['Users']['username']; ?></b>
                </div>
            </td>
            <td class="column2">
                <div class="min-height150 margin-top10" style="width: 100%;">
                    <div class="min-height130">
                        <?php echo $advert['Search']['text']; ?>
                    </div>
                    <div class="right">
                        <i><small>Erstellt am <?php echo date('d.m.Y', strtotime($advert['Search']['created'])); ?></small></i>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <?php foreach($comments as $comment) { ?>
    <table class="fullWidth margin-bottom10">
        <tr>
            <td class="width50">&nbsp;</td>
            <td class="column1">
                <div class="min-height100 margin-top10">
                    <b><?php 
                        foreach($commentUsers as $commentUser) {
                            if($commentUser['id'] == $comment['Adcomment']['users_id']) {
                                echo $commentUser['username'];
                            }
                        }
                    ?></b>
                </div>
            </td>
            <td class="column2">
                <div class="min-height100 margin-top10" style="width: 100%;">
                    <div class="min-height80">
                        <?php echo $comment['Adcomment']['text']; ?>
                    </div>
                    <div class="right">
                        <i><small>Erstellt am <?php echo date('d.m.Y', strtotime($comment['Adcomment']['created'])); ?></small></i>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <?php } ?>
    <div class="margin-left50">
        <input type="button" value="Kommentar hinzufügen" class="btn" onclick="comment();" id="commentbutton">
        <div style="display: none;" id="addcomment">
            <?php echo $this->Form->create('adcomment'); ?>
                <?php echo $this->Form->input('text', array('label' => false, 'class' => 'width736')); ?>
                <input type="button" value="Abbrechen" class="btn right height30" onclick="comment();">
                <?php echo $this->Form->submit('Kommentar abgeben', array('class' => 'btn right height30')); ?>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>