<?php
$name = $_POST["name"];
$condition = $_POST["condition"];
$temperature = $_POST["temperature"];
$sleeping = $_POST["sleeping"];
$memo = $_POST["memo"];
$c = ",";

//文字作成
$str = date("Y-m-d H:i:s");
$str .= $c.$name.$c.$condition.$c.$temperature.$c.$sleeping.$c.$memo;//←表示について

//File書き込み
$file = fopen("kadai01data.txt","a");	// ファイル読み込み
fwrite($file, $str."\n");//""に入れること
fclose($file);
?>


<html>
<head>
<meta charset="utf-8">
<title>kadai01File書き込み</title>
</head>
<body>

<!-- <h1>書き込みしました。</h1>
<h2>./data/kadai01data.txt を確認しましょう！</h2> -->
<div><?=$str?></div>
    
<?php 
    header("Location: kadai01read.php ");
?>

<ul>
<li><a href="input.php">戻る</a></li>
</ul>
</body>
</html>