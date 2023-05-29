<?php
//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=konitan_gs_db_kadai02;charset=utf8;host=mysql57.konitan.sakura.ne.jp','konitan','mrkns10996');
} catch (PDOException $e) {
  exit('DBConectError:'.$e->getMessage());
}

//２．データ登録SQL作成
$sql = "SELECT * FROM gs_an_kadai02_table;";
$stmt = $pdo->prepare("$sql");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONい値を渡す場合に使う
$json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>メディアアート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->


<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
<table>
    <tr>
        <th>作家名</th>
        <th>国</th>
        <th>キーワード</th>
        <th>作品名</th>
        <th>発表年</th>
        <th>解説</th>
        <th>参照url</th>
    </tr>
<?php foreach($values as $v){ ?> 　<!--これはよく使う -->
        <tr> 
         <td><?=$v["name"]?></td>
         <td><?=$v["nationality"]?></td>
         <td><?=$v["keyword"]?></td> 
         <td><?=$v["title"]?></td>
         <td><?=$v["year"]?></td> 
         <td><?=$v["commentary"]?></td>
         <td><a href="<?=$v["url"]?>"><?=$v["url"]?></a></td>
        </tr>
<?php } ?>
</table>
    </div>
</div>
<!-- Main[End] -->


<script>
  //JSON受け取り
  const json = JSON.parse('<?=$json?>');
  console.log(json);


</script>
</body>
</html>
