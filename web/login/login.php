<?php
    
    require 'Users.php';
    $users = new Users();
    
    $result = $users->logincheck();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>
            ログイン|リバーシ
        </title>
        <link rel="stylesheet" type="text/css" href="../menu.css">
    </head>
    <body>
        <h1>
            ログイン
        </h1>
        <?php
            if ($result == 1):
        ?>
        <p>
            ログイン済み
        </p>
        <a href ="../index.php">
            掲示板へ
        </a>
        <?php
            else:
        ?>
        <form method="POST" action ="login_next.php">
            ユーザー名 : <input type="text" name="name" />
            パスワード : <input type="password" name="pass" />
            <input type="submit" value="ログイン">
        </form>
        <?php
            endif;
        ?>
    </body>
</html>