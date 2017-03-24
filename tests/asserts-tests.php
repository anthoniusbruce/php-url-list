<?php 
require_once 'asserts.php';

function assert_arrays_are_equal_empty_arrays_are_equal() {
  // Arrange
  $array1 = array();
  $array2 = array();

  // Act
  $result = assert_arrays_are_equal(__FUNCTION__, $array1, $array2);

  // Assert
  internal_report_assert("pass", $result);
}

function assert_arrays_are_equal_arrays_of_different_size_are_not_equal() {
  // Arrange
  $array1[] = "a";
  $array1[] = "b";
  $array2[] = "a";

  // Act
  $result = assert_arrays_are_equal(__FUNCTION__, $array1, $array2);

  // Assert
  internal_report_assert("fail", $result);
}

function assert_arrays_are_equal_arrays_of_same_item_are_equal() {
  // Arrange
  $array1[] = "a";
  $array1[] = "b";
  $array2[] = "a";
  $array2[] = "b";

  // Act
  $result = assert_arrays_are_equal(__FUNCTION__, $array1, $array2);

  // Assert
  internal_report_assert("pass", $result);
}

function assert_arrays_are_equal_arrays_of_different_items_are_not_equal() {
  // Arrange
  $array1[] = "a";
  $array1[] = "b";
  $array2[] = "c";
  $array2[] = "d";

  // Act
  $result = assert_arrays_are_equal(__FUNCTION__, $array1, $array2);

  // Assert
  internal_report_assert("fail", $result);
}

function assert_arrays_are_equal_arrays_of_different_order_are_not_equal() {
  // Arrange
  $array1[] = "a";
  $array1[] = "b";
  $array2[] = "b";
  $array2[] = "a";

  // Act
  $result = assert_arrays_are_equal(__FUNCTION__, $array1, $array2);

  // Assert
  internal_report_assert("fail", $result);

}

function assert_arrays_are_equal_arrays_of_different_single_item_are_not_equal() {
  // Arrange
  $array1[] = "a";
  $array1[] = "b";
  $array2[] = "a";
  $array2[] = "c";

  // Act
  $result = assert_arrays_are_equal(__FUNCTION__, $array1, $array2);

  // Assert
  internal_report_assert("fail", $result);

}

function assert_arrays_are_equal_arrays_with_same_single_item_are_equal() {
  // Arrange
  $array1[] = "http://www.google.com/0";
  $array2[] = "http://www.google.com/0";

  // Act 
  $result = assert_arrays_are_equal(__FUNCTION__, $array1, $array2);

  // Assert
  internal_report_assert("pass", $result);
}

function internal_report_assert($expected_result, $actual_result) {
  echo "<b><i>...";
  if (stripos($actual_result, $expected_result) === false) {
    echo "FAILED:";
  } else {
    echo "PASSED";
  }
  echo "</b></i>";
}

echo "<b>asserts.php</b>";

assert_arrays_are_equal_empty_arrays_are_equal();
assert_arrays_are_equal_arrays_of_different_size_are_not_equal();
assert_arrays_are_equal_arrays_of_same_item_are_equal();
assert_arrays_are_equal_arrays_of_different_items_are_not_equal();
assert_arrays_are_equal_arrays_of_different_order_are_not_equal();
assert_arrays_are_equal_arrays_of_different_single_item_are_not_equal();
assert_arrays_are_equal_arrays_with_same_single_item_are_equal();

echo "<br><br>";
?>
