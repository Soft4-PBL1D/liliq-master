<?php
require("/var/www/html/liliq/Function/SchoolAttendFunction/SchoolAttend.php");
require("/var/www/html/liliq/Function/ClassAttendFunction/ClassAttendDB.php");
session_start();
$ClassAttendDB=new ClassAttendDB();
$ClassAttendDB->NameSelect($_SESSION["USERID"]);
//登校時間と下校時間より１日の出席をデーターベースに登録する
echo $ClassAttendDB->Name;
echo "aho";
?>
