<html>
<head><title>リバーシ</title>
<meta charset="UTF-8">
<?php include 'menu.php' ?>
<link rel="stylesheet" type="text/css" href="menu.css">


<?php
	require './login/check.php';
	require 'MySQL.php';
	
	$my = new MySQL();
	$id = $_GET["id"];
	
	$evaluationValueList[] = array();
	$evaluationValueListToJs;
	$loopCount = 0;
	$boardOnDiscs;
	$boardOnDiscsToJs;
?>

</head>
<body onLoad="drawBoard(0)">
<h1>手一覧</h1>
<?php
	
	readData($my, $id);

function readData($my, $id){
	print("<table class='tbl'>");
	print("<tr>");
	print("<th class='head'>ゲームID</th><th class='head'>手数</th><th class='head'>手番</th><th class='head'>指し手</th><th class='head'>評価値</th><th class='head'>時刻</th>");
	print("</tr>");

	$result = $my->select_record($id);
	if($result){
		global $evaluationValueList;
		global $evaluationValueListToJs;
		global $loopCount;
		global $boardOnDiscs;
		global $boardOnDiscsToJs;
		$evaluationValueListToJs = "[0,";
		$turnArray = array();
		$posTurnArray = array();
		$posArray2 = array();
		$posArray = array($posTurnArray, $posArray2);
		while($row = $result->fetch_object()){
			$move = intval($row->move) + 1;
			$turnArray[$loopCount] = htmlspecialchars($row->turn);
			$turnName = getTurnName(htmlspecialchars($row->turn));
			$posArray[$loopCount][0] = getPositionY(htmlspecialchars($row->position));
			$posArray[$loopCount][1] = getPositionX(htmlspecialchars($row->position));
            $position = getPosition(htmlspecialchars($row->position));
            $evaluationValue = $row->evaluation_value;
            $evaluationValueList[$loopCount] = $evaluationValue;
            $evaluationValueListToJs .= $evaluationValue.",";
            $time = htmlspecialchars($row->time);
			print("<tr>");
			print("<td class='<%=cls%>' width='120' style='text-align:center'>$row->game_id</td>");
			print("<td class='<%=cls%>' width='200' style='text-align:center'>$move</td>");
			print("<td class='<%=cls%>' width='200' style='text-align:center'>$turnName</td>");
			print("<td class='<%=cls%>' width='200' style='text-align:center'>$position</td>");
			print("<td class='<%=cls%>' width='120' style='text-align:center'>$evaluationValue</td>");
			print("<td class='<%=cls%>' width='120' style='text-align:center'>$time</td>");
			print("</tr>");
			$loopCount++;
  		}
  		$evaluationValueListToJs .= "]";
  		$boardOnDiscs = calcBoard($loopCount, $turnArray, $posArray);
  		$boardOnDiscsToJs = "[";
  		for($i = 0; $i <= $loopCount; ++$i) {
  			$tmpBoardOnDiscsToJs = "";
  			foreach($boardOnDiscs[$i] as $t1) {
  				$tStr1 = "";
  				foreach($t1 as $val) {
  					$tStr1.= (($tStr1 == "") 
  						? ""
  						: ","
  					)."{$val}";
  				}
  				$tmpBoardOnDiscsToJs.= (($tmpBoardOnDiscsToJs == "")
  					? ""
  					: ","
  				).(($tStr1 == "")
  					? ""
  					: "[{$tStr1}]"
  				);
  			}
  			if($i == $loopCount) {
  				$boardOnDiscsToJs.= "[".$tmpBoardOnDiscsToJs."]";
  			} else {
  				$boardOnDiscsToJs.= "[".$tmpBoardOnDiscsToJs."]".",";
  			}
  		}
  		$boardOnDiscsToJs = $boardOnDiscsToJs."]";
	}
	
	print("</table>");

}

function getTurnName($turn) {
	switch($turn) {
	case 1:
		return "先手";
	case 2:
		return "後手";
	}
	return "不明";
}

function getPosition($position) {
	$pos = intval($position);
	$xPos = array("a", "b", "c", "d", "e", "f", "g", "h");
	$string = $xPos[$pos % 8];
	$string .= intval($pos / 8) + 1;
	return $string;
}

function getPositionX($position) {
	$pos = intval($position);
	return $pos % 8;
}

function getPositionY($position) {
	$pos = intval($position);
	return $pos / 8;
}

function putDisc(&$boardOnDiscs, $pos, $turn) {
	for($i = -1; $i <= 1; ++$i) {
		for($j = -1; $j <= 1; ++$j) {
			if(!($i == 0 && $j == 0)) {
				$direction = array();
				$direction[0] = $i;
				$direction[1] = $j;
				reverseDisc($boardOnDiscs, $pos, $direction, $turn);
			}
		}
	}
	$boardOnDiscs[$pos[0]][$pos[1]] = getIntTurn($turn);
}

function countDiscs($boardOnDiscs) {
		$sum = array();
		$sum[0] = 0;
		$sum[1] = 0;
		for($i = 0; $i < 8; ++$i) {
			for($j = 0; $j < 8; ++$j) {
				if($boardOnDiscs[$i][$j] == BLACK_DISC)
					++$sum[0];
				else if($boardOnDiscs[$i][$j] == WHITE_DISC)
					++$sum[1];
			}
		}
		return $sum;
	}
	
function reverseDisc(&$boardOnDiscs, $pos, $direction, $turn) {
	$yPos = $pos[0] + $direction[0];
	$xPos = $pos[1] + $direction[1];
	$num = 0;
	while($yPos >= 0 && $yPos < 8 && $xPos >= 0 && $xPos < 8) {
		if($boardOnDiscs[$yPos][$xPos] == getAnotherIntTurn($turn)) {
			++$num;
		} else if($boardOnDiscs[$yPos][$xPos] == getIntTurn($turn)) {
			$yPos = $pos[0];
			$xPos = $pos[1];
			for($i = 0; $i < $num; ++$i) {
				$yPos += $direction[0];
				$xPos += $direction[1];
				$boardOnDiscs[$yPos][$xPos] = getIntTurn($turn);
			}
			return $boardOnDiscs;
		} else {
			return $boardOnDiscs;
		}
		$yPos += $direction[0];
		$xPos += $direction[1];
	}
	return $boardOnDiscs;
}
	
function getIntTurn($turn) {
	return ($turn == 1) ? BLACK_DISC : WHITE_DISC;
}

function getAnotherIntTurn($turn) {
	return ($turn == 1) ? WHITE_DISC : BLACK_DISC;
}

function calcBoard($N, $turn, $pos) {
	define("BLANK", 0);
	define("BLACK_DISC", 1);
	define("WHITE_DISC", 2);
	
	$boardOnDiscsMove = array();
	$boardOnDiscs1 = array();
	$boardOnDiscs2 = array();
	$boardOnDiscs = array($boardOnDiscsMove, $boardOnDiscs1, $boardOnDiscs2);
	for($i = 0; $i < 8; ++$i) {
		for($j = 0; $j < 8; ++$j) {
			$boardOnDiscs[0][$i][$j] = BLANK;
		}
	}
	$boardOnDiscs[0][3][3] = WHITE_DISC;
	$boardOnDiscs[0][3][4] = BLACK_DISC;
	$boardOnDiscs[0][4][3] = BLACK_DISC;
	$boardOnDiscs[0][4][4] = WHITE_DISC;
	
	
	for($i = 0; $i < $N; ++$i) {
		for($j = 0; $j < 8; ++$j) {
			for($k = 0; $k < 8; ++$k) {
				$boardOnDiscs[$i + 1][$j][$k] = $boardOnDiscs[$i][$j][$k];
			}
		}
		putDisc($boardOnDiscs[$i + 1], $pos[$i], $turn[$i]);
	}
	
	$sum = countDiscs($boardOnDiscs);
	
	return $boardOnDiscs;
	
}

print("<script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
      google.load('visualization', '1', {packages:['corechart']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['手数', '評価値'],");
          for($i = 0; $i <= $loopCount - 1; $i++) {
          	$j = $i + 1;
          	print("['$j',  $evaluationValueList[$i]]");
          	if($i != $loopCount - 1) {
          		print(", ");
          	}
          }
        print("]);

        var options = {
          title: '評価値の推移'
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
      
      
  function drawBoard(currentTurn) {  
    var canvas = document.getElementById('reversiBoard');
    if(canvas.getContext) {
      var context = canvas.getContext('2d');
      context.fillStyle = 'rgb(34, 177, 76)';
      context.fillRect(0, 0, 512, 512);
      context.fillStyle = 'rgb(0, 0, 0)';
      var frameTop = 4;
      var frameLeft = 4;
      var outerFrameWidth = 3;
      var innerFrameWidth = 2;
      var frameLength = 512;
      var frameRight = frameLeft + frameLength - outerFrameWidth;
      var frameBottom = frameTop + frameLength - outerFrameWidth;
      var squareSize = 64;
      var circleSize = 5;
      var discSize = 25;
      context.fillRect(frameLeft, frameTop, outerFrameWidth, frameLength);
      context.fillRect(frameLeft, frameTop, frameLength, outerFrameWidth);
      context.fillRect(frameRight, frameTop, outerFrameWidth, frameLength);
      context.fillRect(frameLeft, frameBottom, frameLength, outerFrameWidth);
      var counter = 1;
      while(counter < 8) {
        context.fillRect(frameLeft + counter * squareSize, frameTop, innerFrameWidth, frameLength);
        context.fillRect(frameLeft, frameTop + counter * squareSize, frameLength, innerFrameWidth);
        counter++;
      }
      drawCircle(2, 2);
      drawCircle(2, 6);
      drawCircle(6, 2);
      drawCircle(6, 6);
    
      var boardOnDiscs = ");
      echo $boardOnDiscsToJs;
      print(";
    
      drawDiscs(boardOnDiscs[currentTurn]);
      drawEvaluation(currentTurn);
    }
  
  function drawCircle(x, y) {
    context.beginPath();
    context.arc(frameLeft + squareSize * x + innerFrameWidth / 2,
      frameTop + squareSize * y  + innerFrameWidth / 2, circleSize, 0, Math.PI * 2, false);
    context.fill();
  }
  
  function drawDisc(x, y, discColor) {
    context.fillStyle = (discColor == 0) ? 'rgb(0, 0, 0)' : 'rgb(255, 255, 255)';
    context.beginPath();
    context.arc(frameLeft + squareSize * x + innerFrameWidth / 2 + squareSize / 2,
      frameTop + squareSize * y  + innerFrameWidth / 2 + squareSize / 2 , discSize, 0, Math.PI * 2, false);
    context.fill();
  }
  
  function drawDiscs(boardOnDiscs) {
    var i = 0;
    while(i < 8) {
      var j = 0;
      while(j < 8) {
        if(boardOnDiscs[i][j] != 0) {
          drawDisc(j, i, boardOnDiscs[i][j] - 1);
        }
        
        ++j;
      }
      ++i;
    }
  }
  
  function drawEvaluation(currentTurn) {
    var canvas = document.getElementById('evaluationDisplay');
    if(canvas.getContext) {
      var context = canvas.getContext('2d');
      context.font = \"64px 'メイリオ'\";
      
      var grad = context.createLinearGradient(100, 50, 100, 120);
      grad.addColorStop(0, 'rgb(255, 232, 214)');
      grad.addColorStop(1, 'rgb(255, 195, 145)');
      context.fillStyle = grad;
      context.fillRect(100, 50, 412, 70);
      context.fillStyle = 'rgb(0, 0, 0)';
      context.fillText('評価値', 110, 110);
      
      var grad2 = context.createLinearGradient(100, 200, 100, 328);
      grad2.addColorStop(0, 'rgb(236, 236, 236)');
      grad2.addColorStop(1, 'rgb(189, 189, 189)');
      context.fillStyle = grad2;
      context.fillRect(100, 200, 412, 128);
      
      var grad3 = context.createLinearGradient(100, 400, 100, 528);
      grad3.addColorStop(0, 'rgb(236, 236, 236)');
      grad3.addColorStop(1, 'rgb(189, 189, 189)');
      context.fillStyle = grad3;
      context.fillRect(100, 400, 412, 128);
     
      context.fillStyle = 'rgb(0, 0, 0)';
      context.beginPath();
      context.arc(160, 265, discSize, 0, Math.PI * 2, false);
      context.fill();
      
      context.fillStyle = 'rgb(255, 255, 255)';
      context.beginPath();
      context.arc(160, 465, discSize, 0, Math.PI * 2, false);
      context.fill();
      
      context.fillStyle = 'rgb(0, 0, 0)';
      
      var evaluationValue = ");
      echo $evaluationValueListToJs;
      print(";
      
      context.font = \"64px 'Arial Black'\";
      context.fillText(evaluationValue[currentTurn], 210, 290);
      context.fillText(-(evaluationValue[currentTurn]), 210, 490);
    }
  }
}

function onButtonClick() {
  drawBoard(parseInt(document.reversiBoardForm.moveTextBox.value));
}

function onLeftButtonClick() {
  document.reversiBoardForm.moveTextBox.value--;
  drawBoard(parseInt(document.reversiBoardForm.moveTextBox.value));
}

function onRightButtonClick() {
  document.reversiBoardForm.moveTextBox.value++;
  drawBoard(parseInt(document.reversiBoardForm.moveTextBox.value));
}
      
	</script>");

?>


	
	<div id="chart_div" style="width: 900px; height: 500px;"></div>
	<canvas id="reversiBoard" width="520" height = "520"></canvas>
	<canvas id="evaluationDisplay" width="520" height = "520"></canvas>
	<br />
	<br />
	<form name="reversiBoardForm" id="reversiBoardForm"  onSubmit="return onButtonClick()">
		<input name="moveTextBox" id="moveTextBox" type="text" value="0" />
		<input type="button" value="表示" onclick="onButtonClick();" />
		<input type="button" value="←" onclick="onLeftButtonClick();" />
		<input type="button" value="→" onclick="onRightButtonClick();" />
	</form>
</body>
</html>
