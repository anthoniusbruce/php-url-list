<?php 
require 'includes/input-format.inc';

//define variables
$url = $urlError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if (empty($_POST["url"])) {
    $url = "";
  } else {
    $url = test_input($_POST["url"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!is_valid_url($url)) {
      $urlError = "Invalid URL"; 
    }
  }
}
?>

<html>
<body>

<form method="post"  action="<?php echo $_SERVER["PHP_SELF"];?>">
URL: 
<input type="text" name="url" value="<?php echo $url;?>">
<span class="error"><?php echo $urlError;?></span>
<br><br>
<input type="submit" name="submit" value="Submit"> 
</form>

</body>
</html>
