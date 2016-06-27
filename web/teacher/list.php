<?php
error_reporting(0);
require("/var/www/Function/SchoolAttendFunction/SchoolAttend.php");
require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
session_start();
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');
$ClassAttendDB = new ClassAttendDB();
$ClassAttendDB->nowYear();
session_start();
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');
$now=$ClassAttendDB->nowY-1;
?>

<!DOCTYPE html>

<head>

<meta charset="utf-8">
<title>教員トップページ</title>
	<!-- 各種読み込み -->
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/kawanishi.css">
		<link rel="stylesheet" type="text/css" href="css/icon.css">
	<!-- 通知関係 -->
		<script src="js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="js/pnotify.custom.min.js"></script>
		<link href="css/pnotify.custom.min.css" media="all" rel="stylesheet" type="text/css" />
	<!-- 通知の動いてる部分 -->
		<script type="text/javascript">
			Flg = 1;
			$(function(){
				if(Flg == 1){
					new PNotify({
					title: '通知',
					text: '通知××件'
				});
        	}
		});
		</script>
</head>
<!-- head終わり -->

<body>

<div id="header">
	<div class="iti">
	<div class="logo"></div>
	<div class="btnrighter">
		<a href="../Login/logout.php" class="btn_hvr-fade"><span>ログアウト</span></a>
		<a href="../Login/password.php" class="btns_hvr-fade"><span>パスワード変更</span></a>
	</div><!-- btnrighter -->
	</div><!-- logo -->
	</div><!-- iti -->
</div><!-- header -->
<!-- body内のheader終了 -->


<div class="seet">
  <div class="seetco">
    <h2>教員用ページ</h2>
    <p>teacherリストページ</p>
  </div><!-- seetco -->
</div><!-- seet -->

<div class="page">
<div class="coram">

	<div class="wn">
	<div class="note">
		<div class="title">
			<p><strong>学生リスト</strong></p>
		</div><!-- title -->

	<div class="wn2">
	<div class="list">


  <form method="POST" action="list.php">
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
echo "<a href=detail.php?id={$ClassAttendDB->attend[$i][userid]}&date={$_SESSION["DATE"]}><span class='icon icon3'></span></a>";
}
else
echo "<a href=detail.php?id={$ClassAttendDB->attend[$i][userid]}&date={$_SESSION["DATE"]}><span class='icon icon4'></span></a>";
echo "<br>";
}
?>

	</div><!-- list -->
	</div><!-- wn2 -->
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
