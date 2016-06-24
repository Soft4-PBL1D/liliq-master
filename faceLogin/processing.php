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
  <a href="wait.php"><img id="liliq" src="../img/logo.png" alt="LILIQ"></a>
	<video id="camera" width="400" height="300" autoplay style='visible:false;position:absolute; top:-1000px; left:-1000px'></video>
	<canvas id="image" width="400" height="300" style='visible:false;position:absolute; top:-1000px; left:-1000px'></canvas>
	<canvas id="overlay" width="400" height="300" style='visible:false;position:absolute; top:-1000px; left:-1000px'></canvas>
<!--	<canvas id="face" width="400" height="300" style='visible:false;position:absolute; top:500px; left:500px'></canvas>-->
  <div id="screen_blue">
    <div id="screen_box">


      <div id="screen_captcha">
        <div id="bigtext_box">


          <p id="clock_txt">
<br /><br /><br /><br /><br /><br />
            <DIV class="bigclock_txt" style="font-size:70px;"><canvas id="face" width="180px" height="200px" style="border:1px solid #000;background:#000;"></canvas><div id='pname' style="float:right;margin-top:30px;padding-right:37px;">認証しています</div></DIV>
		<div id='faceMes' style='font-color:#FF0000'>読み込み中です</div>
<a href="0.php">0.php</a>　<a href="1.php">1.php</a>　<a href="late.php">late.php</a>
          </p>

<div id='pbutton' style="margin-left:400px;">
      <button id='yes' type="button" name="aaa" value="aaa">
           <font style="font-size:70px;" color="#333399">はい</font>
           </button>

      <button id='no' type="button" name="aaa" value="aaa">
                <font style="font-size:70px;" color="#333399">いいえ</font>
                </button>
</div>



        </div>
          <br clear="all">
      </div>


    </div>
  </div>



</body>
	<script src="clmtrackr-dev/clmtrackr.js"></script>
	<script src="clmtrackr-dev/models/model_pca_20_svm.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>

		$('#pbutton').hide();
		var localMediaStream = null;
		var authsuc = false;
		var timer;
		var timerMove;
		var video = document.getElementById('camera');
		$(document).ready(function () {
			var hasGetUserMedia = function() {
				return (navigator.getUserMedia || navigator.webkitGetUserMedia ||
					navigator.mozGetUserMedia || navigator.msGetUserMedia);
			};

			var onFailSoHard = function(e) {
				console.log('ERROR', e);
				alert('カメラを使用できません');
				window.location.href = '0.php';
			};

			if(!hasGetUserMedia()) {
				alert("未対応ブラウザです。");
			} else {
				window.URL = window.URL || window.webkitURL;
				navigator.getUserMedia  = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
				navigator.getUserMedia({video: true}, function(stream) {
					video.src = window.URL.createObjectURL(stream);
					localMediaStream = stream;
				}, onFailSoHard);
			}
		});
		$('body').keydown(function(e){
			if(authsuc && e.keyCode == 13){
				window.location.href= 'students.php';
			}
		});
		$('#yes').click(function() {
			window.location.href = 'students.php';
		});
		$('#no').click(function() {
			location.reload();
		});
		timer = setInterval('auth()', 1000);
		$('#reg').click(function() {
			var canvas = document.getElementById('face');
			var blob = getbase64(canvas.toDataURL());
			sendImage64(blob, 'reg.php');
		});

		$('#auth').click(function() {
			auth();
		});

		function auth() {
			var canvas = document.getElementById('face');
			var blob = getbase64(canvas.toDataURL());
			sendImage64(blob, 'auth.php');
		}

		var sendImage64 = function(base64, php) {
			var formData = new FormData();
			formData.append('acceptImage', base64);
			formData.append('width', faceWidth);
			formData.append('height', faceHeight);
			$.ajax({
				type: 'POST',
				url: php,
				data: formData,
				contentType: false,
				processData: false,
			}).then(function(data) {
				if (data != 'continue') {
					authsuc = true;
					clearInterval(timer);
					clearTimeout(timerMove);
					$('#faceMes').text('認証成功');
					$('#pname').text(data + 'さんですか？');
					$('#pbutton').show();
					//window.location.href = 'students.php';
				}
                      // if (data < 0.3) {
                      //<?php
                             /*          // header("Location:1.php");
                                               require("/var/www/Function/SchoolAttendFunction/SchoolAttend.php");
                                               require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
                                               @session_start();
                                              //  $_SESSION["USERID"]=$_SESSION["userid"];
                                               $_SESSION["USERID"]="0K01001";//testdate
                                               $ClassAttendDB=new ClassAttendDB();
                                               $ClassAttendDB->Attendance_Check($_SESSION["USERID"]); //test data
                                               // 当日の投稿時間の取得
                                               $ClassAttendDB->AttendTime();
                                               // 登校処理
                                               if($ClassAttendDB->Type=="1" || $ClassAttendDB->Type==null){
                                                 //当日の登校時間までに投稿
                                                 if(date("H:i:s",$ClassAttendDB->start) >= date("H:i:s")){
                                                     echo "window.location.href = '2.php'";
                                                 }else{
                                                 // 遅刻理由画面パス
                                                 echo "window.location.href = 'late.php'";
                                                 }
                                               }
                                               //下校処理
                                               if($ClassAttendDB->Type=="0"){
                                                           //通常下校
                                                 if(date("H:i:s",$ClassAttendDB->end)<=date("H:i:s")){
                                                     echo "window.location.href = '1.php'";
                                                     }else{
                                                         echo "window.location.href = 'late2.php'";
                                                           }
			}*/
		       //?>
			//
      //		window.location.href = '0.php';  //遷移
				// }
			});
		};

		var getbase64 = function(base64){
			var base64Data = base64.split(',')[1];
			return base64Data;
		}


		//$('#bt').click(function() {
		var faceHeight = 0;
		var faceWidth = 0;
		$(document).ready(function () {
			if (!authsuc || localMediaStream) {
				console.log('start');
				timeMove = setTimeout("window.location.href = '0.php'", 10000);
				var canvas = document.getElementById('overlay');
				var ctx = canvas.getContext('2d');
				var img = document.getElementById('img');

				//videoの縦幅横幅を取得
			//	var w = video.offsetWidth;
			//	var h = video.offsetHeight;

				//同じサイズをcanvasに指定
			///	canvas.setAttribute("width", w);
			//	canvas.setAttribute("height", h);

				ctx.drawImage(video, 0, 0, 400, 300);

				var videoInput = document.getElementById('camera');
				var tracker = new clm.tracker();
				tracker.init(pModel);
				var positions = tracker.getCurrentPosition();
				tracker.start(videoInput);
				var canvasInput = document.getElementById('overlay');
				var cc = canvasInput.getContext('2d');
				var canvasInput2 = document.getElementById('face');
				var cf = canvasInput2.getContext('2d');

				function drawLoop() {
					requestAnimationFrame(drawLoop);
					cc.clearRect(0, 0, canvasInput.width, canvasInput.height);
					cc.drawImage(video, 0, 0, 400, 300);
					cc.strokeStyle = 'rgb(0, 255, 0)';
					//tracker.draw(canvasInput);
					var positions = tracker.getCurrentPosition();
					var xMin = 9999;
					var xMax = 0;
					var yMin = 9999;
					var yMax = 0;
					if (positions != false) {
						for (i = 0; i < 71; i++) {
							if (positions[i][0] < xMin) {
								xMin = positions[i][0];
							}
							if (positions[i][0] > xMax) {
								xMax = positions[i][0];
							}
							if (positions[i][1] < yMin) {
								yMin = positions[i][1];
							}
							if (positions[i][1] > yMax) {
								yMax = positions[i][1];
							}
						}
					}
					faceWidth = xMax - xMin;
					faceHeight =  yMax - yMin;
					if (!authsuc) {
						if (faceHeight < 70)  {
							$('#faceMes').text('顔を認識できません');
						} else if (faceHeight < 150) {
							$('#faceMes').text('顔をもっと近づけて下さい');
						} else {
							$('#faceMes').text('正面を向いて下さい');
						}
					}
					cc.strokeRect(xMin, yMin, xMax - xMin, yMax - yMin);
					cf.clearRect(0, 0, canvasInput.width, canvasInput.height);
					cf.drawImage(canvasInput, xMin, yMin, xMax - xMin, yMax - yMin, 0, 0, xMax - xMin, yMax - yMin);
				}
				drawLoop();
			}
		});
</script>
</html>


<?php
?>
