<?php

class Talent extends AppModel {

    public $hasMany = array(
        'Talentspec' => array(
            'className'     => 'Talentspec',
            'dependent'     => false
        ),
        'CharactersTalentsTalentspec' => array(
            'className'     => 'CharactersTalentsTalentspec',
            'dependent'     => false
        )
    );

    public $belongsTo = array(
        'Skill' => array(
            'className'     => 'Skill',
            'foreignKey'    => 'skill_id',
            'dependent'     => true
        )
    );
}

?>
