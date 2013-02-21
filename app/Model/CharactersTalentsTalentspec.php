<?php

class CharactersTalentsTalentspec extends AppModel {

    public $belongsTo = array(
        'Character' => array(
            'className'     => 'Character',
            'foreignKey'    => 'character_id',
            'dependent'     => true
        ),
        'Talent' => array(
            'className'     => 'Talent',
            'foreignKey'    => 'talent_id',
            'dependent'     => true
        ),
        'Talentspec' => array(
            'className'     => 'Talentspec',
            'foreignKey'    => 'talentspec_id',
            'dependent'     => true
        )
    );

}

?>
