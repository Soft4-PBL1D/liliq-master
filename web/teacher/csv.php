<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新年度登録機能</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/kawanishi.css">
  <link rel="stylesheet" type="text/css" href="css/icon.css">
</head>
<body>


<div id="header">
  <div class="iti">
    <div class="logo"></div>
    <div class="btnrighter" style="width:700px;position:relative;">
      <a href="../Login/logout.php" class="btn_hvr-fade"><span>ログアウト</span></a>
    <a href="LongHoliday.php" class="btns_hvr-fade"><span>長期休暇登録</span></a>
    <a href="csv.php" class="btns_hvr-fade"><span>新年度登録</span></a>
		<a href="../Login/password.php" class="btns_hvr-fade"><span>パスワード変更</span></a>
    </div>
  </div>
</div>

<div class="seet">
  <div class="seetco">
    <h2>教員用ページ</h2>
    <p>新年度登録機能</p>
  </div>

</div>

<div class="page">
<div class="coram">


  <div class="wn">

	<div class="note">


    <a href="teacher.php" style="display:block;margin-bottom:20px;background:#ddd;width:90px;padding:5px;text-align:center;border:1px solid #666;text-decoration:none;border-radius:1px;">&laquo; 戻る</a>
		<div class="title">
			<h2>CSVファイルアップロード</h2>
		</div>
		<form action="csvDB.php" method="post" enctype="multipart/form-data">

		<input type="file" name="upfile" size="30" /><br />
		<input type="submit" value="アップロード" />
</form>


    </div><!-- note -->
  </div><!-- wn -->


  <div class="wn">
    <div class="note">
      &copy; 2016 Dfun.
    </div>
  </div>


</div>
</div>

</body>
</html>
