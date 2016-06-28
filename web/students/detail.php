<html lang="en">
<head>
<title></title>
</head>
<body>
  <a href="calendar.php" style="display:block;margin-bottom:20px;background:#ddd;width:90px;padding:5px;text-align:center;border:1px solid #666;text-decoration:none;border-radius:1px;">&laquo; 戻る</a>
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
    for($i=1;$i<=5;$i++){
    if($_GET["type$i"]!=null){
    $ClassAttendDB->AttendChangeApplication($_GET["type$i"],$i,$_GET["date1"],$_SESSION["USERID"]);}
  }
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
$genre=["出席","遅刻","欠席","就活","病欠","公欠","遅延認証待ち","就活認証待ち","登下校未処理","","出席申請中","遅刻申請中","欠席 申請中","就活申請中","病欠申請中","公欠申請中"];
?>
<form method="get" action=""><h3 style="font-size:20px;">
<?php
echo $_GET["date"]."の出席状況<br>";
for($i=1;$i<=5;$i++){
if($ClassAttendDB->myattend[$i]!=null){
if(isset($ClassAttendDB->myattend2[$i]))
echo "{$i}時限：".$genre[$ClassAttendDB->myattend2[$i]]."\n";
else
echo "{$i}時限：".$genre[$ClassAttendDB->myattend[$i]]."\n";
echo "<input type='radio' name='type$i' value=10";
if($ClassAttendDB->myattend[$i]==0)
echo " checked>出席";
else
echo ">出席";
echo "<input type='radio' name='type$i' value=11";
if($ClassAttendDB->myattend[$i]==1)
echo " checked>遅刻";
else
echo ">遅刻";
echo "<input type='radio' name='type$i' value=12";
if($ClassAttendDB->myattend[$i]==2)
echo " checked>欠席";
else
echo ">欠席";
echo "<input type='radio' name='type$i' value=13";
if($ClassAttendDB->myattend[$i]==3)
echo " checked>就活";
else
echo ">就活";
echo "<input type='radio' name='type$i' value=14";
if($ClassAttendDB->myattend[$i]==4)
echo " checked>病欠";
else
echo ">病欠";
echo "<input type='radio' name='type$i' value=15";
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
