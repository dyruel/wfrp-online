<?php

class CharactersSkillsSkillspec extends AppModel {

    public $belongsTo = array(
        'Character' => array(
            'className'     => 'Character',
            'foreignKey'    => 'character_id',
            'dependent'     => true
        ),
        'Skill' => array(
            'className'     => 'Skill',
            'foreignKey'    => 'skill_id',
            'dependent'     => true
        ),
        'Skillspec' => array(
            'className'     => 'Skillspec',
            'foreignKey'    => 'skillspec_id',
            'dependent'     => true
        )
    );

}

?>
