<div class="comments form">
<?php echo $this->Form->create('Comment'); ?>
	<fieldset>
		<legend><?php echo __('Add Comment'); ?></legend>
	<?php
		echo $this->Form->input('content', array('type'=>'textarea', 'label' => 'Kommentar'));
		echo $this->Form->input('news_id', array('type' => 'hidden', 'value' => $newsid));
		echo $this->Form->input('users_id', array('type' => 'hidden', 'value' => $userid['id']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
