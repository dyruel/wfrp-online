<?php

class Post extends AppModel {
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );

    public $belongsTo = array(
        'Character' => array(
            'className'     => 'Character',
            'foreignKey'    => 'character_id',
//            'conditions'    => array('Comment.status' => '1'),
//            'order'         => 'Comment.created DESC',
//            'limit'         => '5',
            'dependent'     => true
        ),
        'Area' => array(
            'className'     => 'Area',
            'foreignKey'    => 'area_id',
//            'conditions'    => array('Comment.status' => '1'),
//            'order'         => 'Comment.created DESC',
//            'limit'         => '5',
            'dependent'     => true
        ),
		'Campaign' => array(
            'className'     => 'Area',
            'foreignKey'    => 'area_id',
//            'conditions'    => array('Comment.status' => '1'),
//            'order'         => 'Comment.created DESC',
//            'limit'         => '5',
            'dependent'     => true
        )
    );
}

?>
