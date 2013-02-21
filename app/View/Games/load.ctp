<div class="index">
	<h2><?php echo __('Load a campaign'); ?></h2>

  <?php
    echo $this->Form->create('User');
    $array_pc = array();
    foreach($characters as $character) {
      $array_pc[$character['Campaign']['id']] = $character['Campaign']['name'] . ' (' . $character['Character']['name'] .')';
//      array_push($array, array($character['Campaign']['id'] => $character['Campaign']['name'] . ' (' . $character['Character']['name'] .')'));
    }

    $array_gm = array();
    foreach($campaigns as $campaign) {
      $array_gm[$campaign['Campaign']['id']] = $campaign['Campaign']['name'];
//      array_push($array, array($campaign['Campaign']['id'] => $campaign['Campaign']['name'] . ' (MJ)'));
    }
//    print_r($array);
    echo $this->Form->input('campaign_id', array(
        'options' => array(__('Player') => $array_pc, __('Game master') => $array_gm)
    ));
//    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end(__('Load'));
  ?>
	<div class="paging">

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
