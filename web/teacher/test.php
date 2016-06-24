<?php
require("/var/www/Function/SchoolAttendFunction/SchoolAttend.php");
require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
$ClassAttendDB = new ClassAttendDB();
$ClassAttendDB->nowYear();
$now=$ClassAttendDB->nowY-1;
?>
<html>
<body>
  <form method="POST" action="test.php">
  <?php
  echo "<select name=\"YEAR\">";

  // for ($i = 0; $i < 2; $i++) {
      echo "<option>".$now;
      echo "<option>".$ClassAttendDB->nowY;

  // }
  echo "</select>年";

  echo "<select name=\"MONTH\">";

  for ($i = 3; $i < 15; $i++) {
    if(date("m")==$i+1){
    if($i<=12)
    echo "<option selected>".date("m", 2678400 * $i);
    else
    echo "<option selected>".date("m", 2678400 * ($i-12));
}
else{
  if($i<=12)
  echo "<option>".date("m", 2678400 * $i);
  else
  echo "<option>".date("m", 2678400 * ($i-12));
}
}

  echo "</select>月";

  echo "<select name=\"DAY\">";

  for ($i = 0; $i < 31; $i++) {
    if(date("d")==$i+1)
    echo "<option selected>".date("d", 86400 * $i);
      else
      echo "<option>".date("d", 86400 * $i);
  }
  echo "</select>日";

  ?>
<input type="submit" value="送信">
</form>
<a href="test.php?day=1">前日</a>
<?php
// $ClassAttendDB=new ClassAttendDB();
if(isset($_POST["YEAR"])){
$day=$_POST["YEAR"]."-";
$day.=$_POST["MONTH"]."-";
$day.=$_POST["DAY"];
echo $day."<br>";
$year=$_POST["YEAR"];
$month=$_POST["MONTH"];
$days=$_POST["DAY"];
$_SESSION["DATE"]=$day;
}
else {
$_SESSION["DATE"]=date("Y-m-d");
}
if(!isset($i)){
  $i=0;
}
?>
<?php
$ClassAttendDB->StundentsAttend($_SESSION["DATE"]);
$cnt=count($ClassAttendDB->attend);
for($i=0;$i<$cnt;$i++){
echo $ClassAttendDB->attend[$i][userid];
echo $ClassAttendDB->attend[$i][name];
if($ClassAttendDB->attend[$i][type]==0){
echo "<a href=detail.php?id={$ClassAttendDB->attend[$i][userid]}&date={$_SESSION["DATE"]}>○</a>";
}
else
echo "<a href=detail.php?id={$ClassAttendDB->attend[$i][userid]}&date={$_SESSION["DATE"]}>✗</a>";
echo "<br>";
}
?>
