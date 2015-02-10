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
    <title>新規ユーザー登録|リバーシ</title>
    <script src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
    <script src="check.js"></script>
    <link rel="stylesheet" type="text/css" href="../menu.css">
  </head>
  <body>
    <h1>新規登録</h1>
    <?php if($status == "ok"): ?>
      <p>登録完了</p>
	  <A Href="./index.php">ユーザ一覧へ</A>
    <?php elseif($status == "failed"): ?>
      <p>エラー：既に存在するユーザ名です。</p>
    
    <?php else: ?>
      <p>
        <?php print("$status"); ?>
      </p>
    <?php endif; ?>
	
	<form method="POST" action="add_next.php">
		ユーザ名：<input type="text" name="name" />
        パスワード：<input type="password" name="pass" />
        <input type="submit" value="登録" />
    </form>

	
  </body>
</html>
