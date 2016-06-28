<?php
	session_start();
	$_SESSION["USERID"] = '0K01008';
	date_default_timezone_set('Asia/Tokyo');
	require("/var/www/Function/ClassAttendFunction/ClassAttendDB.php");
	$ClassAttendDB = new ClassAttendDB();
	$ClassAttendDB->Attendance_Check($_SESSION["USERID"]);
	if ($ClassAttendDB->Type == 1 || $ClassAttendDB->Type == null) {
		$now = time();
		$start = strtotime('today');		
		echo $start;
		if ($now - $start > 3600) {
			header('Location:late.php', true, 303);
		} else {
			header('Location:students.php', true, 303);
		}
	} else {
		header('Location:students.php', true, 303);
	}
?>
