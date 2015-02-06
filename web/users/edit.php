<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>
			J11017
		</title>
		<link rel="stylesheet" type="text/css" href="../menu.css">
	</head>
	<body bgcolor="#880000" text = "#FFFF00">
		<p>
			静岡産業技術専門学校　みらい情報科　土井一闘
		</p>
		
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