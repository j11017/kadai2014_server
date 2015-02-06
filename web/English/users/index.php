<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>
			J11017
		</title>
		<link rel="stylesheet" type="text/css" href="../../menu.css">
	</head>
	<body>
		<a href="./add.php">New User</a>
		<?php
		    
		    require 'MySQL.php';
		    
		    $my = new MySQL();
				
			function readData($my) {
			    print("<table class='tbl'>");
			    print("<tr>");
			    print("<th class='head'>Name</th><th class='head'>Password</th><th class='head'>Edit</th><th class='head'>Delete</th>");
			    print("</tr>");
			    
			    $result = $my->selectAll();
			    if ($result) {
			        while($row = $result->fetch_object()) {
			            $name = htmlspecialchars($row->name);
			            $pass = htmlspecialchars($row->pass);
			            print("<tr>");
			            print("<td class='<%=cls%>' width='200' style='text-align:center'>$name</td>");
			            print("<td class='<%=cls%>' width='200' style='text-align:center'>$pass</td>");
			            print("<td class='<%=cls%>' width='120' style='text-align:center'><a href = 'edit.php?name=$row->name')>Edit</a></td>");
			            print("<td class='<%=cls%>' width='120' style='text-align:center'><a href = 'delete.php?name=$row->name')>Delete</a></td>");
			            print("</tr>");
			        }
			    }
			}
			
			readData($my);
		?>
	</body>
</html>