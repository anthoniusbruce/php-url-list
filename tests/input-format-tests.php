<?php 
require 'asserts.php';
require '../includes/input-format.inc';

// tests for test_input method
function test_input_leading_and_trailing_whitespace_returns_no_whitespace() {
  // Arrange
  $expected = "expected";
  $in = " \n" . $expected . "\t\r";

  // Action
  $result = test_input($in);

  // Assert
  assert_strings_are_equal(__FUNCTION__, $expected, $result);
}

function test_input_backslashes_returns_no_backslashes() {
  // Arrange
  $expected = "backslash";
  $in = "back\\slash";

  // Action
  $result = test_input($in);

  // Assert
  assert_strings_are_equal(__FUNCTION__, $expected, $result);
}

function test_input_specialcharacters_returns_escaped_string() {
  // Arrange
  $expected = "hello&amp;there";
  $in = "hello&there";

  // Action
  $result = test_input($in);

  // Assert
  assert_strings_are_equal(__FUNCTION__, $expected, $result);
}

function test_input_one_of_each_returns_all_removed() {
  // Arrange
  $expected = "&lt;Hello World&gt;";
  $in = " <Hello \\World>\n";

  // Action 
  $result = test_input($in);

  // Assert
  assert_strings_are_equal(__FUNCTION__, $expected, $result);
}

test_input_leading_and_trailing_whitespace_returns_no_whitespace();
test_input_backslashes_returns_no_backslashes();
test_input_specialcharacters_returns_escaped_string();
test_input_one_of_each_returns_all_removed();
?>
