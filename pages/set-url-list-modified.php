<?php
require '../includes/url-list.inc';

// define variables
$file = $_SERVER["DOCUMENT_ROOT"] . "/kiosk/sites";
url_list_set_modified($file);
?>
<html>
<body>
<form id="goBack" action="../index.php">
  <input type="submit" name="submit" value="submit" >
</form>
<script type="text/javascript">
<!--  document.getElementById('goBack').submit();-->
</script>
</body>
</html>
