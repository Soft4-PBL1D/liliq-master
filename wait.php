<?php
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>LILIQ Develop - Waiting..</title>
<link rel="stylesheet" type="text/css" href="screen.css">
</head>

<body>

  <div id="screen_blue">
    <div id="screen_box">


      <div id="screen_captcha">

        <div id="bigtext_box">


          <p id="clock_txt">
            <SCRIPT type="text/javascript"><!--
            myWeek=new Array("日","月","火","水","木","金","土");
            function myFunc(){

                 myDate=new Date();
                 myMsg = "";
                 myMsg += myDate.getHours() + ":";
                 myMsg += myDate.getMinutes() + "";
                 document.getElementById("myIDdate").innerHTML = myMsg;

            }
            // --></SCRIPT>
            <DIV id="myIDdate" class="bigclock_txt">00:00</DIV>
            <SCRIPT type="text/javascript"><!--
            setInterval( "myFunc()", 1000 );
            // --></SCRIPT>
          </p>


          <script>
          var ccnt = 5;
          function countdown(){
            ccnt = ccnt - 1;
            if(ccnt < 0){
              document.getElementById("closeup").innerHTML = "0";
            }else{
              document.getElementById("closeup").innerHTML = ccnt;
          }
          }

          </script>


          <a href="##################" id="choice_btn2">
            <p>クリックで認証</p>
          </a>
          <img src="img/logo.png" id="LILIQ2">

        </div>
          <br clear="all">


      </div>


    </div>
  </div>



</body>
</html>


<?php
?>
