<?php
function DeleteTable($i){
  error_reporting(E_ALL ^ E_NOTICE);
    session_start();
    $errorMessage = "";
    //教師IDでログインされていない場合はログイン画面に戻す
//    if($_SESSION["TYPE"]!=1)
  //    header("Location:/Dfun/login/login.php");
    // escappecheck
    // login_submit
    if (isset($_POST["delete"])&&isset($_SESSION["USERID"])&&$_SESSION["USERID"]=="teacher"){
        //現在時間
        $nowTime=date("Y-m-d : H:i:s",time());
          //テストデータ
          //$nowTime=date("Y-m-d : H:i:s",strtotime("+1 year 03/01"));
        //削除可能時間
        $deleteTime=date("Y-m-d : H:i:s",strtotime("+1 year 03/01"));
      //来年度の１っヶ月前より削除可能
    if($nowTime>=$deleteTime){
        try{
          // db session
        //ホストAddr　データーベースの選択
          $dsn="mysql:host=localhost;dbname=Users;charset=utf8";
        //データーベースのIDとPass
          $loginName="root";
          $loginPass="root";
          $pdo= new PDO($dsn,$loginName,$loginPass);
        //テーブル名を配列に入れ削除するSQL文
          $sql=array("UserTable","SchoolAttendTable","ClassAttendTable","FaceTable");
          $count=count($sql);
          foreach($sql as $key => $value){
            $Sql="delete from $value";
            $stmt=$pdo->prepare($Sql);
            $stmt->execute();
          }
        $errorMessage="すべてのデータを削除しました";
        } catch (PDOException $e) {
            exit('database session error。'.$e->getMessage());
            $errorMessage="database error";
          }
        }
        else
        $errorMessage="新年度の１ヶ月前(03/01)より削除が可能になります";
      }
      return $errorMessage;
}

function a(){
  $i=3;
  return $i;
}
function b(){
  // require("delete.php");
  $i=a();
  $i=$i+1;
  return $i;
}
?>
