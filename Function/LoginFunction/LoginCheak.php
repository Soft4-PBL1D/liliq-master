<?php

function teacherCheak(){
  if(!isset($_SESSION)){
session_start();
}
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
  if(!isset($_SESSION)){
  session_start();
  }
  // login_cheack
    if (!isset($_SESSION["USERID"])){
      header("Location:../Login/login.php");
      exit;
    }else if($_SESSION["TYPE"]=="1"){
      header("Location:../teacher/teacher.php");
      exit;
    }
}
function Jamp(){
    error_reporting(E_ALL ^ E_NOTICE);
    if(!isset($_SESSION)){
session_start();
}
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
