<!doctype html>
<?php error_reporting(0);
if(!isset($_SESSION)){
session_start();
}

require("/var/www/Function/LoginFunction/LoginCheak.php");
teacherCheak();
if(sha1($_SESSION["USERID"])==$_SESSION["PASSWORD"]){
  header("Location:../Login/password.php");
  exit;
}?>
<html lang=en>
<head>
  <meta charset="UTF-8">
  <title>LILIQ</title>
  <link rel="stylesheet" type="text/css" href="../students/as.css">
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
      <h2>教員用ページ</h2>
      <p>teacher</p>
    </div>
  </div>

  <div class="page">
  <div class="coram">


    <div class="wn">

      <div class="note">

        <a href="teacher.php" style="display:block;margin-bottom:20px;background:#ddd;width:90px;padding:5px;text-align:center;border:1px solid #666;text-decoration:none;border-radius:1px;">« 戻る</a>

<?php
// error_reporting(0);
require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
$genre=["出席","遅刻","欠席","就活","病欠","公欠","遅延認証待ち","就活認証待ち","登下校未処理","","出席変更依頼がきました","遅刻変更依頼がきました","欠席変更依頼がきました",
"就活変更依頼がきました","病欠変更依頼がきました","公欠変更依頼がきました"];
$Cl = new ClassAttendDB();
$Cl->AttendChangeCheck();
$cnt=count($Cl->userid);
  //遅延、就活でのちコクの許可、出席状況の変更依頼
    for($i=0;$i<$cnt;$i++){
    echo $Cl->userdate[$i]."\n\n\n";
    // echo $Cl->userid[$i]."::";
    echo $Cl->username[$i]."さん";
    echo $Cl->usertime[$i]."限目";
    echo $genre[$Cl->usertype[$i]];?>
    <!-- //認可ボタン　０認証　１拒否 -->
    <a id="btn_n" href="AttendChange.php?Id=<?php echo $Cl->userid[$i].'&Type='.$Cl->usertype[$i].'&Date='.$Cl->userdate[$i].'&Time='.$Cl->usertime[$i].'&i=0';?>">認可</a>
    <a id="btn_t" href="AttendChange.php?Id=<?php echo $Cl->userid[$i].'&Type='.$Cl->usertype[$i].'&Date='.$Cl->userdate[$i].'&Time='.$Cl->usertime[$i].'&i=1';?>">拒否</a>
  <?php
  echo "<br>";
}
    ?>
    <?php
?>

</div>
</div>


<div class="wn">

  <div class="note">
    &copy; Dfun.
  </div>

</div>


</body>
</html>
