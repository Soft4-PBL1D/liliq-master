<!doctype html>
<html lang=en>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
error_reporting(0);
require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
$Cl = new ClassAttendDB();
$Cl->TeacherCheck();
$cnt=count($Cl->userid);
for($i=0;$i<$cnt;$i++){
  if(date("14:50:00")<date("H:i:s")){
  echo $Cl->userdate[$i]."\n\n\n";
  echo $Cl->userid[$i]."::";
  echo $Cl->username[$i]."さん";
  if($Cl->usertype[$i]==8){?>
    <!-- ($UserId,$NowType,$ChangeType,$Date) -->
    登校していないまたは下校処理ができていません
    <a href="AttendChange.php?Id=<?php echo $Cl->userid[$i]."&Type=".$Cl->usertype[$i]."&Date=".$Cl->userdate[$i]."&i=0";?>">出席</a>
    <a href="AttendChange.php?Id=<?php echo $Cl->userid[$i]."&Type=".$Cl->usertype[$i]."&Date=".$Cl->userdate[$i]."&i=2";?>">欠席</a>
    <br>
<?php }
  }
  else if($Cl->usertype[$i]==7){
    echo $Cl->userdate[$i]."\n\n\n";
    echo $Cl->userid[$i]."::";
    echo $Cl->username[$i]."さん";?>
    就活登録申請があります
    <a href="AttendChange.php?Id=<?php echo $Cl->userid[$i]."&Type=".$Cl->usertype[$i]."&Date=".$Cl->userdate[$i]."&i=3";?>">認可</a>
    <a href="AttendChange.php?Id=<?php echo $Cl->userid[$i]."&Type=".$Cl->usertype[$i]."&Date=".$Cl->userdate[$i]."&i=2";?>">拒否</a>
    <br>
    <?php
  }else if($Cl->usertype[$i]==6){
    echo $Cl->userdate[$i]."\n\n\n";
    echo $Cl->userid[$i]."::";
    echo $Cl->username[$i]."さん";?>
    遅延登録申請があります
    <a href="AttendChange.php?Id=<?php echo $Cl->userid[$i]."&Type=".$Cl->usertype[$i]."&Date=".$Cl->userdate[$i]."&i=1";?>">認可</a>
    <a href="AttendChange.php?Id=<?php echo $Cl->userid[$i]."&Type=".$Cl->usertype[$i]."&Date=".$Cl->userdate[$i]."&i=2";?>">拒否</a>
    <br>
<?php  }
  }
?>
