<meta charset="utf-8">
<?php
error_reporting(0);
if(!isset($_SESSION)){
session_start();
}

require("/var/www/Function/LoginFunction/LoginCheak.php");
teacherCheak();
if(sha1($_SESSION["USERID"])==$_SESSION["PASSWORD"]){
  header("Location:../Login/password.php");
  exit;
}
//GoogleカレンダーAPIから祝日を取得
function getHolidays($year) {
	$apiKey="AIzaSyCD1yiodJTU0p6UGoPx-iXuH4_GIgWvhkI";

	$holidays = array();
	$holidays_id = 'outid3el0qkcrsuf89fltf7a4qbacgt9@import.calendar.google.com'; // mozilla.org版
	//$holidays_id = 'japanese__ja@holiday.calendar.google.com'; // Google 公式版日本語
	//$holidays_id = 'japanese@holiday.calendar.google.com'; // Google 公式版英語
	$url = sprintf(
		'https://www.googleapis.com/calendar/v3/calendars/%s/events?'.
		'key=%s&timeMin=%s&timeMax=%s&maxResults=%d&orderBy=startTime&singleEvents=true',
		$holidays_id,
		$apiKey,
		$year.'-04-01T00:00:00Z' , // 取得開始日
		$year+"1".'-03-31T00:00:00Z' , // 取得終了日
		150 // 最大取得数
	);

	if ( $results = file_get_contents($url, true )) {
		//JSON形式で取得した情報を配列に格納
		$results = json_decode($results);
		//年月日をキー、祝日名を配列に格納
		$i=1;
		foreach ($results->items as $item ) {
			$date = strtotime((string) $item->start->date);
			$title = (string) $item->summary;
			$holidays[$i]=date("Y-m-d",$date);
			echo $holidays[$i];
			$i=$i+1;
      // echo date("Y-m-d",$date)."<br>";
		}
		//祝日の配列を並び替え
		// ksort($holidays);
	}
	return $holidays;
}

//うるう年
function nowYearAll($year){
		if(checkdate(2,29,$year)){
			// 今年度の３６５日をデータベースに追加する
  		for($i=1;$i<=365;$i++){
        $date[$i][0]=date("Y-m-d",strtotime("$i day",strtotime("$year-04-00")));
        $date[$i][1]=date("w",strtotime("$i day",strtotime("$year-04-00")));
				// echo date("Y-m-d",strtotime("$i day",strtotime("$year-04-00")));
				// echo date("w",strtotime("$i day",strtotime("$year-04-00")));
				// echo "<br>";
      }
  	}else{
  		for($i=1;$i<=365;$i++){
    		$date[$i][0]=date("Y-m-d",strtotime("$i day",strtotime("$year-04-00")));
		    $date[$i][1]=date("w",strtotime("$i day",strtotime("$year-04-00")));
				// echo date("Y/m/d",strtotime("$i day",strtotime("$year/04/00")));
				// echo date("w",strtotime("$i day",strtotime("$year/04/00")));
      }
  	}
		return $date;
}
//nowYearAllInsertより平日は登校日としてずべ手の生徒のClassAttendTableを作成
function nowUser(){
	$pdo=new PDO("mysql:host=localhost;dbname=pbl;charset=utf8","root","soft4",
  array(PDO::ATTR_EMULATE_PREPARES=>false));
  if(!$pdo){$message="error";}
	//登録されているすべてのユーザーを抽出
		$sql="select UserId from UserTable;";
		$stmt=$pdo->query($sql);
		$i=0;
		while($kari=$stmt->fetch(PDO::FETCH_ASSOC)){
			$user[$i]=$kari["UserId"];
			$i=$i+1;
		 }
		//登校日のデーターを予め抽出
		$sql="select Date from SchoolDayTable where SchoolDay=0;";
		$stmt=$pdo->query($sql);
		$i=0;
		while($kari=$stmt->fetch(PDO::FETCH_ASSOC)){
				//登録されているすべてのユーザーを抽出
				$SchoolDay[$i]=$kari["Date"];
				$i=$i+1;

			}
		//初回セットアップ時に１年間の出席テーブルを作成（デフォルトではきていないの状態）
		for($i=0;$i<count($user);$i++){
			//すべての出席日をさくせい
			for($j=0;$j<count($SchoolDay);$j++){
				for($k=1;$k<=5;$k++){
					$sql="insert into ClassAttendTable(UserId,Date,Time,Type)values(?,?,?,?)";
					$stmt=$pdo->prepare($sql);
					$stmt->execute(array($user[$i],$SchoolDay[$j],$k,8));
				}
			}
		}

}


// nowYearAll("2016");
//今年度の登校日、投稿時間をデータ・ベースに登録　デフォルトでは土日祝日はShoolDay=1 平日は０とする
function nowYearAllInsert(){
  $pdo=new PDO("mysql:host=localhost;dbname=pbl;charset=utf8","root","soft4",
  array(PDO::ATTR_EMULATE_PREPARES=>false));
  if(!$pdo){$message="error";}
	//３６５日の取得
		$date=array();
		$date=nowYearAll(date("Y"));
	// 今年度の祝日の取得
		$holidays=array();
		$holidays=getHolidays(date("Y"));
	//DBにYearを書き込む
		$datecount=count($date);
		// echo $datecount."<br>";SchoolDayTable`
		for($i=1;$i<=$datecount;$i++){
     $sql="insert into SchoolDayTable(Date,Week,SchoolDay,SchoolStartTime,SchoolEndTime)values(?,?,?,?,?)";
	//  $sql2="insert into SchoolAttendTable()"
     $stmt=$pdo->prepare($sql);
		 //土日はSchoolDay=1を(休み)
		 if($date[$i][1]==0 || $date[$i][1]==6)
		 $stmt->execute(array($date[$i][0],$date[$i][1],1,strtotime($date[$i][0])+33600,strtotime($date[$i][0])+53400));
		else
		// 平日はSchoolDay=0(学校)
		$stmt->execute(array($date[$i][0],$date[$i][1],0,strtotime($date[$i][0])+33600,strtotime($date[$i][0])+53400));
	 }
	 //挿入した日の祝日の変更
	 for($i=1;$i<=count($holidays);$i++){
		 $sql="update SchoolDayTable set SchoolDay=? where Date=?";
		 $stmt=$pdo->prepare($sql);
		 $stmt->execute(array(1,$holidays[$i]));
	//  }
	// echo $holidays[1];
// }
}

}
nowYearAllInsert();
// getHolidays("2016");
nowUser();
?>
