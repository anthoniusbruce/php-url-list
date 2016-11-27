<?php
function find_url_in_list($url, $file) {
  // if the file doesn't exist then the line will not be matched
  if (!file_exists($file)) {
    return false;
  }

  $list_file = fopen($file, "r") or die("unable to read: " . $file . " error: " . print_r(error_get_last(), true));
  while (($buffer = fgets($list_file)) !== false) {
    if (strcmp(trim($buffer), $url) == 0) {
      fclose($list_file);
      return true;
    }
  }

  fclose($list_file);
  return false;
}

function url_list_add_url($url, $file) {
  // only add if the url doesn't already exist
  if (!find_url_in_list($url, $file)) {
    $list_file = fopen($file, "a") or die("unable to write to " . $file . " error: " . print_r(error_get_last(), true));
    fwrite($list_file, $url . "\n");
    fclose($list_file);
  }

  return get_url_list($file);
}

function get_url_list($file) {
  if (!file_exists($file)) {
    return null;
  }
  
  $list = array();

  $list_file = fopen($file, "r") or die("unable to read: " . $file . " error: " . print_r(error_get_last(), true));
  while (($buffer = fgets($list_file)) !== false) {
    array_push($list, $buffer);
  }
  
  return $list;
}

?>
