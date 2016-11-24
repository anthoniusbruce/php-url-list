<?php
function assert_strings_are_equal($description, $expected, $actual, $debug = false) {
  $test_result = " <b>FAILED</b>";
  if ($actual == $expected) {
    $test_result = " PASSED";
  }

  echo "<br \>" . $description . $test_result;
  if ($debug) {
    echo " expected: " . $expected . " actual: " . $actual;
  }
}

function assert_bool_is_true($description, $actual, $debug = false) {
  $test_result = " <b>FAILED</b>";
  if ($actual) {
    $test_result = " PASSED";
  }

  echo "<br \>" . $description . $test_result;
  if ($debug) {
    echo " actual: " . $actual;
  }
}

function assert_bool_is_false($description, $actual, $debug = false) {
  $test_result = " <b>FAILED</b>";
  if (!$actual) {
    $test_result = " PASSED";
  }

  echo "<br \>" . $description . $test_result;
  if ($debug) {
    echo " actual: " . $actual;
  }
}

function assert_arrays_are_equal($description, $expected, $actual, $debug = false) {
  $test_result = " <b>FAILED</b>";
  if (is_array($expected) && is_array($actual) && 
      count($expected) == count($actual) &&
      array_diff($expected, $actual) === array_diff($actual, $expected)) {
    $test_result = " PASSED";
  }

  echo "<br \>" . $description . $test_result;
  if ($debug) {
    echo " expected: " . $expected . " actual: " . $actual;
  }
}

function assert_array_is_empty($description, $actual, $debug = false) {
  $test_result = " <b>FAILED</b>";
  if (empty($actual)) {
    $test_result = " PASSED";
  }
  
  echo "<br \>" . $description . $test_result;
  if ($debug) {
    echo " actual: " . $actual;
  }
}
?>
