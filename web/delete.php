<?php
     $game_id = $_GET["id"];
     
     require 'MySQL.php';
     
     $my = new MySQL();
     
     $my->delete($game_id);
     
    header("Location: ./index.php");
?>