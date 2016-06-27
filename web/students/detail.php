<html lang="en">
<head>
<title></title>
</head>
<body>
<?php
error_reporting(0);
session_start();

require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
$ClassAttendDB = new ClassAttendDB();
$ClassAttendDB->classattend($_SESSION["USERID"],$_GET["date"]);
if(!isset($ClassAttendDB->myname)){
  if($_GET["submit"]){
    echo $_SESSION["USERID"];
    echo $_GET["date1"];
    $ClassAttendDB->AttendChangeApplication($_GET["type1"],1,$_GET["date1"],$_SESSION["UERID"]);
    echo "申請しました";
    echo "<a href=calendar.php>modoru</a>";
  }
  else{
    echo "休校日";
	echo $_SESSION["USERID"];
	echo $_GET["date"];
}
exit;
}
?>
<form method="get" action="">
<?php echo $ClassAttendDB->myname."さん<br>";
$genre=["出席","遅刻","欠席","就活","病欠","公欠","遅延認証待ち","就活認証待ち","登下校未処理"];
echo $_GET["date"]."の出席状況<br>";
for($i=1;$i<=5;$i++){
  if($ClassAttendDB->myattend[$i]!=null){
echo "{$i}時限：".$genre[$ClassAttendDB->myattend[$i]]."\n";

echo "<input type='radio' name='type$i' value=0";
if($ClassAttendDB->myattend[$i]==0)
echo " checked>出席";
else
echo ">出席";
echo "<input type='radio' name='type$i' value=1";
if($ClassAttendDB->myattend[$i]==1)
echo " checked>遅刻";
else
echo ">遅刻";
echo "<input type='radio' name='type$i' value=2";
if($ClassAttendDB->myattend[$i]==2)
echo " checked>欠席";
else
echo ">欠席";
echo "<input type='radio' name='type$i' value=3";
if($ClassAttendDB->myattend[$i]==3)
echo " checked>就活";
else
echo ">就活";
echo "<input type='radio' name='type$i' value=4";
if($ClassAttendDB->myattend[$i]==4)
echo " checked>病欠";
else
echo ">病欠";
echo "<input type='radio' name='type$i' value=5";
if($ClassAttendDB->myattend[$i]==5)
echo " checked>公欠";
else
echo ">公欠";
echo "<br>";
echo "<input type=hidden name='date1' value={$_GET["date"]}>";
}
else
echo "{$i}時限：おやすみ<br>";
}
echo "<input type='submit' name='submit' value='変更依頼'>";
echo "</form>";
?>
</body>
  </html>
