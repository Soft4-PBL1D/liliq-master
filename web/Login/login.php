<?php
require("/var/www/Function/LoginFunction/Logindb.php");
$errorMessage=Login();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ログイン　|　LILIQ</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>

  <!-- <fieldset> -->
  <!-- <legend>Loginform</legend> -->

<div class="cover">
  <div id="box">

<img src="../../img/logo.png" style="display:block;width:170px;height:48px;margin:70px 0 70px 110px;" alt="LILIQ">

<form id="loginForm" name="loginForm" action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST">
<input type="text" id="userid" name="userid" style="margin-left:48px;" placeholder=" ユーザーID" value="<?php echo $viewUserId ?>">
  <br><br>
<input type="password" id="password" name="password" style="margin-left:48px;" placeholder=" パスワード" value="">
  <br>
<div class="btncover">
  <input type="submit" id="login" name="login" value="ログイン" class="hvr-fade">
</div>
  <!-- </fieldset> -->
  </form>

    <div style="color:#f00;width:300px;margin:0 auto;margin-top:30px;text-align:center;"><?php echo $errorMessage ?></div>
</div>


</div>
  </body>
</html>
