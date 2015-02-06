<?php
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    
    date_default_timezone_set('Asia/Tokyo');
    
    require 'MySQL.php';
    
    $my = new MySQL();
    
    $my->update($name, $pass);
    
    header("Location: ./index.php");
?>