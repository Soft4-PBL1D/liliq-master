<?php
//登校ボタンか下校ボタンを表示させる
  function Attendance_Cheack($userId){
    error_reporting(E_ALL ^ E_NOTICE);
    session_start();
    // $userId=$_SESSION["USERID"];
    $name=$_SESSION["NAME"];
    // if(!$_SESSION["USERID"]){
      // $ip=$_SERVER["REMOTE_ADDR"];
      // $ip=$_SERVER["SERVER_NAME"];
    //  return header("location: http://{$ip}/login/login.php");
    // }
    if(!$userId)
    // if(!$_SESSION["USERID"])
      header("Location:index.php");
    $Type=""; //attend flag 1 or 0
    $message=""; //message
      try{
// DBの選択
        $pdo=new PDO("mysql:host=localhost;dbname=pbl;charset=utf8","root","soft4",
        array(PDO::ATTR_EMULATE_PREPARES=>false));
        if(!$pdo){$message="error";}
// 登下校かcheak
        $sql="select * from SchoolAttendTable where UserId=? order by Time desc limit 1;";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($userId));
        foreach($stmt as $data){
          $Type=$data["Type"];
          $Time=date("Y-m-d H:i:s",$data["Time"]);
        }
//DB Error
      }catch (PDOException $e) {
        exit('database session error。'.$e->getMessage());
        $errorMessage="database error";
            }
      return array($Type,$Time);
      }

//登校処理
function Attendance_School($userId){
  error_reporting(E_ALL ^ E_NOTICE);
  session_start();
  // $name=$_SESSION["NAME"];
  // $userId=$_SESSION["USERID"];
  // if(!$_SESSION["USERID"]){
    // $ip=$_SERVER["REMOTE_ADDR"];
  //return header("location: http://{$ip}/login/login.php");
  // }
  $Type="1"; //attend flag 1 or 0
  $message=""; //message
    try{
// DBの選択
      $pdo=new PDO("mysql:host=localhost;dbname=pbl;charset=utf8","root","soft4",
      array(PDO::ATTR_EMULATE_PREPARES=>false));
      if(!$pdo){$message="error";}
//登校済みかcheak
// $sql="select * from SchoolAttendTable inner join UserTable on SchoolAttendTable.UserId=UserTable.UserId where SchoolAttendTable.UserId=? order by Time desc limit 1";

      $sql="select * from SchoolAttendTable where UserId=? order by Time desc limit 1;";
      $stmt=$pdo->prepare($sql);
      $stmt->execute(array($userId));
      foreach($stmt as $data){
      $Type=$data["Type"];
      $Name=$data["Name"];
      $Time=date("Y-m-d H:i",$data["Time"]);
    }
//DBに投稿時間を書き込む
    if($Type=="1"||$Type=null){
        $Time=date("Y-m-d H:i:s",time()); //NowTime;
        $sql="insert into SchoolAttendTable(UserId,Time,Type,Checking)values(?,?,?,?)";
        $stmt=$pdo->prepare($sql);
        // $stmt->execute(array("0K01001",time(),"0","0"));
        $stmt->execute(array($userId,time(),"0","0"));
        // $message=$Time."に<br>".$Name."さん登校しました<br>";
        //出席画面パス

//DBに投稿時間を書きこまれいていたら投稿時間を出力
      }
//DB Error
      }catch (PDOException $e) {
        exit('database session error。'.$e->getMessage());
        $errorMessage="database error";
            }
      return $message;
      }
// }

//下校処理

function Leave_School($userId){
  error_reporting(E_ALL ^ E_NOTICE);
  session_start();
  $Type="0"; //attend flag 1 or 0
  $message=""; //message
    try{
      $pdo=new PDO("mysql:host=localhost;dbname=pbl;charset=utf8","root","soft4",
      array(PDO::ATTR_EMULATE_PREPARES=>false));
      if(!$pdo){$message="error";}
//下校済みかcheak
      $sql="select * from SchoolAttendTable where UserId=? order by Time desc limit 1;";
      // $sql="select * from SchoolAttendTable inner join UserTable on SchoolAttendTable.UserId=UserTable.UserId where SchoolAttendTable.UserId=? order by Time desc limit 1";
      $stmt=$pdo->prepare($sql);
      $stmt->execute(array($userId));
      foreach($stmt as $data){
      $Type=$data["Type"];
      // $name=$data["Name"]
      $time=date("Y-m-d H:i",$data["Time"]);
    }
//DBに下校時間を書き込む
    if($Type=="0"){
        $Time=date("Y-m-d H:i:s",time()); //NowTime;
        $sql="insert into SchoolAttendTable(UserId,Time,Type,Checking)values(?,?,?,?)";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($userId,time(),"1","1"));
//DBに下校時間を書きこまれいていたら下校時間を出力
      }
      // else if($Type==1){
        //$message=$time."に\n".$userId."さん下校済み<br>登校ボタンを押してください";
    //}
      }catch (PDOException $e) {
        exit('database session error。'.$e->getMessage());
        $errorMessage="database error";
            }
      return $message;
      }

?>
