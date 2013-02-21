<?php

class Skill extends AppModel {
/*
    public $hasAndBelongsToMany = array(
        'Character' =>
            array(
                'className'              => 'Character',
                'joinTable'              => 'characters_skills',
//                'foreignKey'             => 'character_id',
//                'associationForeignKey'  => 'character_id',
                'unique'                 => false,
                'conditions'             => '',
                'fields'                 => '',
                'order'                  => '',
                'limit'                  => '',
                'offset'                 => '',
                'finderQuery'            => '',
                'deleteQuery'            => '',
                'insertQuery'            => ''
            )
    );
*/
    public $hasMany = array(
        'Skillspec' => array(
            'className'     => 'Skillspec',
            'dependent'     => false
        ),
        'CharactersSkillsSkillspec' => array(
            'className'     => 'CharactersSkillsSkillspec',
            'dependent'     => false
        )
    );
}

?>
