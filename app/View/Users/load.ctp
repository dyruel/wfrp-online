<div class="index">
	<h2><?php echo __('Load a campaign'); ?></h2>

  <?php
    echo $this->Form->create();
    $array_pc = array();
    foreach($t_data['Character'] as $character) {
      $array_pc[$character['campaign_id']] = $character['name'];
    }

    $array_gm = array();
    foreach($t_data['Campaign'] as $campaign) {
      $array_gm[$campaign['id']] = $campaign['name'];
    }
//    print_r($array);
    echo $this->Form->input('campaign_id', array(
        'options' => array(__('Character') => $array_pc, __('Game master') => $array_gm)
    ));
//    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end(__('Load'));
  ?>
	<div class="paging">

	</div>
</div>

