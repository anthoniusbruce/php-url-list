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

// tests for is_valid_url
function is_valid_url_simplewithhttp_returns_true() {
  // Arrange
  $in = "http://www.google.com";

  // Action
  $result = is_valid_url($in);

  // Assert
  assert_bool_is_true(__FUNCTION__, $result);
}

function is_valid_url_simplewithhttps_returns_true() {
  // Arrange
  $in = "https://www.google.com";

  // Action
  $result = is_valid_url($in);

  // Assert
  assert_bool_is_true(__FUNCTION__, $result);
}

function is_valid_url_simplewithwwwonly_returns_false() {
  // Arrange
  $in = "www.google.com";

  // Action
  $result = is_valid_url($in);

  // Assert
  assert_bool_is_false(__FUNCTION__, $result);
}

function is_valid_url_simplewithonlydomainanddotcom_returns_false() {
  // Arrange
  $in = "google.com";

  // Action
  $result = is_valid_url($in);

  // Assert
  assert_bool_is_false(__FUNCTION__, $result);
}

function is_valid_url_complexstring_returns_true() {
  // Arrange
  $in = "http://www.google.ps/search?hl=en&client=firefox-a&hs=42F&rls=org.mozilla%3Aen-US%3Aofficial&q=The+type+%27Microsoft.Practices.ObjectBuilder.Locator%27+is+defined+in+an+assembly+that+is+not+referenced.+You+must+add+a+reference+to+assembly+&aq=f&aqi=&aql=&oq=";

  // Action
  $result = is_valid_url($in);

  // Assert
  assert_bool_is_true(__FUNCTION__, $result);
}

function is_valid_url_poorlyformatedsimpleurl_returns_false() {
  // Arrange
  $in = "www.example.com/?p=home";

  // Action
  $result = is_valid_url($in);

  // Assert
  assert_bool_is_false(__FUNCTION__, $result);
}

function is_valid_url_poorlyformatedcomplexurl_returns_false() {
  // Arrange
  $in = "www.example.com/1/2/content.jsp?cid=23uolk23nlj38;o9sme;93-21-10%21%";

  // Action
  $result = is_valid_url($in);

  // Assert
  assert_bool_is_false(__FUNCTION__, $result);
}

test_input_leading_and_trailing_whitespace_returns_no_whitespace();
test_input_backslashes_returns_no_backslashes();
test_input_specialcharacters_returns_escaped_string();
test_input_one_of_each_returns_all_removed();

is_valid_url_simplewithhttp_returns_true();
is_valid_url_simplewithhttps_returns_true();
is_valid_url_simplewithwwwonly_returns_false();
is_valid_url_simplewithonlydomainanddotcom_returns_false();
is_valid_url_complexstring_returns_true();
is_valid_url_poorlyformatedsimpleurl_returns_false();
is_valid_url_poorlyformatedcomplexurl_returns_false();
?>
