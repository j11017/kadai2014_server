<?php
    require 'Users.php';
    $my = new Users();
    $my->logout();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>
            ログアウト
        </title>
        <link rel="stylesheet" type="text/css" href="../menu.css">
    </head>
    <body>
        <h1>
            ログアウト
        </h1>
        <p>
            完了
        </p>
        <a href="./login.php">
            ホーム
        </a>
    </body>
</html>
