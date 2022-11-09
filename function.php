<?php
ini_set('error_log', 'php.log');

// デバッグ出力用関数
function debug($str) {
  $debug_flg = false;
  if($debug_flg) {
    error_log('デバッグ: '.$str);
  }
}

// パスワード生成関数
function makePassGene($len = '') {
  $str = '';
  $char = 'abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789/*-+!#$%&()"^*';
  for($i = 0; $i < $len; ++$i) {
    $str .= $char[random_int(0, 69)];
  }
  return $str;
}
?>