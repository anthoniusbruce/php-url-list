<?php
function assert_are_equal($description, $expected, $actual, $debug = false) {
  $test_result = " <b>FAILED</b>";
  if ($actual == $expected) {
    $test_result = " PASSED";
  }

  echo "<br \>" . $description . $test_result;
  if ($debug) {
    echo " expected: " . $expected . " actual: " . $actual;
  }
}

function assert_are_not_equal($description, $expected, $actual, $debug = false) {
  $test_result = " <b>FAILED</b>";
  if ($actual != $expected) {
    $test_result = " PASSED";
  }

  echo "<br \>" . $description . $test_result;
  if ($debug) {
    echo " expected: " . $expected . " actual: " . $actual;
  }
}

function assert_string_is_empty($description, $actual, $debug = false) {
  $test_result = " <b>FAILED</b>";
  if (empty($actual)) {
    $test_result = " PASSED";
  }

  echo "<br \>" . $description . $test_result;
  if ($debug) {
    echo " actual: " . $actual;
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
  if (!is_array($expected) || !is_array($actual)) {
    $test_result = $test_result . " they are not both arrays"; 
  } else if (count($expected) == 0 && count($actual) == 0) {
    $test_result = "PASSED";
  } elseif (count($expected) != count($actual)) {
    $test_result = $test_result . " count is different";
  } elseif (!empty(array_diff($expected, $actual)) || !empty(array_diff($actual, $expected))) {
    $test_result = $test_result . " array_diff failed";
  } elseif ($expected !== $actual) {
    $test_resutl = $test_result . "arrays are a different order";
  } else {
    $test_result = " PASSED";
  }

  echo "<br \>" . $description . $test_result;
  if ($debug) {
    echo " expected: " . print_r(array_values($expected)) . " actual: " . print_r(array_values($actual));
  }

  return $test_result;
}

function assert_array_is_empty($description, $actual, $debug = false) {
  $test_result = " <b>FAILED</b>";
  if (empty($actual)) {
    $test_result = " PASSED";
  }
  
  echo "<br \>" . $description . $test_result;
  if ($debug) {
    echo " actual: " . print_r(array_values($actual));
  }
}
?>
