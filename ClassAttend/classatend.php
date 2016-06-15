<!-- tikoku -->
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
</head>
<body>
  <?php
  require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
  error_reporting(0);
  session_start();
      $ClassAttendDB=new ClassAttendDB();
      $ClassAttendDB->Attendance_Check($_SESSION["USERID"]);
      $ClassAttendDB->Attendance_School($_SESSION["USERID"]);
      $ClassAttendDB->AttendUpdate($_GET["id"],$_SESSION["USERID"],1);
      session_destroy();
      header("Location:/faceLogin/wait.php");
        ?>
</body>
</html>
