<?php 
/*
require 'includes/input-format.inc';
require 'includes/url-list.inc';

//define variables
$url = $urlError = "";
$file = "/var/www/kiosk/sites";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if (empty($_POST["url"])) {
    $url = "";
  } else {
    $url = test_input($_POST["url"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!is_valid_url($url)) {
      $urlError = "Invalid URL"; 
    } else {
      url_list_add_url($url, $file);
      $url = "";
    }
  }
}
*/
?>

<html>
<body>
<?php
require 'includes/url-list.inc';

$file = "/var/www/kiosk/sites";
$file_list = get_url_list($file);
$list_count = count($file_list);
for ($i = 0; $i < $list_count; ++$i) {
  echo $file_list[$i] . "<br>";
}

$urlError = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
  if (!empty($_POST["urlError"])) {
    $urlError = $_POST["urlError"];
    $url = $_POST["url"];
  }
}
?>
<br>
<form method="post"  action="pages/url-list.php">
URL: 
<input type="text" name="url" value="<?php echo $url;?>">
<span class="error"><?php echo $urlError;?></span>
<br><br>
<input type="submit" name="submit" value="Submit"> 
</form>
<?php //echo shell_exec('killall chromium-browser'); ?> 
</body>
</html>
