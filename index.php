<?php
//define variables
$url = $urlError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if (empty($_POST["url"])) {
    $url = "";
  } else {
    $url = test_input($_POST["url"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
      $urlError = "Invalid URL"; 
    }
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<html>
<body>

<form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
URL: 
<input type="text" name="url" value="<?php echo $url;?>">
<span class="error"><?php echo $urlError;?></span>
<br><br>
<input type="submit" name="submit" value="Submit"> 
</form>

</body>
</html>
