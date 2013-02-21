

<div class="index">
<h3><?php echo __('Steps'); ?></h3>
<?php echo $this->Wizard->progressMenu(); ?>

	<h2><?php echo __('Character creation tool'); ?></h2>
  <?php echo $this->Wizard->create(); ?>
  <?php
    echo $this->Form->input('campaign_id', array(
        'options' => array('1','2')
    ));
  ?>  
  <?php echo $this->Form->end(__('Next')); ?>
	<div class="paging">

	</div>
</div>


