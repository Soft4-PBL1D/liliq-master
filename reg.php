<?php
	$data = $_POST['acceptImage'];
	$uid = $_POST['uid'];
	$height= $_POST['height'];
	$width = $_POST['width'];
	$uploaddir = '/opt/upload/reg/';
	$fileName = $uid;
	$uploadfile = $uploaddir . $fileName;
	file_put_contents($uploadfile, base64_decode($data));
	chmod($uploadfile, 0777);
	shell_exec("mogrify -crop {$width}x$height+0+0 $uploadfile");
	shell_exec("mogrify -geometry 200x200! $uploadfile");
?>
