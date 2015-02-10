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
            Log In | Reversi
        </title>
        <link rel="stylesheet" type="text/css" href="../../menu.css">
    </head>
    <body>
        <h1>
            Log In
        </h1>
        <?php
            if ($result == 1):
        ?>
        <p>
            Log in completed!
        </p>
        <a href ="../index.php">
            Go home
        </a>
        <?php
            else:
        ?>
        <form method="POST" action ="login_next.php">
            User Name : <input type="text" name="name" />
            Password : <input type="password" name="pass" />
            <input type="submit" value="Log In">
        </form>
        <?php
            endif;
        ?>
    </body>
</html>