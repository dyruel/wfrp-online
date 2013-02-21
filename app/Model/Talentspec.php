<?php

class Talentspec extends AppModel {

    public $belongsTo = array(
        'Talent' => array(
            'className'     => 'Talent',
            'foreignKey'    => 'talent_id',
            'dependent'     => true
        ),
/*
        'CharactersTalent' => array(
            'className'     => 'CharactersTalent',
            'foreignKey'    => 'talentspec_id',
            'dependent'     => true
        )
*/
    );


  
}

?>
