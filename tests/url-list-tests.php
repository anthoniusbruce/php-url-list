<?php
require_once 'asserts.php';
require '../includes/url-list.inc';

function url_list_add_url_addtoanemptylist_returnstheoneitem() {
  // Arrange
  $in = "http://google.com";
  $expected = array($in);

  // Action
  $result = url_list_add_url($in);

  // Assert
  assert_arrays_are_equal(__FUNCTION__, $expected, $result);
}

echo "<br /><br /><b>url-list.inc</b>";

url_list_add_url_addtoanemptylist_returnstheoneitem();
?>
