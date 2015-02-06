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
            Log Out
        </title>
        <link rel="stylesheet" type="text/css" href="../../menu.css">
    </head>
    <body>
        <h1>
            Log Out
        </h1>
        <p>
            Complete!
        </p>
        <a href="./login.php">
            Go home
        </a>
    </body>
</html>
