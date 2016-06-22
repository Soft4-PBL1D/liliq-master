<?php
$message="1";
error_reporting(0);
$Year=$_GET["year"];
$Month=$_GET["month"];
$Day=$_GET["day"];
if(isset($_GET["flag"])){
  require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
  if($_GET["start"]>$_GET["end"]){
    // $message="開始時間が下校時間をこえるとか";
  header("Location:SDChange.php?year=$Year&month=$Month&day=$Day");
exit;
}
  $ClassAttendDB= new ClassAttendDB();
  $ClassAttendDB->AttendChange($_GET["flag"],$_GET["date"],$_GET["start"],$_GET["end"]);
  header("Location:teacherCalendar.php?month={$Month}");
  }
?>
<html lang="en">
<head></head>
<body>
  登校日、登校時間の編集<br>
  <?php echo $Year."年".$Month."月".$Day."日"; ?>
  <form method="GET" action="SDChange.php">
<?php echo $message;?>
登校時間：<input type="time" name="start" value="09:20">
下校時間：<input type="time" name="end" value="14:50">
<input type="radio" name="flag" value="0">登校
<input type="radio" name="flag" value="1">休校
<input type="hidden" name="date" value=<?php  echo $Year."-".$Month."-".$Day ?>>
<input type="hidden" name="year" value=<?php echo $Year?>>
<input type="hidden" name="month" value=<?php echo $Month?>>
<input type="hidden" name="day" value=<?php echo $Day?>>
<input type="submit"  name="button" value="送信">

</body>
</html>
