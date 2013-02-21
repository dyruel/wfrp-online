<?php

class Career extends AppModel {

    public $hasMany = array(
        'Character' => array(
            'className'     => 'Character',
            'dependent'     => false
        )
    );

/*
    public function afterFind($results, $primary = false) {
//      pr($results);

      if(isset($results[0]) && is_array($results[0])){
        foreach ($results as $key => $val) {
          if (isset($val['Career']['profile'])) {
              $results[$key]['Career']['profile'] = $this->profileFormatAfterFind($val['Career']['profile']);
          }
        }
      } else {
        if (isset($val['Career']['profile'])) {
            $results[$key]['Career']['profile'] = $this->profileFormatAfterFind($val['Career']['profile']);
        }
      }
        return $results;
    }
*/


    public static function profileFormat($profile) {
      $return = new SplFixedArray(16);
      $profile = explode(',', $profile);

      foreach($profile as $key => $value) {
        $return[$key] = intval($value);
      }

      return $return;
    }
}

?>
