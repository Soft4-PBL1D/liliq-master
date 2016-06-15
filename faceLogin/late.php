<?php
require("/var/www/Function/SchoolAttendFunction/SchoolAttend.php");
require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
session_start();
$ClassAttendDB=new ClassAttendDB();
$ClassAttendDB->NameSelect($_SESSION["USERID"]);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>LILIQ Develop - 遅刻</title>
<link rel="stylesheet" type="text/css" href="screen.css">
</head>

<body>
<a href="wait.php"><img id="liliq" src="../img/logo.png" alt="LILIQ"></a>

  <div id="screen_yellow">
    <div id="screen_box">


      <div id="screen_captcha">

        <div id="text_box">
          <div id="ck">　</div>
          <h1 id="status">遅刻</h1>
<!-- id=出席：0遅刻(自己都合)：1欠席：2就活：3病欠：4公欠：5遅延:6 -->
        </div>

          <br clear="all">
          <p id="name"  class="marginner"><?php echo $_SESSION["USERID"]."\n"?><?php echo $ClassAttendDB->Name;?></p>
          <a id="select_box" href="###############やり直しの際の処理.php################">
            <!-- 自己都合idは遅刻時(1)始まる時間の１５分以上ならばデーターベースに２が登録される -->
            <a href="../ClassAttend/classatend.php?id=1" id="choice_btn3"><div class="tabler">
              <p>自己都合</p>
            </div></a>
            <a href="../ClassAttend/classatend.php?id=6" id="choice_btn3" name="tien" value="7"><div class="tabler">
              <p>遅延</p>
            </div></a>
            <a href="../ClassAttend/classatend.php?id=7" id="choice_btn3" style="  margin-right:0px;" name="shukatu" value="3"><div class="tabler">
              <p>就活</p>
            </div></a>
          </a>

      </div>


    </div>
  </div>


  <div id="status_box">
    <p id="clock_txt">
      <SCRIPT type="text/javascript"><!--
      myWeek=new Array("日","月","火","水","木","金","土");
      function myFunc(){
           myDate=new Date();
           myMsg = "";
           myMsg += ( myDate.getMonth() + 1 ) + "月";
           myMsg += myDate.getDate() + "日";
           myMsg += "(" + myWeek[myDate.getDay()] + ")";
           myMsg += myDate.getHours() + "時";
           myMsg += myDate.getMinutes() + "分";
           myMsg += myDate.getSeconds() + "秒";
           document.getElementById("myIDdate").innerHTML = myMsg;
      }
      // --></SCRIPT>
      <DIV id="myIDdate" class="clock_txt">00月00日(　)00時00分00秒</DIV>
      <SCRIPT type="text/javascript"><!--
        setInterval( "myFunc()", 1000 );
        setInterval( "countdown()", 1000 );
        // --></SCRIPT>
    </p>
  </div>

</body>
</html>


<?php
?>
