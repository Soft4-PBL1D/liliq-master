<?php
error_reporting(0);
$Year=$_GET["year"];
$Month=$_GET["month"];
$Day=$_GET["day"];

if(isset($_POST["flag"])){
  require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
  $ClassAttendDB= new ClassAttendDB();
  $ClassAttendDB->AttendChange($_POST["flag"],$_POST["date"],$_POST["start"],$_POST["end"]);
  header("Location:teacherCalendar.php");
  }
?>
<html lang="en">
<head></head>
<body>
  登校日、登校時間の編集<br>
  <?php echo $Year."年".$Month."月".$Day."日"; ?>
  <form method="POST" action="SDChange.php">
登校時間：<input type="time" name="start" value="09:20">
下校時間：<input type="time" name="end" value="14:50">
<input type="radio" name="flag" value="0">登校
<input type="radio" name="flag" value="1">休校
<input type="hidden" name="date" value=<?php  echo $Year."-".$Month."-".$Day ?>>
<input type="submit"  name="button" value="送信">

</body>
</html>
