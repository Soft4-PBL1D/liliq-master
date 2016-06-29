<?php
error_reporting(0);
require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
if(!isset($_SESSION)){
session_start();
}

require("/var/www/Function/LoginFunction/LoginCheak.php");
teacherCheak();
if(sha1($_SESSION["USERID"])==$_SESSION["PASSWORD"]){
  header("Location:../Login/password.php");
  exit;
}
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
  <meta charset="utf-8">
  <title>ログイン</title>
  <link rel="stylesheet" type="text/css" href="../students/as.css">
</head>
<body>

<div id="header">
  <div class="iti">
    <div class="logo"></div>
    <div class="btnrighter">
      <a href="../Login/logout.php" class="btn_hvr-fade"><span>ログアウト</span></a>
    <a href="LongHoliday.php" class="btns_hvr-fade"><span>長期休暇登録</span></a>
    <a href="csv.php" class="btns_hvr-fade"><span>新年度登録</span></a>
		<a href="../Login/password.php" class="btns_hvr-fade"><span>パスワード変更</span></a>
    </div>
  </div>
</div>

<div class="seet">
  <div class="seetco">
    <h2><?php echo $_SESSION["NAME"]; ?></h2>
    <p><?php echo $_SESSION["USERID"]; ?></p>
  </div>
</div>

<div class="page">
<div class="coram">


  <div class="wn">

    <div class="note">

<a href="teacher.php" style="display:block;margin-bottom:20px;background:#ddd;width:90px;padding:5px;text-align:center;border:1px solid #666;text-decoration:none;border-radius:1px;">&laquo; 戻る</a>


<h1>長期休みの設定</h1>
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


</div><!-- note -->
</div><!-- wn -->


<div class="wn">
<div class="note">
  &copy; 2016 Dfun.
</div><!-- note -->
</div><!-- wn -->


</div><!-- coram -->
</div><!-- page -->

</body>
</html>
