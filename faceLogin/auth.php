<?php
#	file_put_contents('au', "===========\n", FILE_APPEND);
	$fp = fopen('/tmp/futa.lock', 'r');
        if (flock($fp, LOCK_EX | LOCK_NB) == FALSE) {
                die('continue');
        }   
	$data = $_POST['acceptImage'];
	$height= floor($_POST['height']);
	$width = floor($_POST['width']);
	$uploaddir = '/opt/upload/';
	$fileName = 'authimg';
	$uploadfile = $uploaddir . $fileName;
#	file_put_contents($uploadfile, base64_decode($data));
	$authSig = puzzle_fill_cvec_from_file($uploadfile);
	$imgList = scandir('/opt/upload/reg/');
	chmod('/opt/upload/authimg', 0777);
	
	shell_exec("mogrify -crop {$width}x$height+0+0 /opt/upload/authimg");
	shell_exec('mogrify -resize 200x200! /opt/upload/authimg ');
	foreach($imgList as $file) {
		if ($file == '..' || $file == '.') {
			continue;
		}
		$regSig = puzzle_fill_cvec_from_file("/opt/upload/reg/$file");
		$num = puzzle_vector_normalized_distance($authSig, $regSig);
	#	$num = shell_exec("puzzle-diff -c -t -p 10 /opt/upload/authimg /opt/upload/reg/$file");
		$num = shell_exec("puzzle-diff -c -t /opt/upload/authimg /opt/upload/reg/$file");
		$num = rtrim($num);
#		$num = abs(1 - $num);
#		file_put_contents('au', "$file:$num\n", FILE_APPEND);
		if ($num != '' && $num < 0.4) {
			echo "You are $file";
			session_start();
			$_SESSION['userid'] = $file;
			die();
		} else {
		}
	}
	echo "continue";
?>
