<?php
	$data = $_POST['acceptImage'];
	$uploaddir = '/opt/upload/';
	$fileName = 'authimg';
	$uploadfile = $uploaddir . $fileName;
	file_put_contents($uploadfile, base64_decode($data));

	$authSig = puzzle_fill_cvec_from_file($uploadfile);
	$regSig = puzzle_fill_cvec_from_file($uploaddir.'regimg');
	echo puzzle_vector_normalized_distance($authSig, $regSig);
?>
