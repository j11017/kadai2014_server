<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>
			J11017
		</title>
		<link rel="stylesheet" type="text/css" href="../menu.css">
	</head>
	<body>
		<a href="./add.php">新規</a>
		<?php
		    
		    require 'MySQL.php';
		    
		    $my = new MySQL();
				
			function readData($my) {
			    print("<table class='tbl'>");
			    print("<tr>");
			    print("<th class='head'>name</th><th class='head'>pass</th><th class='head'>編集</th><th class='head'>削除</th>");
			    print("</tr>");
			    
			    $result = $my->selectAll();
			    if ($result) {
			        while($row = $result->fetch_object()) {
			            $name = htmlspecialchars($row->name);
			            $pass = htmlspecialchars($row->pass);
			            print("<tr>");
			            print("<td class='<%=cls%>' width='200' style='text-align:center'>$name</td>");
			            print("<td class='<%=cls%>' width='200' style='text-align:center'>$pass</td>");
			            print("<td class='<%=cls%>' width='120' style='text-align:center'><a href = 'edit.php?name=$row->name')>編集</a></td>");
			            print("<td class='<%=cls%>' width='120' style='text-align:center'><a href = 'delete.php?name=$row->name')>削除</a></td>");
			            print("</tr>");
			        }
			    }
			}
			
			readData($my);
		?>
	</body>
</html>