<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <title>
            ユーザー削除|リバーシ
        </title>
        <link rel="stylesheet" type="text/css" href="../menu.css">
    </head>
    <body>
        <?php
            
            require 'MySQL.php';
            
            $my = new MySQL();
            $name = $_GET["name"];
            
            readData1($my, $name);
            
            function readData1($my, $name) {
                print("<table class='tbl'>");
                print("<tr>");
			    print("<th class='head'>name</th><th class='head'>pass</th><th class='head'>編集</th><th class='head'>削除</th>");
                print("</tr>");
                
                $result = $my->select($name);
                if ($result) {
                    while($row = $result->fetch_object()) {
                        $row_name = htmlspecialchars($row->name);
			            $pass = htmlspecialchars($row->pass);
			            print("<tr>");
			            print("<td class='<%=cls%>' width='200' style='text-align:center'>$row_name</td>");
			            print("<td class='<%=cls%>' width='200' style='text-align:center'>$pass</td>");
			            print("<td class='<%=cls%>' width='120' style='text-align:center'><a href = 'edit.php?name=$row->name')>編集</a></td>");
			            print("<td class='<%=cls%>' width='120' style='text-align:center'><a href = 'delete_next.php?name=$row->name')>削除</a></td>");
			            print("</tr>");
                    }
                }
            }
        ?>
    </body>
</html>