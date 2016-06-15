<?php
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>LILIQ Develop - 欠席</title>
<link rel="stylesheet" type="text/css" href="screen.css">
</head>

<body>
<img id="liliq" src="img/logo.png" alt="LILIQ">

  <div id="screen_green">
    <div id="screen_box">


      <div id="screen_captcha">

        <div id="text_box">
          <div id="ck">　</div>
          <h1 id="status">下校</h1>
          <script>
          var ccnt = 5;
          function countdown(){
            ccnt = ccnt - 1;
            if(ccnt < 0){
              document.getElementById("closeup").innerHTML = "0";
              <?php
              session_start();
              error_reporting(0);
              require("/var/www/html/liliq/Function/ClassAttendFunction/ClassAttendDB.php");
                  $_SESSION["USERID"]="test";// testdate
                  $ClassAttendDB=new ClassAttendDB();
                  $ClassAttendDB->Attendance_Check($_SESSION["USERID"]);
                  $ClassAttendDB->Attendance_School($_SESSION["USERID"]);
                  $ClassAttendDB->AttendUpdate(0,$_SESSION["USERID"],2);
              ?>
            }else{
            document.getElementById("closeup").innerHTML = ccnt;
          }
          }

          </script>
          <span id="closeup" class="closer">
            5
          </span>
          <span class="closer">
            秒後にクローズ
          </span>
        </div>
          <br clear="all">

          <p id="name"  class="marginner">0K00018 土肥　裕平</p>
          <a id="select_box" href="###############やり直しの際の処理.php################">
            <div id="choice_btn">
              <p>　これは私の名前ではありません(Enterでやり直し)</p>
            </div>
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
