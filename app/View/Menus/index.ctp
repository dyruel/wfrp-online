<div class="index">
	<h2><?php echo __('Games'); ?></h2>


	<div class="paging">
    <?php echo print_r($username); ?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Join'), array('action' => 'join')); ?></li>
		<li><?php echo $this->Html->link(__('Create'), array('action' => 'create')); ?></li>
		<li><?php echo $this->Html->link(__('Manage'), array('action' => 'manage')); ?></li>
		<li><?php echo $this->Html->link(__('Load'), array('action' => 'load')); ?></li>
	</ul>
</div>
