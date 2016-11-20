<?php

function is_valid_url($data) {
  return filter_var($data, FILTER_VALIDATE_URL);
}

function add_scheme($url, $scheme = 'http://')
{
  $parsed_scheme = parse_url($url, PHP_URL_SCHEME);

  if (is_null($parsed_scheme)) {
    return $scheme . $url;
  } else {
    return $url;
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = add_scheme($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
