<h1><?php echo __('Skill test for ').$char['Character']['name']; ?></h1>

<?php echo $this->Form->create(false);?>
	    <fieldset>
	    <?php
/*
		    foreach($chars as $char):
				echo $this->Form->label('Char.'.$char['Character']['id'], $char['Character']['name']);
				echo $this->Form->checkbox('Char.'.$char['Character']['id']);
			endforeach;
 */
	    ?>
	    </fieldset>
<?php echo $this->Form->end(__('Perform'));?>