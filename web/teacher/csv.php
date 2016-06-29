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
    <div class="btnrighter">
      <a href="logout.php" class="btn_hvr-fade"><span>ログアウト</span></a>
      <a href="#" class="btns_hvr-fade"><span>設定</span></a>
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
		<div class="title">
			<p><strong>CSVファイルアップロード</strong></p>
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

