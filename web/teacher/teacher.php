<?php
require("/var/www/Function/LoginFunction/LoginCheak.php");
teacherCheak();
if(sha1($_SESSION["USERID"])==$_SESSION["PASSWORD"]){
  header("Location:../Login/password.php");
  exit;
}
?>
<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
    <title>TOPPAGE</title>
    <style>
      *{margin:0;padding:0;}
    </style>
  </head>
  <body>

<iframe width="100%" height="1100px" src="list.php" scrolling="auto" frameborder="0" style="min-height:100%;" ></iframe>

  </body>
</html>
