<!doctype html>
<html lang=en>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
error_reporting(0);
require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
$genre=["出席","遅刻","欠席","就活","病欠","公欠","遅延認証待ち","就活認証待ち","登下校未処理","","出席変更依頼がきました","遅刻変更依頼がきました","欠席変更依頼がきました",
"就活変更依頼がきました","病欠変更依頼がきました","公欠変更依頼がきました"];
$Cl = new ClassAttendDB();
$Cl->AttendChangeCheck();
$cnt=count($Cl->userid);
// echo $cnt;
/*for($i=0;$i<$cnt;$i++){
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
  */
  //遅延、就活でのちコクの許可、出席状況の変更依頼
    for($i=0;$i<$cnt;$i++){
    echo $Cl->userdate[$i]."\n\n\n";
    // echo $Cl->userid[$i]."::";
    echo $Cl->username[$i]."さん";
    echo $Cl->usertime[$i]."限目";
    echo $genre[$Cl->usertype[$i]];
    echo "<a href='AttendChange.php?Id=<?php echo $Cl->userid[$i].'&Type='.$Cl->usertype[$i].'&Date='.$Cl->userdate[$i].'&i=0';?>認可</a>";
    echo "<a href='AttendChange.php?Id=<?php echo $Cl->userid[$i].'&Type='.$Cl->usertype[$i].'&Date='.$Cl->userdate[$i].'&i=1';?>拒否</a>";
  echo "<br>";
}
    ?>
    <?php
?>
