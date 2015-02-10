<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>
			ユーザー編集|リバーシ
		</title>
		<script src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
		<script src="check.js"></script>
		<link rel="stylesheet" type="text/css" href="../menu.css">
	</head>
	<body bgcolor="#880000" text = "#FFFF00">
		
		<?php
            
            require 'MySQL.php';
            
            $my = new MySQL();
            $name_id = $_GET["name"];
            
            $result = $my->select($name_id);
            if ($result) {
                while($row = $result->fetch_object()) {
                    $name = htmlspecialchars($row->name);
			        $pass = htmlspecialchars($row->pass);
                }
            }
        ?>
		
		</form>
		<form method="POST" action="edit_next.php">
            name:<input type="text" name="name" value = "<?php echo $name; ?>"><br>
            pass:<input type="text" name="pass" value = "<?php echo $pass; ?>"><br><br>
            <input type="submit" name="btn1" value="投稿する">
        </form>
    </body>
</html>