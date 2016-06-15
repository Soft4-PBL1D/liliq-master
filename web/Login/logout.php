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
    <li>Back to LoginPage</li>
  </ul>
  <?php
  header("Refresh:2;URL=login.php");?>
  </body>
</html>
