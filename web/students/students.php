<?php
require("/var/www/Function/LoginFunction/LoginCheak.php");
studentsCheak();
if(sha1($_SESSION["USERID"])==$_SESSION["PASSWORD"]){
  header("Location:../Login/password.php");
  exit;
}
//echo "WELCOME" . $_SESSION["NAME"]."生徒";
?>
<!DOCTYPE html>


<head>
  <meta charset="utf-8">
  <title>ログイン</title>
  <link rel="stylesheet" type="text/css" href="as.css">
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
      <div>
      <iframe width="1180" height="720" src="calendar.php" scrolling="auto" frameborder="0"></iframe></div>
    </div>

  </div>


  <div class="wn">

    <div class="note">
      &copy; Dfun.
  </div>


  </body>
</html>
