<?php
// TacherChange
// StundentsAttend
// classattend
// AttendChangeCheck
// StundentsAttend
class ClassAttendDB {
      function construct($host,$user,$pass,$db){
        error_reporting(0);
        if(!isset($_SESSION)){
        session_start();
        }
	      $this->host = $host;
	      $this->user = $user;
	      $this->pass = $pass;
	      $this->db = $db;
	      $this->dsn = "mysql:dbname=$db;$host=$host";
        $this->onegen=date("09:20:00");//1time
        $this->twogen=date("10:20:00");//2time
        $this->threegen=date("11:20:00");//3time
        $this->fourgen=date("13:00:00");//4time
        $this->fifgen=date("14:00:00");//5time
        // 出席：0遅刻：1欠席：2就活：3病欠：4公欠：5
        }
        //ユーザーIDより指名の抽出
        function myname($userid){
          $this->construct("localhost","root","soft4","pbl");
          $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
          PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
          $i=0;
          // school login time
          $sql="select * from UserTable where UserId=?;";
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array($userid));
          while($user=$stmt->fetch(PDO::FETCH_ASSOC)){
              $this->myname=$user[Name];
            }
        }
        //生徒用　各日の登校時間と下校時間の表示
        function gotime($date,$user){
          $this->construct("localhost","root","soft4","pbl");
          $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
          PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
          $i=0;
          // school login time
          $sql="select * from SchoolAttendTable where from_unixtime(Time) like ? and Type=? and UserId=?;";
          $stmt=$pdo->prepare($sql);
          $date=date("Y-m-d",strtotime($date));
          // echo $date;
          $stmt->execute(array($date."%",0,$_SESSION["USERID"]));
          if($_SESSION["USERID"]=="teacher")
          $stmt->execute(array($date."%",0,$_GET["id"]));
          while($user=$stmt->fetch(PDO::FETCH_ASSOC)){
              $this->schoolLogin=$user[Time];
              $i=1;
            }
            if($i==0)$this->schoolLogin=null;
          $sql="select * from SchoolAttendTable where from_unixtime(Time) like ? and Type=? and UserId=?;";
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array($date."%",1,$_SESSION["USERID"]));
          if($_SESSION["USERID"]=="teacher")
          $stmt->execute(array($date."%",1,$_GET["id"]));
          while($user=$stmt->fetch(PDO::FETCH_ASSOC)){
          $this->schoolEnd=$user[Time];
          $i=1;
          }
            if($i==0)$this->schoolEnd=null;
          }
        // 教師用　生徒の出席変更依頼の件数ポップアップ
        function popup(){
          $this->construct("localhost","root","soft4","pbl");
          $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
          PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
          //申請があれば申請中にするため
           //ClassAttendTableの出席状況
          $sql="select count(*) from ClassAttendTable where Type in(6,7);";
           $stmt=$pdo->prepare($sql);
           $stmt->execute();
           $this->myattend=Array();
           $i=0;
           while($user=$stmt->fetch(PDO::FETCH_ASSOC)){
               $this->count=$user["count(*)"];
             }
             $sql2="select count(*) from UserApplication;";
             $stmt2=$pdo->prepare($sql2);
             $stmt2->execute();
             $i=0;
             while($user2=$stmt2->fetch(PDO::FETCH_ASSOC)){
                 $this->count2=$user2["count(*)"];
               }
               $this->countA=$this->count+$this->count2;
        }
        //function mynameとおなじ？かも
        function NameSelect($UserId){
          error_reporting(E_ALL ^ E_NOTICE);
          $this->construct("localhost","root","soft4","pbl");
          $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
          PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
          // 登校ならtype=1　初回登録ならnull 下校ならType=0をかえす
          $sql="select * from UserTable where UserId=?;";
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array($UserId));
          while($data=$stmt->fetch(PDO::FETCH_ASSOC)){
                $this->Name=$data[Name];//1 or 0
              }
            }

      //登校処理をするか下校処理をするかの判別
        function Attendance_Check($userId){
          error_reporting(E_ALL ^ E_NOTICE);
          // DBの選択
          $this->construct("localhost","root","soft4","pbl");
          $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
          PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
          // 登校ならtype=1　初回登録ならnull 下校ならType=0をかえす
          $sql="select * from SchoolAttendTable where UserId=? and from_unixtime(Time) like ? order by Time desc limit 1;";
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array($userId,date("Y-m-d")."%"));
          foreach($stmt as $data){
                $this->Type=$data[Type];//1 or 0
              }
            }

      //登校または下校をデーターベースに登録する
        function Attendance_School($userId){
          error_reporting(E_ALL ^ E_NOTICE);
          session_start();
          $type=$this->Type;
          // DBの選択
          $this->construct("localhost","root","soft4","pbl");
          $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
          PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
            //登校処理
            if($type==1 || $type==null){
              $sql="insert into SchoolAttendTable(UserId,Time,Type,Checking)values(?,?,?,?);";
              $stmt=$pdo->prepare($sql);
              $stmt->execute(array($userId,time(),0,0));
            }
            // 下校処理
            else{
              $sql="insert into SchoolAttendTable(UserId,Time,Type,Checking)values(?,?,?,?);";
              $stmt=$pdo->prepare($sql);
              $stmt->execute(array($userId,time(),1,1));
            }
        }

        //当日の投稿時間、下校時間の抽出
        function AttendTime(){
            $attendtime="select  * from SchoolDayTable where Date= ?";
            $this->construct("localhost","root","soft4","pbl");
            $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
              PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
              $stmt = $pdo->prepare($attendtime);
              $stmt->execute(array(date("Y-m-d")));
              while($kari=$stmt->fetch(PDO::FETCH_ASSOC)){
                $this->start=$kari[SchoolStartTime];
                $this->end=$kari[SchoolEndTime];
              }
            }
            //遅刻処理、早退処理、出欠処理、下校処理　Type=8は登校前

        //各日の出席、欠席の登録（下校時に処理）0は正常処理1は早退や遅刻
        function AttendUpdate($Type,$UserId,$check){
          $this->construct("localhost","root","soft4","pbl");
          $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
          PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
          //各自の投稿した時間を抽出
          $select="select Time from SchoolAttendTable where UserId=? and from_unixtime(Time) like ? and Type=0 order by Time desc limit 1;";
          $stmt=$pdo->prepare($select);
          $stmt->execute(array($UserId,date("Y-m-d")."%"));
          while($kari=$stmt->fetch(PDO::FETCH_ASSOC)){
            $attend[0]=$kari[Time];
          }
          // 下校時間した時間を抽出
          $select="select Time from SchoolAttendTable where UserId=? and from_unixtime(Time) like ?  and Type=1 order by Time desc limit 1;";
          $stmt=$pdo->prepare($select);
          $stmt->execute(array($UserId,date("Y-m-d")."%"));
          //登校時間と下校時間の抽出
          while($kari=$stmt->fetch(PDO::FETCH_ASSOC)){
            $attend[1]=$kari[Time];
          }
          $attendupdate="update ClassAttendTable set Type=? where Time=? and Date=? and UserId=? and Type=8";
          $attendupdate1="update ClassAttendTable set Type=? where Time=? and Date=? and UserId=?";
          $this->construct("localhost","root","soft4","pbl");
          $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
            $this->AttendTime();
            //学校の登校時間
            $start=date("H:i:s",$this->start);
            //学校の下校時間
            $end=$this->end;
            //授業の開始時間が通常とは違う場合
            if($this->onegen<$start){
              $stmt = $pdo->prepare($attendupdate);
              for($i=1;$i<=1;$i++){
              $stmt->execute(array(0,$i,date("Y-m-d"),$UserId));}
            }

            if($this->twogen<$start){
              $stmt = $pdo->prepare($attendupdate);
              for($i=1;$i<=2;$i++){
              $stmt->execute(array(0,$i,date("Y-m-d"),$UserId));}
            }

            if($this->threegen<$start){
              $stmt = $pdo->prepare($attendupdate);
              for($i=1;$i<=3;$i++){
              $stmt->execute(array(0,$i,date("Y-m-d"),$UserId));}
            }

            if($this->fourgen<$start){
              $stmt = $pdo->prepare($attendupdate);
              for($i=1;$i<=4;$i++){
              $stmt->execute(array(0,$i,date("Y-m-d"),$UserId));}
            }

            if($this->fifgen<$start){
              $stmt = $pdo->prepare($attendupdate);
              for($i=1;$i<=5;$i++){
              $stmt->execute(array(0,$i,date("Y-m-d"),$UserId));}
            }
            //ココマデ
            $start=$this->start;
            //通常登校（１元）
            //遅刻
            if($check==1){
              if($start+900<$attend[0]&&$Type==1){
                $stmt = $pdo->prepare($attendupdate);
                $stmt->execute(array(2,1,date("Y-m-d"),$UserId));
              }else if($start<$attend[0]){
                $stmt = $pdo->prepare($attendupdate);
                $stmt->execute(array($Type,1,date("Y-m-d"),$UserId));
              }
              if($start+4500<$attend[0]&&$Type==1){
                  $stmt = $pdo->prepare($attendupdate);
                  $stmt->execute(array(2,2,date("Y-m-d"),$UserId));
                }
                else if($start+3600<$attend[0]){
                  $stmt = $pdo->prepare($attendupdate);
                  $stmt->execute(array($Type,2,date("Y-m-d"),$UserId));
                }
              if($start+8100<$attend[0]&&$Type==1){
                    $stmt = $pdo->prepare($attendupdate);
                    $stmt->execute(array(2,3,date("Y-m-d"),$UserId));
                    }
                    else if($start+7200<$attend[0]){
                    $stmt = $pdo->prepare($attendupdate);
                    $stmt->execute(array($Type,3,date("Y-m-d"),$UserId));
                    }
              if($start+14100<$attend[0]&&$Type==1){
                    $stmt = $pdo->prepare($attendupdate);
                    $stmt->execute(array(2,4,date("Y-m-d"),$UserId));
                  }
                  else if($start+12600<$attend[0]){
                    $stmt = $pdo->prepare($attendupdate);
                    $stmt->execute(array($Type,4,date("Y-m-d"),$UserId));
                  }
              if($start+17700<$attend[0]&&$Type==1){
                    $stmt = $pdo->prepare($attendupdate);
                    $stmt->execute(array(2,5,date("Y-m-d"),$UserId));
                }else if($start+16200<$attend[0]){
                $stmt = $pdo->prepare($attendupdate);
                $stmt->execute(array($Type,5,date("Y-m-d"),$UserId));
                }
            }

            //下校兼早退
            if($check==2){
            //１限目の出席条件
            if($start>=$attend[0]&& $start<=$attend[1]){
                $stmt = $pdo->prepare($attendupdate);
                $stmt->execute(array(0,1,date("Y-m-d"),$UserId));
              }else{//早退
                 $stmt = $pdo->prepare($attendupdate);
                 $stmt->execute(array($Type,1,date("Y-m-d"),$UserId));}
            //２限目の出席条件
            if($start+3600>=$attend[0] && $start+3600<=$attend[1]){
                 $stmt = $pdo->prepare($attendupdate);
                 $stmt->execute(array(0,2,date("Y-m-d"),$UserId));

                }else{
                 $stmt = $pdo->prepare($attendupdate);
                 $stmt->execute(array($Type,2,date("Y-m-d"),$UserId));}
            //3限目の出席条件
            if($start+7200>=$attend[0]&& $start+7200<=$attend[1]){
                 $stmt = $pdo->prepare($attendupdate);
                 $stmt->execute(array(0,3,date("Y-m-d"),$UserId));

                }else{
                  $stmt = $pdo->prepare($attendupdate);
                 $stmt->execute(array($Type,3,date("Y-m-d"),$UserId));}
            //4限目の出席条件
            if($start+11600>=$attend[0]&& $start+11600<=$attend[1]){
                 $stmt = $pdo->prepare($attendupdate);
                 $stmt->execute(array(0,4,date("Y-m-d"),$UserId));

                }else{
                  $stmt = $pdo->prepare($attendupdate);
                 $stmt->execute(array($Type,4,date("Y-m-d"),$UserId));}
            //5限目の出席条件
            if($start+15200>=$attend[0]&& $start+15200<=$attend[1]){
                 $stmt = $pdo->prepare($attendupdate);
                 $stmt->execute(array(0,5,date("Y-m-d"),$UserId));
                }else{
                  $stmt = $pdo->prepare($attendupdate);
                  $stmt->execute(array($Type,5,date("Y-m-d"),$UserId));}
                }
          }

        //出欠状況の表示
        function Attend_select($userId,$Date){
          $type=8;
          $attendselect="select * from pbl.ClassAttendTable where userId=? and Date=?  order by Type desc limit 1";
          $this->construct("localhost","root","soft4","pbl");
          $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
          PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
          $stmt = $pdo->prepare($attendselect);
          $stmt->execute(array($userId,$Date));
          while($kari=$stmt->fetch(PDO::FETCH_ASSOC)){
            $type=$kari["Type"];
                    }
          return $type;
        }

        //生徒の出席欠席の変更（矯正）
        function TeacherUpdate($Type,$Time,$Date,$UserId){
          $this->construct("localhost","root","soft4","pbl");
          $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
          PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
          $sql="update ClassAttendTable set Type=? where Time=? and Date=? and UserId=?";
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array($Type,$Time,$Date,$UserId));
      }
      //生徒が出席変更依頼をおくる（せいとのかれんだーより）
      function AttendChangeApplication($Type,$Time,$Date,$UserId){
        $this->construct("localhost","root","soft4","pbl");
        $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
        $sql="select * from ClassAttendTable where UserId=? and Date=? and Time=?";
        $i=1;
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($UserId,$Date,$Time));
        while($kari=$stmt->fetch(PDO::FETCH_ASSOC)){
          $type1=$kari[Type];
        }
        //チェックボックスに変動がない場合は処理しない
        if($type1==8){
        $sql="delete from UserApplication where UserId=? and Date=? and Time=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($UserId,$Date,$Time));
        $sql="insert into UserApplication(UserId,Date,Time,Type)values(?,?,?,?)";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($UserId,$Date,$Time,$Type));}
        if($type1==0 && $Type!=10){
        $sql="delete from UserApplication where UserId=? and Date=? and Time=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($UserId,$Date,$Time));
        $sql="insert into UserApplication(UserId,Date,Time,Type)values(?,?,?,?)";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($UserId,$Date,$Time,$Type));
          }
          if($type1==1 && $Type!=11){
          $sql="delete from UserApplication where UserId=? and Date=? and Time=?";
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array($UserId,$Date,$Time));
          $sql="insert into UserApplication(UserId,Date,Time,Type)values(?,?,?,?)";
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array($UserId,$Date,$Time,$Type));
        }
         if($type1==2 && $Type!=12){
                $sql="delete from UserApplication where UserId=? and Date=? and Time=?";
                $stmt=$pdo->prepare($sql);
                $stmt->execute(array($UserId,$Date,$Time));
                $sql="insert into UserApplication(UserId,Date,Time,Type)values(?,?,?,?)";
                $stmt=$pdo->prepare($sql);
                $stmt->execute(array($UserId,$Date,$Time,$Type));
              }
          if($type1==3 && $Type!=13){
            $sql="delete from UserApplication where UserId=? and Date=? and Time=?";
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array($UserId,$Date,$Time));
            $sql="insert into UserApplication(UserId,Date,Time,Type)values(?,?,?,?)";
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array($UserId,$Date,$Time,$Type));
                    }
          if($type1==4 && $Type!=14){
            $sql="delete from UserApplication where UserId=? and Date=? and Time=?";
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array($UserId,$Date,$Time));
            $sql="insert into UserApplication(UserId,Date,Time,Type)values(?,?,?,?)";
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array($UserId,$Date,$Time,$Type));
                          }
            if($type1==5 && $Type!=15){
              $sql="delete from UserApplication where UserId=? and Date=? and Time=?";
              $stmt=$pdo->prepare($sql);
              $stmt->execute(array($UserId,$Date,$Time));
              $sql="insert into UserApplication(UserId,Date,Time,Type)values(?,?,?,?)";
              $stmt=$pdo->prepare($sql);
              $stmt->execute(array($UserId,$Date,$Time,$Type));
            }

        }

      // 教師用 生徒よりきた出席変更依頼の表示
      function AttendChangeCheck(){
        $this->construct("localhost","root","soft4","pbl");
        $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
        //遅延、就活の認可
        $sql="select Date,u.UserId,Name,Time,c.Type from ClassAttendTable as c join UserTable as u on c.UserId=u.UserId where Date<=? and c.Type in(6,7);";
          $stmt=$pdo->prepare($sql);
          $i=0;
          $stmt->execute(array(date("Y-m-d")));
          while($kari=$stmt->fetch(PDO::FETCH_ASSOC)){
            $this->userdate[$i]=$kari[Date];
            $this->userid[$i]=$kari[UserId];
            $this->username[$i]=$kari[Name];
            $this->usertype[$i]=$kari[Type];
            $this->usertime[$i]=$kari[Time];
            $i=$i+1;
          }
          // /変更依頼
        $sql="select ut.UserId,ut.Name,Date,ua.Time,ua.Type from UserApplication as ua join UserTable as ut on ua.UserId=ut.UserId";
        $stmt=$pdo->prepare($sql);
        $stmt->execute();
        while($kari=$stmt->fetch(PDO::FETCH_ASSOC)){
          $this->userdate[$i]=$kari[Date];
          $this->userid[$i]=$kari[UserId];
          $this->username[$i]=$kari[Name];
          $this->usertype[$i]=$kari[Type];
          $this->usertime[$i]=$kari[Time];
          $this->userid[$i];
          $i=$i+1;
        }
}
      //当日までの登校していない生徒の抽出
      function TeacherCheck(){
        $this->construct("localhost","root","soft4","pbl");
        $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
        $sql="select c.Date,c.UserId,u.Name,c.Type from ClassAttendTable as c join UserTable as u on c.UserId=u.UserId  where c.Type in(6,7,8,10,11,12,13,14,15) and c.Date <= ?  group by UserId,Date order by Date,UserId";
        $stmt=$pdo->prepare($sql);
        $i=0;
        $stmt->execute(array(date("Y-m-d")));
        while($kari=$stmt->fetch(PDO::FETCH_ASSOC)){
        $this->userdate1[$i]=$kari[Date];
          $this->userid1[$i]=$kari[UserId];
          $this->username1[$i]=$kari[Name];
          $this->usertype1[$i]=$kari[Type];
          $i=$i+1;
        }
      }

      //生徒よりきた出席依頼の認可
      function TacherChange($UserId,$NowType,$ChangeType,$Date,$Time){
        $this->construct("localhost","root","soft4","pbl");
        $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
        // $ChangeType==0は認可、1は拒否
        // 出席：0// 遅刻：1// 欠席：2// 就活：3// 病欠：4// 公欠：5// 遅刻申請：６// 就活申請：７
        // 登校前：８// 出席にかえろ：１０// 遅刻にかえろ：１１// 欠席にかえろ：１２// 就活かえろ：１３// 病欠かえろ：１４// 公欠かえろ：１５
        if($ChangeType==0){
          echo $UserId."<br>";
          echo $NowType."<br>";
          echo $ChangeType."<br>";
          echo $Date."<br>";
          echo $Time."<br>";
          if($NowType==6) $sql="update ClassAttendTable set Type=0 where UserId=? and Date=? and Time=?";
          if($NowType==7) $sql="update ClassAttendTable set Type=5 where UserId=? and Date=? and Time=?";
          if($NowType==10)$sql="update ClassAttendTable set Type=0 where UserId=? and Date=? and Time=?";
          if($NowType==11)$sql="update ClassAttendTable set Type=1 where UserId=? and Date=? and Time=?";
          if($NowType==12)$sql="update ClassAttendTable set Type=2 where UserId=? and Date=? and Time=?";
          if($NowType==13)$sql="update ClassAttendTable set Type=3 where UserId=? and Date=? and Time=?";
          if($NowType==14)$sql="update ClassAttendTable set Type=4 where UserId=? and Date=? and Time=?";
          if($NowType==15)$sql="update ClassAttendTable set Type=5 where UserId=? and Date=? and Time=?";
          // if($NowType==2)$sql="update ClassAttendTable set Type=5 where UserId=? and Date=? and Time=?";
          // $sql="update ClassAttendTable set Type=0 where UserId=? and Date=? and Time=?";
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array($UserId,$Date,$Time));
        }
        if($ChangeType==1){
        $sql="delete from UserApplication where UserId=? and Date=? and Time=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($UserId,$Date,$Time));
        $sql="update ClassAttendTable set Type=2 where UserId=? and Date=? and Time=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($UserId,$Date,$Time));
        }
      }

      //Monthより各日の登校日の抽出
      function Calendar($Year,$Month){
        $this->construct("localhost","root","soft4","pbl");
        $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
        $sql="select DATE_FORMAT(Date,'%e') from SchoolDayTable where Date like ? and SchoolDay=1";
        $stmt=$pdo->prepare($sql);
        switch ($Month) {
          case 1:$Month="01";break;case 2:$Month="02";break;
          case 3:$Month="03";break;case 4:$Month="04";break;
          case 5:$Month="05";break;case 6:$Month="06";break;
          case 7:$Month="07";break;case 8:$Month="08";break;
          case 9:$Month="09";break;}
        $stmt->execute(array(date("$Year-$Month")."%"));
        $i=0;
        while($cal=$stmt->fetch(PDO::FETCH_ASSOC)){
                  $this->calendar[$cal["DATE_FORMAT(Date,'%e')"]]=$cal["DATE_FORMAT(Date,'%e')"];
                  // $i++;

                }
      }
      //各日の学校の始まる時間と終わる時間の抽出
      function startTime($date){
        $this->construct("localhost","root","soft4","pbl");
        $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
          $sql="select  Date_format(from_unixtime(SchoolStartTime),'%H:%i'),Date_format(from_unixtime(SchoolEndTime),'%H:%i') from SchoolDayTable where Date= ? and SchoolDay=0";
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array($date));
          while($cal=$stmt->fetch(PDO::FETCH_ASSOC)){
            $this->starttime=$cal["Date_format(from_unixtime(SchoolStartTime),'%H:%i')"];
            $this->endtime=$cal["Date_format(from_unixtime(SchoolEndTime),'%H:%i')"];
          }
      }
      //登校日の編集
      function AttendDayUpdate($check,$Date){
        $this->construct("localhost","root","soft4","pbl");
        $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
        $sql="update SchoolDayTable set SchoolDay=? where Date=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($check,$Date));
      }
      //現在の年の取得
      function nowYear(){
        $this->construct("localhost","root","soft4","pbl");
        $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
        $sql=" select YEAR(Date) from SchoolDayTable order by YEAR(Date) desc limit 1;";
        $stmt=$pdo->prepare($sql);
        $stmt->execute();
        while($cal=$stmt->fetch(PDO::FETCH_ASSOC)){
                    $this->nowY=$cal["YEAR(Date)"];
        }
      }
      //生徒が登校しているかしていないか
      function StundentsAttend($Date){
        $this->construct("localhost","root","soft4","pbl");
        $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
        //登校済み
        $sql="select U.UserId,Name,S.Type,Time from SchoolAttendTable as S join UserTable as U on S.UserId=U.UserId  where  from_unixtime(Time) like Date_format(?,'%Y-%m-%d%') and S.Type=? group by S.UserId;";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($Date,0));
        $i=0;
        while($attend=$stmt->fetch(PDO::FETCH_ASSOC)){
            $this->attend[$i][userid]=$attend[UserId];
            $this->attend[$i][name]=$attend[Name];
            $this->attend[$i][type]=$attend[Type];
            $this->attend[$i][time]=$attend[Time];
              $i=$i+1;
        }
        // 未登校
        $sql="select * from UserTable where UserId not in(select UserId from SchoolAttendTable where from_unixtime(Time) like Date_format(?,'%Y-%m-%d%') group by UserId)and UserId!=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($Date,"teacher"));
        while($attend=$stmt->fetch(PDO::FETCH_ASSOC)){
          $this->attend[$i][userid]=$attend[UserId];
          $this->attend[$i][name]=$attend[Name];
          $this->attend[$i][type]=3;//未投稿
          $this->attend[$i][time]=0;//未投稿

            $i=$i+1;
          }
          foreach($this->attend as $key=>$value){
                      $userid[$key]=$value["userid"];
                  }
          array_multisort($userid,SORT_ASC,$this->attend);

      }

      function StundentsAttendEnd($Date){
        $this->construct("localhost","root","soft4","pbl");
        $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
        //
        //   //下校確認
          $sql="select U.UserId,Name,S.Type,Time from SchoolAttendTable as S join UserTable as U on S.UserId=U.UserId  where  from_unixtime(Time) like Date_format(?,'%Y-%m-%d%') and S.Type=? group by S.UserId;";
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array($Date,1));
          $i=0;
          while($attend=$stmt->fetch(PDO::FETCH_ASSOC)){
            $this->attendend[$i][userid]=$attend[UserId];
            $this->attendend[$i][name]=$attend[Name];
            $this->attendend[$i][type]=$attend[Type];
            $this->attendend[$i][time]=$attend[Time];
              $i=$i+1;
        }
      // // 未登校
      $sql="select * from UserTable where UserId not in(select UserId from SchoolAttendTable where from_unixtime(Time) like Date_format(?,'%Y-%m-%d%') group by UserId)and UserId!=?";
      $stmt=$pdo->prepare($sql);
      $stmt->execute(array($Date,"teacher"));
      while($attend=$stmt->fetch(PDO::FETCH_ASSOC)){
          $this->attendend[$i][userid]=$attend[UserId];
          $this->attendend[$i][name]=$attend[Name];
          $this->attendend[$i][type]=3;//未投稿
          $this->attendend[$i][time]=0;//未投稿

            $i=$i+1;
          }
          foreach($this->attendend as $key=>$value){
                      $userid[$key]=$value["userid"];
                  }
                  //出席番号順にソート
          array_multisort($userid,SORT_ASC,$this->attendend);
      }


      //登校日変更
      function AttendChange($Flag,$Date,$start,$end){

        $this->construct("localhost","root","soft4","pbl");
        $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
        //SchoolDayTableの変更(トゥ後尾管理)
         $sql="update SchoolDayTable set SchoolDay=?,SchoolStartTime=unix_timestamp(?),SchoolEndTime=unix_timestamp(?) where Date=?;";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($Flag,$Date." ".$start,$Date." ".$end,$Date));
        //休校日（ClassAttendTableから抹消）
          if($Flag==1){
            $sql="delete from ClassAttendTable where Date=?";
            $stmt=$pdo->prepare($sql);
            $stmt->execute(array($Date));
          }
          //登校時間及び登校日の変更
          if($Flag==0){
          //一度その日のテーブルを削除
          $sql="delete from ClassAttendTable where Date=?";
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array($Date));

          //登録済みユーザーの抽出
          $sql="select * from UserTable";
          $stmt=$pdo->prepare($sql);
          $stmt->execute();
          $i=0;
          while($user=$stmt->fetch(PDO::FETCH_ASSOC)){
              $this->users[$i]=$user[UserId];
                $i=$i+1;
              }
          //登校時間に沿ってテーブルに追加
          for($i=0;$i<count($this->users);$i++){
              $sql="insert into ClassAttendTable(UserId,Date,Time,Type)values(?,?,?,?)";
              $stmt=$pdo->prepare($sql);
              if($start<="10:10"&&$end>="10:10")$stmt->execute(array($this->users[$i],$Date,1,8));
              if($start<="11:10"&&$end>="11:10")$stmt->execute(array($this->users[$i],$Date,2,8));
              if($start<="12:10"&&$end>="12:10")$stmt->execute(array($this->users[$i],$Date,3,8));
              if($start<="13:00"&&$end>="13:00")$stmt->execute(array($this->users[$i],$Date,4,8));
              if($start<="13:50"&&$end>="13:50")$stmt->execute(array($this->users[$i],$Date,5,8));
            }
          }



    }
  //夏休み、冬休み、春休みの設定
  function Vacation($date1,$date2){
      $this->construct("localhost","root","soft4","pbl");
      $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
      //休みにする
       $sql="update SchoolDayTable set SchoolDay=1 where Date  between ? and ?;";
      $stmt=$pdo->prepare($sql);
      $stmt->execute(array($date1,$date2));
      $sql="delete from ClassAttendTable where Date between ? and ?;";
     $stmt=$pdo->prepare($sql);
     $stmt->execute(array($date1,$date2));
   }

//書く授業の出席状況の表示
   function classattend($user,$date){
     $this->construct("localhost","root","soft4","pbl");
     $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
     PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
     //申請があれば申請中にするため
      //ClassAttendTableの出席状況
      $sql="select c.Type,Name,Time,u.UserId from ClassAttendTable as c join UserTable as u on c.UserId=u.UserId where u.UserId=? and Date=?;";
      $stmt=$pdo->prepare($sql);
      $stmt->execute(array($user,$date));
      $this->myattend=Array();
      $i=0;
      while($user=$stmt->fetch(PDO::FETCH_ASSOC)){
          $this->myattend[$user[Time]]=$user[Type];
          $this->myname=$user[Name];
          $this->myid=$user[UserId];
          $i=$i+1;
        }
        $sql2="select * from UserApplication where UserId=? and Date=?";
        $stmt2=$pdo->prepare($sql2);
        // $stmt2->execute(array("0K01001","2016-06-15"));
        $stmt2->execute(array($_SESSION["USERID"],$date));

        $i=0;
        while($user2=$stmt2->fetch(PDO::FETCH_ASSOC)){
            $this->myattend2[$user2[Time]]=$user2[Type];
            $this->myid2=$user2[UserId];
            // $i=$i+1;
          }
   }
   //出席状況の変更
   function classchange($user,$date,$type,$time){
     $this->construct("localhost","root","soft4","pbl");
     $pdo = new PDO ($this->dsn, $this->user, $this->pass, array(
     PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"));
      $sql="update ClassAttendTable set Type=? where Time=? and Date=? and UserId=?;";
      $stmt=$pdo->prepare($sql);
      $stmt->execute(array($type,$time,$date,$user));
   }
   //矯正リダイレクト
   function userCheck(){
     if(!isset($_SESSION["USERID"])){
     header("Location:/var/www/web/Login");
     exit;}
     if(($_SESSION["USREID"]=="teacher")){
       header("Location:/var/www/web/teacher");
       exit;
     }else{
       header("Location:/var/www/web/students");
       exit;}
   }

}


?>
