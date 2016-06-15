<?php
	error_reporting(0);
	require("/var/www/html/liliq/Function/ClassAttendFunction/ClassAttendDB.php");
	require("/var/www/html/liliq/Function/SchoolAttendFunction/SchoolAttend.php");
  echo "<meta charset='utf-8'>";
  $ClassAttendDB = new ClassAttendDB();
  $ClassAttendDB->Attend_select_time($_GET["id"],$_GET["date"]);
  for($i=1;$i<=5;$i++){
    echo $ClassAttendDB->time[$i]."時間目";
      if($ClassAttendDB->type[$i]==0){
          echo " 出席<br>";
				}else  if($ClassAttendDB->type[$i]==2){
					echo "欠課<br>";
				}else  if($ClassAttendDB->type[$i]==1){
            echo "遅刻<br>";
      }else  if($ClassAttendDB->type[$i]==3){
					echo "就活<br>";
		}
  }
  ?>
