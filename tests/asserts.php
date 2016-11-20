<?php
function assert_strings_are_equal($description, $expected, $actual, $debug = false) {
  $test_result = " FAILED";
  if ($actual == $expected) {
    $test_result = " PASSED";
  }

  echo "<br \>" . $description . $test_result;
  if ($debug) {
    echo " expected: " . $expected . " actual: " . $actual;
  }
}

function assert_bool_is_true($description, $actual, $debug = false) {
  $test_result = " FAILED";
  if ($actual) {
    $test_result = " PASSED";
  }

  echo "<br \>" . $description . $test_result;
  if ($debug) {
    echo " actual: " . $actual;
  }
}

function assert_bool_is_false($description, $actual, $debug = false) {
  $test_result = " FAILED";
  if (!$actual) {
    $test_result = " PASSED";
  }

  echo "<br \>" . $description . $test_result;
  if ($debug) {
    echo " actual: " . $actual;
  }
}

?>
