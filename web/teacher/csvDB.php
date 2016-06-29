<!DOCTYPE html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

<title>ファイルアップロード</title>
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


<p><?php

if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
  if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "" . $_FILES["upfile"]["name"])) {
    chmod("" . $_FILES["upfile"]["name"], 0777);
    echo $_FILES["upfile"]["name"] . "をアップロードしました。";
  } else {
    echo "ファイルをアップロードできません。";
  }
} else {
  echo "ファイルが選択されていません。";
}


$x = 0;
$y = 0;
$file = new SplFileObject($_FILES["upfile"]["name"]);
$file->setFlags(SplFileObject::READ_CSV);
/*
 * 以下のように SplFileObject::SKIP_EMPTY フラグも設定しても
 * 空行はスキップしてくれない
 */



foreach ($file as $data) {
$x++;

@define('DB_DATABASE','pbl');
@define('DB_USERNAME','root');
@define('DB_PASSWORD','soft4');
@define('PDO_DSN','mysql:dbhost=localhost;dbname=' . DB_DATABASE);


try{
	$db = new PDO(PDO_DSN,DB_USERNAME,DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	@$db->exec("insert into UserTable(UserId,Name,Type,Password) values('$data[0]','$data[1]','0',sha1('$data[0]'))");
	echo "user added!";
	$y++;
	
	$db = null;
	
	}catch(PDOException $data){
	echo $data->getMessage();
		exit;
	}
print $y.'<br />';
}


?>
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
