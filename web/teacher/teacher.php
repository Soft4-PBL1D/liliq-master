<?php
require("/var/www/Function/LoginFunction/LoginCheak.php");
teacherCheak();
if(sha1($_SESSION["USERID"])==$_SESSION["PASSWORD"]){
  header("Location:../Login/password.php");
  exit;
}
echo "WELCOME" . $_SESSION["NAME"]."生徒";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>TOPPAGE</title>
  </head>
  <body>
    <ul>
      <li><a href="../Login/logout.php">Logout</a></li>
    </ul>
    <div>
    <iframe width="1280" height="720" src="teacherCalendar.php" scrolling="auto" frameborder="0"></iframe></div>
  </body>
</html>
