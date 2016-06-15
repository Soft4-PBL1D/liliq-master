<?php
function Login(){
error_reporting(E_ALL ^ E_NOTICE);
  session_start();
  //login->OK = main jamp
  if($_SESSION["USERID"])
    header("Location:Attend.php");
  // errMS
  $errorMessage = "";
  // escappecheck
  $viewUserId = htmlspecialchars($_POST["userid"], ENT_QUOTES);

  // login_submit
  if (isset($_POST["login"])&&isset($_POST["userid"])&&isset($_POST["password"])) {
      // db session
      try{
          $pdo=new PDO("mysql:host=localhost;dbname=pbl;charset=utf8","root","soft4",
        array(PDO::ATTR_EMULATE_PREPARES=>false));
        $sql="select * from UserTable where UserId=? and Password=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($_POST['userid'],SHA1($_POST['password'])));
        while($kari=$stmt->fetch(PDO::FETCH_ASSOC)){
          $user[0]=$kari[UserId];
          $user[1]=$kari[Password];
          $user[2]=$kari[Type];
          $user[3]=$kari[Name];

        }
      } catch (PDOException $e) {
          exit('database session error。'.$e->getMessage());
          $errorMessage="database error";
          // $login="login.php";
        }
    // loginOK
    if ($_POST["userid"] == $user[0] && SHA1($_POST["password"]) == $user[1]) {
      // sessionID_create
      // session_regenerate_id(TRUE);
      if(strstr(SHA1($_POST["userid"]),SHA1($_POST["password"]))):
        $_SESSION["JAMP"]="1";
        header("Location:../Log/password.php");
        exit;
      endif;
      $_SESSION["USERID"] = $_POST["userid"];
      $_SESSION["NAME"]=$user[3];
      if($_SESSION["USERID"]!="teacher"){
          header("Location:Attend.php");
      }
      // exit;
      else {
        $errorMessage = "ユーザーIDまたはパスワードが入力されていません";
      }
    }
    else {
      $errorMessage = "ユーザーIDまたはパスワードが間違えています";
    }
    return $errorMessage;
  }
}


function Logout(){
  error_reporting(E_ALL ^ E_NOTICE);
  session_start();
  if (isset($_SESSION["USERID"])) {
    $errorMessage = "Logout--";
  }
  else {
    $errorMessage = "Session_Time_out";
  }
  // sessionclear
  $_SESSION = array();
  //cukkiedestroy
  if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
          $params["path"], $params["domain"],
          $params["secure"], $params["httponly"]
      );
  }
  // sessionclear
  session_destroy();
  // return header("Refresh:5;URL=index.php");

}
?>
