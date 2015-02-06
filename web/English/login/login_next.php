<?php
    
    $name = $_POST["name"];
    $pass = $_POST["pass"];
    
    require "Users.php";
    $users = new Users();
    
    $result = $users->login($name, $pass);
    
    if ($result == 1) {
        header("Location: ../index.php");
    } else if ($result == 2) {
        header("Location: ../index.php");
    }else if ($result == 0) {
        header("Location: ./login_err.html");
    }else {
        print("status == else");
    }
?>