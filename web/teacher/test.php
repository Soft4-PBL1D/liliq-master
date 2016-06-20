<?php
require("/var/www/Function/SchoolAttendFunction/SchoolAttend.php");
require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
$ClassAttendDB = new ClassAttendDB();
$ClassAttendDB->nowYear();
$ClassAttendDB->startTime("2016-06-13");
echo $ClassAttendDB->starttime;
$now=$ClassAttendDB->nowY-1;
?>
<html>
<body>
  <form method="POST" action="">
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
$_SESSION["DATE"]=$days;
}
else {
$_SESSION["DATE"]=date("Y-m-d");

}
if(!isset($i)){
  $i=0;
}
// if(!isset($cnt)){
  // $cnt=1;
// }
?>
<!-- <form method="get" action=""> -->
<!-- </form> -->
<?php
// echo $day;
// if(isset($_POST["days"])){
// $day1=strtotime(date("Y-m-d"));
// $day2=strtotime($_POST["day"]);
// echo ($day2 - $day1) / (60 * 60 * 24). '日';
// $day=($day2 - $day1) / (60 * 60 * 24);
// $_POST["day"]=$day;
// }
// if(isset($_GET["submitDay"])){
// echo date($_GET["submitDay"])."<br>";
// $ClassAttendDB->StundentsAttend(date($_GET["submitDay"],strtotime("-$day days")));}
// else{
  // echo date("Y-m-d",strtotime("+$day days"))."<br>";
// $ClassAttendDB->StundentsAttend(date("Y-m-d",strtotime("+$day days")));
$ClassAttendDB->StundentsAttend($day);

// }
$cnt=count($ClassAttendDB->attend);
for($i=0;$i<$cnt;$i++){
echo $ClassAttendDB->attend[$i][userid];
echo $ClassAttendDB->attend[$i][name];
if($ClassAttendDB->attend[$i][type]==0){
echo "<a href=detail.php?id={$ClassAttendDB->attend[$i][userid]}>○</a>";
// echo date("Y/m/d H:i:s",$ClassAttendDB->attend[$i][time]);
}
else
echo "<a href=detail.php?id={$ClassAttendDB->attend[$i][userid]}>✗</a>";

echo "<br>";}
?>
