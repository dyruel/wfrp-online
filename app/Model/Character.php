<?php

class Character extends AppModel {

    const WS =  0;
    const BS =  1;
    const S =   2;
    const T =   3;
    const Ag =  4;
    const Int = 5;
    const WP =  6;
    const Fel = 7;

    const A =  8;
    const W =  9;
    const SB = 10;
    const TB = 11;
    const M  = 12;
    const Mag = 13;
    const IP = 14;
    const FP = 15;

    public $belongsTo = array(
        'Campaign' => array(
            'className'     => 'Campaign',
            'foreignKey'    => 'campaign_id',
            'dependent'     => true
        ),
        'Race' => array(
            'className'     => 'Race',
            'foreignKey'    => 'race_id',
            'dependent'     => true
        ),
        'Career' => array(
            'className'     => 'Career',
            'foreignKey'    => 'career_id',
            'dependent'     => true
        ),
        'Rank' => array(
            'className'     => 'Rank',
            'foreignKey'    => 'rank_id',
            'dependent'     => true
        )
    );

    public $hasMany = array(
        'CharactersSkillsSkillspec' => array(
            'className'     => 'CharactersSkillsSkillspec',
            'dependent'     => false
        ),
        'CharactersTalentsTalentspec' => array(
            'className'     => 'CharactersTalentsTalentspec',
            'dependent'     => false
        )
    );


/*
    public function afterFind($results, $primary = false) {
        foreach ($results as $key => $val) {
            if (isset($val['Character']['profile'])) {
                $results[$key]['Character']['profile'] = $this->profileFormatAfterFind($val['Character']['profile']);
            }
            if (isset($val['Character']['money'])) {
                $results[$key]['Character']['money'] = $this->moneyFormatAfterFind($val['Character']['money']);
            }
        }
        return $results;
    }
*/

    public static function profileFormat($profile) {
      $base = new SplFixedArray(16);
      $current = new SplFixedArray(16);
      $profile = explode(',', $profile);
      foreach($profile as $key => $value) {
        $tmp = explode(':', $profile[$key]);
        $current[$key] = intval($tmp[0]);
        $base[$key] = intval($tmp[1]);
      }

      return array(
        'base' => $base,
        'current' => $current
      );
    }

    public static function moneyFormat($money) {
      return explode(',', $money);
    }

}

?>
