<html>
<body>
<?php
require 'includes/url-list.inc';

$file = $_SERVER["DOCUMENT_ROOT"] . "/kiosk/sites";
$file_list = get_url_list($file);
$list_count = count($file_list);

$url = $urlError = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
  if (!empty($_POST["urlError"])) {
    $urlError = $_POST["urlError"];
    $url = $_POST["url"];
  }
}
?>

<?php if ($list_count > 0): ?>
<table>
  <tbody>
<?php foreach ($file_list as $item): ?>
    <tr>
      <td><a href="pages/delete-from-url-list.php?hash=<?php echo hash("sha256",trim($item)); ?>">remove</a>
      <td><?php echo $item; ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>
<br>
<form method="post"  action="pages/url-list.php">
Add URL: 
<input type="text" name="url" value="<?php echo $url;?>">
<span class="error"><?php echo $urlError;?></span>
<br><br>
<input type="submit" name="submit" value="Submit"> 
</form>
<?php //echo shell_exec('killall chromium-browser'); ?> 
</body>
</html>
