<?php
error_reporting(0);
require("/var/www/Function/SchoolAttendFunction/SchoolAttend.php");
require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
session_start();
$ClassAttendDB = new ClassAttendDB();
$ClassAttendDB->StundentsAttendEnd($_GET["Date"]);
$cnt2=count($ClassAttendDB->attendend);
for($i=0;$i<$cnt2;$i++){
echo $ClassAttendDB->attendend[$i][type];
}
?>
