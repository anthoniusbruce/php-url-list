<?php
require_once 'asserts.php';
require '../includes/url-list.inc';

function get_test_file_name() {
  return "/var/www/test_files/url_list_tests";
}

function create_test_file($base_data, $count) {
  $file = get_test_file_name();
  unlink($file);

  for ($i = 0; $i < $count; ++$i) {
    url_list_add_url($base_data . $i, $file);
  }

  return $file;
}

function get_url_list_noFile_returnsEmptyList() {
  // Arrange
  $file = get_test_file_name();
  unlink($file);

  // Action
  $result = get_url_list($file);

  // Assert
  assert_array_is_empty(__FUNCTION__, $result);
}

function get_url_list_returnsListOfOne() {
  // Arrange
  $file = create_test_file("http://google.com/", 1);
  $expected = array("http://google.com/0");
  
  // Action 
  $result = get_url_list($file);

  // Assert
  assert_arrays_are_equal(__FUNCTION__, $expected, $result, true);
}

function get_url_list_returnsMany() { 
}

function url_list_add_url_addtoanemptylist_returnstheoneitem() {
  // Arrange
  $in = "http://google.com";
  $expected = array($in);
  //   create file to test with
  $file = get_test_file_name();
  unlink(Sfile);

  // Action
  $result = url_list_add_url($in, $file);

  // Assert
  assert_arrays_are_equal(__FUNCTION__, $expected, $result, true);
}

echo "<br><br><b>url-list.inc</b>";

get_url_list_noFile_returnsEmptyList();
get_url_list_returnsListOfOne();
url_list_add_url_addtoanemptylist_returnstheoneitem();
?>
