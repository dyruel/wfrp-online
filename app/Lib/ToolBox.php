<?php

class ToolBox {

  private static $_a_statsStr = array();

  public static function statsStr() {
    if(empty(self::$_a_statsStr))
     self::$_a_statsStr = array(__('WS'), __('BS'), __('S'), __('T'), __('Ag'), __('Int'), __('WP'), __('Fel'),
                               __('A'), __('W'), __('SB'), __('TB'), __('M'), __('Mag'), __('IP'), __('FP') );

    return self::$_a_statsStr;
  }


  public static function rollDice($str) {
    if(!is_string($str) or !preg_match("#^[1-9]+d[1-9]+[0-9]*(\+[0-9]+)?$#", $str))
      throw new Exception('Dice format error.');
    
    $bonus = 0;
    $tmp = explode('+', $str);
    $dice = explode('d', $tmp[0]);

    $i = intval($dice[0]);
    $max = intval($dice[1]);
    $r = 0;
    while($i) {
     $r += rand(1, $max);
     --$i;
    }

    if(count($tmp)>1)
      $bonus = intval($tmp[1]);
    
    return $r+$bonus;
  }


}

?>
