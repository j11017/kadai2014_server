<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <title>
            新規ユーザー登録|リバーシ
        </title>
        <link rel="stylesheet" type="text/css" href="../menu.css">
    </head>
    <body>
<?php
     $name = $_POST['name'];
     $pass = $_POST['pass'];
     
     date_default_timezone_set('Asia/Tokyo');
     
     require 'MySQL.php';
     
     $my = new MySQL();

     $rows = $my->nameCheck($name);
     
     if ($rows != 0) {
         print("nameが重複しています<br /><br />");
         print("<a href='./add.php'>戻る</a>");
     } else {
         $my->add($name, $pass);
         header("Location: ./index.php");
     }
?>
</body>
</html>