<?php
require("/var/www/Function/LoginFunction/Logindb.php");
Logout();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Logout</title>
  </head>
  <body>
  <div><?php echo $errorMessage; ?></div>
  <ul>
    <li>ログアウトしています</li>
  </ul>
  <?php
  header("location:login.php");?>
  </body>
</html>
