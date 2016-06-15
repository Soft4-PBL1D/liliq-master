<?php
function yesterdayCheack(){
require("../SchoolAttendFunction/SchoolAttend.php");
// date("Y-m-d :H:i:s",time());
list($Type,$Time)=Attendance_Cheack();


if($Type==0){
  try{
    $pdo=new PDO("mysql:host=localhost;dbname=Users;charset=utf8","root","root",
    array(PDO::ATTR_EMULATE_PREPARES=>false));
    if(!$pdo){$message="error";}
//下校済みかcheak
    $sql="update ShcoolAttendTabel set Type=? where Type=0"
    $sql="select * from SchoolAttendTable where Type=?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(1));
    // foreach($stmt as $data){
    // $Type=$data["Type"];
    // $time=date("Y-m-d H:i",$data["Time"]);
  }
    }catch (PDOException $e) {
      exit('database session error。'.$e->getMessage());
      $errorMessage="database error";
          }

}
}

yesterdayCheak();
?>
