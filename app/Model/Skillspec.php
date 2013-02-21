<?php

class Skillspec extends AppModel {

    public $belongsTo = array(
        'Skill' => array(
            'className'     => 'Skill',
            'foreignKey'    => 'skill_id',
            'dependent'     => true
        ),
/*
        'CharactersSkill' => array(
            'className'     => 'CharactersSkill',
            'foreignKey'    => 'skillspec_id',
            'dependent'     => true
        )
*/
    );


  
}

?>
