<?php
//1. POSTデータ取得
$name  = $_POST["name"];
$email = $_POST["email"];
$age   = $_POST["age"];
$naiyou = $_POST["naiyou"];


//2. DB接続します(db名を間違えない！テーブル名ではない)
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConectError:'.$e->getMessage());
}


//３．データ登録SQL作成　ここはINSERT INTOテーブル名
$sql = "INSERT INTO gs_an_table(name,email,naiyou,age,indate)VALUES(:name, :email, :naiyou, :age, sysdate());";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',  $name,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':age',   $age,   PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou',$naiyou,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
 header("Location: index.php"); //indexの前の半角スペースは必ず！
 exit();
}
?>
