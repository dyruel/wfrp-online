<?php

class Race extends AppModel {

    public $hasMany = array(
        'Character' => array(
            'className'     => 'Character',
//            'foreignKey'    => 'rank_id',
//            'conditions'    => array('Comment.status' => '1'),
//            'order'         => 'Comment.created DESC',
//            'limit'         => '5',
            'dependent'     => false
        )
    );

}

?>
