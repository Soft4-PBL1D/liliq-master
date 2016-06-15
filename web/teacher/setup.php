<html>
<meta charset="utf-8">
<script>
window.onload = function(){
	$(function() {
		$("#loading").fadeOut();
		$("#container").fadeIn();
	});
}
</script>
<body>
<div id="loading"><img src="setup.gif"></div>
<div id="container">
　〜データーベースを登録中です〜
<?php
exec("nohup php -c '' 'SDT_SAT_setup.php' > /dev/null &");
?>
</div>
</body>
</html>
