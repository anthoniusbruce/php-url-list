<?php
require_once 'asserts.php';
require '../includes/url-list.inc';

function get_test_file_name() {
  return "/var/www/test_files/url_list_tests";
}

function remove_file($file) {
  if (!file_exists($file)) {
    return;
  }

  if (!unlink($file)) {
    echo("unable to delete"  . $file . " error: " . print_r(error_get_last(), true));
  }
}

function create_test_file($base_data, $count) {
  $file = get_test_file_name();
  remove_file($file);

  for ($i = 0; $i < $count; $i++) {
    url_list_add_url($base_data . $i, $file);
  }

  return $file;
}

function get_url_list_noFile_returnsEmptyList() {
  // Arrange
  $file = get_test_file_name();
  remove_file($file);

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
  assert_arrays_are_equal(__FUNCTION__, $expected, $result);
}

function get_url_list_returnsMany() { 
  // Arrange
  $file = create_test_file("http://google.com/", 3);
  $expected = array("http://google.com/0", "http://google.com/1", "http://google.com/2");

  // Action
  $result = get_url_list($file);

  // Assert
  assert_arrays_are_equal(__FUNCTION__, $expected, $result);
}

function url_list_add_url_addtoanemptylist_returnstheoneitem() {
  // Arrange
  $in = "http://google.com";
  $expected = array($in);
  //   create file to test with
  $file = get_test_file_name();
  remove_file($file);

  // Action
  $result = url_list_add_url($in, $file);

  // Assert
  assert_arrays_are_equal(__FUNCTION__, $expected, $result);
}

function url_list_add_url_addtoexistinglist_returnslistwithnewitematend() {
  // Arrange
  $in = "http://cnn.com";
  $file = create_test_file("http://google.com/", 3);
  $expected = array("http://google.com/0", "http://google.com/1", "http://google.com/2", $in);

  // Action
  $result = url_list_add_url($in, $file);

  // Assert
  assert_arrays_are_equal(__FUNCTION__, $expected, $result);
}

echo "<br><br><b>url-list.inc</b>";

get_url_list_noFile_returnsEmptyList();
get_url_list_returnsListOfOne();
get_url_list_returnsMany(); 
url_list_add_url_addtoanemptylist_returnstheoneitem();
url_list_add_url_addtoexistinglist_returnslistwithnewitematend();
?>
