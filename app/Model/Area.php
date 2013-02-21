<?php

class Area extends AppModel {
    public $hasMany = array(
        'Post' => array(
            'className'     => 'Post',
//            'foreignKey'    => 'user_id',
//            'conditions'    => array('Comment.status' => '1'),
//            'order'         => 'Comment.created DESC',
//            'limit'         => '5',
            'dependent'     => false
        )
    );
}

?>
