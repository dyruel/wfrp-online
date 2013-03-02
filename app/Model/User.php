<?php

class User extends AppModel {



    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );

    public $hasMany = array(
        'Character' => array(
            'className'     => 'Character',
//            'foreignKey'    => 'user_id',
//            'conditions'    => array('Comment.status' => '1'),
//            'order'         => 'Comment.created DESC',
//            'limit'         => '5',
            'dependent'     => true
        ),
        'Campaign' => array(
            'className'     => 'Campaign',
            'foreignKey'    => 'user_id',
//            'conditions'    => array('Comment.status' => '1'),
//            'order'         => 'Comment.created DESC',
//            'limit'         => '5',
            'dependent'     => false
        )
    );
	
	public $belongsTo = array(
        'ACampaign' => array(
            'className'     => 'Campaign',
            'foreignKey'    => 'campaign_id',
//            'conditions'    => array('Comment.status' => '1'),
//            'order'         => 'Comment.created DESC',
//            'limit'         => '5',
            'dependent'     => true
        )
    );
/*
    public $hasOne = array(
        'ActiveCharacter' => array(
            'className'     => 'Character',
//            'foreignKey'    => 'user_id',
            'conditions'    => array('ActiveCharacter.campaign_id = User.campaign_id'),
//            'order'         => 'Comment.created DESC',
//            'limit'         => '5',
            'dependent'     => false
        )
    );
*/
}

?>
