<?php
require '../includes/url-list.inc';

// define variables
$file = $_SERVER["DOCUMENT_ROOT"] . "/kiosk/sites";
$hash = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (!empty($_GET["hash"])) {
    $hash = $_GET["hash"];
    url_list_delete_url($hash, $file);
    $hash = "";
  }
}
?>
<html>
<body>
<form id="goBack" action="../index.php">
  <!--<input type="submit" name="submit" value="submit" > -->
</form>
<script type="text/javascript">
  document.getElementById('goBack').submit();
</script>
</body>
</html>
