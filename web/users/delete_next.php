<?php
     $name = $_GET["name"];
     
     require 'MySQL.php';
     
     $my = new MySQL();
     
     $my->delete($name);
     
     header("Location: ./index.php");
?>