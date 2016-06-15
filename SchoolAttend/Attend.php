<?php
//Login Time(Date)
session_start();
$message=null;
require("../Function/SchoolAttendFunction/SchoolAttend.php");
require("../Function/SchoolAttendFunction/SchoolAttenddb.php");
//Login();
list($Type)=Attendance_Cheack($_SESSION["USERID"]);
if(isset($_POST["attendance"])){
$message=Attendance_School($_SESSION["USERID"]);}
if(isset($_POST["leave"])){
$message=Leave_School($_SESSION["USERID"]);}
?>
<html>
<haed>
  <meta charset="utf8">
  <title></title>
</haed>
<body>
  <form method="POST" action="">
  <?php
    if($message!=null){
      echo $message;
        Logout();
      }
  ?>
  <?php
  if($Type==1||$Type==null){
        if(!$message){
          echo "<input type='submit' value='登校しますか' name='attendance'>";
          echo $Time;
          }
      exit;
    }
?>
  <?php
    if($Type==0&&!$message)
      echo "<input type='submit' value='下校しますか' name='leave'>";
?>

</body>
</html>
