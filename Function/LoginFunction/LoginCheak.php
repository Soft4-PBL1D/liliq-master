<?php

function teacherCheak(){
  session_start();
  // login_check teacherONLY
    if (!isset($_SESSION["USERID"])){
        header("Location:../Login/login.php");
        exit;
    }else if($_SESSION["TYPE"]!="1"){
      header("Location:../students/students.php");
      exit;
    }
}
function studentsCheak(){
  session_start();
  // login_cheack
    if (!isset($_SESSION["USERID"])&&($_SESSION["USERID"]!=$_SESSION["PASSWORD"])){
      header("Location:login.php");
      exit;
    }else if($_SESSION["TYPE"]=="1"&&$_SESSION["USERID"]!=$_SESSION["PASSWORD"]){
      header("Location:../teacher/teacher.php");
      exit;
    }
}
function Jamp(){
    error_reporting(E_ALL ^ E_NOTICE);
    session_start();
    //login->OK = main jamp
    if($_SESSION["TYPE"]==0){
      header("Refresh:3,URL:../students/students.php");
    // header("Location:students.php");
    exit;
  }
    if($_SESSION["TYPE"]==1){
        // header("Location:teacher.php");
        header("Refresh:3,URL:../teacher/teacher.php");
    exit;
  // }else{
    // header("Refresh:3,URL:index.php");
    // header("Location:index.php");
  // exit;
}
}
?>
