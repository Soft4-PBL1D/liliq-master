<?php
error_reporting(0);
require("/var/www/html/Dfun/Function/ClassAttendFunction/ClassAttendDB.php");
require("/var/www/html/Dfun/Function/SchoolAttendFunction/SchoolAttend.php");
    //出席処理のクラス作成
    $ClassAttendDB=new ClassAttendDB();
if($_POST["submit"])
    $ClassAttendDB->sampleData($_POST["toukouTime"],$_POST["gekouTime"],$_POST["userId"]);
?>
<html lang="en">
<head>
  <meta charset="utf-8"></head>
<body>
<form method="POST" action="">
  設定する登校時間を入力してください(9時20分を超えると遅刻あつかいになります)
  <input type="text" name="toukouTime" value=""><br>
  設定する下校時間を入力してください
  <input type="text" name="gekouTime" value=""><br>
  設定するuserIdを入力してください
  <input type="text" name="userId" value=""><br>
  <input type="submit" name="submit" value="登校します">
  <?php echo $ClassAttendDB->toukouTime;
  $ClassAttendDB->Attend_select("0K01001","2016-06-02");
  echo $ClassAttendDB->type; 
  ?>
</form>
