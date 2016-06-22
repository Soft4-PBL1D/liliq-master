<?php
error_reporting(0);
session_start();

$_SESSION["USERID"]="teacher";
require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
$ClassAttendDB = new ClassAttendDB();
if($_SESSION["USERID"]=="teacher"){
$ClassAttendDB->classattend($_GET["id"],$_GET["date"]);
}
else
$ClassAttendDB->classattend($_SESSION["USERID"],$_GET["date"]);
if(!isset($ClassAttendDB->myname)){
echo "休校日";
exit;
}
echo $ClassAttendDB->myname."さん<br>";
$genre=["出席","遅刻","欠席","就活","病欠","公欠","遅延認証待ち","就活認証待ち","登下校未処理"];
echo $_GET["date"]."の出席状況<br>";
for($i=1;$i<=5;$i++){
  if($ClassAttendDB->myattend[$i]!=null){
echo "{$i}時限：".$genre[$ClassAttendDB->myattend[$i]]."\n";
echo "<input type='radio' name='type' value=0>出席";
echo "<input type='radio' name='type' value=1>遅刻";
echo "<input type='radio' name='type' value=2>欠席";
echo "<input type='radio' name='type' value=3>終活";
echo "<input type='radio' name='type' value=4>病欠";
echo "<input type='radio' name='type' value=5>高血";
echo "<br>";
}
else
echo "{$i}時限：おやすみ<br>";
}
?>
