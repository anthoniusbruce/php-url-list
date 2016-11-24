<?php
function url_list_add_url($url, $file) {
  $list_file = fopen($file, "a") or die("unable to write to " . $file . " error: " . print_r(error_get_last(), true));
  fwrite($list_file, $url . "\n");
  fclose($list_file);

  return get_url_list($file);
}

function get_url_list($file) {
  $list = array();
  $list_file = fopen($file, "r") or die("unable to read: " . $file . " error: " . print_r(error_get_last(), true));
  while (($buffer = fgets($file)) !== false) {
    array_push($list, $buffer);
  }
  
  return $list;
}

?>
