<?php
    session_start();
    if (!isset ($_SESSION["name"])) {
        header("Location: ./login/login.php");
    }
?>