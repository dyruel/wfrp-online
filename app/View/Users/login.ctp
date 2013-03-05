
<?php echo $this->Session->flash('auth'); ?>

<div style="width:166px; margin:auto;">

	<div >
    <p><?php /*echo __('Please enter your username and password');*/ ?></p>
    <?php echo $this->Form->create('User'); ?>
    <?php echo $this->Form->input('username', array(
                    'label' => array(
                        'class' => 'text1'
                    ),
                    'class' => 'input1'
                ));
          echo $this->Form->input('password', array(
                    'label' => array(
                        'class' => 'text1'
                    ),
                    'class' => 'input1'
                ));
          echo $this->Form->end(array(
//                                'type' => 'image',
//                                'src' => '../img/homepage09.jpg',
                                'label' => 'Login',
                                'value' => 'Login',
                                'id' => 'imagefield1',

//                                'class' => 'link1'
                            )); 
/*
          echo $this->Form->end(array(
                                'type' => 'image',
                                'src' => '../img/homepage09.jpg',
                                'id' => 'imagefield1',
                              
                                'class' => 'link1'
                            )); 
*/
    ?>
			<p>&nbsp;<br /><a href="#" class="link1">Login Help</a></p>
	</div>
</div>

<br />
<br />

