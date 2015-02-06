<html>
<head><title>Reversi | Game List</title>
<meta charset="UTF-8">
<?php include 'menu.php' ?>
<link rel="stylesheet" type="text/css" href="../menu.css">

<?php
	require './login/check.php';
	//MySQL.phpの取り込み
	require '../MySQL.php';
	
	//インスタンス生成
	$my = new MySQL();
?>

</head>
<!-- 1.色をつけてみよう-->
<body>
<h1>Game List</h1>
<?php  //PHPの始まり
	
	readData($my);

function readData($my){
	print("<table class='tbl'>");
	print("<tr>");
	print("<th class='head'>Game ID</th><th class='head'>Game Mode</th><th class='head'>Start Time</th><th class='head'>End Time</th><th class='head'>View</th><th class='head'>Delete</th>");
	print("</tr>");

	$result = $my->selectAll('games');
	if($result){
		//1行ずつ取り出し
		$columnCount = 0;
		while($row = $result->fetch_object()){
			$mode = getModeName(htmlspecialchars($row->mode));
            $start_time = htmlspecialchars($row->start_time);
            $end_time = htmlspecialchars($row->end_time);
			print("<tr>");
			print("<td class='<%=cls%>' width='120' style='text-align:center'>$row->game_id</td>");
			print("<td class='<%=cls%>' width='200' style='text-align:center'>$mode</td>");
			print("<td class='<%=cls%>' width='200' style='text-align:center'>$start_time</td>");
			print("<td class='<%=cls%>' width='200' style='text-align:center'>$end_time</td>");
			print("<td class='<%=cls%>' width='120' style='text-align:center'><a href = 'view.php?id=$row->game_id')>View</a></td>");
			print("<td class='<%=cls%>' width='120' style='text-align:center'><a href = 'delete.php?id=$row->game_id')>Delete</a></td>");
			print("</tr>");
			
			$columnCount++;
		
  		}
	}
	
	print("</table>");

}

function getModeName($mode) {
	switch($mode) {
	case 0:
		return "Human vs. CPU";
	case 1:
		return "CPU vs. Human";
	case 2:
		return "Human vs. Human";
	case 3:
		return "CPU vs. CPU";
	}
	return "Unknown";
}

//PHPの終了  
?>

</body>
</html>
