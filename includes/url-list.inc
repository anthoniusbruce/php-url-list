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

function find_url_hash_in_list($url_hash, $file) {
  // if the file doesn't exist then the line will not be matched
  if (!file_exists($file)) {
    return null;
  }

  $list_file = fopen($file, "r") or die("unable to read: " . $file . " error: " . print_r(error_get_last(), true));
  while (($buffer = fgets($list_file)) !== false) {
    if (strcmp(hash(trim($buffer)), $url_hash) == 0) {
      fclose($list_file);
      return $buffer;
    }
  }

  fclose($list_file);
  return null;
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
  fclose($list_file);
  
  return $list;
}

function url_list_delete_url($url_hash, $file) {
  $url = find_url_hash_in_list($url_hash, $file);
  if (!empty($url)) {
    $list = array();
    $list_file = fopen($file, "r") or die("unable to read: " . $file . " error: " . print_r(error_get_last(), true));
    while (($buffer = fgets($list_file)) !== false) {
      $buffer = trim($buffer);
      if (strcmp($buffer, $url) == 0) {
        $url = "";
      } else {
        array_push($list, $buffer);
      }
    }
    fclose($list_file);

    $list_file = fopen($file, "w") or die("unable to read: " . $file . " error: " . print_r(error_get_last(), true));
    $list_count = count($list);
    for ($i = 0; $i < $list_count; ++$i) {
      fwrite($list_file, $list[$i] . "\n");
    }
    fclose($list_file);
  }

  return get_url_list($file);
}
?>
