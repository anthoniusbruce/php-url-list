<?php
require_once 'asserts.php';
require '../includes/url-list.inc';

function get_test_file_name() {
  return $_SERVER["DOCUMENT_ROOT"] . "/test_files/url_list_tests";
}

function remove_file($file) {
  if (!file_exists($file)) {
    return;
  }

  if (!unlink($file)) {
    echo("unable to delete"  . $file . " error: " . print_r(error_get_last(), true));
  }
}

function create_test_file($base_data, $count, $useAltName) {
  $file = get_test_file_name();
  if ($useAltName) {
    $file = $file . "alt";
  }
  remove_file($file);

  for ($i = 0; $i < $count; $i++) {
    url_list_add_url($base_data . $i, $file);
  }

  return $file;
}

function find_url_in_list_filedoesnotexist_returnfalse() {
  // Arrange
  $in = "http://www.google.com";
  $file = get_test_file_name();
  remove_file($file);

  // Action 
  $result = find_url_in_list($in, $file);

  // Assert
  assert_bool_is_false(__FUNCTION__, $result);  
}

function find_url_in_list_isnotinlist_returnsfalse() {
  // Arrange
  $file = create_test_file("http://www.google.com/", 3);
  $in = "http://www.cnn.com";

  // Action
  $result = find_url_in_list($in, $file);

  // Assert
  assert_bool_is_false(__FUNCTION__, $result);  
}

function find_url_in_list_isfirstinlist_returnstrue() {
  // Arrange
  $file = create_test_file("http://www.google.com/", 3);
  $in = "http://www.google.com/0";

  // Action
  $result = find_url_in_list($in, $file);

  // Assert
  assert_bool_is_true(__FUNCTION__, $result);  
}

function find_url_in_list_issecondinlist_returnstrue() {
  // Arrange
  $file = create_test_file("http://www.google.com/", 3);
  $in = "http://www.google.com/1";

  // Action
  $result = find_url_in_list($in, $file);

  // Assert
  assert_bool_is_true(__FUNCTION__, $result);  
}

function find_url_in_list_isthirdinlist_returnstrue() {
  // Arrange
  $file = create_test_file("http://www.google.com/", 3);
  $in = "http://www.google.com/2";

  // Action
  $result = find_url_in_list($in, $file);

  // Assert
  assert_bool_is_true(__FUNCTION__, $result);  
}

function find_url_hash_in_list_filedoesnotexist_returnempty() {
  // Arrange
  $expected = "http://www.google.com";
  $in = hash("sha256", $expected);
  $file = get_test_file_name();
  remove_file($file);

  // Action 
  $result = find_url_hash_in_list($in, $file);

  // Assert
  assert_string_is_empty(__FUNCTION__, $result);  
}

function find_url_hash_in_list_isnotinlist_returnsempty() {
  // Arrange
  $file = create_test_file("http://www.google.com/", 3);
  $expected = "http://www.cnn.com";
  $in = hash("sha256", $expected);

  // Action
  $result = find_url_hash_in_list($in, $file);

  // Assert
  assert_string_is_empty(__FUNCTION__, $result);  
}

function find_url_hash_in_list_isfirstinlist_returnsurl() {
  // Arrange
  $file = create_test_file("http://www.google.com/", 3);
  $expected = "http://www.google.com/0";
  $in = hash("sha256", $expected);

  // Action
  $result = find_url_hash_in_list($in, $file);

  // Assert
  assert_are_equal(__FUNCTION__, $expected, $result);  
}

function find_url_hash_in_list_issecondinlist_returnsurl() {
  // Arrange
  $file = create_test_file("http://www.google.com/", 3);
  $expected = "http://www.google.com/1";
  $in = hash("sha256", $expected);

  // Action
  $result = find_url_hash_in_list($in, $file);

  // Assert
  assert_are_equal(__FUNCTION__, $expected, $result);  
}

function find_url_hash_in_list_isthirdinlist_returnsurl() {
  // Arrange
  $file = create_test_file("http://www.google.com/", 3);
  $expected = "http://www.google.com/2";
  $in = hash("sha256", $expected);

  // Action
  $result = find_url_hash_in_list($in, $file);

  // Assert
  assert_are_equal(__FUNCTION__, $expected, $result);  
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

function url_list_add_url_addurlthatisalreadyinlist_listshouldnotchange() {
  // Arrange
  $in = "http://www.google.com/0";
  $file = create_test_file("http://www.google.com/", 3);
  $expected = array("http://www.google.com/0", "http://www.google.com/1", "http://www.google.com/2");

  // Action
  $result = url_list_add_url($in, $file);

  // Assert
  assert_arrays_are_equal(__FUNCTION__, $expected, $result);
}

function url_list_delete_url_deleteurlnotinlist_liststaysthesame() {
  // Arrange
  $file = create_test_file("http://www.google.com/", 3);
  $in = hash("sha256", "http://www.google.com");
  $expected = array("http://www.google.com/0", "http://www.google.com/1", "http://www.google.com/2");

  // Action
  $result = url_list_delete_url($in, $file);

  // Assert
  assert_arrays_are_equal(__FUNCTION__, $expected, $result);
}

function url_list_delete_url_deletefirsturlsnlist_listreduces() {
  // Arrange
  $file = create_test_file("http://www.google.com/", 3);
  $in = hash("sha256", "http://www.google.com/0");
  $expected = array("http://www.google.com/1", "http://www.google.com/2");

  // Action
  $result = url_list_delete_url($in, $file);

  // Assert
  assert_arrays_are_equal(__FUNCTION__, $expected, $result);
}

function url_list_delete_url_deletelasturlinlist_listreduces() {
  // Arrange
  $file = create_test_file("http://www.google.com/", 3);
  $in = hash("sha256", "http://www.google.com/2");
  $expected = array("http://www.google.com/0", "http://www.google.com/1");

  // Action
  $result = url_list_delete_url($in, $file);

  // Assert
  assert_arrays_are_equal(__FUNCTION__, $expected, $result);
}

function url_list_delete_url_deletemiddleurlinlist_listreduces() {
  // Arrange
  $file = create_test_file("http://www.google.com/", 3);
  $in = hash("sha256", "http://www.google.com/1");
  $expected = array("http://www.google.com/0", "http://www.google.com/2");

  // Action
  $result = url_list_delete_url($in, $file);

  // Assert
  assert_arrays_are_equal(__FUNCTION__, $expected, $result);
}

function url_list_set_modified_calledonfilethatdoesntexist_fileisnotcreated() {
  // Arrange
  $file = get_test_file_name(); 
  remove_file($file);

  // Action
  $result = url_list_set_modified($file);

  // Assert
  assert_bool_is_true(__FUNCTION__ . " set_modified is successful", $result);
  assert_bool_is_false(__FUNCTION__ . " file does not exist", file_exists($file));
}

function url_list_set_modified_calledonfilethatdoesexist_filetimeischanged() {
  // Arrange
  $file = create_test_file("http://www.google.com/", 3);
  $orig_time = filemtime($file);
  sleep(1);
  clearstatcache();
  $second_time = filemtime($file);

  // Action
  $result = url_list_set_modified($file);
  clearstatcache();
  
  // Assert
  $mod_time = filemtime($file);
  assert_bool_is_true(__FUNCTION__ . " set_modified is successful", $result);
  assert_are_equal(__FUNCTION__ . " second check of modified time is still the same value", $orig_time, $second_time);
  assert_are_equal(__FUNCTION__ . " file last modified has changed one second", $orig_time+1, $mod_time);
}

function url_list_move_down_url_movefirstdown_secondisfirstandfirstissecond() {
  // Arrange
  $file = create_test_file("http://www.google.com/", 3);
  $in = hash("sha256", "http://www.google.com/0");
  $expected = array("http://www.google.com/1", "http://www.google.com/0", "http://www.google.com/2");

  // Act
  $result = url_list_move_down_url($in, $file);

  // Assert
  assert_arrays_are_equal(__FUNCTION__, $expected, $result);
}

function url_list_move_down_url_movelastdown_nochange() {
  // Arrange
  $file = create_test_file("http://www.google.com/", 3);
  $in = hash("sha256", "http://www.google.com/2");
  $expected = array("http://www.google.com/0", "http://www.google.com/1", "http://www.google.com/2");

  // Act
  $result = url_list_move_down_url($in, $file);

  // Assert
  assert_arrays_are_equal(__FUNCTION__, $expected, $result);
}

function url_list_move_down_url_moveseconddown_secondislastandlastissecond() {
  // Arrange
  $file = create_test_file("http://www.google.com/", 3);
  $in = hash("sha256", "http://www.google.com/1");
  $expected = array("http://www.google.com/0", "http://www.google.com/2", "http://www.google.com/1");

  // Act 
  $result = url_list_move_down_url($in, $file);

  // Assert
  assert_arrays_are_equal(__FUNCTION__, $expected, $result);
}

function url_list_move_down_url_oneiteminlist_movedowndoesnothing() {
  // Arrange
  $file = create_test_file("http://www.google.com/", 1);
  $in = hash("sha256", "http://www.google.com/0");
  $expected = array("http://www.google.com/0");

  // Act 
  $result = url_list_move_down_url($in, $file);

  // Assert
  assert_arrays_are_equal(__FUNCTION__, $expected, $result);
}

echo "<br>";
echo "<br><br><b>url-list.inc</b>";

find_url_in_list_filedoesnotexist_returnfalse();
find_url_in_list_isnotinlist_returnsfalse();
find_url_in_list_isfirstinlist_returnstrue();
find_url_in_list_issecondinlist_returnstrue();
find_url_in_list_isthirdinlist_returnstrue();
echo "<br>";
find_url_hash_in_list_filedoesnotexist_returnempty();
find_url_hash_in_list_isnotinlist_returnsempty();
find_url_hash_in_list_isfirstinlist_returnsurl();
find_url_hash_in_list_issecondinlist_returnsurl();
find_url_hash_in_list_isthirdinlist_returnsurl();
echo "<br>";
get_url_list_noFile_returnsEmptyList();
get_url_list_returnsListOfOne();
get_url_list_returnsMany(); 
echo "<br>";
url_list_add_url_addtoanemptylist_returnstheoneitem();
url_list_add_url_addtoexistinglist_returnslistwithnewitematend();
url_list_add_url_addurlthatisalreadyinlist_listshouldnotchange();
echo "<br>";
url_list_delete_url_deleteurlnotinlist_liststaysthesame();
url_list_delete_url_deletefirsturlsnlist_listreduces();
url_list_delete_url_deletelasturlinlist_listreduces();
url_list_delete_url_deletemiddleurlinlist_listreduces();
echo "<br>";
url_list_set_modified_calledonfilethatdoesntexist_fileisnotcreated();
url_list_set_modified_calledonfilethatdoesexist_filetimeischanged();
echo "<br>";
url_list_move_down_url_movefirstdown_secondisfirstandfirstissecond();
url_list_move_down_url_movelastdown_nochange();
url_list_move_down_url_moveseconddown_secondislastandlastissecond();
url_list_move_down_url_oneiteminlist_movedowndoesnothing();
?>
