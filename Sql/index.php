<?php
require("/var/www/html/Dfun/Function/SQL/Sql.php");
$errorMessage=DeleteTable(1);
echo "<meta charset=utf8>";
// echo b();
 ?>
 <doctype! html>
 <head>
 </head>
 <body>
 <form method="post" action="">
 <input type="submit" name="delete" value="データの初期化を行います">
 <?php echo $errorMessage;?>
 </form>
 </body>
 </html>
