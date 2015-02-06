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
        <p>
            静岡産業技術専門学校　みらい情報科　土井一闘
        </p>
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