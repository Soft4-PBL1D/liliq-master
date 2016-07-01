<?php
error_reporting(0);
if(!isset($_SESSION)){
session_start();
}

require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
$ClassAttendDB = new ClassAttendDB();
$ClassAttendDB->nowYear();
$nowY=$ClassAttendDB->nowY;
$ClassAttendDB->myname($_GET["id"]);
require("/var/www/Function/LoginFunction/LoginCheak.php");
teacherCheak();
if(sha1($_SESSION["USERID"])==$_SESSION["PASSWORD"]){
  header("Location:../Login/password.php");
  exit;
}

//登校日、または休校日変更


	// $year = @$_GET['year'];
	$month = @$_GET['month'];
	// $month=date("n",strtotime($_GET["month"]));
	if(!isset($month)||$month>12||$month<1){
	$month=date("n");}
	$year=date("Y");
	if($year!=$nowY){
	switch($month){
	case 1:
	case 2:
	case 3:$year=$year+1;
	break;
}
}
  // $month=;
	$monthNum = getMonthDayNum($year, $month);
	$dayPointer = 0 - getStartDate($year, $month, 1);
	function getMonthDayNum($year, $month) {
		switch ($month) {
			case 2:
				return (isLeapYear($year) ? 29 : 28);
				break;
			case 4:
			case 6:
			case 9:
			case 11:
				return 30;
				break;
			default:
				return 31;
				break;
		}
	}
	function isLeapYear ( $year ) {
		if( ( $year % 4 == 0 && $year % 100 != 0 ) || $year % 400 == 0 ) {
			return true;
		} else {
			return false;
		}
	}
	function getStartDate($y, $m, $d) {
		$y = intval( $y );
		$m = intval( $m );
		$d = intval( $d );
		if( $m == 1 or $m == 2 ){
			$y -= 1;
			$m += 12;
		}
		$res = ( $y + intval( $y / 4 ) - intval( $y / 100 ) + intval( $y / 400 ) + intval( ( 13 * $m + 8 ) / 5 ) + $d ) % 7;
		return $res;
	}
?>








<html>
	<head>

		<meta charset="utf-8">
    <link rel='stylesheet' href='css/style.css'>
		<link rel='stylesheet' href='cstyle.css'>
	</head>

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

		<!-- //生徒名の表示 -->
		<?php echo $ClassAttendDB->myname;?>
	<h2 class='title' style='color:#000;'><?php echo "{$year}年{$month}月"?>
		<!-- 月の判別 -->
		<?php if($month==12){?>
		<a href='studentsCalendar.php?month=<?php echo $month-1?>&id=<?php echo $_GET["id"]?>'> < </a>
		<a href='studentsCalendar.php?month=1&id=$_GET['id']'> > </a>
		<?php }else if($moh==1){?>
			<a href='studentsCalendar.php?month=12&id=$_GET['id']'> < </a>
			<a href='studentsCalendar.php?month=<?php echo $month+1?>&id=<?php echo $_GET["id"]?>'> > </a>
			<?php }else if($month==4){?>
				<a href='studentsCalendar.php?month=<?php echo $month+1?>&id=<?php echo $_GET["id"]?>'> > </a>
			<?php }else if($month!=3){?>
				<a href='studentsCalendar.php?month=<?php echo $month-1?>&id=<?php echo $_GET["id"]?>'>< </a>
				<a href='studentsCalendar.php?month=<?php echo $month+1?>&id=<?php echo $_GET["id"]?>'>>  </a>
	<?php }else{?>
		<a href='studentsCalendar.php?month=<?php echo $month-1?>&id=<?php echo $_GET["id"]?>'>< </a>
		<?php } ?>
<h2 style='color:#000;'>月の指定：
<form method="GET" action="">
<SELECT name="month">
<OPTION value="4">4</OPTION>
<OPTION value="5">5</OPTION>
<OPTION value="6">6</OPTION>
<OPTION value="7">7</OPTION>
<OPTION value="8">8</OPTION>
<OPTION value="9">9</OPTION>
<OPTION value="10">10</OPTION>
<OPTION value="11">11</OPTION>
<OPTION value="12">12</OPTION>
<OPTION value="1">1</OPTION>
<OPTION value="2">2</OPTION>
<OPTION value="3">3</OPTION>
</SELECT>
<input type="hidden" name="id" value="<?php echo $_GET["id"]?>">
<input type="submit" value="送信">
</FORM>
</h2>
</h2>

<div id="caldiv">
	<span class='day date'>日</span><span class='day date'>月</span><span class='day date'>火</span><span class='day date'>水</span><span class='day date'>木</span><span class='day date'>金</span><span class='day date'>土</span>
<?php
session_start();
error_reporting(1);
$ClassAttendDB->Calendar($year,$month);
	for ($i = 0; $i < 6; $i++) {
		echo "<div class='week'>";
		for ($j = 0; $j < 7; $j++) {
			// echo $year."-".$month."-".$dayPointer;
			if ($dayPointer > $monthNum - 1) {
        	// echo "<span class='day$restClass'><span class='text'></span></span>";
				break;
			}
			$restClass = '';
			if ($j == 0 || $j == 6) {
				$restClass = ' holid';
			}
			if ($dayPointer < 0) {
				$prevDay = getMonthDayNum(($month == 1 ? $year - 1 : $year), ($month == 1 ? 12 : $month - 1)) + $dayPointer + 1;
				echo "<span class='day$restClass'><span class='text prev'>{$prevDay}日
				</span><font size=1><br>&nbsp;</font></span>";
				$dayPointer++;
				continue;
			}
			$day = $dayPointer + 1;
	    $type=$ClassAttendDB->Attend_select($_GET["id"],$year."-".$month."-".$day);
      for($i=0;$i<$dayPointer+1;$i++){
      if($ClassAttendDB->calendar[$day]==$day){

        echo "<span class='day holid'><span class='text'>{$day}日</span><font size=1>休日<br>&nbsp;</font></span>";
			}else{
				// $ClassAttendDB->startTime($year."-".$month."-".$day);
				$ClassAttendDB->gotime($year."-".$month."-".$day,$_GET["id"]);
				if(isset($ClassAttendDB->schoolLogin)){
				$start=date("H:i:s",$ClassAttendDB->schoolLogin);
			}
				else
				$start="未登校";
				if(isset($ClassAttendDB->schoolEnd))
				$end=date("H:i:s",$ClassAttendDB->schoolEnd);
				else
				$end="未下校";
				if($type==0||$type==3||$type==5)
    			echo "<a href=detail.php?date=$year-$month-$day&id={$_GET["id"]}><span class='day attend'><span class='text'>{$day}日○</span><font size=1>登校時間:{$start}<br>下校時間:{$end}</font></span></a>";
    			//遅刻、結石があれば
    			else if ($type!=8 && $type!=0)
    			echo "<a href=detail.php?date=$year-$month-$day&id={$_GET["id"]}><span class='day attend'><span class='text'>{$day}日●</span><font size=1>登校時間:{$start}<br>下校時間:{$end}</font></span></a>";
    			else
    			echo "<a href=detail.php?date=$year-$month-$day&id={$_GET["id"]}><span class='day attend'><span class='text'>{$day}日</span><font size=1>登校時間:{$start}<br>下校時間:{$end}</font></span></a>";
          // echo "<span class='day'><span class='text'>{$day}日</span></span>";
     }
      break;
    }
    //  break;
    //  else{
      // break;
    //  }
    // }
			// $ClassAttend->Type="8";
			$dayPointer++;
		}
    echo "</div>";
	}
?>
</div>
</div>
</div>


<div class="wn">

  <div class="note">
    &copy; Dfun.
  </div>

</div>


</div>
	</body>

</html>
