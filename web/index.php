<html>
<head><title>リバーシ</title>
<meta charset="UTF-8">
<?php include 'menu.php' ?>
<link rel="stylesheet" type="text/css" href="menu.css">

<?php
	require './login/check.php';
	//MySQL.phpの取り込み
	require 'MySQL.php';
	
	//インスタンス生成
	$my = new MySQL();
?>

</head>
<!-- 1.色をつけてみよう-->
<body>
<h1>ゲーム一覧</h1>
<?php  //PHPの始まり
	
	readData($my);

function readData($my){
	print("<table class='tbl'>");
	print("<tr>");
	print("<th class='head'>ゲームID</th><th class='head'>ゲームモード</th><th class='head'>開始時刻</th><th class='head'>終了時刻</th><th class='head'>閲覧</th><th class='head'>削除</th>");
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
			print("<td class='<%=cls%>' width='120' style='text-align:center'><a href = 'view.php?id=$row->game_id')>閲覧</a></td>");
			print("<td class='<%=cls%>' width='120' style='text-align:center'><a href = 'delete.php?id=$row->game_id')>削除</a></td>");
			print("</tr>");
			
			$columnCount++;
		
  		}
	}
	
	print("</table>");

}

function getModeName($mode) {
	switch($mode) {
	case 0:
		return "人間 vs. CPU";
	case 1:
		return "CPU vs. 人間";
	case 2:
		return "人間 vs. 人間";
	case 3:
		return "CPU vs. CPU";
	}
	return "不明";
}

//PHPの終了  
?>

</body>
</html>
