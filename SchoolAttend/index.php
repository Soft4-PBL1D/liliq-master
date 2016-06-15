<?php
require("../Function/SchoolAttendFunction/SchoolAttenddb.php");
$errorMessage=Login();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>login</title>
  </head>
  <body>
  <form id="loginForm" name="loginForm" action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST">
  <!-- <fieldset> -->
  <!-- <legend>Loginform</legend> -->
  <div><?php echo $errorMessage ?></div>
  <label for="userid">userID:</label><input type="text" id="userid" name="userid" value="<?php echo $viewUserId ?>">
  <br>
  <label for="password">password:</label><input type="password" id="password" name="password" value="">
  <br>
  <label></label><input type="submit" id="login" name="login" value="Login">
  <!-- </fieldset> -->
  </form>
  </body>
</html>
