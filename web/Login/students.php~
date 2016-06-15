<?php
require("../Function/LoginFunction/LoginCheak.php");
studentsCheak();
if(sha1($_SESSION["USERID"])==$_SESSION["PASSWORD"]){
  header("Location:password.php");
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
      <li><a href="logout.php">Logout</a></li>
    </ul>
    <div>
    <iframe width="1280" height="720" src="../calender/calendar.php" scrolling="auto"></iframe></div>
  </body>
</html>
