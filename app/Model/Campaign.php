<?php

class Campaign extends AppModel {

    public $belongsTo = array(
        'User' => array(
            'className'     => 'User',
            'foreignKey'    => 'user_id',
//            'conditions'    => array('Comment.status' => '1'),
//            'order'         => 'Comment.created DESC',
//            'limit'         => '5',
            'dependent'     => true
        )
    );

    public $hasMany = array(
        'Character' => array(
            'className'     => 'Character',
//            'foreignKey'    => 'user_id',
//            'conditions'    => array('Comment.status' => '1'),
//            'order'         => 'Comment.created DESC',
//            'limit'         => '5',
            'dependent'     => false
        )
    );
}

?>
