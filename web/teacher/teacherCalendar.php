<?php
error_reporting(0);
if(!isset($_SESSION)){
session_start();
}

require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
require("/var/www/Function/LoginFunction/LoginCheak.php");
teacherCheak();
if(sha1($_SESSION["USERID"])==$_SESSION["PASSWORD"]){
  header("Location:../Login/password.php");
  exit;
}
$ClassAttendDB = new ClassAttendDB();
$ClassAttendDB->nowYear();
$nowY=$ClassAttendDB->nowY;

//登校日、または休校日変更


	// $year = @$_GET['year'];
	$month = @$_GET['month'];
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
		<link rel='stylesheet' href='cstyle.css'>
	</head>

	<body>

	<h2 class='title'><?php echo "{$year}年{$month}月"?>
		<!-- 月の判別 -->
		<?php if($month==12){?>
		<a href="teacherCalendar.php?month=<?php echo $month-1?>"> < </a>
		<a href="teacherCalendar.php?month=1"> > </a>
		<?php }else if($month==1){?>
			<a href="teacherCalendar.php?month=12"> < </a>
			<a href="teacherCalendar.php?month=<?php echo $month+1?>"> >  </a>
			<?php }else if($month==4){?>
				<a href="teacherCalendar.php?month=<?php echo $month+1?>"> >  </a>
			<?php }else if($month!=3){?>
				<a href="teacherCalendar.php?month=<?php echo $month-1?>"> < </a>
				<a href="teacherCalendar.php?month=<?php echo $month+1?>"> >  </a>
	<?php }else{?>
		<a href="teacherCalendar.php?month=<?php echo $month-1?>"> < </a>
		<?php } ?>
<h3>月の指定：
<form method="GET" action="teacherCalendar.php">
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
<input type="submit" value="送信">
</FORM>
</h3>
</h2>
	<hr class='calendar_hr'>

	<span class='day date'>日</span><span class='day date'>月</span><span class='day date'>火</span><span class='day date'>水</span><span class='day date'>木</span><span class='day date'>金</span><span class='day date'>土</span>
<?php
session_start();
error_reporting(0);
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
	    // $type=$ClassAttendDB->Attend_select($_SESSION["USERID"],$year."-".$month."-".$day);
      for($i=0;$i<$dayPointer+1;$i++){
      if($ClassAttendDB->calendar[$day]==$day){
        echo "<a href='SDChange.php?year=$year&month=$month&day=$day'><span class='day holid'><span class='text'>{$day}日</span><font size=2>休日<br>&nbsp;</font></span></a>";
			}else{
				// $ClassAttendDB->startTime($year."-".$month."-".$day);
				$ClassAttendDB->startTime($year."-".$month."-".$day);
    			echo "<a href='SDChange.php?year=$year&month=$month&day=$day'><span class='day attend'><span class='text'>{$day}日</span><font size=2>登校日<br>{$ClassAttendDB->starttime}〜{$ClassAttendDB->endtime}</font></span></a>";
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
	</body>

</html>
