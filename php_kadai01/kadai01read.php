<?php
    $file = fopen("kadai01data.txt", "r");
    $dataArray = [];
    
    while (($line = fgets($file)) !== false) {
        $data = explode(",", $line);
        $date = $data[0];
        $temperature = $data[3];
        $dataArray[] = [$date, (float) $temperature];
    }
    
    fclose($file);
    
?>

<html>
<head>
<meta charset="utf-8">
<title>kadai01Dataを表示する</title>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<style>
    table {
        border-collapse: collapse;
        width: 80%;
    }

    th, td {
        border: 2px solid black;
        padding: 8px;
        text-align: right;
    }
    #chart_div {
        width: 80%;
        height: 400px;
        margin-top: 20px;
    }
</style>

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'line']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', '日時');
      data.addColumn('number', '体温');

      <?php
      echo "data.addRows(" . json_encode($dataArray) . ");";
      ?>

      var options = {
        title: '体温推移',
        curveType: 'function',
        legend: { position: 'bottom' },
        colors:["red"],
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
</script>
</head>
<body>
<h1>体調記録</h1>

<?php
$file = fopen("kadai01data.txt", "r");
if ($file) {
    echo "<table>";
    echo "<tr>";
    echo "<th>記録日時</th>";
    echo "<th>お名前</th>";
    echo "<th>体調（10点満点で）</th>";
    echo "<th>体温</th>";
    echo "<th>睡眠時間</th>";
    echo "<th>コンディションメモ</th>";
    echo "</tr>";

    while (($line = fgets($file)) !== false) {
        $data = explode(",", $line);
        $date = $data[0];
        $name = $data[1];
        $condition = $data[2];
        $temperature = $data[3];
        $sleeping = $data[4];
        $memo = $data[5];

        echo "<tr>";
        echo "<td>" . $date . "</td>";
        echo "<td>" . $name . "</td>";
        echo "<td>" . $condition . "</td>";
        echo "<td>" . $temperature . "</td>";
        echo "<td>" . $sleeping . "</td>";
        echo "<td>" . $memo . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    fclose($file);
} else {
    echo "ファイルを開けませんでした。";
}
?>

<div id="chart_div"></div>

<ul>
<li><a href="kadai01post.php">戻る</a></li>
</ul>
</body>
</html>
