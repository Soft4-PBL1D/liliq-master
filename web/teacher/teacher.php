<?php
error_reporting(0);
if(!isset($_SESSION)){
session_start();
}

require("/var/www/Function/SchoolAttendFunction/SchoolAttend.php");
require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");

require("/var/www/Function/LoginFunction/LoginCheak.php");
teacherCheak();
if(sha1($_SESSION["USERID"])==$_SESSION["PASSWORD"]){
  header("Location:../Login/password.php");
  exit;
}
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
$ClassAttendDB->popup();
?>

<!DOCTYPE html>

<head>
  <script type="text/javascript">
  $(window).load(function () {
      // 「id="jQueryBox"」を非表示
      $("#showw").css("display", "none");

      // 「id="jQueryPush"」がクリックされた場合
      $("#btnopen").click(function(){
          // 「id="jQueryBox"」の表示、非表示を切り替える
          $("#showw").toggle();
      });
  });
  </script>
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
	<?php if($ClassAttendDB->countA!=0) {?>
		<script type="text/javascript">
			Flg = 1;
			$(function(){
				if(Flg == 1){
					new PNotify({
					title: '通知',
					text: '通知<?php echo $ClassAttendDB->countA;?>件'
				});
        	}
		});
		</script>
		<?php } ?>
		<style>
		.belll{
		  width:30px;
		  height:30px;
		  background-image:url("bell.png");
		  background-size:contain;
			position:center;
		  float:right;
			margin-top:-55px;
			margin-right:20px;
			padding:7px;
			display:block;
      text-decoration:none;
		}
		.belll:hover{
		  opacity:0.5;
		}
		</style>
</head>
<!-- head終わり -->

<body>

<div id="header">
	<div class="iti">
	<div class="logo"></div>
	<div class="btnrighter" style="width:700px;position:relative;">


  <a href="../Login/logout.php" class="btn_hvr-fade"><span>ログアウト</span></a>
    <a href="LongHoliday.php" class="btns_hvr-fade"><span>長期休暇登録</span></a>
    <a href="csv.php" class="btns_hvr-fade"><span>新年度登録</span></a>
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
		<a href="AttendCheck.php" class="belll">　</a>
  </div><!-- seetco -->
</div><!-- seet -->

<div class="page">
<div class="coram">

	<div class="wn">
	<div class="note">
		<div class="title">
			<h1 style="font-size:30px;">学生リスト</h1>
		</div><!-- title -->

	<div class="wn">
	<div class="list">


  <form method="POST" action="teacher.php">
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
echo $_SESSION["DATE"];
}
if(!isset($i)){
  $i=0;
}
?>


<?php
$ClassAttendDB->StundentsAttend($_SESSION["DATE"]);
$ClassAttendDB->StundentsAttendEnd($_SESSION["DATE"]);
$cnt=count($ClassAttendDB->attend);
$cnt2=count($ClassAttendDB->attendend);
echo "<table>";
echo "<tr><th>出席番号</th><th>氏名</th><th>登校</th><th></th><th>下校</th><tr>";
for($i=0;$i<$cnt;$i++){
echo "<tr><td>".$ClassAttendDB->attend[$i][userid]."</td>";
echo "<td>".$ClassAttendDB->attend[$i][name]."</td>";

if($ClassAttendDB->attend[$i][type]==0)
echo "<td><a href=studentsCalendar.php?id={$ClassAttendDB->attend[$i][userid]}><span class='icon icon3'></span></a></td>";
else
echo "<td><a href=studentsCalendar.php?id={$ClassAttendDB->attend[$i][userid]}><span class='icon icon4'></span></a></td>";
echo "<td>&nbsp;&nbsp;&nbsp;</td>";
if($ClassAttendDB->attendend[$i][type]==1)
echo "<td><a href=studentsCalendar.php?id={$ClassAttendDB->attend[$i][userid]}><span class='icon icon3'></span></a></td>";
else
echo "<td><a href=studentsCalendar.php?id={$ClassAttendDB->attend[$i][userid]}><span class='icon icon4'></span></a></td>";
echo "</tr>";
}
echo "</table>";
?>

	</div><!-- list -->
	</div><!-- wn2 -->
	</div><!-- note -->
	</div><!-- wn -->

	<div class="wn">
	<div class="note">
		<iframe width="1100px" height="720px" src="teacherCalendar.php" scrolling="auto" frameborder="0" style="min-height:100%;" ></iframe>
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
