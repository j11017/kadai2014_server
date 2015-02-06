<?php
$mode = intval($_POST["mode"]);
$start_time = $_POST["start_time"];
$end_time = $_POST["end_time"];
$turn = array_fill(0, 60, 0);
$position = array_fill(0, 60, 0);
$evaluation_value = array_fill(0, 60, 0);
$time = array_fill(0, 60, 0);
$turn[0] = intval($_POST["turn0"]);
for($i = 0; $i < 60; ++$i) {
	$turn[$i] = intval($_POST["turn".$i]);
	$position[$i] = intval($_POST["position".$i]);
	$evaluation_value[$i] = intval($_POST["evaluation_value".$i]);
	$time[$i] = $_POST["time".$i];
}
$link = mysqli_connect('localhost', 'j11017', 'j11017');
if (!$link) {
    die('接続失敗です。'.mysqli_error($link));
}
$db_selected = mysqli_select_db($link, 'j11017');
if (!$db_selected){
    die('データベース選択失敗です。'.mysqli_error($link));
}
//mysqli_set_charset('utf8');

$sql = "INSERT INTO games VALUES (NULL, $mode, cast('$start_time' as datetime), cast('$end_time' as datetime))";
$result_flag = mysqli_query($link, $sql);
$sql = "SET @game_id := LAST_INSERT_ID()";
mysqli_query($link, $sql);

if (!$result_flag) {
    die('INSERTクエリーが失敗しました。'.mysqli_error($link));
}


for($i = 0; $i < count($position); ++$i) {
	$sql = "INSERT INTO records VALUES (@game_id, $i, $turn[$i], $position[$i], $evaluation_value[$i], cast('$time[$i]' as datetime))";
	$result_flag = mysqli_query($link, $sql);
}
if (!$result_flag) {
    die('INSERTクエリーが失敗しました。'.mysqli_error($link));
}

$close_flag = mysqli_close($link);
if ($close_flag){
    print('OK');
}
?>
