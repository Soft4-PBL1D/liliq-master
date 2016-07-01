
<html lang="en">
<head>
<title></title>
<head>
  <meta charset="utf-8">
  <title>ログイン</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="cstyle.css">
</head>
<body>

<div id="header">
  <div class="iti">
    <div class="logo"></div>
    <div class="btnrighter">
      <a href="../Login/logout.php" class="btn_hvr-fade"><span>ログアウト</span></a>
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

  <a href="studentsCalendar.php" style="display:block;margin-bottom:20px;background:#ddd;width:90px;padding:5px;text-align:center;border:1px solid #666;text-decoration:none;border-radius:1px;">&laquo; 戻る</a>

<?php
error_reporting(0);
if(!isset($_SESSION)){
session_start();
}

require("/var/www/Function/LoginFunction/LoginCheak.php");
teacherCheak();
if(sha1($_SESSION["USERID"])==$_SESSION["PASSWORD"]){
  header("Location:../Login/password.php");
  exit;
}
$_SESSION["USERID"]="teacher";
require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
$ClassAttendDB = new ClassAttendDB();
if($_SESSION["USERID"]=="teacher"){
$ClassAttendDB->classattend($_GET["id"],$_GET["date"]);
}
else
$ClassAttendDB->classattend($_SESSION["USERID"],$_GET["date"]);
if(!isset($ClassAttendDB->myname)){
  if($_GET["submit"]){
    if(isset($_GET["type1"]))$ClassAttendDB->classchange($_GET["myname"],$_GET["date"],$_GET["type1"],1);
    if(isset($_GET["type2"]))$ClassAttendDB->classchange($_GET["myname"],$_GET["date"],$_GET["type2"],2);
    if(isset($_GET["type3"]))$ClassAttendDB->classchange($_GET["myname"],$_GET["date"],$_GET["type3"],3);
    if(isset($_GET["type4"]))$ClassAttendDB->classchange($_GET["myname"],$_GET["date"],$_GET["type4"],4);
    if(isset($_GET["type5"]))$ClassAttendDB->classchange($_GET["myname"],$_GET["date"],$_GET["type5"],5);

    echo "変更しました";
  }
  else
    echo "休校日";
exit;
}
?>
<form method="get" action="">
<?php echo $ClassAttendDB->myname."さん<br>";
$genre=["出席","遅刻","欠席","就活","病欠","公欠","遅延認証待ち","就活認証待ち","登下校未処理"];
echo $_GET["date"]."の出席状況<br>";
for($i=1;$i<=5;$i++){
  if($ClassAttendDB->myattend[$i]!=null){
echo "{$i}時限：".$genre[$ClassAttendDB->myattend[$i]]."\n";

echo "<input type='radio' name='type$i' value=0";
if($ClassAttendDB->myattend[$i]==0)
echo " checked>出席";
else
echo ">出席";
echo "<input type='radio' name='type$i' value=1";
if($ClassAttendDB->myattend[$i]==1)
echo " checked>遅刻";
else
echo ">遅刻";
echo "<input type='radio' name='type$i' value=2";
if($ClassAttendDB->myattend[$i]==2)
echo " checked>欠席";
else
echo ">欠席";
echo "<input type='radio' name='type$i' value=3";
if($ClassAttendDB->myattend[$i]==3)
echo " checked>就活";
else
echo ">就活";
echo "<input type='radio' name='type$i' value=4";
if($ClassAttendDB->myattend[$i]==4)
echo " checked>病欠";
else
echo ">病欠";
echo "<input type='radio' name='type$i' value=5";
if($ClassAttendDB->myattend[$i]==5)
echo " checked>公欠";
else
echo ">公欠";
echo "<br>";
}
else
echo "{$i}時限：おやすみff<br>";
}
echo "<input type='hidden' name='myname' value={$ClassAttendDB->myid}>";
echo "<input type='hidden' name='date' value={$_GET["date"]}>";
echo "<input type='submit' name='submit' value='変更'>";
echo "</form>";
?>
</body>
  </html>
