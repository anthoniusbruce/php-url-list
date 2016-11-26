<?php
require '../includes/input-format.inc';
require '../includes/url-list.inc';

// define variables
$file = $_SERVER["DOCUMENT_ROOT"] . "/kiosk/sites";
$url = $urlError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST["url"])) {
    $url = test_input($_POST["url"]);
    if (!is_valid_url($url)) {
      $urlError = "Invalid URL"; 
    } else {
      url_list_add_url($url, $file);
    }
  }
}
?>
<html>
<body>
<form id="goBack" action="../index.php" <?php if ($urlError != "") echo("method = 'post'"); ?> >
  <input type="hidden" name="urlError" <?php echo("value='" . $urlError . "'"); ?> >
  <input type="hidden" name="url" <?php echo("value='" . $url . "'"); ?> >
</form>
<script type="text/javascript">
  document.getElementById('goBack').submit();
</script>
</body>
</html>
