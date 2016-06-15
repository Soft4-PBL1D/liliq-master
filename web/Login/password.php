<?php require("/var/www/Function/LoginFunction/Logindb.php");
      require("/var/www/Function/LoginFunction/LoginCheak.php");
      $comment=password();?>

<!DOCTYPE html>


<head>
  <meta charset="utf-8">
  <title>パスワード変更</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div id="header">
  <div class="coram">
    <div class="logo"></div>
    <div class="btnrighter">
      <a href="logout.php" class="btn_hvr-fade"><span>ログアウト</span></a>
      <a href="#" class="btns_hvr-fade"><span>設定</span></a>
    </div>
  </div>
</div>

<div class="page">
<div class="coram">



  <div class="wn">
    <div class="excla note2">
      <h2 style="font-size:27px;">パスワード変更</h2>
      <h2>パスワードを変更してください。</h2>
    </div>
    <div class="note">
        <p>変更後のパスワードは、６文字以上１０文字以下である必要があります。</p>
        <form method="post" action="">
          <!-- パスワードを変更したらテキストフィールドを 隠し指定時間後トップ画面に繊維 -->
          <?php
            if(strstr(SHA1($_SESSION["USERID"]),$_SESSION["PASSWORD"])){?>


              <input type="password" placeholder="パスワードを入力してください" name="password"><br>
              <input type="password" placeholder="確認用パスワードを入力してください" name="passwordcheck"><br>
              <p>　</p>
              <input type="submit" name="passcheck" values="submit" class="kotei_hvr-fade">


          <?php
          }
              echo $comment;
         ?>
    </div>
  </div>




  <div class="wn">
    <div class="note">
      &copy; 2016 Dfun.
    </div>
  </div>






</div>
</div>

</body>
</html>
