<?php
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>LILIQ Develop - Waiting..</title>
<link rel="stylesheet" type="text/css" href="screen.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>

<body>
<a href="wait.php"><img id="liliq" src="../img/logo.png" alt="LILIQ"></a>
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
                 if(myDate.getMinutes()<10){
                   myMsg += "0" + myDate.getMinutes() + "";
                } else{
                  myMsg += myDate.getMinutes() + "";
                }
                 document.getElementById("myIDdate").innerHTML = myMsg;

            }
            // --></SCRIPT>
            <DIV id="myIDdate" class="bigclock_txt">00:00</DIV>
            <SCRIPT type="text/javascript"><!--
	    myFunc();
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
	    $('body').keydown(function(e){
		    	if( e.keyCode == 13){
		        	window.location.href= 'processing_demo.php';
				}
	    });
	    var code = 13; 

          </script>


          <a href="processing_demo.php" id="choice_btn2">
            <p>クリックで認証</p>
          </a>

        </div>
          <br clear="all">


      </div>


    </div>
  </div>



</body>
</html>


<?php
?>
