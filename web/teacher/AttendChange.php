<?php
//申請の許可及び拒否処理
require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
session_start();
require("/var/www/Function/LoginFunction/LoginCheak.php");
teacherCheak();
if(sha1($_SESSION["USERID"])==$_SESSION["PASSWORD"]){
  header("Location:../Login/password.php");
  exit;
}
$Cl=new ClassAttendDB();
$Cl->TacherChange($_GET["Id"],$_GET["Type"],$_GET["i"],$_GET["Date"],$_GET["Time"]);
header("Location:AttendCheck.php");
// echo $_GET["Id"].$_GET["Type"].$_GET["i"].$_GET["Date"];
?>
