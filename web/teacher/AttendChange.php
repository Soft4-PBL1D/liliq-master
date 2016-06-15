<?php
//申請の許可及び拒否処理
require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
$Cl=new ClassAttendDB();
$Cl->TacherChange($_GET["Id"],$_GET["Type"],$_GET["i"],$_GET["Date"]);
header("Location:AttendCheck.php");
?>
