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

?>
