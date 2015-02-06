<?php
    require 'Users.php';
    $my = new Users();
    
    $status = "";
    if (isset($_SESSION["register"])) {
        $status = $_SESSION["register"];
    }
    $my->logout();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>User Registration</title>
    <script src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
    <script src="check.js"></script>
    <link rel="stylesheet" type="text/css" href="../../menu.css">
  </head>
  <body>
    <h1>User Registration</h1>
    <?php if($status == "ok"): ?>
      <p>Registration Completed!</p>
	  <A Href="./index.php">User List</A>
    <?php elseif($status == "failed"): ?>
      <p>Error：This username already exists.</p>
    
    <?php else: ?>
      <p>
        <?php print("$status"); ?>
      </p>
    <?php endif; ?>
	
	<form method="POST" action="add_next.php">
		Username：<input type="text" name="name" />
        Password：<input type="password" name="pass" />
        <input type="submit" value="Registration" />
    </form>

	
  </body>
</html>
