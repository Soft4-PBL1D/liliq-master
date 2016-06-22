<?php
require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
$ClassAttendDB = new ClassAttendDB();
$ClassAttendDB->nowYear();
$now=$ClassAttendDB->nowY-1;
if($_GET["YEAR0"]){
  $date1=$_GET["YEAR0"]."-".$_GET["MONTH0"]."-".$_GET["DAY0"];
  $date2=$_GET["YEAR1"]."-".$_GET["MONTH1"]."-".$_GET["DAY1"];
 $ClassAttendDB->Vacation($date1,$date2);
  }
?>
<html land="en">
<head>
<title>長期休みの設定</title>
</head>
<body>
長期休みの設定
<form method="GET" action="">
<?php
for($j=0;$j<=1;$j++){
echo "<select name=\"YEAR$j\">";
    echo "<option>".$now;
    echo "<option>".$ClassAttendDB->nowY;
echo "</select>年";

echo "<select name=\"MONTH$j\">";

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

echo "<select name=\"DAY$j\">";

for ($i = 0; $i < 31; $i++) {
  if(date("d")==$i+1)
  echo "<option selected>".date("d", 86400 * $i);
    else
    echo "<option>".date("d", 86400 * $i);
}
echo "</select>日";
if($j==0)
echo "から";
else
echo "まで";}
?>
<input type="submit" value="送信">
</form>
